<?php

include ('../../../inc/includes.php');

Session::checkRight("plugin_unhassets", READ);

Html::header(
    __('Software Licenses', 'unhassets'),
    $_SERVER['PHP_SELF'],
    "unhassets",
    "license"
);

Search::show('PluginUnhassetsLicense');

Html::footer();
