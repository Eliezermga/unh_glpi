<?php

include('../../../inc/includes.php');

global $DB;

$table = 'glpi_incidentsalles';

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Mise à jour table</title></head><body>";
echo "<h2>🔧 Mise à jour de la table des incidents</h2>";

if ($DB->tableExists($table)) {
    // Vérifier si les colonnes existent déjà
    $columns = $DB->listFields($table);
    
    $updates = [];
    
    if (!isset($columns['inventaire_glpi'])) {
        $updates[] = "ADD COLUMN `inventaire_glpi` VARCHAR(50) NULL AFTER `equipement`";
    }
    
    if (!isset($columns['action_maintenance'])) {
        $updates[] = "ADD COLUMN `action_maintenance` VARCHAR(100) NULL AFTER `inventaire_glpi`";
    }
    
    if (!empty($updates)) {
        $query = "ALTER TABLE `$table` " . implode(', ', $updates);
        
        if ($DB->query($query)) {
            echo "<p style='color: green;'>✅ Colonnes ajoutées avec succès !</p>";
            echo "<ul>";
            if (in_array("ADD COLUMN `inventaire_glpi` VARCHAR(50) NULL AFTER `equipement`", $updates)) {
                echo "<li>inventaire_glpi (Numéro d'inventaire GLPI)</li>";
            }
            if (in_array("ADD COLUMN `action_maintenance` VARCHAR(100) NULL AFTER `inventaire_glpi`", $updates)) {
                echo "<li>action_maintenance (Action de maintenance effectuée)</li>";
            }
            echo "</ul>";
        } else {
            echo "<p style='color: red;'>❌ Erreur lors de la mise à jour : " . $DB->error() . "</p>";
        }
    } else {
        echo "<p style='color: blue;'>ℹ️ La table est déjà à jour.</p>";
    }
} else {
    echo "<p style='color: red;'>❌ La table '$table' n'existe pas. Créez-la d'abord.</p>";
}

echo "<hr>";
echo "<p><a href='incident.php' style='padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 4px;'>➡️ Retour aux incidents</a></p>";
echo "</body></html>";