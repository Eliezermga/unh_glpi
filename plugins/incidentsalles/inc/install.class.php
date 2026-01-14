<?php

class PluginIncidentsallesInstall {

    public static function install(Migration $migration) {
        global $DB;

        $table = 'glpi_incidentsalles';

        if (!$DB->tableExists($table)) {
            $query = "CREATE TABLE `$table` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `user_id` INT NOT NULL,
                `salle` VARCHAR(100) NOT NULL,
                `type_incident` VARCHAR(100) NOT NULL,
                `description` TEXT NOT NULL,
                `date_incident` DATETIME NOT NULL,
                `heure_incident` TIME NOT NULL,
                `statut` ENUM('ouvert','en_cours','resolu') DEFAULT 'ouvert',
                `date_resolution` DATETIME NULL,
                `equipement` VARCHAR(200) NULL,
                PRIMARY KEY (`id`),
                KEY `user_id` (`user_id`),
                KEY `salle` (`salle`),
                KEY `statut` (`statut`),
                KEY `date_incident` (`date_incident`)
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
