<?php

include ('../../../inc/includes.php');
include ('../inc/navigation.php');

Session::checkLoginUser();

Html::header('Statistiques - Incidents en Salles', $_SERVER['PHP_SELF'], "tools", "PluginIncidentsallesMenu");

showIncidentSallesNavigation('stats');

global $DB;

// Statistiques globales
$total = $DB->request(['COUNT' => 'total', 'FROM' => 'glpi_plugin_incidentsalles_incidents'])->current()['total'];
$nouveau = $DB->request(['COUNT' => 'total', 'FROM' => 'glpi_plugin_incidentsalles_incidents', 'WHERE' => ['status' => 'nouveau']])->current()['total'];
$en_cours = $DB->request(['COUNT' => 'total', 'FROM' => 'glpi_plugin_incidentsalles_incidents', 'WHERE' => ['status' => 'en_cours']])->current()['total'];
$resolu = $DB->request(['COUNT' => 'total', 'FROM' => 'glpi_plugin_incidentsalles_incidents', 'WHERE' => ['status' => 'resolu']])->current()['total'];
$ferme = $DB->request(['COUNT' => 'total', 'FROM' => 'glpi_plugin_incidentsalles_incidents', 'WHERE' => ['status' => 'ferme']])->current()['total'];

// Incidents en retard
$retard = $DB->request([
   'COUNT' => 'total',
   'FROM'  => 'glpi_plugin_incidentsalles_incidents',
   'WHERE' => [
      'status' => ['nouveau', 'en_cours'],
      'date_creation' => ['<', date('Y-m-d H:i:s', strtotime('-7 days'))]
   ]
])->current()['total'];

echo "<div style='max-width: 800px; margin: 0 auto; padding: 20px;'>";

// Alerte
if ($retard > 0) {
   echo "<div style='background: #f44336; color: white; padding: 20px; margin-bottom: 20px; border-radius: 5px; text-align: center;'>";
   echo "<h2 style='margin: 0;'>⚠️ $retard incident(s) en retard (plus de 7 jours)</h2>";
   echo "</div>";
}

// Vue d'ensemble
echo "<h2>Vue d'ensemble</h2>";
echo "<table class='tab_cadre_fixe' style='width: 100%;'>";
echo "<tr><th style='width: 50%;'>Indicateur</th><th style='width: 50%;'>Valeur</th></tr>";
echo "<tr><td><strong>Total des incidents</strong></td><td><span style='background: #4CAF50; color: white; padding: 8px 20px; border-radius: 5px; font-size: 18px; font-weight: bold;'>$total</span></td></tr>";
echo "<tr><td>Nouveaux</td><td><span style='background: #FF9800; color: white; padding: 5px 15px; border-radius: 3px;'>$nouveau</span></td></tr>";
echo "<tr><td>En cours</td><td><span style='background: #2196F3; color: white; padding: 5px 15px; border-radius: 3px;'>$en_cours</span></td></tr>";
echo "<tr><td>Résolus</td><td><span style='background: #8BC34A; color: white; padding: 5px 15px; border-radius: 3px;'>$resolu</span></td></tr>";
echo "<tr><td>Fermés</td><td><span style='background: #9E9E9E; color: white; padding: 5px 15px; border-radius: 3px;'>$ferme</span></td></tr>";
if ($retard > 0) {
   echo "<tr style='background: #ffebee;'><td><strong style='color: #d32f2f;'>En retard (> 7 jours)</strong></td><td><span style='background: #f44336; color: white; padding: 5px 15px; border-radius: 3px; font-weight: bold;'>$retard</span></td></tr>";
}
echo "</table>";

echo "</div>";

Html::footer();
