<?php

include ('../../../inc/includes.php');

// Vérifier les droits - utiliser config comme fallback
$canview = Session::haveRight('plugin_unhassets', READ) 
           || Session::haveRight('config', READ);

if (!$canview) {
    Html::displayRightError();
}

Html::header(
    __('Parc informatique', 'unhassets'),
    $_SERVER['PHP_SELF'],
    "unhassets",
    "unhassets",
    "asset"
);

Search::show('PluginUnhassetsAsset');

Html::footer();