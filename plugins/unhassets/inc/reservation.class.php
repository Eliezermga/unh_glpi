<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginUnhassetsReservation extends CommonDBTM {

    static $rightname = 'plugin_unhassets';
    
    static function getTypeName($nb = 0) {
        return _n('Réservation', 'Réservations', $nb, 'unhassets');
    }

    public static function getTable($classname = null) {
      return 'glpi_plugin_unhassets_reservations';
   }

   public static function getSearchURL($full = true) {
      return Plugin::getWebDir('unhassets', $full) . "/front/reservation.php";
   }

   public static function getFormURL($full = true) {
      return Plugin::getWebDir('unhassets', $full) . "/front/reservation.form.php";
   }

   /**
    * Le bouton "+" (Ajouter) dans les listes GLPI n'est affiché que si
    * canCreate() retourne true.
    *
    * Selon la configuration des profils, un plugin expose parfois uniquement
    * Lecture/Écriture, et "Écriture" est fréquemment mappé sur UPDATE.
    * On accepte donc CREATE ou UPDATE.
    *
    * En Super-Admin, le droit "config" (UPDATE) doit aussi permettre la création
    * afin d'éviter une UI en lecture seule si le droit plugin n'est pas encore
    * correctement initialisé sur le profil.
    */
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

    // Garde défensive : empêche l'injection de nos options de recherche
    // dans les types natifs (Monitor, Computer...) → évite "Duplicate key 23"
    static function getSearchOptionsToAdd($itemtype = null) {
        return [];
    }


    function defineTabs($options = []) {
        $ong = [];
        $this->addDefaultFormTab($ong);
        $this->addStandardTab('Log', $ong, $options);
        return $ong;
    }

    function showForm($ID, $options = []) {
        global $DB;

        $this->initForm($ID, $options);
        $this->showFormHeader($options);

        echo "<tr class='tab_bg_1'>";
        
        echo "<td>".__('Équipement', 'unhassets')."</td>";
        echo "<td>";
        
        // Liste des assets disponibles
        $assets = [];
        $iterator = $DB->request([
            'SELECT' => ['id', 'name', 'asset_category', 'building', 'room'],
            'FROM'   => 'glpi_plugin_unhassets_assets',
            'WHERE'  => [
                'status' => 'active',
                'is_deleted' => 0
            ]
        ]);

        foreach ($iterator as $asset) {
            $label = $asset['name'] . " (" . $asset['asset_category'] . ")";
            if ($asset['building']) {
                $label .= " - " . $asset['building'];
            }
            if ($asset['room']) {
                $label .= " / " . $asset['room'];
            }
            $assets[$asset['id']] = $label;
        }

        Dropdown::showFromArray('assets_id', $assets, [
            'value' => $this->fields['assets_id'] ?? 0
        ]);
        echo "</td>";

        echo "<td>".__('Utilisateur', 'unhassets')."</td>";
        echo "<td>";
        User::dropdown([
            'name'   => 'users_id',
            'value'  => $this->fields['users_id'] ?? Session::getLoginUserID(),
            'right'  => 'all'
        ]);
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Date de réservation', 'unhassets')."</td>";
        echo "<td>";
        Html::showDateField('reservation_date', [
            'value' => $this->fields['reservation_date'] ?? date('Y-m-d')
        ]);
        echo "</td>";

        echo "<td>".__('Statut', 'unhassets')."</td>";
        echo "<td>";
        $statuses = [
            'pending'   => __('En attente', 'unhassets'),
            'approved'  => __('Approuvée', 'unhassets'),
            'rejected'  => __('Rejetée', 'unhassets'),
            'completed' => __('Terminée', 'unhassets'),
            'cancelled' => __('Annulée', 'unhassets')
        ];
        Dropdown::showFromArray('status', $statuses, [
            'value' => $this->fields['status'] ?? 'pending'
        ]);
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Heure de début', 'unhassets')."</td>";
        echo "<td>";
        Html::showDateTimeField('start_time', [
            'value' => $this->fields['start_time'] ?? ''
        ]);
        echo "</td>";

        echo "<td>".__('Heure de fin', 'unhassets')."</td>";
        echo "<td>";
        Html::showDateTimeField('end_time', [
            'value' => $this->fields['end_time'] ?? ''
        ]);
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Objet de la réservation', 'unhassets')."</td>";
        echo "<td colspan='3'>";
        echo "<textarea name='purpose' rows='3' cols='80'>";
        echo $this->fields['purpose'] ?? '';
        echo "</textarea>";
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Commentaire', 'unhassets')."</td>";
        echo "<td colspan='3'>";
        echo "<textarea name='comment' rows='3' cols='80'>";
        echo $this->fields['comment'] ?? '';
        echo "</textarea>";
        echo "</td>";
        echo "</tr>";

        $this->showFormButtons($options);

        return true;
    }

    function prepareInputForAdd($input) {
        // Vérifier les conflits de réservation
        if ($this->hasConflict($input)) {
            Session::addMessageAfterRedirect(
                __('Cette plage horaire est déjà réservée pour cet équipement', 'unhassets'),
                false,
                ERROR
            );
            return false;
        }

        $input['entities_id'] = $_SESSION['glpiactive_entity'];
        $input['date_creation'] = $_SESSION['glpi_currenttime'];
        
        // Envoi de notification
        $this->sendNotification($input, 'new');
        
        return $input;
    }

    function prepareInputForUpdate($input) {
        $input['date_mod'] = $_SESSION['glpi_currenttime'];
        
        // Notification si changement de statut
        if (isset($input['status']) && $input['status'] != $this->fields['status']) {
            $this->sendNotification($input, 'update');
        }
        
        return $input;
    }

    function hasConflict($input) {
        global $DB;

        $assets_id = $input['assets_id'] ?? 0;
        $start_time = $input['start_time'] ?? '';
        $end_time = $input['end_time'] ?? '';
        $id = $input['id'] ?? 0;

        if (empty($assets_id) || empty($start_time) || empty($end_time)) {
            return false;
        }

        $where = [
            'assets_id' => $assets_id,
            'status'    => ['pending', 'approved'],
            'OR'        => [
                [
                    'start_time' => ['<', $end_time],
                    'end_time'   => ['>', $start_time]
                ]
            ]
        ];

        if ($id > 0) {
            $where['id'] = ['!=', $id];
        }

        $iterator = $DB->request([
            'FROM'  => $this->getTable(),
            'WHERE' => $where
        ]);

        return count($iterator) > 0;
    }

    function sendNotification($input, $type) {
        // Récupérer l'utilisateur
        $user = new User();
        $user->getFromDB($input['users_id'] ?? 0);

        $subject = '';
        $message = '';

        if ($type == 'new') {
            $subject = __('Nouvelle réservation créée', 'unhassets');
            $message = sprintf(
                __('Votre réservation a été créée et est en attente de validation.', 'unhassets')
            );
        } elseif ($type == 'update') {
            $status_label = [
                'approved'  => __('approuvée', 'unhassets'),
                'rejected'  => __('rejetée', 'unhassets'),
                'completed' => __('terminée', 'unhassets'),
                'cancelled' => __('annulée', 'unhassets')
            ];
            $subject = __('Statut de réservation modifié', 'unhassets');
            $message = sprintf(
                __('Votre réservation a été %s.', 'unhassets'),
                $status_label[$input['status']] ?? $input['status']
            );
        }

        // Utiliser le système de notification GLPI
        NotificationEvent::raiseEvent('reservation_' . $type, $this, [
            'subject' => $subject,
            'message' => $message
        ]);
    }

    public function rawSearchOptions() {

        return [

            [
                'id'            => 5101,
                'table'         => $this->getTable(),
                'field'         => 'id',
                'name'          => __('ID', 'unhassets'),
                'datatype'      => 'number',
                'massiveaction' => false,
            ],

            [
                'id'       => 5102,
                'table'    => $this->getTable(),
                'field'    => 'reservation_date',
                'name'     => __('Reservation Date', 'unhassets'),
                'datatype' => 'date',
            ],

            [
                'id'       => 5103,
                'table'    => $this->getTable(),
                'field'    => 'status',
                'name'     => __('Status', 'unhassets'),
                'datatype' => 'string',
            ],

            [
                'id'       => 5104,
                'table'    => $this->getTable(),
                'field'    => 'purpose',
                'name'     => __('Purpose', 'unhassets'),
                'datatype' => 'text',
            ],

            [
                'id'       => 5105,
                'table'    => $this->getTable(),
                'field'    => 'is_approved',
                'name'     => __('Approved', 'unhassets'),
                'datatype' => 'bool',
            ],

            [
                'id'       => 5106,
                'table'    => $this->getTable(),
                'field'    => 'comment',
                'name'     => __('Comment', 'unhassets'),
                'datatype' => 'text',
            ],
        ];
    }
}