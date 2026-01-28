<?php
include('../../../inc/includes.php');

if (!isset($_GET["id"])) {
    $_GET["id"] = 0;
}

$categorie = new PluginUniversiteCategorie();

if (isset($_POST["add"])) {
    $categorie->check(-1, CREATE, $_POST);
    if ($newID = $categorie->add($_POST)) {
        Html::back();
    }
    Html::back();
} else if (isset($_POST["update"])) {
    $categorie->check($_POST["id"], UPDATE);
    $categorie->update($_POST);
    Html::back();
} else if (isset($_POST["delete"])) {
    $categorie->check($_POST["id"], DELETE);
    $categorie->delete($_POST);
    $categorie->redirectToList();
}

Html::header(
    'Catégories',
    $_SERVER['PHP_SELF'],
    'config',
    'PluginUniversiteMenu',
    'categories'
);

$categorie->display(['id' => $_GET["id"]]);

Html::footer();
