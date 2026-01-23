<?php
/**
 * Hook d'installation et désinstallation
 */

/**
 * Installation du plugin
 */
function plugin_unhassets_install() {
    global $DB;

    // Table des assets (parc informatique)
    if (!$DB->tableExists('glpi_plugin_unhassets_assets')) {
        $query = "CREATE TABLE `glpi_plugin_unhassets_assets` (
            `id` int unsigned NOT NULL AUTO_INCREMENT,
            `entities_id` int unsigned NOT NULL DEFAULT '0',
            `is_recursive` tinyint(1) NOT NULL DEFAULT '0',
            `name` varchar(255) DEFAULT NULL,
            `itemtype` varchar(100) DEFAULT NULL,
            `items_id` int unsigned NOT NULL DEFAULT '0',
            `brand` varchar(255) DEFAULT NULL,
            `model` varchar(255) DEFAULT NULL,
            `serial_number` varchar(255) DEFAULT NULL,
            `locations_id` int unsigned NOT NULL DEFAULT '0',
            `users_id` int unsigned NOT NULL DEFAULT '0',
            `groups_id` int unsigned NOT NULL DEFAULT '0',
            `purchase_date` date DEFAULT NULL,
            `warranty_date` date DEFAULT NULL,
            `states_id` int unsigned NOT NULL DEFAULT '0',
            `asset_category` varchar(100) DEFAULT NULL,
            `building` varchar(255) DEFAULT NULL,
            `room` varchar(100) DEFAULT NULL,
            `floor` varchar(50) DEFAULT NULL,
            `department` varchar(255) DEFAULT NULL,
            `status` varchar(50) DEFAULT 'active',
            `comment` text,
            `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
            `date_creation` timestamp NULL DEFAULT NULL,
            `date_mod` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `entities_id` (`entities_id`),
            KEY `locations_id` (`locations_id`),
            KEY `users_id` (`users_id`),
            KEY `states_id` (`states_id`),
            KEY `is_deleted` (`is_deleted`),
            KEY `itemtype_items` (`itemtype`, `items_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;";
        $DB->query($query) or die($DB->error());
    }

    // Table des réservations
    if (!$DB->tableExists('glpi_plugin_unhassets_reservations')) {
        $query = "CREATE TABLE `glpi_plugin_unhassets_reservations` (
            `id` int unsigned NOT NULL AUTO_INCREMENT,
            `entities_id` int unsigned NOT NULL DEFAULT '0',
            `assets_id` int unsigned NOT NULL DEFAULT '0',
            `users_id` int unsigned NOT NULL DEFAULT '0',
            `users_id_tech` int unsigned NOT NULL DEFAULT '0',
            `reservation_date` date DEFAULT NULL,
            `start_time` timestamp NULL DEFAULT NULL,
            `end_time` timestamp NULL DEFAULT NULL,
            `status` varchar(50) DEFAULT 'pending',
            `purpose` text,
            `comment` text,
            `is_approved` tinyint(1) NOT NULL DEFAULT '0',
            `date_creation` timestamp NULL DEFAULT NULL,
            `date_mod` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `entities_id` (`entities_id`),
            KEY `assets_id` (`assets_id`),
            KEY `users_id` (`users_id`),
            KEY `status` (`status`),
            KEY `reservation_date` (`reservation_date`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;";
        $DB->query($query) or die($DB->error());
    }

    // Table des licences
    if (!$DB->tableExists('glpi_plugin_unhassets_licenses')) {
        $query = "CREATE TABLE `glpi_plugin_unhassets_licenses` (
            `id` int unsigned NOT NULL AUTO_INCREMENT,
            `entities_id` int unsigned NOT NULL DEFAULT '0',
            `is_recursive` tinyint(1) NOT NULL DEFAULT '0',
            `name` varchar(255) DEFAULT NULL,
            `software_name` varchar(255) DEFAULT NULL,
            `version` varchar(100) DEFAULT NULL,
            `license_key` varchar(255) DEFAULT NULL,
            `license_type` varchar(100) DEFAULT NULL,
            `supplier` varchar(255) DEFAULT NULL,
            `purchase_date` date DEFAULT NULL,
            `expiration_date` date DEFAULT NULL,
            `number_licenses` int NOT NULL DEFAULT '1',
            `used_licenses` int NOT NULL DEFAULT '0',
            `department` varchar(255) DEFAULT NULL,
            `status` varchar(50) DEFAULT 'active',
            `alert_threshold` int NOT NULL DEFAULT '30',
            `comment` text,
            `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
            `date_creation` timestamp NULL DEFAULT NULL,
            `date_mod` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `entities_id` (`entities_id`),
            KEY `expiration_date` (`expiration_date`),
            KEY `is_deleted` (`is_deleted`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;";
        $DB->query($query) or die($DB->error());
    }

    // Table des profils
    if (!$DB->tableExists('glpi_plugin_unhassets_profiles')) {
        $query = "CREATE TABLE `glpi_plugin_unhassets_profiles` (
            `id` int unsigned NOT NULL AUTO_INCREMENT,
            `profiles_id` int unsigned NOT NULL DEFAULT '0',
            `unhassets` char(1) DEFAULT NULL,
            `open_ticket` char(1) DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `uniq_profile` (`profiles_id`),
            KEY `profiles_id` (`profiles_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;";
        $DB->query($query) or die($DB->error());
    }

    // Initialiser les profils et droits
    PluginUnhassetsProfile::installRights();

    return true;
}

/**
 * Désinstallation du plugin
 */
function plugin_unhassets_uninstall() {
    global $DB;

    $tables = [
        'glpi_plugin_unhassets_assets',
        'glpi_plugin_unhassets_reservations',
        'glpi_plugin_unhassets_licenses',
        'glpi_plugin_unhassets_profiles'
    ];

    foreach ($tables as $table) {
        if ($DB->tableExists($table)) {
            $DB->query("DROP TABLE `$table`");
        }
    }

    return true;
}