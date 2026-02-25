<?php

// Enregistrement de la classe RoomIncident
Plugin::registerClass('RoomIncident', ['addtabon' => 'Central']);

// Hooks pour le menu
$PLUGIN_HOOKS['menu_toadd']['roomincident'] = ['tools' => 'RoomIncident'];

// Hook pour l'initialisation
$PLUGIN_HOOKS['init']['roomincident'] = function() {
    // Créer la table si elle n'existe pas
    RoomIncident::createTable();
};

?>
