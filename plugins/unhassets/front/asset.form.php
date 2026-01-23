<?php

include ('../../../inc/includes.php');

Session::checkRight("plugin_unhassets", READ);

$asset = new PluginUnhassetsAsset();

if (isset($_POST['add'])) {
    // Certains profils peuvent avoir UPDATE (écriture) sans le bit CREATE.
    // On autorise donc la création via UPDATE.
    $asset->check(-1, UPDATE, $_POST);
    if ($newID = $asset->add($_POST)) {
        Session::addMessageAfterRedirect(__('Équipement ajouté avec succès', 'unhassets'));
    }
    Html::back();
    
} else if (isset($_POST['update'])) {
    $asset->check($_POST['id'], UPDATE);
    if ($asset->update($_POST)) {
        Session::addMessageAfterRedirect(__('Équipement mis à jour avec succès', 'unhassets'));
    }
    Html::back();
    
} else if (isset($_POST['delete'])) {
    $asset->check($_POST['id'], DELETE);
    if ($asset->delete($_POST)) {
        Session::addMessageAfterRedirect(__('Équipement supprimé avec succès', 'unhassets'));
    }
    Html::redirect($CFG_GLPI["root_doc"]."/plugins/unhassets/front/asset.php");
    
} else if (isset($_POST['purge'])) {
    $asset->check($_POST['id'], PURGE);
    if ($asset->delete($_POST, 1)) {
        Session::addMessageAfterRedirect(__('Équipement purgé avec succès', 'unhassets'));
    }
    Html::redirect($CFG_GLPI["root_doc"]."/plugins/unhassets/front/asset.php");
    
} else {
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    
    Html::header(
        __('Parc informatique', 'unhassets'),
        $_SERVER['PHP_SELF'],
        "unhassets",
        "unhassets",
        "asset"
    );
    
    $asset->display(['id' => $id]);
    
    Html::footer();
}