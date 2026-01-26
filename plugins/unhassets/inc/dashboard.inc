<?php
// dashboard.inc.php
// Logique testable du dashboard – incidents et alertes

/**
 * Compte le nombre d'incidents ouverts
 */
function getOpenedIncidentsCount($DB) {
    $res = $DB->request([
        'COUNT' => 'cpt',
        'FROM'  => 'glpi_tickets',
        'WHERE' => ['status' => 1] // 1 = Ouvert
    ])->current();

    return (int)($res['cpt'] ?? 0);
}

/**
 * Compte le nombre d'incidents résolus
 */
function getResolvedIncidentsCount($DB) {
    $res = $DB->request([
        'COUNT' => 'cpt',
        'FROM'  => 'glpi_tickets',
        'WHERE' => ['status' => 6] // 6 = Résolu
    ])->current();

    return (int)($res['cpt'] ?? 0);
}

/**
 * Vérifie si le seuil d'alerte est atteint
 */
function isIncidentAlertTriggered($opened, $threshold = 10) {
    return $opened >= $threshold;
}
