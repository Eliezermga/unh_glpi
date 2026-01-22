<?php

/**
 * Script pour créer les catégories de tâches adaptées à un contexte universitaire
 * 
 * Usage: php create_university_task_categories.php
 * Ou accès via navigateur: http://localhost/unh_glpi/create_university_task_categories.php
 */

require_once(__DIR__ . '/inc/includes.php');

if (!isCommandLine()) {
    Session::checkLoginUser();
}

global $DB;

echo isCommandLine() ? '' : '<html><head><meta charset="UTF-8"><title>' . __('Creation of university task categories') . '</title></head><body>';
echo isCommandLine() ? '' : '<h1>' . __('Creation of task categories for university context') . '</h1>';
echo isCommandLine() ? '' : '<pre>';

// Structure hiérarchique des catégories de tâches pour une université
$university_task_categories = [
    // Catégories parentes (niveau 1)
    [
        'name' => __('Diagnostic / Analyse'),
        'comment' => __('Tâches de diagnostic et d\'analyse de problèmes'),
        'is_active' => 1,
        'children' => [
            [
                'name' => __('Diagnostic matériel'),
                'comment' => __('Analyse et diagnostic de pannes matérielles'),
                'is_active' => 1,
            ],
            [
                'name' => __('Diagnostic logiciel'),
                'comment' => __('Analyse de problèmes logiciels, erreurs, plantages'),
                'is_active' => 1,
            ],
            [
                'name' => __('Diagnostic réseau'),
                'comment' => __('Analyse de problèmes réseau, connectivité, performance'),
                'is_active' => 1,
            ],
            [
                'name' => __('Analyse de sécurité'),
                'comment' => __('Analyse d\'incidents de sécurité, vulnérabilités'),
                'is_active' => 1,
            ],
        ]
    ],
    [
        'name' => __('Réparation / Maintenance'),
        'comment' => __('Tâches de réparation et maintenance d\'équipements'),
        'is_active' => 1,
        'children' => [
            [
                'name' => __('Réparation matérielle'),
                'comment' => __('Réparation d\'équipements défectueux'),
                'is_active' => 1,
            ],
            [
                'name' => __('Maintenance préventive'),
                'comment' => __('Maintenance préventive, nettoyage, vérifications'),
                'is_active' => 1,
            ],
            [
                'name' => __('Remplacement d\'équipement'),
                'comment' => __('Remplacement d\'équipements en panne ou obsolètes'),
                'is_active' => 1,
            ],
            [
                'name' => __('Mise à jour firmware'),
                'comment' => __('Mise à jour du firmware d\'équipements'),
                'is_active' => 1,
            ],
        ]
    ],
    [
        'name' => __('Installation / Configuration'),
        'comment' => __('Tâches d\'installation et de configuration'),
        'is_active' => 1,
        'children' => [
            [
                'name' => __('Installation matérielle'),
                'comment' => __('Installation de nouveaux équipements matériels'),
                'is_active' => 1,
            ],
            [
                'name' => __('Installation logicielle'),
                'comment' => __('Installation de logiciels, applications'),
                'is_active' => 1,
            ],
            [
                'name' => __('Configuration système'),
                'comment' => __('Configuration de systèmes, paramètres réseau'),
                'is_active' => 1,
            ],
            [
                'name' => __('Configuration utilisateur'),
                'comment' => __('Configuration de comptes, profils utilisateurs'),
                'is_active' => 1,
            ],
        ]
    ],
    [
        'name' => __('Formation / Support utilisateur'),
        'comment' => __('Tâches de formation et support aux utilisateurs'),
        'is_active' => 1,
        'children' => [
            [
                'name' => __('Formation logicielle'),
                'comment' => __('Formation à l\'utilisation de logiciels'),
                'is_active' => 1,
            ],
            [
                'name' => __('Formation matérielle'),
                'comment' => __('Formation à l\'utilisation d\'équipements'),
                'is_active' => 1,
            ],
            [
                'name' => __('Support à distance'),
                'comment' => __('Assistance à distance, prise en main'),
                'is_active' => 1,
            ],
            [
                'name' => __('Support sur site'),
                'comment' => __('Assistance directement sur le lieu d\'utilisation'),
                'is_active' => 1,
            ],
        ]
    ],
    [
        'name' => __('Documentation'),
        'comment' => __('Tâches liées à la documentation'),
        'is_active' => 1,
        'children' => [
            [
                'name' => __('Rédaction de procédures'),
                'comment' => __('Création de documentation, guides d\'utilisation'),
                'is_active' => 1,
            ],
            [
                'name' => __('Mise à jour documentation'),
                'comment' => __('Mise à jour de documentation existante'),
                'is_active' => 1,
            ],
            [
                'name' => __('Création de tutoriels'),
                'comment' => __('Création de tutoriels vidéo ou écrits'),
                'is_active' => 1,
            ],
        ]
    ],
    [
        'name' => __('Tests / Validation'),
        'comment' => __('Tâches de tests et validation'),
        'is_active' => 1,
        'children' => [
            [
                'name' => __('Tests fonctionnels'),
                'comment' => __('Tests de fonctionnement d\'équipements ou logiciels'),
                'is_active' => 1,
            ],
            [
                'name' => __('Tests de performance'),
                'comment' => __('Tests de performance, charge, vitesse'),
                'is_active' => 1,
            ],
            [
                'name' => __('Validation utilisateur'),
                'comment' => __('Validation par l\'utilisateur final'),
                'is_active' => 1,
            ],
        ]
    ],
    [
        'name' => __('Communication'),
        'comment' => __('Tâches de communication avec les utilisateurs'),
        'is_active' => 1,
        'children' => [
            [
                'name' => __('Contact utilisateur'),
                'comment' => __('Prise de contact, rendez-vous avec utilisateur'),
                'is_active' => 1,
            ],
            [
                'name' => __('Mise à jour du statut'),
                'comment' => __('Communication de l\'avancement, statut'),
                'is_active' => 1,
            ],
            [
                'name' => __('Clôture et suivi'),
                'comment' => __('Communication de clôture, suivi post-intervention'),
                'is_active' => 1,
            ],
        ]
    ],
    [
        'name' => __('Recherche / Investigation'),
        'comment' => __('Tâches de recherche et investigation approfondie'),
        'is_active' => 1,
        'children' => [
            [
                'name' => __('Recherche de solution'),
                'comment' => __('Recherche de solutions à des problèmes complexes'),
                'is_active' => 1,
            ],
            [
                'name' => __('Investigation technique'),
                'comment' => __('Investigation approfondie de problèmes techniques'),
                'is_active' => 1,
            ],
            [
                'name' => __('Consultation base de connaissances'),
                'comment' => __('Consultation de la base de connaissances, documentation'),
                'is_active' => 1,
            ],
        ]
    ],
];

