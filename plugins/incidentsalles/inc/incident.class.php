<?php

class PluginIncidentsallesIncident extends CommonDBTM {
   
   static $rightname = 'config';

   static function getTypeName($nb = 0) {
      return _n('Incident en Salle', 'Incidents en Salles', $nb, 'incidentsalles');
   }

   function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {
      if ($item->getType() == 'Ticket') {
         return self::getTypeName(Session::getPluralNumber());
      }
      return '';
   }

   static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {
      if ($item->getType() == 'Ticket') {
         self::showForTicket($item);
      }
      return true;
   }

   static function showForTicket(Ticket $ticket) {
      global $DB;

      $iterator = $DB->request([
         'FROM'   => 'glpi_plugin_incidentsalles_incidents',
         'WHERE'  => ['entities_id' => $ticket->fields['entities_id']],
         'ORDER'  => 'date_creation DESC'
      ]);

      echo "<div class='center'>";
      echo "<table class='tab_cadre_fixe'>";
      echo "<tr><th colspan='6'>Incidents en Salles</th></tr>";
      echo "<tr>";
      echo "<th>Salle</th>";
      echo "<th>Type</th>";
      echo "<th>Description</th>";
      echo "<th>Statut</th>";
      echo "<th>Priorité</th>";
      echo "<th>Date</th>";
      echo "</tr>";

      foreach ($iterator as $data) {
         $days_open = self::getDaysOpen($data['date_creation'], $data['date_resolution']);
         $row_class = ($days_open > 7 && $data['status'] != 'resolu') ? "style='background-color: #ffcccc;'" : "";
         
         echo "<tr $row_class>";
         echo "<td>" . $data['salle'] . "</td>";
         echo "<td>" . $data['type_incident'] . "</td>";
         echo "<td>" . $data['description'] . "</td>";
         echo "<td>" . $data['status'] . "</td>";
         echo "<td>" . $data['priority'] . "</td>";
         echo "<td>" . Html::convDateTime($data['date_creation']) . "</td>";
         echo "</tr>";
      }

      echo "</table>";
      echo "</div>";
   }

   static function getDaysOpen($date_creation, $date_resolution) {
      if ($date_resolution) {
         $start = new DateTime($date_creation);
         $end = new DateTime($date_resolution);
         return $start->diff($end)->days;
      }
      $start = new DateTime($date_creation);
      $now = new DateTime();
      return $start->diff($now)->days;
   }

   function showForm($ID, array $options = []) {
      $this->initForm($ID, $options);
      $this->showFormHeader($options);

      echo "<tr class='tab_bg_1'>";
      echo "<td>" . __('Salle', 'incidentsalles') . "</td>";
      echo "<td>";
      echo "<input type='text' name='salle' value='" . $this->fields['salle'] . "' style='width:95%;'>";
      echo "</td>";
      echo "<td>" . __('Type d\'incident', 'incidentsalles') . "</td>";
      echo "<td>";
      Dropdown::showFromArray('type_incident', [
         'materiel_defectueux' => 'Matériel défectueux',
         'panne_reseau'        => 'Panne réseau',
         'probleme_logiciel'   => 'Problème logiciel',
         'probleme_projection' => 'Problème de projection',
         'climatisation'       => 'Climatisation',
         'electricite'         => 'Électricité',
         'autre'               => 'Autre'
      ], ['value' => $this->fields['type_incident']]);
      echo "</td>";
      echo "</tr>";

      echo "<tr class='tab_bg_1'>";
      echo "<td>" . __('Date incident', 'incidentsalles') . "</td>";
      echo "<td>";
      Html::showDateField('date_incident', ['value' => $this->fields['date_incident']]);
      echo "</td>";
      echo "<td>" . __('Heure incident', 'incidentsalles') . "</td>";
      echo "<td>";
      echo "<input type='time' name='heure_incident' value='" . $this->fields['heure_incident'] . "'>";
      echo "</td>";
      echo "</tr>";

      echo "<tr class='tab_bg_1'>";
      echo "<td>" . __('Équipement', 'incidentsalles') . "</td>";
      echo "<td>";
      echo "<input type='text' name='equipement' value='" . $this->fields['equipement'] . "' style='width:95%;'>";
      echo "</td>";
      echo "<td>" . __('Statut', 'incidentsalles') . "</td>";
      echo "<td>";
      Dropdown::showFromArray('status', [
         'nouveau'     => 'Nouveau',
         'en_cours'    => 'En cours',
         'resolu'      => 'Résolu',
         'ferme'       => 'Fermé'
      ], ['value' => $this->fields['status']]);
      echo "</td>";
      echo "</tr>";

      echo "<tr class='tab_bg_1'>";
      echo "<td>" . __('Priorité', 'incidentsalles') . "</td>";
      echo "<td>";
      Dropdown::showFromArray('priority', [
         1 => 'Très basse',
         2 => 'Basse',
         3 => 'Moyenne',
         4 => 'Haute',
         5 => 'Très haute'
      ], ['value' => $this->fields['priority']]);
      echo "</td>";
      echo "<td colspan='2'></td>";
      echo "</tr>";

      echo "<tr class='tab_bg_1'>";
      echo "<td>" . __('Description', 'incidentsalles') . "</td>";
      echo "<td colspan='3'>";
      echo "<textarea name='description' rows='5' style='width:100%'>" . 
           $this->fields['description'] . "</textarea>";
      echo "</td>";
      echo "</tr>";

      $this->showFormButtons($options);

      return true;
   }

   function prepareInputForAdd($input) {
      $input['date_creation'] = $_SESSION['glpi_currenttime'];
      $input['users_id'] = Session::getLoginUserID();
      return $input;
   }

   function prepareInputForUpdate($input) {
      if (isset($input['status']) && $input['status'] == 'resolu' && !$this->fields['date_resolution']) {
         $input['date_resolution'] = $_SESSION['glpi_currenttime'];
      }
      return $input;
   }

   function rawSearchOptions() {
      $tab = [];

      $tab[] = [
         'id'   => 'common',
         'name' => self::getTypeName(1)
      ];

      $tab[] = [
         'id'            => '1',
         'table'         => $this->getTable(),
         'field'         => 'salle',
         'name'          => __('Salle'),
         'datatype'      => 'text'
      ];

      $tab[] = [
         'id'            => '2',
         'table'         => $this->getTable(),
         'field'         => 'type_incident',
         'name'          => __('Type'),
         'datatype'      => 'text'
      ];

      $tab[] = [
         'id'            => '3',
         'table'         => $this->getTable(),
         'field'         => 'description',
         'name'          => __('Description'),
         'datatype'      => 'text'
      ];

      $tab[] = [
         'id'            => '4',
         'table'         => $this->getTable(),
         'field'         => 'status',
         'name'          => __('Statut'),
         'datatype'      => 'text'
      ];

      $tab[] = [
         'id'            => '5',
         'table'         => $this->getTable(),
         'field'         => 'priority',
         'name'          => __('Priorité'),
         'datatype'      => 'number'
      ];

      $tab[] = [
         'id'            => '6',
         'table'         => $this->getTable(),
         'field'         => 'date_creation',
         'name'          => __('Date création'),
         'datatype'      => 'datetime'
      ];

      $tab[] = [
         'id'            => '7',
         'table'         => $this->getTable(),
         'field'         => 'equipement',
         'name'          => __('Équipement'),
         'datatype'      => 'text'
      ];

      return $tab;
   }
}
