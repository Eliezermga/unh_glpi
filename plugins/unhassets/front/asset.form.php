<?php

include ('../../../inc/includes.php');

// Sur un formulaire, GLPI utilise généralement id=-1 pour un nouvel objet.
// On exige CREATE dans ce cas (sinon le lien "Ajouter" mène à une erreur de droits).
if ((isset($_GET['id']) && (int)$_GET['id'] === -1) || isset($_POST['add'])) {
    Session::checkRight("plugin_unhassets", CREATE);
} else {
    Session::checkRight("plugin_unhassets", READ);
}

$asset = new PluginUnhassetsAsset();

if (isset($_POST['add'])) {
    $asset->check(-1, CREATE, $_POST);
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