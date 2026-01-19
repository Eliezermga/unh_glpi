<?php

include ('../../../inc/includes.php');

Session::checkRight("plugin_unhassets", READ);

$reservation = new PluginUnhassetsReservation();

if (isset($_POST['add'])) {
    $reservation->check(-1, CREATE, $_POST);
    if ($newID = $reservation->add($_POST)) {
        Session::addMessageAfterRedirect(__('Réservation créée avec succès', 'unhassets'));
    }
    Html::back();
    
} else if (isset($_POST['update'])) {
    $reservation->check($_POST['id'], UPDATE);
    if ($reservation->update($_POST)) {
        Session::addMessageAfterRedirect(__('Réservation mise à jour avec succès', 'unhassets'));
    }
    Html::back();
    
} else if (isset($_POST['delete'])) {
    $reservation->check($_POST['id'], DELETE);
    if ($reservation->delete($_POST)) {
        Session::addMessageAfterRedirect(__('Réservation supprimée avec succès', 'unhassets'));
    }
    Html::redirect($CFG_GLPI["root_doc"]."/plugins/unhassets/front/reservation.php");
    
} else {
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    
    Html::header(
        __('Réservations', 'unhassets'),
        $_SERVER['PHP_SELF'],
        "assets",
        "pluginunhassetsmenu",
        "reservation"
    );
    
    $reservation->display(['id' => $id]);
    
    Html::footer();
}