<?php

class PluginIncidentsallesInstall {

    public static function install(Migration $migration) {
        global $DB;

        $table = 'glpi_incidentsalles';

        if (!$DB->tableExists($table)) {
            $query = "CREATE TABLE `$table` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `users_id` INT UNSIGNED NOT NULL DEFAULT 0,
                `salle` VARCHAR(100) NOT NULL,
                `laboratoire` VARCHAR(100) NULL,
                `type_incident` VARCHAR(100) NOT NULL,
                `description` TEXT NOT NULL,
                `date_incident` DATETIME NOT NULL,
                `heure_incident` TIME NOT NULL,
                `statut` ENUM('ouvert','en_cours','resolu') DEFAULT 'ouvert',
                `date_resolution` DATETIME NULL,
                `equipement` VARCHAR(200) NULL,
                `priorite` ENUM('basse','normale','haute','critique') DEFAULT 'normale',
                `date_creation` DATETIME NOT NULL,
                `date_modification` DATETIME NULL,
                PRIMARY KEY (`id`),
                KEY `users_id` (`users_id`),
                KEY `salle` (`salle`),
                KEY `statut` (`statut`),
                KEY `date_incident` (`date_incident`),
                KEY `priorite` (`priorite`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

            $DB->queryOrDie($query, $DB->error());
        }

        return true;
    }

    public static function uninstall(Migration $migration) {
        global $DB;

        $table = 'glpi_incidentsalles';

        if ($DB->tableExists($table)) {
            $DB->queryOrDie("DROP TABLE `$table`", $DB->error());
        }

        return true;
    }
}
