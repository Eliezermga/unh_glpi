<?php

include('../../../inc/includes.php');

global $DB;

echo "<h2>Test de connexion à la base de données</h2>";

// Test connexion
if ($DB) {
    echo "<p style='color: green;'>✓ Connexion à la base de données réussie</p>";
    
    // Test table existe
    $query = "SHOW TABLES LIKE 'glpi_incidentsalles'";
    $result = $DB->query($query);
    
    if ($DB->numrows($result) > 0) {
        echo "<p style='color: green;'>✓ La table 'glpi_incidentsalles' existe</p>";
        
        // Test structure table
        $query = "DESCRIBE glpi_incidentsalles";
        $result = $DB->query($query);
        
        echo "<h3>Structure de la table:</h3>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>Champ</th><th>Type</th><th>Null</th><th>Clé</th></tr>";
        while ($row = $DB->fetchAssoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['Field'] . "</td>";
            echo "<td>" . $row['Type'] . "</td>";
            echo "<td>" . $row['Null'] . "</td>";
            echo "<td>" . $row['Key'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // Compter les incidents
        $query = "SELECT COUNT(*) as total FROM glpi_incidentsalles";
        $result = $DB->query($query);
        $row = $DB->fetchAssoc($result);
        
        echo "<p style='color: blue;'>📊 Nombre total d'incidents: <strong>" . $row['total'] . "</strong></p>";
        
        // Afficher les 5 derniers incidents
        if ($row['total'] > 0) {
            echo "<h3>5 derniers incidents:</h3>";
            $query = "SELECT * FROM glpi_incidentsalles ORDER BY date_incident DESC LIMIT 5";
            $result = $DB->query($query);
            
            echo "<table border='1' cellpadding='5'>";
            echo "<tr><th>ID</th><th>Salle</th><th>Type</th><th>Date</th><th>Statut</th></tr>";
            while ($row = $DB->fetchAssoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['salle'] . "</td>";
                echo "<td>" . $row['type_incident'] . "</td>";
                echo "<td>" . $row['date_incident'] . "</td>";
                echo "<td>" . $row['statut'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        
    } else {
        echo "<p style='color: red;'>✗ La table 'glpi_incidentsalles' n'existe pas!</p>";
        echo "<p>Vous devez installer le plugin d'abord.</p>";
    }
    
} else {
    echo "<p style='color: red;'>✗ Impossible de se connecter à la base de données</p>";
}

echo "<br><br><a href='incident.php'>← Retour aux incidents</a>";
