<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Test</title></head><body>";
echo "<h1>Test de chargement</h1>";

try {
    include('../../../inc/includes.php');
    echo "<p style='color: green;'>✅ Includes chargé</p>";
    
    global $DB;
    if ($DB) {
        echo "<p style='color: green;'>✅ DB connectée</p>";
    }
    
    $table = 'glpi_plugin_incidentsalles_incidents';
    if ($DB->tableExists($table)) {
        echo "<p style='color: green;'>✅ Table existe: $table</p>";
        
        $count = $DB->query("SELECT COUNT(*) as c FROM $table")->fetch_assoc()['c'];
        echo "<p style='color: blue;'>📊 Nombre d'incidents: $count</p>";
    } else {
        echo "<p style='color: red;'>❌ Table n'existe pas: $table</p>";
        echo "<p>➡️ <a href='migrate.php'>Cliquez ici pour créer la table</a></p>";
    }
    
    echo "<hr>";
    echo "<h2>Test d'affichage simple</h2>";
    echo "<div style='background: #fff; padding: 20px; border: 1px solid #ddd;'>";
    echo "<h3>Formulaire de test</h3>";
    echo "<form method='post'>";
    echo "<input type='text' name='test' placeholder='Test' style='padding: 10px; border: 1px solid #ddd;' />";
    echo "<button type='submit' style='padding: 10px 20px; background: #667eea; color: white; border: none;'>Envoyer</button>";
    echo "</form>";
    echo "</div>";
    
    if (isset($_POST['test'])) {
        echo "<p style='color: green;'>✅ Formulaire reçu: " . htmlspecialchars($_POST['test']) . "</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erreur: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p><a href='incident.php'>➡️ Aller à incident.php</a></p>";
echo "</body></html>";
