<?php

include ('../../../inc/includes.php');

Session::checkLoginUser();

$incident = new PluginIncidentsallesIncident();

if (isset($_POST["add"])) {
   $incident->check(-1, CREATE, $_POST);
   $incident->add($_POST);
   Html::back();
} else if (isset($_POST["update"])) {
   $incident->check($_POST['id'], UPDATE);
   $incident->update($_POST);
   Html::back();
} else if (isset($_POST["delete"])) {
   $incident->check($_POST['id'], DELETE);
   $incident->delete($_POST);
   $incident->redirectToList();
} else {
   Html::header('Incident en Salle', $_SERVER['PHP_SELF'], "tools", "PluginIncidentsallesMenu");
   $incident->display(['id' => $_GET["id"]]);
   Html::footer();
}
