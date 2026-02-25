<?php

include ('../inc/includes.php');

Session::checkLoginUser();

Html::header(RoomIncident::getTypeName(2), $_SERVER['PHP_SELF'], "config", "RoomIncident");

// Initialiser la table si elle n'existe pas
RoomIncident::createTable();

// Afficher les alertes d'incidents en retard en premier
echo '<div class="mt-3">';
RoomIncident::showOverdueAlerts();
echo '</div>';

// Afficher les statistiques détaillées
echo '<div class="mt-4">';
RoomIncident::showStatistics();
echo '</div>';

// Afficher l'historique des équipements
echo '<div class="mt-4">';
RoomIncident::showEquipmentHistory();
echo '</div>';

echo '<div class="mt-4">';
Search::show('RoomIncident');
echo '</div>';

Html::footer();
?>
