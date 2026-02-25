<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginUnhassetsLicense extends CommonDBTM {

    static $rightname = 'plugin_unhassets';
    
    static function getTypeName($nb = 0) {
        return _n('Software License', 'Software Licenses', $nb, 'unhassets');
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

    static function getSearchOptionsToAdd($itemtype = null) {
        return [];
    }

    function showForm($ID, $options = []) {

        $this->initForm($ID, $options);
        $this->showFormHeader($options);

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('License Name', 'unhassets')."</td>";
        echo "<td><input type='text' name='name' value='".($this->fields['name'] ?? '')."' size='40'></td>";

        echo "<td>".__('Software', 'unhassets')."</td>";
        echo "<td><input type='text' name='software_name' value='".($this->fields['software_name'] ?? '')."' size='40'></td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Version', 'unhassets')."</td>";
        echo "<td><input type='text' name='version' value='".($this->fields['version'] ?? '')."' size='20'></td>";

        echo "<td>".__('License Type', 'unhassets')."</td>";
        echo "<td>";

        $types = [
            'perpetual'    => __('Perpetual', 'unhassets'),
            'subscription' => __('Subscription', 'unhassets'),
            'trial'        => __('Trial', 'unhassets'),
            'volume'       => __('Volume', 'unhassets'),
            'oem'          => __('OEM', 'unhassets')
        ];

        Dropdown::showFromArray('license_type', $types, [
            'value' => $this->fields['license_type'] ?? ''
        ]);

        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('License Key', 'unhassets')."</td>";
        echo "<td><input type='text' name='license_key' value='".($this->fields['license_key'] ?? '')."' size='40'></td>";

        echo "<td>".__('Supplier', 'unhassets')."</td>";
        echo "<td><input type='text' name='supplier' value='".($this->fields['supplier'] ?? '')."' size='40'></td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Purchase Date', 'unhassets')."</td>";
        echo "<td>";
        Html::showDateField('purchase_date', [
            'value' => $this->fields['purchase_date'] ?? ''
        ]);
        echo "</td>";

        echo "<td>".__('Expiration Date', 'unhassets')."</td>";
        echo "<td>";
        Html::showDateField('expiration_date', [
            'value' => $this->fields['expiration_date'] ?? ''
        ]);

        if (!empty($this->fields['expiration_date'])) {
            $exp_date  = strtotime($this->fields['expiration_date']);
            $today     = time();
            $days_left = floor(($exp_date - $today) / 86400);

            if ($days_left <= 30 && $days_left > 0) {
                echo " <span style='color: orange;'>";
                echo sprintf(__('Expiring in %d days', 'unhassets'), $days_left);
                echo "</span>";
            } elseif ($days_left <= 0) {
                echo " <span style='color: red; font-weight: bold;'>";
                echo __('EXPIRED', 'unhassets');
                echo "</span>";
            }
        }

        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Number of Licenses', 'unhassets')."</td>";
        echo "<td><input type='number' name='number_licenses' value='".($this->fields['number_licenses'] ?? 1)."' min='1'></td>";

        echo "<td>".__('Used Licenses', 'unhassets')."</td>";
        echo "<td><input type='number' name='used_licenses' value='".($this->fields['used_licenses'] ?? 0)."' min='0'>";

        if (isset($this->fields['number_licenses']) && isset($this->fields['used_licenses'])) {
            $available = $this->fields['number_licenses'] - $this->fields['used_licenses'];
            echo " <span style='margin-left:10px;'>";
            echo sprintf(__('Available: %d', 'unhassets'), $available);
            echo "</span>";
        }

        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Department', 'unhassets')."</td>";
        echo "<td><input type='text' name='department' value='".($this->fields['department'] ?? '')."' size='40'></td>";

        echo "<td>".__('Alert Threshold (days)', 'unhassets')."</td>";
        echo "<td><input type='number' name='alert_threshold' value='".($this->fields['alert_threshold'] ?? 30)."' min='1'></td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Status', 'unhassets')."</td>";
        echo "<td>";

        $statuses = [
            'active'   => __('Active', 'unhassets'),
            'expired'  => __('Expired', 'unhassets'),
            'inactive' => __('Inactive', 'unhassets')
        ];

        Dropdown::showFromArray('status', $statuses, [
            'value' => $this->fields['status'] ?? 'active'
        ]);

        echo "</td><td colspan='2'></td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Comment', 'unhassets')."</td>";
        echo "<td colspan='3'><textarea name='comment' rows='4' cols='80'>".$this->fields['comment'] ?? ''."</textarea></td>";
        echo "</tr>";

        $this->showFormButtons($options);

        return true;
    }

    public function rawSearchOptions() {

    
        return [

            ['id'=>5201,'table'=>$this->getTable(),'field'=>'name','name'=>__('Name','unhassets'),'datatype'=>'itemlink','massiveaction'=>false],
            ['id'=>5202,'table'=>$this->getTable(),'field'=>'software_name','name'=>__('Software','unhassets'),'datatype'=>'string'],
            ['id'=>5203,'table'=>$this->getTable(),'field'=>'version','name'=>__('Version','unhassets'),'datatype'=>'string'],
            ['id'=>5204,'table'=>$this->getTable(),'field'=>'license_type','name'=>__('License Type','unhassets'),'datatype'=>'string'],
            ['id'=>5205,'table'=>$this->getTable(),'field'=>'supplier','name'=>__('Supplier','unhassets'),'datatype'=>'string'],
            ['id'=>5206,'table'=>$this->getTable(),'field'=>'expiration_date','name'=>__('Expiration Date','unhassets'),'datatype'=>'date'],
            ['id'=>5207,'table'=>$this->getTable(),'field'=>'number_licenses','name'=>__('Number of Licenses','unhassets'),'datatype'=>'number'],
            ['id'=>5208,'table'=>$this->getTable(),'field'=>'used_licenses','name'=>__('Used Licenses','unhassets'),'datatype'=>'number'],
            ['id'=>5209,'table'=>$this->getTable(),'field'=>'status','name'=>__('Status','unhassets'),'datatype'=>'string'],
            ['id'=>5210,'table'=>$this->getTable(),'field'=>'department','name'=>__('Department','unhassets'),'datatype'=>'string'],
            ['id'=>5211,'table'=>$this->getTable(),'field'=>'comment','name'=>__('Comment','unhassets'),'datatype'=>'text'],
        ];
    }
}