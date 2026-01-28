<?php
include('../../../inc/includes.php');

if (!isset($_GET["id"])) {
    $_GET["id"] = 0;
}

$cours = new PluginUniversiteCours();

if (isset($_POST["add"])) {
    $cours->check(-1, CREATE, $_POST);
    if ($newID = $cours->add($_POST)) {
        Html::back();
    }
    Html::back();
} else if (isset($_POST["update"])) {
    $cours->check($_POST["id"], UPDATE);
    $cours->update($_POST);
    Html::back();
} else if (isset($_POST["delete"])) {
    $cours->check($_POST["id"], DELETE);
    $cours->delete($_POST);
    $cours->redirectToList();
}

Html::header(
    PluginUniversiteCours::getTypeName(Session::getPluralNumber()),
    $_SERVER['PHP_SELF'],
    'config',
    'PluginUniversiteMenu',
    'cours'
);

$cours->display(['id' => $_GET["id"]]);

Html::footer();
