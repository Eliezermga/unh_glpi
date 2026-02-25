<?php

function plugin_projet_install() {
    global $DB;
    
    $migration = new Migration(PLUGIN_PROJET_VERSION);
    
    $default_charset = DBConnection::getDefaultCharset();
    $default_collation = DBConnection::getDefaultCollation();
    $default_key_sign = DBConnection::getDefaultPrimaryKeySignOption();
    
    $table = 'glpi_plugin_projet_projets';
    
    if (!$DB->tableExists($table)) {
        $query = "CREATE TABLE `$table` (
            `id` int {$default_key_sign} NOT NULL AUTO_INCREMENT,
            `name` varchar(255) DEFAULT NULL,
            `entities_id` int {$default_key_sign} NOT NULL DEFAULT '0',
            `is_recursive` tinyint NOT NULL DEFAULT '0',
            `type` varchar(50) DEFAULT NULL COMMENT 'etudiant ou recherche',
            `responsable` varchar(255) DEFAULT NULL,
            `etudiants` text DEFAULT NULL,
            `date_debut` date DEFAULT NULL,
            `date_fin` date DEFAULT NULL,
            `statut` varchar(50) DEFAULT NULL,
            `description` text DEFAULT NULL,
            `comment` text DEFAULT NULL,
            `date_creation` timestamp NULL DEFAULT NULL,
            `date_mod` timestamp NULL DEFAULT NULL,
            `users_id` int {$default_key_sign} NOT NULL DEFAULT '0',
            PRIMARY KEY (`id`),
            KEY `name` (`name`),
            KEY `entities_id` (`entities_id`),
            KEY `date_debut` (`date_debut`),
            KEY `date_fin` (`date_fin`),
            KEY `statut` (`statut`)
        ) ENGINE=InnoDB DEFAULT CHARSET={$default_charset} COLLATE={$default_collation} ROW_FORMAT=DYNAMIC;";
        
        $DB->query($query) or die($DB->error());
    }
    
    // Ajouter les droits pour tous les profils
    $profiles = $DB->request(['FROM' => 'glpi_profiles']);
    foreach ($profiles as $profile) {
        PluginProjetProfile::createFirstAccess($profile['id']);
    }
    
    $migration->executeMigration();
    
    return true;
}

function plugin_projet_uninstall() {
    global $DB;
    
    $tables = [
        'glpi_plugin_projet_projets'
    ];
    
    foreach ($tables as $table) {
        $DB->query("DROP TABLE IF EXISTS `$table`");
    }
    
    return true;
}
