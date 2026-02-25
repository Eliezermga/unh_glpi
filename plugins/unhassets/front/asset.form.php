<?php

include ('../../../inc/includes.php');

Session::checkRight("plugin_unhassets", (isset($_GET['id']) && (int)$_GET['id'] === -1) || isset($_POST['add']) ? CREATE : READ);

$asset = new PluginUnhassetsAsset();

if (isset($_POST['add'])) {
    $asset->check(-1, CREATE, $_POST);
    if ($newID = $asset->add($_POST)) {
        Session::addMessageAfterRedirect(__('Asset added successfully', 'unhassets'));
    }
    Html::back();

} else if (isset($_POST['update'])) {
    $asset->check($_POST['id'], UPDATE);
    if ($asset->update($_POST)) {
        Session::addMessageAfterRedirect(__('Asset updated successfully', 'unhassets'));
    }
    Html::back();

} else if (isset($_POST['delete'])) {
    $asset->check($_POST['id'], DELETE);
    if ($asset->delete($_POST)) {
        Session::addMessageAfterRedirect(__('Asset deleted successfully', 'unhassets'));
    }
    Html::redirect($CFG_GLPI["root_doc"]."/plugins/unhassets/front/asset.php");

} else if (isset($_POST['purge'])) {
    $asset->check($_POST['id'], PURGE);
    if ($asset->delete($_POST, 1)) {
        Session::addMessageAfterRedirect(__('Asset purged successfully', 'unhassets'));
    }
    Html::redirect($CFG_GLPI["root_doc"]."/plugins/unhassets/front/asset.php");

} else {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : -1;

    Html::header(
        __('IT Asset Inventory', 'unhassets'),
        $_SERVER['PHP_SELF'],
        "unhassets",
        "asset"
    );

    $asset->display(['id' => $id]);

    Html::footer();
}