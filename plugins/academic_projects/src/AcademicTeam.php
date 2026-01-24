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

class PluginAcademicTeam extends CommonDBTM
{
    public static $rightname = 'plugin_academic_projects';

    public static function getTypeName($nb = 0)
    {
        return _n('Team Member', 'Team Members', $nb);
    }

    public function getTabNameForItem(CommonGLPI $item, $withtemplate = 0)
    {
        if ($item->getType() == 'PluginAcademicProject') {
            return self::getTypeName(2);
        }
        return '';
    }

    public static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0)
    {
        if ($item->getType() == 'PluginAcademicProject') {
            self::showForProject($item);
        }
        return true;
    }

    public static function showForProject(PluginAcademicProject $project)
    {
        global $DB;

        $ID = $project->getField('id');

        if (!$project->can($ID, READ)) {
            return false;
        }

        $canedit = $project->can($ID, UPDATE);

        echo "<div class='center'>";

        if ($canedit) {
            echo "<form method='post' action='" . self::getFormURL() . "'>";
            echo "<table class='tab_cadre_fixe'>";
            echo "<tr><th colspan='3'>" . __('Add a team member') . "</th></tr>";
            echo "<tr class='tab_bg_1'>";
            echo "<td>" . __('User') . "</td>";
            echo "<td>";
            User::dropdown(['name' => 'users_id', 'entity' => $project->getField('entities_id')]);
            echo "</td>";
            echo "<td>" . __('Role') . "</td>";
            echo "<td>";
            $roles = [
                'supervisor' => __('Supervisor'),
                'member' => __('Member'),
                'observer' => __('Observer')
            ];
            Dropdown::showFromArray('role', $roles);
            echo "</td>";
            echo "<td>";
            echo Html::hidden('plugin_academic_projects_id', ['value' => $ID]);
            echo Html::submit(_x('button', 'Add'), ['name' => 'add']);
            echo "</td>";
            echo "</tr>";
            echo "</table>";
            Html::closeForm();
        }

        $iterator = $DB->request([
            'FROM' => 'glpi_plugin_academic_teams',
            'LEFT JOIN' => [
                'glpi_users' => [
                    'ON' => [
                        'glpi_plugin_academic_teams' => 'users_id',
                        'glpi_users' => 'id'
                    ]
                ]
            ],
            'WHERE' => ['plugin_academic_projects_id' => $ID],
            'ORDER' => 'glpi_users.name'
        ]);

        echo "<table class='tab_cadre_fixehov'>";
        echo "<tr><th colspan='4'>" . __('Team Members') . "</th></tr>";
        echo "<tr>";
        echo "<th>" . __('Name') . "</th>";
        echo "<th>" . __('Role') . "</th>";
        echo "<th>" . __('Added') . "</th>";
        if ($canedit) {
            echo "<th>" . __('Actions') . "</th>";
        }
        echo "</tr>";

        foreach ($iterator as $data) {
            echo "<tr class='tab_bg_1'>";
            echo "<td>" . $data['name'] . " " . $data['realname'] . "</td>";
            echo "<td>" . self::getRoleName($data['role']) . "</td>";
            echo "<td>" . Html::convDateTime($data['date_creation']) . "</td>";
            if ($canedit) {
                echo "<td>";
                Html::showSimpleForm(
                    self::getFormURL(),
                    'delete',
                    _x('button', 'Delete'),
                    ['id' => $data['id']],
                    'fa-fw ti ti-trash'
                );
                echo "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }

    public static function getRoleName($role)
    {
        switch ($role) {
            case 'supervisor':
                return __('Supervisor');
            case 'member':
                return __('Member');
            case 'observer':
                return __('Observer');
            default:
                return $role;
        }
    }

    public function prepareInputForAdd($input)
    {
        // Check if user is already in the team
        $existing = $this->find([
            'plugin_academic_projects_id' => $input['plugin_academic_projects_id'],
            'users_id' => $input['users_id']
        ]);

        if (count($existing) > 0) {
            Session::addMessageAfterRedirect(__('This user is already in the team'), false, ERROR);
            return false;
        }

        return $input;
    }
}
