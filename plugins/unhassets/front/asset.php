<?php

include ('../../../inc/includes.php');

Session::checkRight('plugin_unhassets', READ);

Html::header(
    __('IT Asset Inventory', 'unhassets'),
    $_SERVER['PHP_SELF'],
    "unhassets",
    "asset"
);

Search::show('PluginUnhassetsAsset');

Html::footer();
