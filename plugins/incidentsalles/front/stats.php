<?php

include ('../../../inc/includes.php');
include ('../inc/navigation.php');

Session::checkLoginUser();

Html::header('Statistiques - Incidents en Salles', $_SERVER['PHP_SELF'], "tools", "PluginIncidentsallesMenu");

showIncidentSallesNavigation('stats');

global $DB;

// Statistiques globales
$total_incidents = $DB->request(['COUNT' => 'total', 'FROM' => 'glpi_plugin_incidentsalles_incidents'])->current()['total'];
$incidents_nouveau = $DB->request(['COUNT' => 'total', 'FROM' => 'glpi_plugin_incidentsalles_incidents', 'WHERE' => ['status' => 'nouveau']])->current()['total'];
$incidents_en_cours = $DB->request(['COUNT' => 'total', 'FROM' => 'glpi_plugin_incidentsalles_incidents', 'WHERE' => ['status' => 'en_cours']])->current()['total'];
$incidents_resolus = $DB->request(['COUNT' => 'total', 'FROM' => 'glpi_plugin_incidentsalles_incidents', 'WHERE' => ['status' => 'resolu']])->current()['total'];

// Incidents en retard
$incidents_retard = $DB->request([
   'FROM'   => 'glpi_plugin_incidentsalles_incidents',
   'WHERE'  => [
      'status' => ['nouveau', 'en_cours'],
      'date_creation' => ['<', date('Y-m-d H:i:s', strtotime('-7 days'))]
   ]
]);
$count_retard = count($incidents_retard);

// Salles les plus touchées
$salles_stats = $DB->request([
   'SELECT' => ['salle', 'COUNT(*) as total'],
   'FROM'   => 'glpi_plugin_incidentsalles_incidents',
   'WHERE'  => ['NOT' => ['salle' => [null, '']]],
   'GROUPBY' => 'salle',
   'ORDER'  => 'total DESC',
   'LIMIT'  => 10
]);

// Types d'incidents
$types_stats = $DB->request([
   'SELECT' => ['type_incident', 'COUNT(*) as total'],
   'FROM'   => 'glpi_plugin_incidentsalles_incidents',
   'WHERE'  => ['NOT' => ['type_incident' => [null, '']]],
   'GROUPBY' => 'type_incident',
   'ORDER'  => 'total DESC'
]);

// Évolution par mois
$mois_stats = $DB->request([
   'SELECT' => ['DATE_FORMAT(date_creation, "%Y-%m") as mois', 'COUNT(*) as total'],
   'FROM'   => 'glpi_plugin_incidentsalles_incidents',
   'GROUPBY' => 'mois',
   'ORDER'  => 'mois DESC',
   'LIMIT'  => 6
]);

echo "<div class='center' style='max-width: 1200px; margin: 0 auto;'>";

// Alerte incidents en retard
if ($count_retard > 0) {
   echo "<div style='background: #f44336; color: white; padding: 20px; margin: 20px 0; border-radius: 5px;'>";
   echo "<h2 style='margin: 0;'>⚠️ ALERTE: $count_retard incident(s) non résolu(s) depuis plus de 7 jours</h2>";
   echo "<p style='margin: 10px 0 0 0;'>Ces incidents nécessitent une attention immédiate !</p>";
   echo "</div>";
}

// Cartes statistiques
echo "<div style='display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin: 20px 0;'>";

echo "<div style='background: #4CAF50; color: white; padding: 20px; border-radius: 8px; text-align: center;'>";
echo "<div style='font-size: 36px; font-weight: bold;'>$total_incidents</div>";
echo "<div style='font-size: 14px; margin-top: 5px;'>Total Incidents</div>";
echo "</div>";

echo "<div style='background: #FF9800; color: white; padding: 20px; border-radius: 8px; text-align: center;'>";
echo "<div style='font-size: 36px; font-weight: bold;'>$incidents_nouveau</div>";
echo "<div style='font-size: 14px; margin-top: 5px;'>Nouveaux</div>";
echo "</div>";

echo "<div style='background: #2196F3; color: white; padding: 20px; border-radius: 8px; text-align: center;'>";
echo "<div style='font-size: 36px; font-weight: bold;'>$incidents_en_cours</div>";
echo "<div style='font-size: 14px; margin-top: 5px;'>En cours</div>";
echo "</div>";

echo "<div style='background: #8BC34A; color: white; padding: 20px; border-radius: 8px; text-align: center;'>";
echo "<div style='font-size: 36px; font-weight: bold;'>$incidents_resolus</div>";
echo "<div style='font-size: 14px; margin-top: 5px;'>Résolus</div>";
echo "</div>";

echo "</div>";

// Salles les plus touchées
echo "<div style='background: white; padding: 20px; margin: 20px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>";
echo "<h2>📍 Top 10 des salles les plus touchées</h2>";
echo "<table class='tab_cadre_fixe' style='width: 100%;'>";
echo "<tr><th style='width: 70%;'>Salle</th><th style='width: 30%;'>Nombre d'incidents</th></tr>";

foreach ($salles_stats as $stat) {
   echo "<tr>";
   echo "<td><strong>" . $stat['salle'] . "</strong></td>";
   echo "<td><span style='background: #4CAF50; color: white; padding: 5px 15px; border-radius: 3px; font-weight: bold;'>" . $stat['total'] . "</span></td>";
   echo "</tr>";
}

echo "</table>";
echo "</div>";

// Types d'incidents
echo "<div style='background: white; padding: 20px; margin: 20px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>";
echo "<h2>🔧 Types d'incidents les plus fréquents</h2>";
echo "<table class='tab_cadre_fixe' style='width: 100%;'>";
echo "<tr><th style='width: 70%;'>Type</th><th style='width: 30%;'>Nombre</th></tr>";

$type_labels = [
   'materiel_defectueux' => 'Matériel défectueux',
   'panne_reseau' => 'Panne réseau',
   'probleme_logiciel' => 'Problème logiciel',
   'probleme_projection' => 'Problème de projection',
   'climatisation' => 'Climatisation',
   'electricite' => 'Électricité',
   'autre' => 'Autre'
];

$colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#C9CBCF'];
$color_index = 0;

foreach ($types_stats as $stat) {
   $color = $colors[$color_index % count($colors)];
   $color_index++;
   
   echo "<tr>";
   echo "<td><strong>" . ($type_labels[$stat['type_incident']] ?? $stat['type_incident']) . "</strong></td>";
   echo "<td><span style='background: $color; color: white; padding: 5px 15px; border-radius: 3px; font-weight: bold;'>" . $stat['total'] . "</span></td>";
   echo "</tr>";
}

echo "</table>";
echo "</div>";

// Évolution par mois
echo "<div style='background: white; padding: 20px; margin: 20px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>";
echo "<h2>📈 Évolution des incidents (6 derniers mois)</h2>";
echo "<table class='tab_cadre_fixe' style='width: 100%;'>";
echo "<tr><th style='width: 70%;'>Mois</th><th style='width: 30%;'>Incidents</th></tr>";

$mois_data = [];
foreach ($mois_stats as $stat) {
   $mois_data[] = $stat;
}

foreach (array_reverse($mois_data) as $stat) {
   echo "<tr>";
   echo "<td><strong>" . $stat['mois'] . "</strong></td>";
   echo "<td><span style='background: #FF9800; color: white; padding: 5px 15px; border-radius: 3px; font-weight: bold;'>" . $stat['total'] . "</span></td>";
   echo "</tr>";
}

echo "</table>";
echo "</div>";

echo "</div>";

Html::footer();
