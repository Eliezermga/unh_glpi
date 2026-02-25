<?php

include ('../../../inc/includes.php');
include ('../inc/navigation.php');

Session::checkLoginUser();

Html::header('Historique Matériel - Incidents en Salles', $_SERVER['PHP_SELF'], "tools", "PluginIncidentsallesMenu");

showIncidentSallesNavigation('historique');

global $DB;

$equipement = isset($_GET['equipement']) ? $_GET['equipement'] : '';

echo "<div class='center' style='max-width: 1200px; margin: 0 auto;'>";

// Formulaire de recherche
echo "<div style='background: #f4f4f4; padding: 20px; margin: 20px 0; border-radius: 8px;'>";
echo "<form method='GET' action='' style='display: flex; gap: 10px; align-items: center;'>";
echo "<strong style='font-size: 16px;'>🔍 Rechercher un équipement:</strong>";
echo "<input type='text' name='equipement' value='$equipement' placeholder='Ex: Projecteur, Ordinateur...' style='padding: 10px; width: 300px; border: 1px solid #ddd; border-radius: 4px;'>";
echo "<button type='submit' style='padding: 10px 20px; background: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer;'>Rechercher</button>";
if ($equipement) {
   echo "<a href='historique.php' style='padding: 10px 20px; background: #666; color: white; text-decoration: none; border-radius: 4px;'>Réinitialiser</a>";
}
echo "</form>";
echo "</div>";

if ($equipement) {
   // Historique de l'équipement
   $historique = $DB->request([
      'FROM'   => 'glpi_plugin_incidentsalles_incidents',
      'WHERE'  => ['equipement' => ['LIKE', "%$equipement%"]],
      'ORDER'  => 'date_creation DESC'
   ]);

   $count = count($historique);
   
   if ($count > 0) {
      // Statistiques de l'équipement
      $resolu = 0;
      $en_cours = 0;
      $total_jours = 0;
      
      foreach ($historique as $incident) {
         if ($incident['status'] == 'resolu') {
            $resolu++;
            $total_jours += PluginIncidentsallesIncident::getDaysOpen($incident['date_creation'], $incident['date_resolution']);
         } else {
            $en_cours++;
         }
      }
      
      $moyenne = $resolu > 0 ? round($total_jours / $resolu, 1) : 0;
      
      // Cartes statistiques
      echo "<div style='display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin: 20px 0;'>";
      
      echo "<div style='background: #4CAF50; color: white; padding: 20px; border-radius: 8px; text-align: center;'>";
      echo "<div style='font-size: 36px; font-weight: bold;'>$count</div>";
      echo "<div style='font-size: 14px; margin-top: 5px;'>Total Incidents</div>";
      echo "</div>";
      
      echo "<div style='background: #8BC34A; color: white; padding: 20px; border-radius: 8px; text-align: center;'>";
      echo "<div style='font-size: 36px; font-weight: bold;'>$resolu</div>";
      echo "<div style='font-size: 14px; margin-top: 5px;'>Résolus</div>";
      echo "</div>";
      
      echo "<div style='background: #FF9800; color: white; padding: 20px; border-radius: 8px; text-align: center;'>";
      echo "<div style='font-size: 36px; font-weight: bold;'>$en_cours</div>";
      echo "<div style='font-size: 14px; margin-top: 5px;'>En cours</div>";
      echo "</div>";
      
      echo "<div style='background: #2196F3; color: white; padding: 20px; border-radius: 8px; text-align: center;'>";
      echo "<div style='font-size: 36px; font-weight: bold;'>$moyenne</div>";
      echo "<div style='font-size: 14px; margin-top: 5px;'>Jours (moyenne)</div>";
      echo "</div>";
      
      echo "</div>";
      
      // Tableau historique
      echo "<div style='background: white; padding: 20px; margin: 20px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>";
      echo "<h2>📋 Historique: $equipement</h2>";
      echo "<table class='tab_cadre_fixe' style='width: 100%;'>";
      echo "<tr>";
      echo "<th>Date</th>";
      echo "<th>Salle</th>";
      echo "<th>Type</th>";
      echo "<th>Description</th>";
      echo "<th>Statut</th>";
      echo "<th>Durée</th>";
      echo "</tr>";
      
      $type_labels = [
         'materiel_defectueux' => 'Matériel défectueux',
         'panne_reseau' => 'Panne réseau',
         'probleme_logiciel' => 'Problème logiciel',
         'probleme_projection' => 'Problème de projection',
         'climatisation' => 'Climatisation',
         'electricite' => 'Électricité',
         'autre' => 'Autre'
      ];
      
      $status_colors = [
         'nouveau' => '#FFF3CD',
         'en_cours' => '#D1ECF1',
         'resolu' => '#D4EDDA',
         'ferme' => '#E2E3E5'
      ];
      
      foreach ($historique as $incident) {
         $days = PluginIncidentsallesIncident::getDaysOpen($incident['date_creation'], $incident['date_resolution']);
         $bg_color = $status_colors[$incident['status']] ?? '#FFF';
         
         echo "<tr style='background-color: $bg_color;'>";
         echo "<td>" . date('d/m/Y', strtotime($incident['date_creation'])) . "</td>";
         echo "<td><strong>" . $incident['salle'] . "</strong></td>";
         echo "<td>" . ($type_labels[$incident['type_incident']] ?? $incident['type_incident']) . "</td>";
         echo "<td style='max-width: 300px;'>" . $incident['description'] . "</td>";
         echo "<td><strong>" . strtoupper($incident['status']) . "</strong></td>";
         echo "<td>" . ($incident['date_resolution'] ? "$days jours" : "En cours ($days jours)") . "</td>";
         echo "</tr>";
      }
      
      echo "</table>";
      echo "</div>";
   } else {
      echo "<div style='background: #fff3cd; padding: 20px; margin: 20px 0; border-radius: 8px; text-align: center;'>";
      echo "<h3>Aucun incident trouvé pour '$equipement'</h3>";
      echo "<p>Essayez avec un autre nom d'équipement</p>";
      echo "</div>";
   }
}

