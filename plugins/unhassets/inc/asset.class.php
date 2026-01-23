<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginUnhassetsAsset extends CommonDBTM {

    static $rightname = 'plugin_unhassets';
    
    static function getTypeName($nb = 0) {
        return __('Parc informatique', 'unhassets');
    }

    static function canView() {
        return Session::haveRight(self::$rightname, READ)
            || Session::haveRight('config', READ);
    }

    static function canCreate() {
        // Dans GLPI, certains profils/plugins mappent "Écriture" sur UPDATE.
        // On accepte donc UPDATE comme droit de création pour éviter de masquer
        // le bouton "+" quand l'utilisateur a bien un droit d'écriture.
        return Session::haveRight(self::$rightname, CREATE)
            || Session::haveRight(self::$rightname, UPDATE)
            || Session::haveRight('config', UPDATE);
    }

    static function canUpdate() {
        return Session::haveRight(self::$rightname, UPDATE)
            || Session::haveRight('config', UPDATE);
    }

    static function canDelete() {
        return Session::haveRight(self::$rightname, DELETE)
            || Session::haveRight('config', UPDATE);
    }

    function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {
        if (!$withtemplate) {
            if ($item->getType() == 'Computer' || $item->getType() == 'Printer' 
                || $item->getType() == 'NetworkEquipment' || $item->getType() == 'Peripheral') {
                return __('Info UNH Assets', 'unhassets');
            }
        }
        return '';
    }

    static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {
        $asset = new self();
        $asset->showFormForItem($item);
        return true;
    }

    function showFormForItem($item) {
        global $DB;

        $itemtype = $item->getType();
        $items_id = $item->getID();

        // Récupérer les données existantes
        $iterator = $DB->request([
            'FROM'  => 'glpi_plugin_unhassets_assets',
            'WHERE' => [
                'itemtype' => $itemtype,
                'items_id' => $items_id
            ]
        ]);

        $data = [];
        if (count($iterator) > 0) {
            $data = $iterator->current();
        }

        echo "<form method='post' action='".Plugin::getWebDir('unhassets')."/front/asset.form.php'>";
        echo "<table class='tab_cadre_fixe'>";
        
        echo "<tr><th colspan='4'>".__('Informations UNH Assets', 'unhassets')."</th></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Bâtiment', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='text' name='building' value='".($data['building'] ?? '')."' size='40'>";
        echo "</td>";
        
        echo "<td>".__('Salle', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='text' name='room' value='".($data['room'] ?? '')."' size='20'>";
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Étage', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='text' name='floor' value='".($data['floor'] ?? '')."' size='10'>";
        echo "</td>";
        
        echo "<td>".__('Département', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='text' name='department' value='".($data['department'] ?? '')."' size='40'>";
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Marque', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='text' name='brand' value='".($data['brand'] ?? '')."' size='40'>";
        echo "</td>";
        
        echo "<td>".__('Modèle', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='text' name='model' value='".($data['model'] ?? '')."' size='40'>";
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Numéro de série', 'unhassets')."</td>";
        echo "<td>";
        echo "<input type='text' name='serial_number' value='".($data['serial_number'] ?? '')."' size='40'>";
        echo "</td>";
        
        echo "<td>".__('Catégorie', 'unhassets')."</td>";
        echo "<td>";
        $categories = ['PC' => 'PC', 'Imprimante' => 'Imprimante', 'Projecteur' => 'Projecteur', 
                      'Serveur' => 'Serveur', 'Switch' => 'Switch', 'Autre' => 'Autre'];
        Dropdown::showFromArray('asset_category', $categories, 
                               ['value' => $data['asset_category'] ?? '']);
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Statut', 'unhassets')."</td>";
        echo "<td>";
        $statuses = ['active' => __('Actif', 'unhassets'), 
                    'inactive' => __('Inactif', 'unhassets'),
                    'maintenance' => __('En maintenance', 'unhassets'),
                    'broken' => __('En panne', 'unhassets'),
                    'retired' => __('Retiré', 'unhassets')];
        Dropdown::showFromArray('status', $statuses, 
                               ['value' => $data['status'] ?? 'active']);
        echo "</td>";
        
        echo "<td>".__('Date d\'achat', 'unhassets')."</td>";
        echo "<td>";
        Html::showDateField('purchase_date', ['value' => $data['purchase_date'] ?? '']);
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Commentaire', 'unhassets')."</td>";
        echo "<td colspan='3'>";
        echo "<textarea name='comment' rows='4' cols='80'>".($data['comment'] ?? '')."</textarea>";
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td colspan='4' class='center'>";
        echo "<input type='hidden' name='id' value='".($data['id'] ?? 0)."'>";
        echo "<input type='hidden' name='itemtype' value='".$itemtype."'>";
        echo "<input type='hidden' name='items_id' value='".$items_id."'>";
        
        if (isset($data['id']) && $data['id'] > 0) {
            echo "<input type='submit' name='update' value='".__('Mettre à jour', 'unhassets')."' class='submit'>";
        } else {
            echo "<input type='submit' name='add' value='".__('Ajouter', 'unhassets')."' class='submit'>";
        }
        echo "</td>";
        echo "</tr>";

        echo "</table>";
        Html::closeForm();
    }

    function prepareInputForAdd($input) {
        if (!isset($input['entities_id'])) {
            $input['entities_id'] = $_SESSION['glpiactive_entity'];
        }
        $input['date_creation'] = $_SESSION['glpi_currenttime'];
        return $input;
    }

    function prepareInputForUpdate($input) {
        $input['date_mod'] = $_SESSION['glpi_currenttime'];
        return $input;
    }

    public function rawSearchOptions() {
    return parent::rawSearchOptions();
    }
}