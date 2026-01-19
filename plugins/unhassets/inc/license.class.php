<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginUnhassetsLicense extends CommonDBTM {

    static $rightname = 'plugin_unhassets';
    
    static function getTypeName($nb = 0) {
        return _n('Licence', 'Licences', $nb, 'unhassets');
    }

    function defineTabs($options = []) {
        $ong = [];
        $this->addDefaultFormTab($ong);
        $this->addStandardTab('Log', $ong, $options);
        return $ong;
    }

    function showForm($ID, $options = []) {
        $this->initForm($ID, $options);
        $this->showFormHeader($options);

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Nom de la licence', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='text' name='name' value='".($this->fields['name'] ?? '')."' size='40'>";
        echo "</td>";

        echo "<td>".__('Logiciel', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='text' name='software_name' value='".($this->fields['software_name'] ?? '')."' size='40'>";
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Version', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='text' name='version' value='".($this->fields['version'] ?? '')."' size='20'>";
        echo "</td>";

        echo "<td>".__('Type de licence', 'unhassets')."</td>";
        echo "<td>";
        $types = [
            'perpetual'    => __('Perpétuelle', 'unhassets'),
            'subscription' => __('Abonnement', 'unhassets'),
            'trial'        => __('Essai', 'unhassets'),
            'volume'       => __('Volume', 'unhassets'),
            'oem'          => __('OEM', 'unhassets')
        ];
        Dropdown::showFromArray('license_type', $types, [
            'value' => $this->fields['license_type'] ?? ''
        ]);
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Clé de licence', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='text' name='license_key' value='".($this->fields['license_key'] ?? '')."' size='40'>";
        echo "</td>";

        echo "<td>".__('Fournisseur', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='text' name='supplier' value='".($this->fields['supplier'] ?? '')."' size='40'>";
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Date d\'achat', 'unhassets')."</td>";
        echo "<td>";
        Html::showDateField('purchase_date', [
            'value' => $this->fields['purchase_date'] ?? ''
        ]);
        echo "</td>";

        echo "<td>".__('Date d\'expiration', 'unhassets')."</td>";
        echo "<td>";
        Html::showDateField('expiration_date', [
            'value' => $this->fields['expiration_date'] ?? ''
        ]);
        // Afficher un warning si proche de l'expiration
        if (!empty($this->fields['expiration_date'])) {
            $exp_date = strtotime($this->fields['expiration_date']);
            $today = time();
            $days_left = floor(($exp_date - $today) / (60 * 60 * 24));
            
            if ($days_left <= 30 && $days_left > 0) {
                echo " <span style='color: orange;'>";
                echo sprintf(__('Expire dans %d jours', 'unhassets'), $days_left);
                echo "</span>";
            } elseif ($days_left <= 0) {
                echo " <span style='color: red; font-weight: bold;'>";
                echo __('EXPIRÉE', 'unhassets');
                echo "</span>";
            }
        }
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Nombre de licences', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='number' name='number_licenses' value='".($this->fields['number_licenses'] ?? 1)."' min='1'>";
        echo "</td>";

        echo "<td>".__('Licences utilisées', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='number' name='used_licenses' value='".($this->fields['used_licenses'] ?? 0)."' min='0'>";
        if (isset($this->fields['number_licenses']) && isset($this->fields['used_licenses'])) {
            $available = $this->fields['number_licenses'] - $this->fields['used_licenses'];
            echo " <span style='margin-left: 10px;'>";
            echo sprintf(__('Disponibles: %d', 'unhassets'), $available);
            echo "</span>";
        }
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Département', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='text' name='department' value='".($this->fields['department'] ?? '')."' size='40'>";
        echo "</td>";

        echo "<td>".__('Seuil d\'alerte (jours)', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='number' name='alert_threshold' value='".($this->fields['alert_threshold'] ?? 30)."' min='1'>";
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Statut', 'unhassets')."</td>";
        echo "<td>";
        $statuses = [
            'active'   => __('Active', 'unhassets'),
            'expired'  => __('Expirée', 'unhassets'),
            'inactive' => __('Inactive', 'unhassets')
        ];
        Dropdown::showFromArray('status', $statuses, [
            'value' => $this->fields['status'] ?? 'active'
        ]);
        echo "</td>";
        echo "<td colspan='2'></td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Commentaire', 'unhassets')."</td>";
        echo "<td colspan='3'>";
        echo "<textarea name='comment' rows='4' cols='80'>";
        echo $this->fields['comment'] ?? '';
        echo "</textarea>";
        echo "</td>";
        echo "</tr>";

        $this->showFormButtons($options);

        return true;
    }

    function prepareInputForAdd($input) {
        $input['entities_id'] = $_SESSION['glpiactive_entity'];
        $input['date_creation'] = $_SESSION['glpi_currenttime'];
        
        // Mettre à jour le statut selon la date d'expiration
        if (!empty($input['expiration_date'])) {
            $exp_date = strtotime($input['expiration_date']);
            if ($exp_date < time()) {
                $input['status'] = 'expired';
            }
        }
        
        return $input;
    }

    function prepareInputForUpdate($input) {
        $input['date_mod'] = $_SESSION['glpi_currenttime'];
        
        // Mettre à jour le statut selon la date d'expiration
        if (!empty($input['expiration_date'])) {
            $exp_date = strtotime($input['expiration_date']);
            if ($exp_date < time()) {
                $input['status'] = 'expired';
            }
        }
        
        return $input;
    }

    /**
     * Vérifier les licences qui approchent de l'expiration
     */
    static function cronCheckExpiration($task) {
        global $DB;

        $today = date('Y-m-d');
        $cron_count = 0;

        $iterator = $DB->request([
            'FROM'  => 'glpi_plugin_unhassets_licenses',
            'WHERE' => [
                'is_deleted' => 0,
                'status'     => 'active',
                'expiration_date' => ['>', $today]
            ]
        ]);

        foreach ($iterator as $data) {
            $exp_date = strtotime($data['expiration_date']);
            $threshold = $data['alert_threshold'] ?? 30;
            $alert_date = strtotime("-{$threshold} days", $exp_date);

            if (time() >= $alert_date) {
                $days_left = floor(($exp_date - time()) / (60 * 60 * 24));
                
                // Envoyer une alerte
                $message = sprintf(
                    __('La licence "%s" expire dans %d jours (date d\'expiration: %s)', 'unhassets'),
                    $data['name'],
                    $days_left,
                    $data['expiration_date']
                );

                // Logger l'alerte
                Toolbox::logInFile('unhassets_licenses', $message . "\n");
                
                $cron_count++;
            }
        }

        $task->addVolume($cron_count);
        return 1;
    }

    function rawSearchOptions() {
        $tab = [];

        $tab[] = [
            'id'   => 'common',
            'name' => __('Caractéristiques')
        ];

        $tab[] = [
            'id'            => '1',
            'table'         => $this->getTable(),
            'field'         => 'name',
            'name'          => __('Nom'),
            'datatype'      => 'itemlink',
            'massiveaction' => false
        ];

        $tab[] = [
            'id'       => '2',
            'table'    => $this->getTable(),
            'field'    => 'software_name',
            'name'     => __('Logiciel', 'unhassets'),
            'datatype' => 'text'
        ];

        $tab[] = [
            'id'       => '3',
            'table'    => $this->getTable(),
            'field'    => 'version',
            'name'     => __('Version', 'unhassets'),
            'datatype' => 'text'
        ];

        $tab[] = [
            'id'       => '4',
            'table'    => $this->getTable(),
            'field'    => 'license_type',
            'name'     => __('Type', 'unhassets'),
            'datatype' => 'text'
        ];

        $tab[] = [
            'id'       => '5',
            'table'    => $this->getTable(),
            'field'    => 'expiration_date',
            'name'     => __('Date d\'expiration', 'unhassets'),
            'datatype' => 'date'
        ];

        $tab[] = [
            'id'       => '6',
            'table'    => $this->getTable(),
            'field'    => 'number_licenses',
            'name'     => __('Nombre de licences', 'unhassets'),
            'datatype' => 'number'
        ];

        $tab[] = [
            'id'       => '7',
            'table'    => $this->getTable(),
            'field'    => 'used_licenses',
            'name'     => __('Licences utilisées', 'unhassets'),
            'datatype' => 'number'
        ];

        $tab[] = [
            'id'       => '8',
            'table'    => $this->getTable(),
            'field'    => 'status',
            'name'     => __('Statut', 'unhassets'),
            'datatype' => 'text'
        ];

        $tab[] = [
            'id'       => '9',
            'table'    => $this->getTable(),
            'field'    => 'department',
            'name'     => __('Département', 'unhassets'),
            'datatype' => 'text'
        ];

        return $tab;
    }
}