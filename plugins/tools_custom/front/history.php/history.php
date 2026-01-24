<?php
include ('../../../inc/includes.php');
Session::checkLoginUser();

Html::header('Historique des accès', $_SERVER['PHP_SELF'], 'tools', 'tools_custom');

echo "<h2>Historique (simulation)</h2>";
echo "<ul>";
echo "<li>Connexion utilisateur – succès</li>";
echo "<li>Accès module sécurisé – autorisé</li>";
echo "<li>Tentative accès admin – refusée</li>";
echo "</ul>";

Html::footer();