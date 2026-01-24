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

include('../../../inc/includes.php');

Session::checkRightsOr('plugin_academic_projects', [READ, UPDATE, CREATE, DELETE]);

$project = new PluginAcademicProject();

// Handle actions
if (isset($_POST['add'])) {
    $project->check(-1, CREATE, $_POST);
    $project->add($_POST);
    Html::back();
} elseif (isset($_POST['update'])) {
    $project->check($_POST['id'], UPDATE);
    $project->update($_POST);
    Html::back();
} elseif (isset($_POST['delete'])) {
    $project->check($_POST['id'], DELETE);
    $project->delete($_POST);
    Html::redirect($project->getSearchURL());
} elseif (isset($_GET['id'])) {
    // Show form for editing or viewing
    $project->getFromDB($_GET['id']);
    Html::header(PluginAcademicProject::getTypeName(1), $_SERVER['PHP_SELF'], "tools", "PluginAcademicProject");
    $project->showForm($_GET['id']);
    $project->showTabsContent();
    Html::footer();
} else {
    // Default: Show search list
    Html::header(PluginAcademicProject::getTypeName(Session::getPluralNumber()), $_SERVER['PHP_SELF'], "tools", "PluginAcademicProject");

    // Optional filter for student and research projects
    echo "<div class='center'>";
    echo "<form method='get' action='" . $_SERVER['PHP_SELF'] . "'>";
    echo "<table class='tab_cadre'>";
    echo "<tr><th colspan='2'>" . __('Filter projects') . "</th></tr>";
    echo "<tr class='tab_bg_1'>";
    echo "<td>" . _n('Type', 'Types', 1) . "</td>";
    echo "<td>";
    $types = [
        'student' => __('Student Project'),
        'research' => __('Research Project')
    ];
    Dropdown::showFromArray('projecttype', $types, ['value' => $_GET['projecttype'] ?? '']);
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
    Dropdown::showFromArray('status', $statuses, ['value' => $_GET['status'] ?? '']);
    echo "</td>";
    echo "</tr>";
    echo "<tr class='tab_bg_2'>";
    echo "<td colspan='2' class='center'>";
    echo "<input type='submit' name='search' value=\"" . _sx('button', 'Search') . "\" class='btn btn-primary'>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    Html::closeForm();
    echo "</div>";

    $criteria = [];
    if (isset($_GET['projecttype']) && !empty($_GET['projecttype'])) {
        $criteria['criteria'][] = [
            'field' => 3, // projecttype
            'searchtype' => 'equals',
            'value' => $_GET['projecttype']
        ];
    }
    if (isset($_GET['status']) && !empty($_GET['status'])) {
        $criteria['criteria'][] = [
            'field' => 4, // status
            'searchtype' => 'equals',
            'value' => $_GET['status']
        ];
    }

    Search::show('PluginAcademicProject', $criteria);
    Html::footer();
}