// Liste de tous les équipements
echo "<div style='background: white; padding: 20px; margin: 20px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>";
echo "<h2>💻 Tous les équipements</h2>";

$equipements = $DB->request([
   'SELECT' => ['equipement', 'COUNT(*) as total'],
   'FROM'   => 'glpi_plugin_incidentsalles_incidents',
   'WHERE'  => ['NOT' => ['equipement' => [null, '']]],
   'GROUPBY' => 'equipement',
   'ORDER'  => 'total DESC'
]);

$equip_count = count($equipements);

if ($equip_count > 0) {
   echo "<p style='margin-bottom: 15px;'><strong>$equip_count équipement(s) avec incidents signalés</strong></p>";
   echo "<table class='tab_cadre_fixe' style='width: 100%;'>";
   echo "<tr><th style='width: 60%;'>Équipement</th><th style='width: 20%;'>Incidents</th><th style='width: 20%;'>Action</th></tr>";

   foreach ($equipements as $equip) {
      echo "<tr>";
      echo "<td><strong>" . $equip['equipement'] . "</strong></td>";
      echo "<td><span style='background: #2196F3; color: white; padding: 5px 10px; border-radius: 3px;'>" . $equip['total'] . "</span></td>";
      echo "<td><a href='?equipement=" . urlencode($equip['equipement']) . "' style='padding: 8px 15px; background: #4CAF50; color: white; text-decoration: none; border-radius: 4px;'>📋 Voir historique</a></td>";
      echo "</tr>";
   }

   echo "</table>";
} else {
   echo "<p style='text-align: center; color: #666;'>Aucun équipement enregistré pour le moment</p>";
}

echo "</div>";
echo "</div>";

Html::footer();
