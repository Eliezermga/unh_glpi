<?php

include('../../../inc/includes.php');

global $DB;

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Test Plugin</title></head><body>";
echo "<h2>🔍 Diagnostic du Plugin Incidents en Salles</h2>";

// Test 1: Connexion DB
echo "<h3>1. Test de connexion à la base de données</h3>";
if ($DB) {
    echo "<p style='color: green;'>✅ Connexion réussie</p>";
} else {
    echo "<p style='color: red;'>❌ Échec de connexion</p>";
    exit;
}

// Test 2: Table existe
echo "<h3>2. Vérification de la table</h3>";
$query = "SHOW TABLES LIKE 'glpi_incidentsalles'";
$result = $DB->query($query);

if ($DB->numrows($result) > 0) {
    echo "<p style='color: green;'>✅ La table 'glpi_incidentsalles' existe</p>";
} else {
    echo "<p style='color: red;'>❌ La table 'glpi_incidentsalles' n'existe pas</p>";
    echo "<p>➡️ Allez dans Configuration > Plugins > Incidents en salles > Installer</p>";
    exit;
}

// Test 3: Insertion test
echo "<h3>3. Test d'insertion</h3>";
$test_query = "INSERT INTO glpi_incidentsalles 
              (user_id, salle, type_incident, description, date_incident, heure_incident, equipement, statut) 
              VALUES (2, 'TEST-SALLE', 'Test', 'Test insertion', NOW(), '12:00', 'TEST', 'ouvert')";

if ($DB->query($test_query)) {
    $insert_id = $DB->insertId();
    echo "<p style='color: green;'>✅ Insertion réussie (ID: $insert_id)</p>";
    
    // Suppression du test
    $DB->query("DELETE FROM glpi_incidentsalles WHERE id = $insert_id");
    echo "<p style='color: blue;'>🗑️ Enregistrement de test supprimé</p>";
} else {
    echo "<p style='color: red;'>❌ Échec d'insertion: " . $DB->error() . "</p>";
}

// Test 4: Comptage
echo "<h3>4. Nombre d'incidents dans la base</h3>";
$count_query = "SELECT COUNT(*) as total FROM glpi_incidentsalles";
$result = $DB->query($count_query);
$row = $DB->fetchAssoc($result);
echo "<p style='color: blue;'>📊 Total: <strong>" . $row['total'] . "</strong> incidents</p>";

echo "<hr>";
echo "<p><a href='incident.php' style='padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 4px;'>➡️ Aller à la page des incidents</a></p>";
echo "</body></html>";
