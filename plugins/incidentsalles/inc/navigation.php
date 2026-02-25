<?php

function showIncidentSallesNavigation($current_page = '') {
   global $CFG_GLPI;
   
   $base_url = $CFG_GLPI["root_doc"] . "/plugins/incidentsalles/front";
   
   $pages = [
      'signalement' => ['title' => '📝 Signaler un incident', 'url' => "$base_url/signalement.php"],
      'incident'    => ['title' => '📋 Liste des incidents', 'url' => "$base_url/incident.php"],
      'stats'       => ['title' => '📊 Statistiques', 'url' => "$base_url/stats.php"],
      'historique'  => ['title' => '📜 Historique Matériel', 'url' => "$base_url/historique.php"]
   ];
   
   echo "<div style='background: #f4f4f4; padding: 10px; margin-bottom: 20px; border-radius: 5px;'>";
   echo "<div style='display: flex; gap: 10px; flex-wrap: wrap;'>";
   
   foreach ($pages as $key => $page) {
      $active = ($current_page == $key) ? "background: #2196F3; color: white;" : "background: white; color: #333;";
      echo "<a href='" . $page['url'] . "' style='padding: 10px 20px; text-decoration: none; border-radius: 5px; $active'>";
      echo $page['title'];
      echo "</a>";
   }
   
   echo "</div>";
   echo "</div>";
}
