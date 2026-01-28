<?php
include('../../../inc/includes.php');

Html::header(
    PluginUniversiteCours::getTypeName(Session::getPluralNumber()),
    $_SERVER['PHP_SELF'],
    'config',
    'PluginUniversiteMenu',
    'cours'
);

if (PluginUniversiteCours::canView()) {
    Search::show('PluginUniversiteCours');
} else {
    echo "<div class='center'>";
    echo "<div role='alert' class='alert alert-danger'>";
    echo "<strong>" . __("Accès refusé", 'universite') . "</strong><br>";
    echo __("Vous n'avez pas les droits pour accéder à cette section", 'universite');
    echo "</div>";
    echo "</div>";
}

Html::footer();
?>
