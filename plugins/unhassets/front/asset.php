<?php

include ('../../../inc/includes.php');

// Vérifier les droits plugin (évite de masquer les actions si accès obtenu via un "fallback")
Session::checkRight('plugin_unhassets', READ);

Html::header(
    __('Parc informatique', 'unhassets'),
    $_SERVER['PHP_SELF'],
    "unhassets",
    "unhassets",
    "asset"
);

Search::show('PluginUnhassetsAsset');

Html::footer();