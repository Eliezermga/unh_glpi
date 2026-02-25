<?php
include ('../../inc/includes.php');

Html::header(
    __('Gestion des Projets', 'projet'),
    $_SERVER['PHP_SELF'],
    'tools',
    'PluginProjet'
);

echo "<div class='center'>";
echo "<h2>Bienvenue sur le module de gestion des projets.</h2>";
echo "<p>Cette page servira à afficher et gérer les projets étudiants et de recherche.</p>";
echo "</div>";

Html::footer();
