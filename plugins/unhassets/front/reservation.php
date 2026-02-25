<?php

include ('../../../inc/includes.php');

Session::checkRight("plugin_unhassets", READ);

Html::header(
    __('Réservations', 'unhassets'),
    $_SERVER['PHP_SELF'],
    "unhassets",
    "reservation"
);

Search::show('PluginUnhassetsReservation');

Html::footer();