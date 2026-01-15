<?php

include('../../../inc/includes.php');

global $DB;

echo "<h2>🔄 Mise à jour de la table</h2>";

$table = 'glpi_incidentsalles';

// Ajouter les colonnes manquantes
$columns_to_add = [
    "ALTER TABLE `$table` ADD COLUMN `heure_incident` TIME NULL AFTER `date_incident`",
    "ALTER TABLE `$table` ADD COLUMN `equipement` VARCHAR(200) NULL AFTER `description`",
    "ALTER TABLE `$table` ADD COLUMN `statut` ENUM('ouvert','en_cours','resolu') DEFAULT 'ouvert' AFTER `equipement`",
    "ALTER TABLE `$table` ADD COLUMN `date_resolution` DATETIME NULL AFTER `statut`",
    "ALTER TABLE `$table` CHANGE `user_id` `user_id` INT UNSIGNED NOT NULL DEFAULT 0"
];

echo "<p><strong>Structure actuelle de la table:</strong></p>";
$result = $DB->query("DESCRIBE $table");
echo "<table border='1' cellpadding='5'><tr><th>Colonne</th><th>Type</th></tr>";
while ($row = $DB->fetchAssoc($result)) {
    echo "<tr><td>" . $row['Field'] . "</td><td>" . $row['Type'] . "</td></tr>";
}
echo "</table><hr>";

foreach ($columns_to_add as $i => $query) {
    if ($DB->query($query)) {
        echo "<p style='color: green;'>✅ Colonne " . ($i+1) . " ajoutée</p>";
    } else {
        $error = $DB->error();
        if (strpos($error, 'Duplicate column') !== false) {
            echo "<p style='color: blue;'>ℹ️ Colonne " . ($i+1) . " existe déjà</p>";
        } else {
            echo "<p style='color: orange;'>⚠️ Colonne " . ($i+1) . ": " . $error . "</p>";
        }
    }
}

echo "<hr>";
echo "<p><a href='incident.php' style='padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 4px;'>➡️ Aller aux incidents</a></p>";
