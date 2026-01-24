<?php
include ('../../../inc/includes.php');
Session::checkLoginUser();

Html::header('Accès sécurisé', $_SERVER['PHP_SELF'], 'tools', 'tools_custom');

if (Session::haveRight('config', READ)) {
   echo "<h2>Accès autorisé</h2>";
   echo "<p>Vous avez les droits nécessaires.</p>";
} else {
   echo "<h2>Accès limité</h2>";
   echo "<p>Vous êtes connecté mais avec des droits restreints.</p>";
}

Html::footer();