<?php

include ('../../../inc/includes.php');

Session::checkRight("plugin_unhassets", READ);

$license = new PluginUnhassetsLicense();

if (isset($_POST['add'])) {
    $license->check(-1, UPDATE, $_POST);
    if ($newID = $license->add($_POST)) {
        Session::addMessageAfterRedirect(__('Licence ajoutée avec succès', 'unhassets'));
    }
    Html::back();
    
} else if (isset($_POST['update'])) {
    $license->check($_POST['id'], UPDATE);
    if ($license->update($_POST)) {
        Session::addMessageAfterRedirect(__('Licence mise à jour avec succès', 'unhassets'));
    }
    Html::back();
    
} else if (isset($_POST['delete'])) {
    $license->check($_POST['id'], DELETE);
    if ($license->delete($_POST)) {
        Session::addMessageAfterRedirect(__('Licence supprimée avec succès', 'unhassets'));
    }
    Html::redirect($CFG_GLPI["root_doc"]."/plugins/unhassets/front/license.php");
    
} else if (isset($_POST['purge'])) {
    $license->check($_POST['id'], PURGE);
    if ($license->delete($_POST, 1)) {
        Session::addMessageAfterRedirect(__('Licence purgée avec succès', 'unhassets'));
    }
    Html::redirect($CFG_GLPI["root_doc"]."/plugins/unhassets/front/license.php");
    
} else {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : -1;
    
    Html::header(
        __('Licences logicielles', 'unhassets'),
        $_SERVER['PHP_SELF'],
        "unhassets",
    "license"
    );
    
    $license->display(['id' => $id]);
    
    Html::footer();
}