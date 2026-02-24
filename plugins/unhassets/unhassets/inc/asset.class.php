<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

/**
 * Classe de gestion des données du parc UNH Assets.
 * Gère le CRUD sur glpi_plugin_unhassets_assets.
 *
 * L'onglet sur les types natifs (Computer, Monitor...) est géré par
 * PluginUnhassetsAssetTab (inc/assettab.class.php) qui étend CommonGLPI.
 */
class PluginUnhassetsAsset extends CommonDBTM {

    static $rightname = 'plugin_unhassets';

    static function getTypeName($nb = 0) {
        return __('Parc informatique', 'unhassets');
    }

    public static function getTable($classname = null) {
        return 'glpi_plugin_unhassets_assets';
    }

    public static function getSearchURL($full = true) {
        return Plugin::getWebDir('unhassets', $full) . "/front/asset.php";
    }

    public static function getFormURL($full = true) {
        return Plugin::getWebDir('unhassets', $full) . "/front/asset.form.php";
    }

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

    /**
     * GARDE DÉFENSIVE contre le "Duplicate key 23".
     * CommonDBTM fournit par défaut une getSearchOptionsToAdd() qui retourne
     * rawSearchOptions() de la classe, injectant ainsi nos clés (et la clé 23
     * héritée) dans les types natifs Monitor, Computer, etc.
     * On surcharge pour retourner [] : cette classe ne doit jamais polluer
     * les options de recherche d'autres itemtypes.
     */
    static function getSearchOptionsToAdd($itemtype = null) {
        return [];
    }

    /**
     * Affiche le formulaire UNH Assets dans l'onglet d'un item natif.
     * Appelé par PluginUnhassetsAssetTab::displayTabContentForItem().
     */
    function showFormForItem($item) {
        global $DB;

        $itemtype = $item->getType();
        $items_id = $item->getID();

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
        echo "<td>Batiment</td><td>";
        echo "<input type='text' name='building' value='".($data['building'] ?? '')."' size='40'>";
        echo "</td><td>Salle</td><td>";
        echo "<input type='text' name='room' value='".($data['room'] ?? '')."' size='20'>";
        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>Etage</td><td>";
        echo "<input type='text' name='floor' value='".($data['floor'] ?? '')."' size='10'>";
        echo "</td><td>Departement</td><td>";
        echo "<input type='text' name='department' value='".($data['department'] ?? '')."' size='40'>";
        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>Marque</td><td>";
        echo "<input type='text' name='brand' value='".($data['brand'] ?? '')."' size='40'>";
        echo "</td><td>Modele</td><td>";
        echo "<input type='text' name='model' value='".($data['model'] ?? '')."' size='40'>";
        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>Numero de serie</td><td>";
        echo "<input type='text' name='serial_number' value='".($data['serial_number'] ?? '')."' size='40'>";
        echo "</td><td>Categorie</td><td>";
        $categories = ['PC' => 'PC', 'Imprimante' => 'Imprimante', 'Projecteur' => 'Projecteur',
                       'Serveur' => 'Serveur', 'Switch' => 'Switch', 'Autre' => 'Autre'];
        Dropdown::showFromArray('asset_category', $categories, ['value' => $data['asset_category'] ?? '']);
        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>Statut</td><td>";
        $statuses = ['active' => 'Actif', 'inactive' => 'Inactif',
                     'maintenance' => 'En maintenance', 'broken' => 'En panne', 'retired' => 'Retire'];
        Dropdown::showFromArray('status', $statuses, ['value' => $data['status'] ?? 'active']);
        echo "</td><td>Date achat</td><td>";
        Html::showDateField('purchase_date', ['value' => $data['purchase_date'] ?? '']);
        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>Commentaire</td><td colspan='3'>";
        echo "<textarea name='comment' rows='4' cols='80'>".($data['comment'] ?? '')."</textarea>";
        echo "</td></tr>";

        echo "<tr class='tab_bg_1'><td colspan='4' class='center'>";
        echo "<input type='hidden' name='id' value='".($data['id'] ?? 0)."'>";
        echo "<input type='hidden' name='itemtype' value='".$itemtype."'>";
        echo "<input type='hidden' name='items_id' value='".$items_id."'>";
        if (isset($data['id']) && $data['id'] > 0) {
            echo "<input type='submit' name='update' value='Mettre a jour' class='submit'>";
        } else {
            echo "<input type='submit' name='add' value='Ajouter' class='submit'>";
        }
        echo "</td></tr>";
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

    /**
     * Options de recherche pour la liste /front/asset.php uniquement.
     * Clés >= 5000 par convention plugin. Pas d'appel à parent::
     */
    public function rawSearchOptions() {
        $tab = [];
        $tab[] = ['id' => 5001, 'table' => $this->getTable(), 'field' => 'name',
                  'name' => 'Nom', 'datatype' => 'itemlink', 'massiveaction' => false];
        $tab[] = ['id' => 5002, 'table' => $this->getTable(), 'field' => 'building',
                  'name' => 'Batiment', 'datatype' => 'string'];
        $tab[] = ['id' => 5003, 'table' => $this->getTable(), 'field' => 'room',
                  'name' => 'Salle', 'datatype' => 'string'];
        $tab[] = ['id' => 5004, 'table' => $this->getTable(), 'field' => 'floor',
                  'name' => 'Etage', 'datatype' => 'string'];
        $tab[] = ['id' => 5005, 'table' => $this->getTable(), 'field' => 'department',
                  'name' => 'Departement', 'datatype' => 'string'];
        $tab[] = ['id' => 5006, 'table' => $this->getTable(), 'field' => 'brand',
                  'name' => 'Marque', 'datatype' => 'string'];
        $tab[] = ['id' => 5007, 'table' => $this->getTable(), 'field' => 'model',
                  'name' => 'Modele', 'datatype' => 'string'];
        $tab[] = ['id' => 5008, 'table' => $this->getTable(), 'field' => 'serial_number',
                  'name' => 'Numero de serie', 'datatype' => 'string'];
        $tab[] = ['id' => 5009, 'table' => $this->getTable(), 'field' => 'status',
                  'name' => 'Statut', 'datatype' => 'string'];
        $tab[] = ['id' => 5010, 'table' => $this->getTable(), 'field' => 'asset_category',
                  'name' => 'Categorie', 'datatype' => 'string'];
        $tab[] = ['id' => 5011, 'table' => $this->getTable(), 'field' => 'purchase_date',
                  'name' => 'Date achat', 'datatype' => 'date'];
        $tab[] = ['id' => 5012, 'table' => $this->getTable(), 'field' => 'warranty_date',
                  'name' => 'Date garantie', 'datatype' => 'date'];
        $tab[] = ['id' => 5013, 'table' => $this->getTable(), 'field' => 'comment',
                  'name' => 'Commentaire', 'datatype' => 'text'];
        return $tab;
    }
}
