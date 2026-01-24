<?php

/**
 * ---------------------------------------------------------------------
 *
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * http://glpi-project.org
 *
 * @copyright 2015-2023 Teclib' and contributors.
 * @copyright 2003-2014 by the INDEPNET Development Team.
 * @licence   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * ---------------------------------------------------------------------
 */

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginAcademicProject extends CommonDBTM
{
    public static $rightname = 'plugin_academic_projects';

    public static function getTypeName($nb = 0)
    {
        return _n('Academic Project', 'Academic Projects', $nb);
    }

    public static function getMenuName()
    {
        return self::getTypeName(Session::getPluralNumber());
    }

    public static function getMenuContent()
    {
        $menu = [];
        if (static::canView()) {
            $menu['title'] = self::getMenuName();
            $menu['page']  = '/plugins/academic_projects/front/project.php';
            $menu['icon']  = 'fas fa-graduation-cap';
        }
        if (count($menu)) {
            return $menu;
        }
        return false;
    }

    public function getTabNameForItem(CommonGLPI $item, $withtemplate = 0)
    {
        if ($item->getType() == 'User') {
            return __('Supervised Projects');
        }
        return '';
    }

    public static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0)
    {
        if ($item->getType() == 'User') {
            self::showForUser($item);
        }
        return true;
    }

    public static function showForUser(User $user)
    {
        global $DB;

        $ID = $user->getField('id');

        $iterator = $DB->request([
            'FROM' => 'glpi_plugin_academic_projects',
            'WHERE' => ['users_id_supervisor' => $ID],
            'ORDER' => 'name'
        ]);

        echo "<div class='center'>";
        echo "<table class='tab_cadre_fixehov'>";
        echo "<tr><th colspan='6'>" . __('Supervised Projects') . "</th></tr>";
        echo "<tr>";
        echo "<th>" . __('Name') . "</th>";
        echo "<th>" . __('Type') . "</th>";
        echo "<th>" . __('Status') . "</th>";
        echo "<th>" . __('Start date') . "</th>";
        echo "<th>" . __('Progress') . "</th>";
        echo "<th>" . __('Actions') . "</th>";
        echo "</tr>";

        foreach ($iterator as $data) {
            echo "<tr class='tab_bg_1'>";
            echo "<td><a href='" . self::getFormURL() . "?id=" . $data['id'] . "'>" . $data['name'] . "</a></td>";
            echo "<td>" . self::getProjectTypeName($data['projecttype']) . "</td>";
            echo "<td>" . self::getStatusName($data['status']) . "</td>";
            echo "<td>" . Html::convDate($data['start_date']) . "</td>";
            echo "<td>";
            echo "<div class='progress' style='width: 100px;'>";
            echo "<div class='progress-bar' role='progressbar' style='width: " . $data['progress'] . "%' aria-valuenow='" . $data['progress'] . "' aria-valuemin='0' aria-valuemax='100'>" . $data['progress'] . "%</div>";
            echo "</div>";
            echo "</td>";
            echo "<td><a href='" . self::getFormURL() . "?id=" . $data['id'] . "'>" . __('View') . "</a></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }

    public static function getProjectTypeName($type)
    {
        switch ($type) {
            case 'student':
                return __('Student Project');
            case 'research':
                return __('Research Project');
            default:
                return $type;
        }
    }

    public static function getStatusName($status)
    {
        switch ($status) {
            case 'draft':
                return __('Draft');
            case 'active':
                return __('Active');
            case 'completed':
                return __('Completed');
            case 'cancelled':
                return __('Cancelled');
            default:
                return $status;
        }
    }

    public function showForm($ID, $options = [])
    {
        global $CFG_GLPI;

        $this->initForm($ID, $options);
        $this->showFormHeader($options);

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Name') . "</td>";
        echo "<td>";
        echo Html::input('name', ['value' => $this->fields['name'], 'size' => 40]);
        echo "</td>";
        echo "<td>" . __('Type') . "</td>";
        echo "<td>";
        $types = [
            'student' => __('Student Project'),
            'research' => __('Research Project')
        ];
        Dropdown::showFromArray('projecttype', $types, ['value' => $this->fields['projecttype']]);
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Description') . "</td>";
        echo "<td colspan='3'>";
        echo "<textarea name='description' cols='80' rows='6'>" . $this->fields['description'] . "</textarea>";
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Status') . "</td>";
        echo "<td>";
        $statuses = [
            'draft' => __('Draft'),
            'active' => __('Active'),
            'completed' => __('Completed'),
            'cancelled' => __('Cancelled')
        ];
        Dropdown::showFromArray('status', $statuses, ['value' => $this->fields['status']]);
        echo "</td>";
        echo "<td>" . __('Progress') . "</td>";
        echo "<td>";
        echo "<input type='number' name='progress' value='" . $this->fields['progress'] . "' min='0' max='100'> %";
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Start date') . "</td>";
        echo "<td>";
        Html::showDateField('start_date', ['value' => $this->fields['start_date']]);
        echo "</td>";
        echo "<td>" . __('End date') . "</td>";
        echo "<td>";
        Html::showDateField('end_date', ['value' => $this->fields['end_date']]);
        echo "</td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Budget') . "</td>";
        echo "<td>";
        echo "<input type='number' name='budget' value='" . $this->fields['budget'] . "' step='0.01'> " . $CFG_GLPI['currency'];
        echo "</td>";
        echo "<td>" . __('Supervisor') . "</td>";
        echo "<td>";
        User::dropdown(['name' => 'users_id_supervisor', 'value' => $this->fields['users_id_supervisor'], 'entity' => $this->fields['entities_id']]);
        echo "</td>";
        echo "</tr>";

        $this->showFormButtons($options);
        return true;
    }

    public function showTabsContent()
    {
        echo "<div id='tabcontent'></div>";
        echo "<script type='text/javascript'>";
        echo "var mytabs = new GLPI.Tabs();";
        echo "mytabs.add('team', '" . __('Team') . "', '" . PluginAcademicTeam::getFormURL() . "?project_id=" . $this->getID() . "');";
        echo "mytabs.add('comments', '" . __('Comments') . "', '" . PluginAcademicComment::getFormURL() . "?project_id=" . $this->getID() . "');";
        echo "mytabs.init();";
        echo "</script>";
    }

    public function getSearchOptionsNew()
    {
        $tab = [];

        $tab[] = [
            'id' => 'common',
            'name' => __('Characteristics')
        ];

        $tab[] = [
            'id' => '1',
            'table' => $this->getTable(),
            'field' => 'name',
            'name' => __('Name'),
            'datatype' => 'itemlink',
            'massiveaction' => false
        ];

        $tab[] = [
            'id' => '2',
            'table' => $this->getTable(),
            'field' => 'description',
            'name' => __('Description'),
            'datatype' => 'text'
        ];

        $tab[] = [
            'id' => '3',
            'table' => $this->getTable(),
            'field' => 'projecttype',
            'name' => __('Type'),
            'searchtype' => 'equals',
            'datatype' => 'specific'
        ];

        $tab[] = [
            'id' => '4',
            'table' => $this->getTable(),
            'field' => 'status',
            'name' => __('Status'),
            'searchtype' => 'equals',
            'datatype' => 'specific'
        ];

        $tab[] = [
            'id' => '5',
            'table' => $this->getTable(),
            'field' => 'start_date',
            'name' => __('Start date'),
            'datatype' => 'date'
        ];

        $tab[] = [
            'id' => '6',
            'table' => $this->getTable(),
            'field' => 'end_date',
            'name' => __('End date'),
            'datatype' => 'date'
        ];

        $tab[] = [
            'id' => '7',
            'table' => $this->getTable(),
            'field' => 'progress',
            'name' => __('Progress'),
            'datatype' => 'number',
            'unit' => '%'
        ];

        $tab[] = [
            'id' => '8',
            'table' => $this->getTable(),
            'field' => 'budget',
            'name' => __('Budget'),
            'datatype' => 'decimal'
        ];

        $tab[] = [
            'id' => '9',
            'table' => $this->getTable(),
            'field' => 'users_id_supervisor',
            'name' => __('Supervisor'),
            'datatype' => 'dropdown',
            'right' => 'all'
        ];

        return $tab;
    }

    public static function getSpecificValueToDisplay($field, $values, array $options = [])
    {
        if (!is_array($values)) {
            $values = [$field => $values];
        }

        switch ($field) {
            case 'projecttype':
                return self::getProjectTypeName($values[$field]);
            case 'status':
                return self::getStatusName($values[$field]);
        }

        return parent::getSpecificValueToDisplay($field, $values, $options);
    }

    public static function getSpecificValueToSelect($field, $name = '', $values = '', array $options = [])
    {
        if (!is_array($values)) {
            $values = [$field => $values];
        }
        $options['display'] = false;

        switch ($field) {
            case 'projecttype':
                $types = [
                    'student' => __('Student Project'),
                    'research' => __('Research Project')
                ];
                $options['value'] = $values[$field];
                return Dropdown::showFromArray($name, $types, $options);
            case 'status':
                $statuses = [
                    'draft' => __('Draft'),
                    'active' => __('Active'),
                    'completed' => __('Completed'),
                    'cancelled' => __('Cancelled')
                ];
                $options['value'] = $values[$field];
                return Dropdown::showFromArray($name, $statuses, $options);
        }

        return parent::getSpecificValueToSelect($field, $name, $values, $options);
    }

    public function prepareInputForAdd($input)
    {
        $input['date_creation'] = $_SESSION['glpi_currenttime'];
        return $input;
    }

    public function prepareInputForUpdate($input)
    {
        $input['date_mod'] = $_SESSION['glpi_currenttime'];
        return $input;
    }
}
