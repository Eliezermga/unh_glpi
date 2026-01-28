<?php
include('../../../inc/includes.php');

if (!isset($_GET["id"])) {
    $_GET["id"] = 0;
}

$ressource = new PluginUniversiteRessource();

if (isset($_POST["add"])) {
    $ressource->check(-1, CREATE, $_POST);
    if ($newID = $ressource->add($_POST)) {
        Html::back();
    }
    Html::back();
} else if (isset($_POST["update"])) {
    $ressource->check($_POST["id"], UPDATE);
    $ressource->update($_POST);
    Html::back();
} else if (isset($_POST["delete"])) {
    $ressource->check($_POST["id"], DELETE);
    $ressource->delete($_POST);
    $ressource->redirectToList();
}

Html::header(
    'Ressources',
    $_SERVER['PHP_SELF'],
    'config',
    'PluginUniversiteMenu',
    'ressources'
);

$ressource->display(['id' => $_GET["id"]]);

Html::footer();
