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

class PluginAcademicComment extends CommonDBTM
{
    public static $rightname = 'plugin_academic_projects';

    public static function getTypeName($nb = 0)
    {
        return _n('Comment', 'Comments', $nb);
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
            echo "<tr><th colspan='2'>" . __('Add a comment') . "</th></tr>";
            echo "<tr class='tab_bg_1'>";
            echo "<td colspan='2'>";
            echo "<textarea name='content' cols='80' rows='6'></textarea>";
            echo "</td>";
            echo "</tr>";
            echo "<tr class='tab_bg_2'>";
            echo "<td colspan='2' class='center'>";
            echo Html::hidden('plugin_academic_projects_id', ['value' => $ID]);
            echo Html::submit(_x('button', 'Add'), ['name' => 'add']);
            echo "</td>";
            echo "</tr>";
            echo "</table>";
            Html::closeForm();
        }

        $iterator = $DB->request([
            'FROM' => 'glpi_plugin_academic_comments',
            'LEFT JOIN' => [
                'glpi_users' => [
                    'ON' => [
                        'glpi_plugin_academic_comments' => 'users_id',
                        'glpi_users' => 'id'
                    ]
                ]
            ],
            'WHERE' => ['plugin_academic_projects_id' => $ID],
            'ORDER' => 'date_creation DESC'
        ]);

        echo "<table class='tab_cadre_fixehov'>";
        echo "<tr><th colspan='3'>" . __('Comments') . "</th></tr>";
        echo "<tr>";
        echo "<th>" . __('Author') . "</th>";
        echo "<th>" . __('Content') . "</th>";
        echo "<th>" . __('Date') . "</th>";
        echo "</tr>";

        foreach ($iterator as $data) {
            echo "<tr class='tab_bg_1'>";
            echo "<td>" . $data['name'] . " " . $data['realname'] . "</td>";
            echo "<td>" . nl2br(Html::entities_deep($data['content'])) . "</td>";
            echo "<td>" . Html::convDateTime($data['date_creation']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }

    public function prepareInputForAdd($input)
    {
        $input['users_id'] = Session::getLoginUserID();
        return $input;
    }
}
