<?php
/**
 * Script de mise à jour de la base de données
 * À exécuter une seule fois pour ajouter les nouvelles colonnes
 */

include('../../../inc/includes.php');

global $DB;

echo "<h2>Mise à jour de la base de données - Incidents en salles</h2>";

$table = 'glpi_incidentsalles';

// Vérifier si les colonnes existent déjà
$columns_to_add = [
    'heure_incident' => "ALTER TABLE `$table` ADD `heure_incident` TIME NOT NULL AFTER `date_incident`",
    'statut' => "ALTER TABLE `$table` ADD `statut` ENUM('ouvert','en_cours','resolu') DEFAULT 'ouvert' AFTER `heure_incident`",
    'date_resolution' => "ALTER TABLE `$table` ADD `date_resolution` DATETIME NULL AFTER `statut`",
    'equipement' => "ALTER TABLE `$table` ADD `equipement` VARCHAR(200) NULL AFTER `date_resolution`"
];

foreach ($columns_to_add as $column => $query) {
    // Vérifier si la colonne existe
    $check = $DB->query("SHOW COLUMNS FROM `$table` LIKE '$column'");
    
    if ($DB->numrows($check) == 0) {
        try {
            $DB->queryOrDie($query, $DB->error());
            echo "<p style='color: green;'>✓ Colonne '$column' ajoutée avec succès</p>";
        } catch (Exception $e) {
            echo "<p style='color: red;'>✗ Erreur lors de l'ajout de '$column': " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color: blue;'>ℹ Colonne '$column' existe déjà</p>";
    }
}

// Ajouter les index
$indexes = [
    "ALTER TABLE `$table` ADD INDEX `salle` (`salle`)",
    "ALTER TABLE `$table` ADD INDEX `statut` (`statut`)",
    "ALTER TABLE `$table` ADD INDEX `date_incident` (`date_incident`)"
];

foreach ($indexes as $index_query) {
    try {
        $DB->queryOrDie($index_query, "");
        echo "<p style='color: green;'>✓ Index ajouté</p>";
    } catch (Exception $e) {
        echo "<p style='color: blue;'>ℹ Index existe déjà ou erreur: " . $e->getMessage() . "</p>";
    }
}

echo "<h3>Mise à jour terminée !</h3>";
echo "<p><a href='incident.php'>Retour aux incidents</a></p>";
