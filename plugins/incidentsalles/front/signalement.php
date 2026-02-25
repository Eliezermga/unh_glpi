<?php

include ('../../../inc/includes.php');
include ('../inc/navigation.php');

Session::checkLoginUser();

$incident = new PluginIncidentsallesIncident();

if (isset($_POST["submit_signalement"])) {
   $_POST['entities_id'] = $_SESSION['glpiactive_entity'];
   $_POST['status'] = 'nouveau';
   $_POST['priority'] = isset($_POST['priority']) ? $_POST['priority'] : 3;
   
   if ($incident->add($_POST)) {
      Session::addMessageAfterRedirect("Incident signalé avec succès", false, INFO);
      Html::redirect($CFG_GLPI["root_doc"]."/plugins/incidentsalles/front/signalement.php");
   } else {
      Session::addMessageAfterRedirect("Erreur lors du signalement", false, ERROR);
   }
}

Html::header('Signaler un Incident en Salle', $_SERVER['PHP_SELF'], "tools", "PluginIncidentsallesMenu");

showIncidentSallesNavigation('signalement');

echo "<div class='center' style='max-width: 800px; margin: 0 auto;'>";
echo "<h1>📝 Signaler un Incident en Salle</h1>";

echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
echo Html::hidden('_glpi_csrf_token', ['value' => Session::getNewCSRFToken()]);

echo "<table class='tab_cadre_fixe'>";
echo "<tr><th colspan='2'>Informations sur l'incident</th></tr>";

// Salle
echo "<tr class='tab_bg_1'>";
echo "<td width='30%'><strong><span style='color:red;'>*</span> Salle :</strong></td>";
echo "<td>";
echo "<input type='text' name='salle' required style='width: 95%;' placeholder='Ex: Salle A101'>";
echo "</td>";
echo "</tr>";

// Type d'incident
echo "<tr class='tab_bg_1'>";
echo "<td><strong><span style='color:red;'>*</span> Type d'incident :</strong></td>";
echo "<td>";
echo "<select name='type_incident' required style='width: 95%;'>";
echo "<option value=''>-- Sélectionner --</option>";
echo "<option value='materiel_defectueux'>Matériel défectueux</option>";
echo "<option value='panne_reseau'>Panne réseau</option>";
echo "<option value='probleme_logiciel'>Problème logiciel</option>";
echo "<option value='probleme_projection'>Problème de projection</option>";
echo "<option value='climatisation'>Climatisation</option>";
echo "<option value='electricite'>Électricité</option>";
echo "<option value='autre'>Autre</option>";
echo "</select>";
echo "</td>";
echo "</tr>";

// Date de l'incident
echo "<tr class='tab_bg_1'>";
echo "<td><strong><span style='color:red;'>*</span> Date de l'incident :</strong></td>";
echo "<td>";
echo "<input type='date' name='date_incident' required value='" . date('Y-m-d') . "' style='width: 95%;'>";
echo "</td>";
echo "</tr>";

// Heure de l'incident
echo "<tr class='tab_bg_1'>";
echo "<td><strong><span style='color:red;'>*</span> Heure de l'incident :</strong></td>";
echo "<td>";
echo "<input type='time' name='heure_incident' required value='" . date('H:i') . "' style='width: 95%;'>";
echo "</td>";
echo "</tr>";

// Équipement
echo "<tr class='tab_bg_1'>";
echo "<td><strong>Équipement concerné :</strong></td>";
echo "<td>";
echo "<input type='text' name='equipement' style='width: 95%;' placeholder='Ex: Projecteur, Ordinateur, Tableau interactif...'>";
echo "</td>";
echo "</tr>";

// Priorité
echo "<tr class='tab_bg_1'>";
echo "<td><strong>Priorité :</strong></td>";
echo "<td>";
echo "<select name='priority' style='width: 95%;'>";
echo "<option value='1'>Très basse - Peut attendre</option>";
echo "<option value='2'>Basse - Non urgent</option>";
echo "<option value='3' selected>Moyenne - Normal</option>";
echo "<option value='4'>Haute - Urgent</option>";
echo "<option value='5'>Très haute - Critique</option>";
echo "</select>";
echo "</td>";
echo "</tr>";

// Description
echo "<tr class='tab_bg_1'>";
echo "<td><strong><span style='color:red;'>*</span> Description :</strong></td>";
echo "<td>";
echo "<textarea name='description' required rows='6' style='width: 95%;' placeholder='Décrivez le problème rencontré en détail...'></textarea>";
echo "</td>";
echo "</tr>";

// Bouton de soumission
echo "<tr class='tab_bg_1'>";
echo "<td colspan='2' class='center'>";
echo "<input type='submit' name='submit_signalement' value='📤 Signaler l\'incident' class='btn btn-primary' style='font-size: 16px; padding: 10px 30px;'>";
echo "</td>";
echo "</tr>";

echo "</table>";
echo "</form>";

// Afficher les derniers incidents signalés
echo "<br><h2>📋 Mes derniers signalements</h2>";

global $DB;
$user_id = Session::getLoginUserID();

$mes_incidents = $DB->request([
   'FROM'   => 'glpi_plugin_incidentsalles_incidents',
   'WHERE'  => ['users_id' => $user_id],
   'ORDER'  => 'date_creation DESC',
   'LIMIT'  => 5
]);

if (count($mes_incidents) > 0) {
   echo "<table class='tab_cadre_fixe'>";
   echo "<tr>";
   echo "<th>Date</th>";
   echo "<th>Salle</th>";
   echo "<th>Type</th>";
   echo "<th>Statut</th>";
   echo "<th>Action</th>";
   echo "</tr>";
   
   foreach ($mes_incidents as $inc) {
      $status_colors = [
         'nouveau' => '#FFA500',
         'en_cours' => '#4169E1',
         'resolu' => '#32CD32',
         'ferme' => '#808080'
      ];
      $color = $status_colors[$inc['status']] ?? '#000';
      
      echo "<tr class='tab_bg_1'>";
      echo "<td>" . Html::convDateTime($inc['date_creation']) . "</td>";
      echo "<td>" . $inc['salle'] . "</td>";
      echo "<td>" . $inc['type_incident'] . "</td>";
      echo "<td style='color: $color; font-weight: bold;'>" . $inc['status'] . "</td>";
      echo "<td><a href='incident.form.php?id=" . $inc['id'] . "'>Voir détails</a></td>";
      echo "</tr>";
   }
   
   echo "</table>";
} else {
   echo "<p class='center'>Aucun incident signalé pour le moment.</p>";
}

echo "</div>";

Html::footer();
