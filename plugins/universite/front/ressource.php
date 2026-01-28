<?php
include('../../../inc/includes.php');

Html::header(
    'Ressources',
    $_SERVER['PHP_SELF'],
    'config',
    'PluginUniversiteMenu',
    'ressources'
);

if (Session::haveRight('plugin_universite_ressource', READ)) {
    Search::show('PluginUniversiteRessource');
} else {
    echo "<div class='center'>";
    echo "<table class='tab_cadre_fixe'>";
    echo "<tr><th>" . __("Aucun droit d'accès", 'universite') . "</th></tr>";
    echo "</table></div>";
}

Html::footer();
