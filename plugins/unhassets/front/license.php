<?php

include ('../../../inc/includes.php');

Session::checkRight("plugin_unhassets", READ);

Html::header(
    __('Licences logicielles', 'unhassets'),
    $_SERVER['PHP_SELF'],
    "unhassets",
    "license"
);

Search::show('PluginUnhassetsLicense');

Html::footer();