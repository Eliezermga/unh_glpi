<?php
// dashboardFunctions.php

/**
 * Fonction safeCount pour tester les comptages
 */
function safeCount($DB, $table, $where = []) {
    $res = $DB->request([
        'COUNT' => 'cpt',
        'FROM'  => $table,
        'WHERE' => $where
    ])->current();
    return $res['cpt'] ?? 0;
}

/**
 * Exemple de fonction pour KPI incidents
 */
function getOpenIncidents($DB) {
    return safeCount($DB, 'glpi_plugin_unhassets_incidents', ['status' => 'open']);
}

function getResolvedIncidents($DB) {
    return safeCount($DB, 'glpi_plugin_unhassets_incidents', ['status' => 'resolved']);
}
