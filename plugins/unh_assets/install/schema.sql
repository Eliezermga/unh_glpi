-- ============================================================================
-- Schéma SQL pour le Plugin Assets/Parc UNH - GLPI
-- Université Nouveaux Horizons
-- ============================================================================

-- ============================================================================
-- Table : glpi_plugin_unh_assets_types
-- Description : Types d'équipements (PC, Imprimante, Projecteur, Serveur, etc.)
-- ============================================================================
CREATE TABLE IF NOT EXISTS `glpi_plugin_unh_assets_types` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon_class` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'fa-box',
  `color_hex` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT '#17a2b8',
  `is_active` tinyint NOT NULL DEFAULT '1',
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `is_active` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ============================================================================
-- Table : glpi_plugin_unh_assets_buildings
-- Description : Bâtiments de l'université
-- ============================================================================
CREATE TABLE IF NOT EXISTS `glpi_plugin_unh_assets_buildings` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `name` (`name`),
  KEY `is_active` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ============================================================================
-- Table : glpi_plugin_unh_assets_rooms
-- Description : Salles/Bureaux dans les bâtiments
-- ============================================================================
CREATE TABLE IF NOT EXISTS `glpi_plugin_unh_assets_rooms` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buildings_id` int UNSIGNED NOT NULL,
  `floor` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `buildings_id` (`buildings_id`),
  KEY `name` (`name`),
  KEY `is_active` (`is_active`),
  CONSTRAINT `fk_rooms_building` FOREIGN KEY (`buildings_id`) REFERENCES `glpi_plugin_unh_assets_buildings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ============================================================================
-- Table : glpi_plugin_unh_assets_equipments
-- Description : Table centralisée des équipements (vue unifiée)
-- ============================================================================
CREATE TABLE IF NOT EXISTS `glpi_plugin_unh_assets_equipments` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itemtype` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Computer',
  `items_id` int UNSIGNED NOT NULL,
  `unh_asset_types_id` int UNSIGNED NOT NULL,
  `buildings_id` int UNSIGNED DEFAULT NULL,
  `rooms_id` int UNSIGNED DEFAULT NULL,
  `brand` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `warranty_expiration` date DEFAULT NULL,
  `assigned_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'operational',
  `condition` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'good',
  `comments` text COLLATE utf8mb4_unicode_ci,
  `last_maintenance` date DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `is_alert` tinyint NOT NULL DEFAULT '0',
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `itemtype_items` (`itemtype`, `items_id`),
  KEY `unh_asset_types_id` (`unh_asset_types_id`),
  KEY `buildings_id` (`buildings_id`),
  KEY `rooms_id` (`rooms_id`),
  KEY `status` (`status`),
  KEY `is_alert` (`is_alert`),
  KEY `name` (`name`),
  KEY `date_creation` (`date_creation`),
  CONSTRAINT `fk_equipment_type` FOREIGN KEY (`unh_asset_types_id`) REFERENCES `glpi_plugin_unh_assets_types` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `fk_equipment_building` FOREIGN KEY (`buildings_id`) REFERENCES `glpi_plugin_unh_assets_buildings` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_equipment_room` FOREIGN KEY (`rooms_id`) REFERENCES `glpi_plugin_unh_assets_rooms` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ============================================================================
-- Table : glpi_plugin_unh_assets_alerts
-- Description : Système d'alerte pour matériel en panne/hors service
-- ============================================================================
CREATE TABLE IF NOT EXISTS `glpi_plugin_unh_assets_alerts` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `equipments_id` int UNSIGNED NOT NULL,
  `alert_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alert_level` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'warning',
  `message` text COLLATE utf8mb4_unicode_ci,
  `created_by` int UNSIGNED DEFAULT NULL,
  `is_resolved` tinyint NOT NULL DEFAULT '0',
  `resolved_at` timestamp NULL DEFAULT NULL,
  `resolved_by` int UNSIGNED DEFAULT NULL,
  `resolution_notes` text COLLATE utf8mb4_unicode_ci,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `equipments_id` (`equipments_id`),
  KEY `alert_type` (`alert_type`),
  KEY `is_resolved` (`is_resolved`),
  KEY `alert_level` (`alert_level`),
  KEY `date_creation` (`date_creation`),
  CONSTRAINT `fk_alert_equipment` FOREIGN KEY (`equipments_id`) REFERENCES `glpi_plugin_unh_assets_equipments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ============================================================================
-- Table : glpi_plugin_unh_assets_maintenance_logs
-- Description : Journal de maintenance pour chaque équipement
-- ============================================================================
CREATE TABLE IF NOT EXISTS `glpi_plugin_unh_assets_maintenance_logs` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `equipments_id` int UNSIGNED NOT NULL,
  `maintenance_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `technician_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cost` decimal(10,2) DEFAULT '0.00',
  `duration_hours` int DEFAULT NULL,
  `is_completed` tinyint NOT NULL DEFAULT '1',
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `equipments_id` (`equipments_id`),
  KEY `maintenance_type` (`maintenance_type`),
  KEY `date_creation` (`date_creation`),
  CONSTRAINT `fk_maintenance_equipment` FOREIGN KEY (`equipments_id`) REFERENCES `glpi_plugin_unh_assets_equipments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ============================================================================
-- Données d'initialisation
-- ============================================================================

-- Types d'équipements par défaut
INSERT INTO `glpi_plugin_unh_assets_types` (`name`, `icon_class`, `color_hex`, `description`) VALUES
('PC de Bureau', 'fa-desktop', '#0BA0D0', 'Ordinateur de bureau standard'),
('Laptop/Portable', 'fa-laptop', '#3AA3E3', 'Ordinateur portable'),
('Imprimante', 'fa-print', '#20C997', 'Imprimante réseau ou locale'),
('Projecteur', 'fa-video', '#FFD700', 'Projecteur de salle'),
('Serveur', 'fa-server', '#DC3545', 'Serveur d\'infrastructure'),
('Moniteur', 'fa-tv', '#6F42C1', 'Écran/Moniteur'),
('Switch/Routeur', 'fa-network-wired', '#FFC107', 'Équipement réseau'),
('Tableau blanc interactif', 'fa-chalkboard', '#28A745', 'TBI/Smartboard'),
('Caméra de surveillance', 'fa-camera', '#E83E8C', 'Caméra IP'),
('Téléphone VoIP', 'fa-phone', '#17A2B8', 'Téléphone IP');

-- États d'équipement par défaut
ALTER TABLE `glpi_plugin_unh_assets_equipments` 
ADD CONSTRAINT `check_status` CHECK (`status` IN ('operational', 'maintenance', 'out_of_service', 'deprecated'));

-- Index pour améliorer les performances
CREATE INDEX `idx_search_equipment` ON `glpi_plugin_unh_assets_equipments` (`name`, `status`, `date_creation`);
CREATE INDEX `idx_building_room_search` ON `glpi_plugin_unh_assets_rooms` (`buildings_id`, `is_active`);
