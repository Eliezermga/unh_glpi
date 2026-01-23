<?php

include('../../../inc/includes.php');

global $DB;

$table = 'glpi_incidentsalles';

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Création de table</title></head><body>";
echo "<h2>🔧 Création de la table des incidents</h2>";

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
        `date_creation` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `date_modification` DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        KEY `users_id` (`users_id`),
        KEY `salle` (`salle`),
        KEY `statut` (`statut`),
        KEY `date_incident` (`date_incident`),
        KEY `priorite` (`priorite`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    if ($DB->query($query)) {
        echo "<p style='color: green;'>✅ Table '$table' créée avec succès !</p>";
    } else {
        echo "<p style='color: red;'>❌ Erreur lors de la création : " . $DB->error() . "</p>";
    }
} else {
    echo "<p style='color: blue;'>ℹ️ La table '$table' existe déjà.</p>";
}

echo "<hr>";
echo "<p><a href='incident.php' style='padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 4px;'>➡️ Aller aux incidents</a></p>";
echo "</body></html>";