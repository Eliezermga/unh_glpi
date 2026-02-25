<?php

include ('../inc/includes.php');

Session::checkLoginUser();

$incident = new RoomIncident();

if (isset($_POST["add"])) {
    $incident->check(-1, CREATE, $_POST);
    $newID = $incident->add($_POST);
    Event::log(
        $newID,
        "roomincident",
        4,
        "inventory",
        //TRANS: %s is the user name
        sprintf(__('%s adds an item'), $_SESSION["glpiname"])
    );
    Html::redirect($incident->getFormURL()."?id=".$newID);

} else if (isset($_POST["delete"])) {
    $incident->check($_POST['id'], DELETE);
    $incident->delete($_POST);
    Event::log(
        $_POST["id"],
        "roomincident",
        4,
        "inventory",
        //TRANS: %s is the user name
        sprintf(__('%s deletes an item'), $_SESSION["glpiname"])
    );
    $incident->redirectToList();

} else if (isset($_POST["restore"])) {
    $incident->check($_POST['id'], PURGE);
    $incident->restore($_POST);
    Event::log(
        $_POST["id"],
        "roomincident",
        4,
        "inventory",
        //TRANS: %s is the user name
        sprintf(__('%s restores an item'), $_SESSION["glpiname"])
    );
    $incident->redirectToList();

} else if (isset($_POST["purge"])) {
    $incident->check($_POST['id'], PURGE);
    $incident->delete($_POST, 1);
    Event::log(
        $_POST["id"],
        "roomincident",
        4,
        "inventory",
        //TRANS: %s is the user name
        sprintf(__('%s purges an item'), $_SESSION["glpiname"])
    );
    $incident->redirectToList();

} else if (isset($_POST["update"])) {
    $incident->check($_POST['id'], UPDATE, $_POST);
    $incident->update($_POST);
    Event::log(
        $_POST["id"],
        "roomincident",
        4,
        "inventory",
        //TRANS: %s is the user name
        sprintf(__('%s updates an item'), $_SESSION["glpiname"])
    );
    Html::back();

} else if (isset($_GET["resolve"]) && isset($_GET["id"])) {
    // Résolution rapide d'incident
    $incident->getFromDB($_GET["id"]);
    $incident->update([
        'id' => $_GET["id"],
        'status' => 'resolved',
        'date_mod' => date('Y-m-d H:i:s'),
        'date_resolution' => date('Y-m-d H:i:s')
    ]);
    
    Event::log(
        $_GET["id"],
        "roomincident",
        4,
        "inventory",
        sprintf(__('%s resolves incident %d'), $_SESSION["glpiname"], $_GET["id"])
    );
    
    Html::redirect($incident->getSearchURL());

} else {
    Html::header(RoomIncident::getTypeName(2), $_SERVER['PHP_SELF'], "config", "RoomIncident");
    
    $incident->showForm($_GET["id"]);
    
    Html::footer();
}
?>
