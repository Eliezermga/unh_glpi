<?php

/**
 * ---------------------------------------------------------------------
 *
 * Script de création des congés académiques UNH (Université Nouveaux Horizons)
 *
 * Crée les congés dans la table glpi_holidays pour le calendrier universitaire.
 * Les congés doivent ensuite être associés à un calendrier via Configuration > Calendriers.
 *
 * Usage (CLI) : php scripts/create_university_holidays.php [année]
 * Exemple : php scripts/create_university_holidays.php 2025
 *
 * Usage (web) : Accédez à ce script via l'URL (nécessite droits config)
 *
 * @copyright 2025 UNH
 * ---------------------------------------------------------------------
 */

define('GLPI_ROOT', dirname(__DIR__));
include(GLPI_ROOT . "/inc/includes.php");

// Vérifier les droits
Session::checkRight("config", UPDATE);

$year = isset($argv[1]) ? (int) $argv[1] : (int) date('Y');
if ($year < 2020 || $year > 2030) {
    $year = (int) date('Y');
}

$holidays_data = [
    [
        'name'       => 'Rentrée universitaire',
        'begin_date' => "$year-09-01",
        'end_date'   => "$year-09-01",
        'is_perpetual' => 0,
    ],
    [
        'name'       => 'Vacances de Noël',
        'begin_date' => "$year-12-23",
        'end_date'   => ($year + 1) . "-01-05",
        'is_perpetual' => 0,
    ],
    [
        'name'       => 'Session d\'examens - Semestre 1',
        'begin_date' => "$year-12-15",
        'end_date'   => "$year-12-22",
        'is_perpetual' => 0,
    ],
    [
        'name'       => 'Vacances de Pâques',
        'begin_date' => ($year + 1) . "-04-01",
        'end_date'   => ($year + 1) . "-04-15",
        'is_perpetual' => 0,
    ],
    [
        'name'       => 'Session d\'examens - Semestre 2',
        'begin_date' => ($year + 1) . "-05-15",
        'end_date'   => ($year + 1) . "-06-15",
        'is_perpetual' => 0,
    ],
    [
        'name'       => 'Vacances d\'été',
        'begin_date' => ($year + 1) . "-07-01",
        'end_date'   => ($year + 1) . "-08-31",
        'is_perpetual' => 0,
    ],
];

$holiday = new Holiday();
$created = 0;
$errors = [];

foreach ($holidays_data as $data) {
    $data['entities_id'] = 0;
    if ($holiday->add($data)) {
        $created++;
    } else {
        $errors[] = $data['name'];
    }
}

if (php_sapi_name() === 'cli') {
    echo "Congés académiques UNH - Année $year\n";
    echo "Créés : $created / " . count($holidays_data) . "\n";
    if (!empty($errors)) {
        echo "Erreurs : " . implode(', ', $errors) . "\n";
    }
    echo "\nAssociez ces congés à votre calendrier via Configuration > Calendriers.\n";
} else {
    header('Content-Type: text/html; charset=utf-8');
    echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Congés académiques UNH</title></head><body>";
    echo "<h1>Congés académiques UNH - Année $year</h1>";
    echo "<p><strong>Créés :</strong> $created / " . count($holidays_data) . "</p>";
    if (!empty($errors)) {
        echo "<p style='color:red'>Erreurs : " . implode(', ', $errors) . "</p>";
    }
    echo "<p>Associez ces congés à votre calendrier via <strong>Configuration > Calendriers</strong>.</p>";
    echo "</body></html>";
}
