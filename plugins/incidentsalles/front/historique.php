<?php

include ('../../../inc/includes.php');
include ('../inc/navigation.php');

Session::checkLoginUser();

Html::header('Historique Matériel', $_SERVER['PHP_SELF'], "tools", "PluginIncidentsallesMenu");

showIncidentSallesNavigation('historique');

global $DB;

$type_labels = [
   'materiel_defectueux' => 'Matériel défectueux',
   'panne_reseau' => 'Panne réseau',
   'probleme_logiciel' => 'Problème logiciel',
   'probleme_projection' => 'Problème de projection',
   'climatisation' => 'Climatisation',
   'electricite' => 'Électricité',
   'autre' => 'Autre'
];

echo "<div style='max-width: 1200px; margin: 0 auto; padding: 20px;'>";

echo "<h2>Historique des incidents par équipement</h2>";

// Récupérer tous les incidents groupés par équipement
$all_incidents = $DB->request([
   'FROM'   => 'glpi_plugin_incidentsalles_incidents',
   'ORDER'  => 'equipement ASC, date_creation DESC'
]);

$equipements = [];
foreach ($all_incidents as $incident) {
   $equip = $incident['equipement'] ? $incident['equipement'] : 'Sans équipement';
   if (!isset($equipements[$equip])) {
      $equipements[$equip] = [];
   }
   $equipements[$equip][] = $incident;
}

if (count($equipements) == 0) {
   echo "<div style='background: #f4f4f4; padding: 30px; text-align: center; border-radius: 5px;'>";
   echo "<p style='font-size: 16px; color: #666;'>Aucun incident signalé</p>";
   echo "</div>";
} else {
   foreach ($equipements as $equipement => $incidents) {
      $count = count($incidents);
      
      echo "<div style='background: white; padding: 20px; margin: 20px 0; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>";
      echo "<h3 style='margin-top: 0;'>💻 " . $equipement . " <span style='background: #2196F3; color: white; padding: 5px 10px; border-radius: 3px; font-size: 14px; margin-left: 10px;'>$count incident(s)</span></h3>";
      
      echo "<table class='tab_cadre_fixe' style='width: 100%;'>";
      echo "<tr>";
      echo "<th style='width: 20%;'>Date</th>";
      echo "<th style='width: 40%;'>Type d'incident</th>";
      echo "<th style='width: 40%;'>Salle</th>";
      echo "</tr>";
      
      foreach ($incidents as $incident) {
         echo "<tr>";
         echo "<td>" . date('d/m/Y H:i', strtotime($incident['date_creation'])) . "</td>";
         echo "<td>" . ($type_labels[$incident['type_incident']] ?? $incident['type_incident']) . "</td>";
         echo "<td><strong>" . $incident['salle'] . "</strong></td>";
         echo "</tr>";
      }
      
      echo "</table>";
      echo "</div>";
   }
}

echo "</div>";

Html::footer();