$category = new TaskCategory();
$created_parents = 0;
$created_children = 0;
$skipped = 0;
$parent_ids = [];

echo __('Création des catégories de tâches...') . PHP_EOL;
echo PHP_EOL;

// Créer d'abord les catégories parentes
foreach ($university_task_categories as $parent_data) {
    // Vérifier si la catégorie parente existe déjà
    $iterator = $DB->request([
        'FROM' => 'glpi_taskcategories',
        'WHERE' => [
            'name' => $DB->escape($parent_data['name']),
            'entities_id' => 0,
            'taskcategories_id' => 0
        ]
    ]);
    
    if (count($iterator) > 0) {
        $existing = $iterator->current();
        $parent_ids[$parent_data['name']] = $existing['id'];
        echo sprintf(__('⚠ Catégorie parente "%s" existe déjà (ID: %d)'), $parent_data['name'], $existing['id']) . PHP_EOL;
        $skipped++;
        continue;
    }
    
    // Préparer les données pour la création
    $input = [
        'name' => $DB->escape($parent_data['name']),
        'comment' => $DB->escape($parent_data['comment']),
        'entities_id' => 0,
        'is_recursive' => 1,
        'taskcategories_id' => 0, // Catégorie racine
        'is_active' => $parent_data['is_active'] ?? 1,
    ];
    
    // Créer la catégorie parente
    if ($parent_id = $category->add($input)) {
        $parent_ids[$parent_data['name']] = $parent_id;
        echo sprintf(__('✓ Catégorie parente "%s" créée (ID: %d)'), $parent_data['name'], $parent_id) . PHP_EOL;
        $created_parents++;
    } else {
        echo sprintf(__('✗ Erreur lors de la création de la catégorie parente "%s"'), $parent_data['name']) . PHP_EOL;
        continue;
    }
}

echo PHP_EOL;
echo __('Création des sous-catégories...') . PHP_EOL;
echo PHP_EOL;

// Créer ensuite les sous-catégories
foreach ($university_task_categories as $parent_data) {
    if (!isset($parent_ids[$parent_data['name']]) || !isset($parent_data['children'])) {
        continue;
    }
    
    $parent_id = $parent_ids[$parent_data['name']];
    
    foreach ($parent_data['children'] as $child_data) {
        // Vérifier si la sous-catégorie existe déjà
        $iterator = $DB->request([
            'FROM' => 'glpi_taskcategories',
            'WHERE' => [
                'name' => $DB->escape($child_data['name']),
                'entities_id' => 0,
                'taskcategories_id' => $parent_id
            ]
        ]);
        
        if (count($iterator) > 0) {
            echo sprintf(__('  ⚠ Sous-catégorie "%s" existe déjà'), $child_data['name']) . PHP_EOL;
            $skipped++;
            continue;
        }
        
        // Préparer les données pour la création
        $comment = $child_data['comment'] ?? '';
        $input = [
            'name' => $DB->escape($child_data['name']),
            'comment' => $DB->escape($comment),
            'entities_id' => 0,
            'is_recursive' => 1,
            'taskcategories_id' => $parent_id,
            'is_active' => $child_data['is_active'] ?? 1,
        ];
        
        // Créer la sous-catégorie
        if ($category->add($input)) {
            echo sprintf(__('  ✓ Sous-catégorie "%s" créée'), $child_data['name']) . PHP_EOL;
            $created_children++;
        } else {
            echo sprintf(__('  ✗ Erreur lors de la création de la sous-catégorie "%s"'), $child_data['name']) . PHP_EOL;
        }
    }
}

echo PHP_EOL;
echo __('Résumé:') . PHP_EOL;
echo sprintf(__('  - Catégories parentes créées: %d'), $created_parents) . PHP_EOL;
echo sprintf(__('  - Sous-catégories créées: %d'), $created_children) . PHP_EOL;
echo sprintf(__('  - Catégories ignorées (déjà existantes): %d'), $skipped) . PHP_EOL;
echo sprintf(__('  - Total catégories: %d'), $created_parents + $created_children) . PHP_EOL;

echo isCommandLine() ? '' : '</pre></body></html>';


