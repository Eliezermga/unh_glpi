<?php

include('../../../inc/includes.php');

global $DB;

echo "<h2>🔄 Migration de la base de données</h2>";

$old_table = 'glpi_incidentsalles';
$new_table = 'glpi_plugin_incidentsalles_incidents';

// Vérifier si l'ancienne table existe
if ($DB->tableExists($old_table)) {
    echo "<p>✅ Ancienne table trouvée: $old_table</p>";
    
    // Créer la nouvelle table
    if (!$DB->tableExists($new_table)) {
        $query = "CREATE TABLE `$new_table` (
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
        
        if ($DB->query($query)) {
            echo "<p>✅ Nouvelle table créée: $new_table</p>";
            
            // Migrer les données
            $migrate = "INSERT INTO $new_table 
                       (users_id, salle, type_incident, description, date_incident, heure_incident, statut, date_resolution, equipement, priorite, date_creation)
                       SELECT user_id, salle, type_incident, description, date_incident, heure_incident, statut, date_resolution, equipement, 'normale', date_incident
                       FROM $old_table";
            
            if ($DB->query($migrate)) {
                $count = $DB->affectedRows();
                echo "<p>✅ $count enregistrements migrés</p>";
                echo "<p style='color: orange;'>⚠️ Vous pouvez maintenant supprimer l'ancienne table manuellement si vous le souhaitez</p>";
            } else {
                echo "<p style='color: red;'>❌ Erreur migration: " . $DB->error() . "</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ Erreur création table: " . $DB->error() . "</p>";
        }
    } else {
        echo "<p>✅ La nouvelle table existe déjà</p>";
    }
} else {
    // Créer directement la nouvelle table
    if (!$DB->tableExists($new_table)) {
        $query = "CREATE TABLE `$new_table` (
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
        
        if ($DB->query($query)) {
            echo "<p>✅ Table créée: $new_table</p>";
        } else {
            echo "<p style='color: red;'>❌ Erreur: " . $DB->error() . "</p>";
        }
    } else {
        echo "<p>✅ La table existe déjà</p>";
    }
}

echo "<hr>";
echo "<p><a href='incident.php' style='padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 4px;'>➡️ Aller à la page des incidents</a></p>";
