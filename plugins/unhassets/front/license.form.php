<?php

include ('../../../inc/includes.php');

Session::checkRight("plugin_unhassets", (isset($_GET['id']) && (int)$_GET['id'] === -1) || isset($_POST['add']) ? CREATE : READ);

$license = new PluginUnhassetsLicense();

if (isset($_POST['add'])) {
    $license->check(-1, CREATE, $_POST);
    if ($newID = $license->add($_POST)) {
        Session::addMessageAfterRedirect(__('License added successfully', 'unhassets'));
    }
    Html::back();

} else if (isset($_POST['update'])) {
    $license->check($_POST['id'], UPDATE);
    if ($license->update($_POST)) {
        Session::addMessageAfterRedirect(__('License updated successfully', 'unhassets'));
    }
    Html::back();

} else if (isset($_POST['delete'])) {
    $license->check($_POST['id'], DELETE);
    if ($license->delete($_POST)) {
        Session::addMessageAfterRedirect(__('License deleted successfully', 'unhassets'));
    }
    Html::redirect($CFG_GLPI["root_doc"]."/plugins/unhassets/front/license.php");

} else if (isset($_POST['purge'])) {
    $license->check($_POST['id'], PURGE);
    if ($license->delete($_POST, 1)) {
        Session::addMessageAfterRedirect(__('License purged successfully', 'unhassets'));
    }
    Html::redirect($CFG_GLPI["root_doc"]."/plugins/unhassets/front/license.php");

} else {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : -1;

    Html::header(
        __('Software Licenses', 'unhassets'),
        $_SERVER['PHP_SELF'],
        "unhassets",
        "license"
    );

    $license->display(['id' => $id]);

    Html::footer();
}