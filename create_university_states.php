<?php

/**
 * Script pour créer les statuts par défaut adaptés à un contexte universitaire
 * 
 * Usage: php create_university_states.php
 * Ou accès via navigateur: http://localhost/unh_glpi/create_university_states.php
 */

require_once(__DIR__ . '/inc/includes.php');

if (!isCommandLine()) {
    Session::checkLoginUser();
}

global $DB;

echo isCommandLine() ? '' : '<html><head><meta charset="UTF-8"><title>' . __('Creation of university states') . '</title></head><body>';
echo isCommandLine() ? '' : '<h1>' . __('Creation of default states for university context') . '</h1>';
echo isCommandLine() ? '' : '<pre>';

// Définition des statuts adaptés à un contexte universitaire
$university_states = [
    [
        'name' => __('En service'),
        'comment' => __('Équipement en service et utilisable'),
        'is_visible_computer' => 1,
        'is_visible_monitor' => 1,
        'is_visible_networkequipment' => 1,
        'is_visible_peripheral' => 1,
        'is_visible_phone' => 1,
        'is_visible_printer' => 1,
        'is_visible_softwarelicense' => 1,
        'is_visible_certificate' => 1,
    ],
    [
        'name' => __('En maintenance'),
        'comment' => __('Équipement en cours de maintenance'),
        'is_visible_computer' => 1,
        'is_visible_monitor' => 1,
        'is_visible_networkequipment' => 1,
        'is_visible_peripheral' => 1,
        'is_visible_phone' => 1,
        'is_visible_printer' => 1,
        'is_visible_softwarelicense' => 0,
        'is_visible_certificate' => 0,
    ],
    [
        'name' => __('Hors service'),
        'comment' => __('Équipement hors service, non utilisable'),
        'is_visible_computer' => 1,
        'is_visible_monitor' => 1,
        'is_visible_networkequipment' => 1,
        'is_visible_peripheral' => 1,
        'is_visible_phone' => 1,
        'is_visible_printer' => 1,
        'is_visible_softwarelicense' => 0,
        'is_visible_certificate' => 0,
    ],
    [
        'name' => __('En réparation'),
        'comment' => __('Équipement en cours de réparation'),
        'is_visible_computer' => 1,
        'is_visible_monitor' => 1,
        'is_visible_networkequipment' => 1,
        'is_visible_peripheral' => 1,
        'is_visible_phone' => 1,
        'is_visible_printer' => 1,
        'is_visible_softwarelicense' => 0,
        'is_visible_certificate' => 0,
    ],
    [
        'name' => __('En stock'),
        'comment' => __('Équipement en stock, disponible mais non assigné'),
        'is_visible_computer' => 1,
        'is_visible_monitor' => 1,
        'is_visible_networkequipment' => 1,
        'is_visible_peripheral' => 1,
        'is_visible_phone' => 1,
        'is_visible_printer' => 1,
        'is_visible_softwarelicense' => 0,
        'is_visible_certificate' => 0,
    ],
    [
        'name' => __('Réservé'),
        'comment' => __('Équipement réservé pour un usage spécifique'),
        'is_visible_computer' => 1,
        'is_visible_monitor' => 1,
        'is_visible_networkequipment' => 1,
        'is_visible_peripheral' => 1,
        'is_visible_phone' => 1,
        'is_visible_printer' => 1,
        'is_visible_softwarelicense' => 0,
        'is_visible_certificate' => 0,
    ],
];

$state = new State();
$created = 0;
$skipped = 0;

echo __('Création des statuts par défaut...') . PHP_EOL;
echo PHP_EOL;

foreach ($university_states as $state_data) {
    // Vérifier si le statut existe déjà
    $iterator = $DB->request([
        'FROM' => 'glpi_states',
        'WHERE' => [
            'name' => $state_data['name'],
            'entities_id' => 0
        ]
    ]);
    
    if (count($iterator) > 0) {
        echo sprintf(__('⚠ Statut "%s" existe déjà, ignoré'), $state_data['name']) . PHP_EOL;
        $skipped++;
        continue;
    }
    
    // Préparer les données pour la création
    $input = [
        'name' => $state_data['name'],
        'comment' => $state_data['comment'],
        'entities_id' => 0,
        'is_recursive' => 1,
        'states_id' => 0, // Pas de parent
    ];
    
    // Ajouter les champs de visibilité
    foreach ($state_data as $key => $value) {
        if (strpos($key, 'is_visible_') === 0) {
            $input[$key] = $value;
        }
    }
    
    // Créer le statut
    if ($state->add($input)) {
        echo sprintf(__('✓ Statut "%s" créé avec succès'), $state_data['name']) . PHP_EOL;
        $created++;
    } else {
        echo sprintf(__('✗ Erreur lors de la création du statut "%s"'), $state_data['name']) . PHP_EOL;
    }
}

echo PHP_EOL;
echo __('Résumé:') . PHP_EOL;
echo sprintf(__('  - Statuts créés: %d'), $created) . PHP_EOL;
echo sprintf(__('  - Statuts ignorés (déjà existants): %d'), $skipped) . PHP_EOL;
echo sprintf(__('  - Total: %d'), count($university_states)) . PHP_EOL;

echo isCommandLine() ? '' : '</pre></body></html>';



