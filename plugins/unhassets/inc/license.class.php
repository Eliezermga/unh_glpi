<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginUnhassetsLicense extends CommonDBTM {

    static $rightname = 'plugin_unhassets';

    static function getTypeName($nb = 0) {
        return _n('Licence logicielle', 'Licences logicielles', $nb, 'unhassets');
    }

    function defineTabs($options = []) {
        $tabs = [];
        $this->addDefaultFormTab($tabs);
        $tabs['summary'] = __('Suivi global', 'unhassets');
        $this->addStandardTab('Log', $tabs, $options);
        return $tabs;
    }

    /* ================= FORMULAIRE ================= */

    function showForm($ID, $options = []) {
        $this->initForm($ID, $options);
        $this->showFormHeader($options);

        echo "<tr class='tab_bg_1'>
                <td>Nom de la licence</td>
                <td><input type='text' name='name' value='".($this->fields['name'] ?? '')."'></td>
                <td>Logiciel</td>
                <td><input type='text' name='software_name' value='".($this->fields['software_name'] ?? '')."'></td>
              </tr>";

        echo "<tr class='tab_bg_1'>
                <td>Version</td>
                <td><input type='text' name='version' value='".($this->fields['version'] ?? '')."'></td>
                <td>Type de licence</td>
                <td>";
        Dropdown::showFromArray('license_type', [
            'perpetual' => 'Perpétuelle',
            'subscription' => 'Abonnement',
            'volume' => 'Volume',
            'trial' => 'Essai'
        ], ['value' => $this->fields['license_type'] ?? 'subscription']);
        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>
                <td>Date d’expiration</td>
                <td>";
        Html::showDateField('expiration_date', [
            'value' => $this->fields['expiration_date'] ?? ''
        ]);
        echo "</td>
              <td>Seuil d’alerte (jours)</td>
              <td><input type='number' name='alert_threshold' value='".($this->fields['alert_threshold'] ?? 30)."'></td>
              </tr>";

        echo "<tr class='tab_bg_1'>
                <td>Nombre de postes</td>
                <td><input type='number' name='number_licenses' value='".($this->fields['number_licenses'] ?? 1)."'></td>
                <td>Licences utilisées</td>
                <td><input type='number' name='used_licenses' value='".($this->fields['used_licenses'] ?? 0)."'></td>
              </tr>";

        echo "<tr class='tab_bg_1'>
                <td>Département</td>
                <td><input type='text' name='department' value='".($this->fields['department'] ?? '')."'></td>
                <td>Faculté</td>
                <td><input type='text' name='faculty' value='".($this->fields['faculty'] ?? '')."'></td>
              </tr>";

        echo "<tr class='tab_bg_1'>
                <td>Commentaire</td>
                <td colspan='3'>
                    <textarea name='comment' rows='4' cols='80'>".($this->fields['comment'] ?? '')."</textarea>
                </td>
              </tr>";

        $this->showFormButtons($options);
        return true;
    }

    /* ================= STATUT AUTO ================= */

    function prepareInputForAdd($input) {
        return self::computeStatus($input);
    }

    function prepareInputForUpdate($input) {
        return self::computeStatus($input);
    }

    static function computeStatus($input) {
        if (!empty($input['expiration_date'])) {
            $days = (strtotime($input['expiration_date']) - time()) / 86400;
            if ($days <= 0) {
                $input['status'] = 'expired';
            } elseif ($days <= ($input['alert_threshold'] ?? 30)) {
                $input['status'] = 'soon_expired';
            } else {
                $input['status'] = 'active';
            }
        }
        return $input;
    }

    /* ================= CRON ALERTES ================= */

    static function cronCheckExpiration($task) {
        global $DB;

        $count = 0;
        $licenses = $DB->request([
            'FROM' => 'glpi_plugin_unhassets_licenses',
            'WHERE' => ['is_deleted' => 0]
        ]);

        foreach ($licenses as $lic) {
            if ($lic['status'] === 'soon_expired') {
                Toolbox::logInFile(
                    'unhassets_licenses',
                    "ALERTE : Licence {$lic['name']} ({$lic['software_name']}) expire le {$lic['expiration_date']}\n"
                );
                $count++;
            }
        }

        $task->addVolume($count);
        return 1;
    }

    /* ================= RECHERCHE ================= */

    function rawSearchOptions() {
        return [
            ['id' => 1, 'table' => $this->getTable(), 'field' => 'software_name', 'name' => 'Logiciel'],
            ['id' => 2, 'table' => $this->getTable(), 'field' => 'department', 'name' => 'Département'],
            ['id' => 3, 'table' => $this->getTable(), 'field' => 'faculty', 'name' => 'Faculté'],
            ['id' => 4, 'table' => $this->getTable(), 'field' => 'status', 'name' => 'Statut'],
            ['id' => 5, 'table' => $this->getTable(), 'field' => 'expiration_date', 'name' => 'Expiration']
        ];
    }
}
