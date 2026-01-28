<?php
include('../../../inc/includes.php');

Html::header(
    'Catégories',
    $_SERVER['PHP_SELF'],
    'config',
    'PluginUniversiteMenu',
    'categories'
);

if (Session::haveRight('plugin_universite_categorie', READ)) {
    Search::show('PluginUniversiteCategorie');
} else {
    echo "<div class='center'>";
    echo "<table class='tab_cadre_fixe'>";
    echo "<tr><th>" . __("Aucun droit d'accès", 'universite') . "</th></tr>";
    echo "</table></div>";
}

Html::footer();
