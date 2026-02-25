<?php

if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access this file directly");
}

class PluginUnhassetsLicense extends CommonDBTM {

   static $rightname = 'plugin_unhassets';

   static function getTypeName($nb = 0) {
      return _n('Licence', 'Licences', $nb, 'unhassets');
   }

   public static function getTable($classname = null) {
      return 'glpi_plugin_unhassets_licenses';
   }

   public static function getSearchURL($full = true) {
      return Plugin::getWebDir('unhassets', $full) . "/front/license.php";
   }

   public static function getFormURL($full = true) {
      return Plugin::getWebDir('unhassets', $full) . "/front/license.form.php";
   }

   // --- DROITS ---

   public static function canCreate() {
      return Session::haveRight(self::$rightname, CREATE)
         || Session::haveRight(self::$rightname, UPDATE)
         || Session::haveRight('config', UPDATE);
   }

   public static function canUpdate() {
      return Session::haveRight(self::$rightname, UPDATE)
         || Session::haveRight('config', UPDATE);
   }

   public static function canDelete() {
      return Session::haveRight(self::$rightname, DELETE)
         || Session::haveRight(self::$rightname, UPDATE)
         || Session::haveRight('config', UPDATE);
   }

   static function canView() {
      return Session::haveRight(self::$rightname, READ)
         || Session::haveRight('config', READ);
   }

   function defineTabs($options = []) {
      $ong = [];
      $this->addDefaultFormTab($ong);
      $this->addStandardTab('Log', $ong, $options);
      return $ong;
   }

   // --- LOGIQUE MÉTIER ET STATUTS ---

   public static function getStatuses(): array {
      return [
         'active'    => __('Active', 'unhassets'),
         'expired'   => __('Expirée', 'unhassets'),
         'inactive'  => __('Inactive', 'unhassets'),
         'validated' => __('Validée', 'unhassets'),
      ];
   }

   private function normalizeDate($date): string {
      $date = trim((string)$date);
      if ($date === '') {
         return '';
      }
      $ts = strtotime($date);
      return ($ts === false) ? '' : date('Y-m-d', $ts);
   }

   private function computeStatusFromExpiration(string $expiration_date): ?string {
      if ($expiration_date === '') {
         return null;
      }
      $exp = strtotime($expiration_date . ' 23:59:59');
      if ($exp !== false && $exp < time()) {
         return 'expired';
      }
      return null;
   }

   /**
    * Centralise les règles métiers et corrige l'erreur Deprecated de GLPI 10
    */
   private function validateBusinessLogic(array $input): array|false {
      
      // 1. Correction Deprecated : Nettoyage conforme GLPI 10
      if (isset($input['comment'])) {
         $input['comment'] = \Glpi\RichText\RichText::getSafeHtml($input['comment']);
      }

      // 2. Gestion des dates
      $purchase_date   = $this->normalizeDate($input['purchase_date'] ?? ($this->fields['purchase_date'] ?? ''));
      $expiration_date = $this->normalizeDate($input['expiration_date'] ?? ($this->fields['expiration_date'] ?? ''));

      if (array_key_exists('purchase_date', $input)) $input['purchase_date'] = $purchase_date;
      if (array_key_exists('expiration_date', $input)) $input['expiration_date'] = $expiration_date;

      if ($purchase_date !== '' && $expiration_date !== '') {
         if (strtotime($purchase_date) >= strtotime($expiration_date)) {
            Session::addMessageAfterRedirect(__('La date d’achat doit être antérieure à la date d’expiration.', 'unhassets'), false, ERROR);
            return false;
         }
      }

      // 3. Quotas
      $total = isset($input['number_licenses']) ? (int)$input['number_licenses'] : (int)($this->fields['number_licenses'] ?? 1);
      $used  = isset($input['used_licenses']) ? (int)$input['used_licenses'] : (int)($this->fields['used_licenses'] ?? 0);

      if ($total > 0 && $used > $total) {
         Session::addMessageAfterRedirect(__('Le nombre de licences utilisées ne peut pas dépasser le total.', 'unhassets'), false, ERROR);
         return false;
      }

      // 4. Statut automatique
      $forced = $this->computeStatusFromExpiration($expiration_date);
      if ($forced === 'expired') {
         $input['status'] = 'expired';
      }

      return $input;
   }

   // --- FORMULAIRE ---

   function showForm($ID, $options = []) {
      $this->initForm($ID, $options);
      $this->showFormHeader($options);

      // Nom et Logiciel
      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Nom de la licence', 'unhassets')."</td>";
      echo "<td><input type='text' name='name' value='".Html::cleanInputText($this->fields['name'] ?? '')."' size='40' required></td>";
      echo "<td>".__('Logiciel', 'unhassets')."</td>";
      echo "<td><input type='text' name='software_name' value='".Html::cleanInputText($this->fields['software_name'] ?? '')."' size='40'></td>";
      echo "</tr>";

      // Version et Type
      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Version', 'unhassets')."</td>";
      echo "<td><input type='text' name='version' value='".Html::cleanInputText($this->fields['version'] ?? '')."' size='20'></td>";
      echo "<td>".__('Type de licence', 'unhassets')."</td>";
      echo "<td>";
      $types = [
         'perpetual'    => __('Perpétuelle', 'unhassets'),
         'subscription' => __('Abonnement', 'unhassets'),
         'trial'        => __('Essai', 'unhassets'),
         'volume'       => __('Volume', 'unhassets'),
         'oem'          => __('OEM', 'unhassets')
      ];
      Dropdown::showFromArray('license_type', $types, ['value' => $this->fields['license_type'] ?? '']);
      echo "</td>";
      echo "</tr>";

      // Clé et Fournisseur
      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Clé de licence', 'unhassets')."</td>";
      echo "<td><input type='text' name='license_key' value='".Html::cleanInputText($this->fields['license_key'] ?? '')."' size='40'></td>";
      echo "<td>".__('Fournisseur', 'unhassets')."</td>";
      echo "<td><input type='text' name='supplier' value='".Html::cleanInputText($this->fields['supplier'] ?? '')."' size='40'></td>";
      echo "</tr>";

      // Dates
      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Date d\'achat', 'unhassets')."</td>";
      echo "<td>";
      Html::showDateField('purchase_date', ['value' => $this->fields['purchase_date'] ?? '']);
      echo "</td>";
      echo "<td>".__('Date d\'expiration', 'unhassets')."</td>";
      echo "<td>";
      Html::showDateField('expiration_date', ['value' => $this->fields['expiration_date'] ?? '']);
      
