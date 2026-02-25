<?php

include ('../../../inc/includes.php');
include ('../inc/navigation.php');

Session::checkLoginUser();

Html::header('Incidents en Salles', $_SERVER['PHP_SELF'], "tools", "PluginIncidentsallesMenu");

showIncidentSallesNavigation('incident');

global $DB;

// Filtres
$where = [];
if (isset($_GET['status']) && $_GET['status'] != '') {
   $where['status'] = $_GET['status'];
}
if (isset($_GET['salle']) && $_GET['salle'] != '') {
   $where['salle'] = ['LIKE', '%' . $_GET['salle'] . '%'];
}

// Récupérer tous les incidents
$incidents = $DB->request([
   'FROM'   => 'glpi_plugin_incidentsalles_incidents',
   'WHERE'  => $where,
   'ORDER'  => 'date_creation DESC'
]);

echo "<div class='center'>";

// Formulaire de filtres
echo "<div style='background: #f4f4f4; padding: 15px; margin: 20px 0; border-radius: 5px;'>";
echo "<form method='GET' action='' style='display: flex; gap: 10px; align-items: center;'>";
echo "<strong>Filtres:</strong>";
echo "<input type='text' name='salle' placeholder='Salle' value='" . ($_GET['salle'] ?? '') . "' style='padding: 5px;'>";
echo "<select name='status' style='padding: 5px;'>";
echo "<option value=''>Tous les statuts</option>";
echo "<option value='nouveau' " . (($_GET['status'] ?? '') == 'nouveau' ? 'selected' : '') . ">Nouveau</option>";
echo "<option value='en_cours' " . (($_GET['status'] ?? '') == 'en_cours' ? 'selected' : '') . ">En cours</option>";
echo "<option value='resolu' " . (($_GET['status'] ?? '') == 'resolu' ? 'selected' : '') . ">Résolu</option>";
echo "<option value='ferme' " . (($_GET['status'] ?? '') == 'ferme' ? 'selected' : '') . ">Fermé</option>";
echo "</select>";
echo "<button type='submit' style='padding: 5px 15px; background: #2196F3; color: white; border: none; border-radius: 3px; cursor: pointer;'>Filtrer</button>";
echo "<a href='incident.php' style='padding: 5px 15px; background: #666; color: white; text-decoration: none; border-radius: 3px;'>Réinitialiser</a>";
echo "</form>";
echo "</div>";

// Statistiques rapides
$total = count(iterator_to_array($DB->request(['FROM' => 'glpi_plugin_incidentsalles_incidents'])));
$nouveau = count(iterator_to_array($DB->request(['FROM' => 'glpi_plugin_incidentsalles_incidents', 'WHERE' => ['status' => 'nouveau']])));
$en_cours = count(iterator_to_array($DB->request(['FROM' => 'glpi_plugin_incidentsalles_incidents', 'WHERE' => ['status' => 'en_cours']])));
$resolu = count(iterator_to_array($DB->request(['FROM' => 'glpi_plugin_incidentsalles_incidents', 'WHERE' => ['status' => 'resolu']])));

echo "<div style='display: flex; gap: 15px; margin: 20px 0; justify-content: center;'>";
echo "<div style='background: #4CAF50; color: white; padding: 15px; border-radius: 5px; min-width: 120px; text-align: center;'>";
echo "<div style='font-size: 24px; font-weight: bold;'>$total</div><div>Total</div>";
echo "</div>";
echo "<div style='background: #FF9800; color: white; padding: 15px; border-radius: 5px; min-width: 120px; text-align: center;'>";
echo "<div style='font-size: 24px; font-weight: bold;'>$nouveau</div><div>Nouveau</div>";
echo "</div>";
echo "<div style='background: #2196F3; color: white; padding: 15px; border-radius: 5px; min-width: 120px; text-align: center;'>";
echo "<div style='font-size: 24px; font-weight: bold;'>$en_cours</div><div>En cours</div>";
echo "</div>";
echo "<div style='background: #8BC34A; color: white; padding: 15px; border-radius: 5px; min-width: 120px; text-align: center;'>";
echo "<div style='font-size: 24px; font-weight: bold;'>$resolu</div><div>Résolu</div>";
echo "</div>";
echo "</div>";

