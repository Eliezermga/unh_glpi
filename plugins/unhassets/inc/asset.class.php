<?php 

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginUnhassetsAsset extends CommonDBTM {

    static $rightname = 'plugin_unhassets';

    static function getTypeName($nb = 0) {
        return __('IT Asset Inventory', 'unhassets');
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

    static function getSearchOptionsToAdd($itemtype = null) {
        return [];
    }

    function showFormForItem($item) {
        global $DB;

        $itemtype = $item->getType();
        $items_id = $item->getID();

        $iterator = $DB->request([
            'FROM'  => self::getTable(),
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
        echo "<tr><th colspan='4'>".__('UNH Assets Information', 'unhassets')."</th></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Building', 'unhassets') . "</td><td>";
        echo "<input type='text' name='building' value='".($data['building'] ?? '')."' size='40'>";
        echo "</td><td>" . __('Room', 'unhassets') . "</td><td>";
        echo "<input type='text' name='room' value='".($data['room'] ?? '')."' size='20'>";
        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Floor', 'unhassets') . "</td><td>";
        echo "<input type='text' name='floor' value='".($data['floor'] ?? '')."' size='10'>";
        echo "</td><td>" . __('Department', 'unhassets') . "</td><td>";
        echo "<input type='text' name='department' value='".($data['department'] ?? '')."' size='40'>";
        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Brand', 'unhassets') . "</td><td>";
        echo "<input type='text' name='brand' value='".($data['brand'] ?? '')."' size='40'>";
        echo "</td><td>" . __('Model', 'unhassets') . "</td><td>";
        echo "<input type='text' name='model' value='".($data['model'] ?? '')."' size='40'>";
        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Serial Number', 'unhassets') . "</td><td>";
        echo "<input type='text' name='serial_number' value='".($data['serial_number'] ?? '')."' size='40'>";
        echo "</td><td>" . __('Category', 'unhassets') . "</td><td>";

        $categories = [
            'PC'          => __('PC', 'unhassets'),
            'Imprimante'  => __('Printer', 'unhassets'),
            'Projecteur'  => __('Projector', 'unhassets'),
            'Serveur'     => __('Server', 'unhassets'),
            'Switch'      => __('Switch', 'unhassets'),
            'Autre'       => __('Other', 'unhassets')
        ];

        Dropdown::showFromArray('asset_category', $categories, [
            'value' => $data['asset_category'] ?? ''
        ]);

        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Status', 'unhassets') . "</td><td>";

        $statuses = [
            'active'      => __('Active', 'unhassets'),
            'inactive'    => __('Inactive', 'unhassets'),
            'maintenance' => __('Under Maintenance', 'unhassets'),
            'broken'      => __('Broken', 'unhassets'),
            'retired'     => __('Retired', 'unhassets')
        ];

        Dropdown::showFromArray('status', $statuses, [
            'value' => $data['status'] ?? 'active'
        ]);

        echo "</td><td>" . __('Purchase Date', 'unhassets') . "</td><td>";
        Html::showDateField('purchase_date', [
            'value' => $data['purchase_date'] ?? ''
        ]);
        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Comment', 'unhassets') . "</td><td colspan='3'>";
        echo "<textarea name='comment' rows='4' cols='80'>".($data['comment'] ?? '')."</textarea>";
        echo "</td></tr>";

        echo "<tr class='tab_bg_1'><td colspan='4' class='center'>";
        echo "<input type='hidden' name='id' value='".($data['id'] ?? 0)."'>";
        echo "<input type='hidden' name='itemtype' value='".$itemtype."'>";
        echo "<input type='hidden' name='items_id' value='".$items_id."'>";

        if (isset($data['id']) && $data['id'] > 0) {
            echo "<input type='submit' name='update' value='" . __('Update', 'unhassets') . "' class='submit'>";
        } else {
            echo "<input type='submit' name='add' value='" . __('Add', 'unhassets') . "' class='submit'>";
        }

        echo "</td></tr>";
        echo "</table>";
        Html::closeForm();
    }

    public function rawSearchOptions() {

        $tab = [];

        $tab[] = ['id' => 5001, 'table' => $this->getTable(), 'field' => 'name',
            'name' => __('Name', 'unhassets'), 'datatype' => 'itemlink', 'massiveaction' => false];

        $tab[] = ['id' => 5002, 'table' => $this->getTable(), 'field' => 'building',
            'name' => __('Building', 'unhassets'), 'datatype' => 'string'];

        $tab[] = ['id' => 5003, 'table' => $this->getTable(), 'field' => 'room',
            'name' => __('Room', 'unhassets'), 'datatype' => 'string'];

        $tab[] = ['id' => 5004, 'table' => $this->getTable(), 'field' => 'floor',
            'name' => __('Floor', 'unhassets'), 'datatype' => 'string'];

        $tab[] = ['id' => 5005, 'table' => $this->getTable(), 'field' => 'department',
            'name' => __('Department', 'unhassets'), 'datatype' => 'string'];

        $tab[] = ['id' => 5006, 'table' => $this->getTable(), 'field' => 'brand',
            'name' => __('Brand', 'unhassets'), 'datatype' => 'string'];

        $tab[] = ['id' => 5007, 'table' => $this->getTable(), 'field' => 'model',
            'name' => __('Model', 'unhassets'), 'datatype' => 'string'];

        $tab[] = ['id' => 5008, 'table' => $this->getTable(), 'field' => 'serial_number',
            'name' => __('Serial Number', 'unhassets'), 'datatype' => 'string'];

        $tab[] = ['id' => 5009, 'table' => $this->getTable(), 'field' => 'status',
            'name' => __('Status', 'unhassets'), 'datatype' => 'string'];

        $tab[] = ['id' => 5010, 'table' => $this->getTable(), 'field' => 'asset_category',
            'name' => __('Category', 'unhassets'), 'datatype' => 'string'];

        $tab[] = ['id' => 5011, 'table' => $this->getTable(), 'field' => 'purchase_date',
            'name' => __('Purchase Date', 'unhassets'), 'datatype' => 'date'];

        $tab[] = ['id' => 5012, 'table' => $this->getTable(), 'field' => 'warranty_date',
            'name' => __('Warranty Date', 'unhassets'), 'datatype' => 'date'];

        $tab[] = ['id' => 5013, 'table' => $this->getTable(), 'field' => 'comment',
            'name' => __('Comment', 'unhassets'), 'datatype' => 'text'];

        return $tab;
    }
}