      if (!empty($this->fields['expiration_date'])) {
         $days = (int)floor((strtotime($this->fields['expiration_date']) - time()) / 86400);
         if ($days <= 30 && $days > 0) echo " <span style='color:orange;'>Expire dans $days j</span>";
         elseif ($days <= 0) echo " <span style='color:red;font-weight:bold;'>EXPIRÉE</span>";
      }
      echo "</td>";
      echo "</tr>";

      // Quotas
      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Total licences', 'unhassets')."</td>";
      echo "<td><input type='number' name='number_licenses' value='".(int)($this->fields['number_licenses'] ?? 1)."' min='1'></td>";
      echo "<td>".__('Utilisées', 'unhassets')."</td>";
      echo "<td><input type='number' name='used_licenses' value='".(int)($this->fields['used_licenses'] ?? 0)."' min='0'>";
      if (isset($this->fields['number_licenses'])) {
         $avail = (int)$this->fields['number_licenses'] - (int)($this->fields['used_licenses'] ?? 0);
         echo " <small>(Dispo: $avail)</small>";
      }
      echo "</td>";
      echo "</tr>";

      // Statut et Seuil
      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Statut', 'unhassets')."</td>";
      echo "<td>";
      Dropdown::showFromArray('status', self::getStatuses(), ['value' => $this->fields['status'] ?? 'active']);
      echo "</td>";
      echo "<td>".__('Seuil d\'alerte (jours)', 'unhassets')."</td>";
      echo "<td><input type='number' name='alert_threshold' value='".(int)($this->fields['alert_threshold'] ?? 30)."' min='1'></td>";
      echo "</tr>";

      // Commentaire (FIX DEPRECATED)
      echo "<tr class='tab_bg_1'>";
      echo "<td>".__('Commentaire', 'unhassets')."</td>";
      echo "<td colspan='3'>";
      echo "<textarea name='comment' rows='4' style='width:97%'>";
      echo \Glpi\RichText\RichText::getSafeHtml($this->fields['comment'] ?? '');
      echo "</textarea>";
      echo "</td>";
      echo "</tr>";

      // Zone bouton VALIDER
      if ($ID > 0) {
         echo "<tr class='tab_bg_2'><td colspan='4' class='center'>";
         echo "<input type='hidden' name='id' value='".(int)$ID."'>";
         echo "<input type='submit' name='validate' value=\"".__('Valider cette licence', 'unhassets')."\" class='vsubmit' style='background-color:#28a745;color:#fff;padding:8px 20px;border:none;border-radius:3px;cursor:pointer;font-weight:bold;'>";
         echo "</td></tr>";
      }

      $this->showFormButtons($options);
      return true;
   }

   // --- PREPARE INPUT ---

   function prepareInputForAdd($input) {
      $input['entities_id'] = $_SESSION['glpiactive_entity'];
      $input['date_creation'] = $_SESSION['glpi_currenttime'];
      return $this->validateBusinessLogic($input);
   }

   function prepareInputForUpdate($input) {
      $input['date_mod'] = $_SESSION['glpi_currenttime'];
      return $this->validateBusinessLogic($input);
   }

   // --- RECHERCHE ET CRON ---

   public function rawSearchOptions() {
      $tab = [];
      $tab[] = ['id' => '1', 'table' => $this->getTable(), 'field' => 'name', 'name' => __('Nom', 'unhassets'), 'datatype' => 'itemlink'];
      $tab[] = ['id' => '2', 'table' => $this->getTable(), 'field' => 'software_name', 'name' => __('Logiciel', 'unhassets'), 'datatype' => 'string'];
      $tab[] = ['id' => '3', 'table' => $this->getTable(), 'field' => 'status', 'name' => __('Statut', 'unhassets'), 'datatype' => 'string'];
      $tab[] = ['id' => '4', 'table' => $this->getTable(), 'field' => 'expiration_date', 'name' => __('Expiration', 'unhassets'), 'datatype' => 'date'];
      return $tab;
   }

   static function cronCheckExpiration($task) {
      global $DB;
      $cron_count = 0;
      $iterator = $DB->request(['FROM' => 'glpi_plugin_unhassets_licenses', 'WHERE' => ['is_deleted' => 0, 'status' => 'active', 'expiration_date' => ['<', date('Y-m-d', strtotime('+30 days'))]]]);
      foreach ($iterator as $data) {
         Toolbox::logInFile('unhassets_licenses', "Alerte expiration : ".$data['name']."\n");
         $cron_count++;
      }
      $task->addVolume($cron_count);
      return 1;
   }
}