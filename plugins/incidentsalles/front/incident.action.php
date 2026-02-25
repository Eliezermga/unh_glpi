<?php

include ('../../../inc/includes.php');

Session::checkLoginUser();

if (isset($_GET['id']) && isset($_GET['action'])) {
   $incident = new PluginIncidentsallesIncident();
   
   if ($incident->getFromDB($_GET['id'])) {
      $update = ['id' => $_GET['id']];
      
      if ($_GET['action'] == 'resoudre') {
         $update['status'] = 'resolu';
         $update['date_resolution'] = $_SESSION['glpi_currenttime'];
         Session::addMessageAfterRedirect("Incident marqué comme résolu", false, INFO);
      } elseif ($_GET['action'] == 'en_cours') {
         $update['status'] = 'en_cours';
         Session::addMessageAfterRedirect("Incident marqué comme en cours", false, INFO);
      }
      
      $incident->update($update);
   }
}

Html::redirect($CFG_GLPI["root_doc"]."/plugins/incidentsalles/front/incident.php");
