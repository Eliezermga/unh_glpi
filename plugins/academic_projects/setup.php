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

/**
 * Plugin version and information
 */
function plugin_version_academic_projects()
{
    return [
        'name'           => 'Academic Projects',
        'version'        => '1.0.0',
        'author'         => 'Your Name',
        'license'        => 'GPLv3+',
        'homepage'       => '',
        'requirements'   => [
            'glpi' => [
                'min' => '10.0.0',
            ],
            'php' => [
                'min' => '7.4.0',
            ]
        ]
    ];
}

/**
 * Check prerequisites before install
 */
function plugin_academic_projects_check_prerequisites()
{
    if (version_compare(GLPI_VERSION, '10.0.0', 'lt')) {
        echo "This plugin requires GLPI >= 10.0.0";
        return false;
    }
    return true;
}

/**
 * Check configuration
 */
function plugin_academic_projects_check_config($verbose = false)
{
    return true;
}

/**
 * Initialize the plugin
 */
function plugin_init_academic_projects()
{
    global $PLUGIN_HOOKS;

    $PLUGIN_HOOKS['csrf_compliant']['academic_projects'] = true;

    // Add menu entry
    $PLUGIN_HOOKS['menu_toadd']['academic_projects'] = [
        'tools' => 'PluginAcademicProject'
    ];

    // Add search options
    $PLUGIN_HOOKS['add_search_options']['academic_projects'] = [
        'PluginAcademicProject' => 'PluginAcademicProject'
    ];

    // Register classes
    Plugin::registerClass('PluginAcademicProject', [
        'addtabon' => ['User', 'Group']
    ]);

    Plugin::registerClass('PluginAcademicTeam');
    Plugin::registerClass('PluginAcademicComment');
}

/**
 * Install the plugin
 */
function plugin_academic_projects_install()
{
    global $DB;

    // Create tables
    if (!$DB->tableExists('glpi_plugin_academic_projects')) {
        $query = "CREATE TABLE `glpi_plugin_academic_projects` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
            `description` text COLLATE utf8_unicode_ci,
            `projecttype` enum('student','research') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'student',
            `status` enum('draft','active','completed','cancelled') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
            `start_date` date DEFAULT NULL,
            `end_date` date DEFAULT NULL,
            `progress` int(11) NOT NULL DEFAULT '0',
            `budget` decimal(15,2) DEFAULT NULL,
            `entities_id` int(11) NOT NULL DEFAULT '0',
            `is_recursive` tinyint(1) NOT NULL DEFAULT '0',
            `users_id_supervisor` int(11) NOT NULL DEFAULT '0',
            `date_creation` timestamp NULL DEFAULT NULL,
            `date_mod` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `name` (`name`),
            KEY `projecttype` (`projecttype`),
            KEY `status` (`status`),
            KEY `entities_id` (`entities_id`),
            KEY `users_id_supervisor` (`users_id_supervisor`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
        $DB->queryOrDie($query, "Error creating glpi_plugin_academic_projects table");
    }

    if (!$DB->tableExists('glpi_plugin_academic_teams')) {
        $query = "CREATE TABLE `glpi_plugin_academic_teams` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `plugin_academic_projects_id` int(11) NOT NULL DEFAULT '0',
            `users_id` int(11) NOT NULL DEFAULT '0',
            `role` enum('supervisor','member','observer') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'member',
            `date_creation` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `plugin_academic_projects_id` (`plugin_academic_projects_id`),
            KEY `users_id` (`users_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
        $DB->queryOrDie($query, "Error creating glpi_plugin_academic_teams table");
    }

    if (!$DB->tableExists('glpi_plugin_academic_comments')) {
        $query = "CREATE TABLE `glpi_plugin_academic_comments` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `plugin_academic_projects_id` int(11) NOT NULL DEFAULT '0',
            `users_id` int(11) NOT NULL DEFAULT '0',
            `content` text COLLATE utf8_unicode_ci,
            `date_creation` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `plugin_academic_projects_id` (`plugin_academic_projects_id`),
            KEY `users_id` (`users_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
        $DB->queryOrDie($query, "Error creating glpi_plugin_academic_comments table");
    }

    return true;
}

/**
 * Uninstall the plugin
 */
function plugin_academic_projects_uninstall()
{
    global $DB;

    // Drop tables
    $tables = [
        'glpi_plugin_academic_projects',
        'glpi_plugin_academic_teams',
        'glpi_plugin_academic_comments'
    ];

    foreach ($tables as $table) {
        if ($DB->tableExists($table)) {
            $DB->queryOrDie("DROP TABLE `$table`", "Error dropping $table table");
        }
    }

    return true;
}