// Bouton ajouter
echo "<div style='margin: 20px 0;'>";
echo "<a href='signalement.php' style='padding: 10px 20px; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;'>✚ Signaler un nouvel incident</a>";
echo "</div>";

// Tableau des incidents
echo "<table class='tab_cadre_fixe' style='width: 98%;'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Salle</th>";
echo "<th>Type</th>";
echo "<th>Équipement</th>";
echo "<th>Description</th>";
echo "<th>Statut</th>";
echo "<th>Priorité</th>";
echo "<th>Date incident</th>";
echo "<th>Date création</th>";
echo "<th>Jours ouverts</th>";
echo "<th>Actions</th>";
echo "</tr>";

$status_colors = [
   'nouveau' => '#FFF3CD',
   'en_cours' => '#D1ECF1',
   'resolu' => '#D4EDDA',
   'ferme' => '#E2E3E5'
];

$priority_labels = [
   1 => 'Très basse',
   2 => 'Basse',
   3 => 'Moyenne',
   4 => 'Haute',
   5 => 'Très haute'
];

$type_labels = [
   'materiel_defectueux' => 'Matériel défectueux',
   'panne_reseau' => 'Panne réseau',
   'probleme_logiciel' => 'Problème logiciel',
   'probleme_projection' => 'Problème de projection',
   'climatisation' => 'Climatisation',
   'electricite' => 'Électricité',
   'autre' => 'Autre'
];

if (count($incidents) == 0) {
   echo "<tr><td colspan='11' class='center'>Aucun incident trouvé</td></tr>";
} else {
   foreach ($incidents as $incident) {
      $days_open = PluginIncidentsallesIncident::getDaysOpen($incident['date_creation'], $incident['date_resolution']);
      $bg_color = $status_colors[$incident['status']] ?? '#FFF';
      
      // Alerte si plus de 7 jours
      if ($days_open > 7 && $incident['status'] != 'resolu' && $incident['status'] != 'ferme') {
         $bg_color = '#FFCCCC';
      }
      
      echo "<tr style='background-color: $bg_color;'>";
      echo "<td><strong>#" . $incident['id'] . "</strong></td>";
      echo "<td><strong>" . $incident['salle'] . "</strong></td>";
      echo "<td>" . ($type_labels[$incident['type_incident']] ?? $incident['type_incident']) . "</td>";
      echo "<td>" . ($incident['equipement'] ?: '-') . "</td>";
      echo "<td style='max-width: 200px; overflow: hidden; text-overflow: ellipsis;'>" . substr($incident['description'], 0, 80) . (strlen($incident['description']) > 80 ? '...' : '') . "</td>";
      
      // Statut avec badge
      $status_badge_colors = [
         'nouveau' => '#FF9800',
         'en_cours' => '#2196F3',
         'resolu' => '#4CAF50',
         'ferme' => '#9E9E9E'
      ];
      $badge_color = $status_badge_colors[$incident['status']] ?? '#000';
      echo "<td><span style='background: $badge_color; color: white; padding: 3px 8px; border-radius: 3px; font-size: 11px;'>" . strtoupper($incident['status']) . "</span></td>";
      
      // Priorité avec étoiles
      $stars = str_repeat('⭐', $incident['priority']);
      echo "<td>$stars<br><small>" . $priority_labels[$incident['priority']] . "</small></td>";
      
      echo "<td>" . ($incident['date_incident'] ? date('d/m/Y', strtotime($incident['date_incident'])) : '-') . "<br><small>" . ($incident['heure_incident'] ?: '') . "</small></td>";
      echo "<td>" . Html::convDateTime($incident['date_creation']) . "</td>";
      
      // Jours ouverts avec alerte
      $days_color = ($days_open > 7 && $incident['status'] != 'resolu') ? 'color: red; font-weight: bold;' : '';
      echo "<td style='$days_color'>$days_open jours</td>";
      
      echo "<td>";
      echo "<a href='incident.form.php?id=" . $incident['id'] . "' style='padding: 5px 10px; background: #2196F3; color: white; text-decoration: none; border-radius: 3px; font-size: 11px;'>🔍 Voir</a>";
      echo "</td>";
      echo "</tr>";
   }
}

echo "</table>";
echo "</div>";

Html::footer();
