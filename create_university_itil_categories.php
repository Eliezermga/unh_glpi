<?php

/**
 * Script pour créer les catégories ITIL adaptées à un contexte universitaire
 * 
 * Usage: php create_university_itil_categories.php
 * Ou accès via navigateur: http://localhost/unh_glpi/create_university_itil_categories.php
 */

require_once(__DIR__ . '/inc/includes.php');

if (!isCommandLine()) {
    Session::checkLoginUser();
}

global $DB;

echo isCommandLine() ? '' : '<html><head><meta charset="UTF-8"><title>' . __('Creation of university ITIL categories') . '</title></head><body>';
echo isCommandLine() ? '' : '<h1>' . __('Creation of ITIL categories for university context') . '</h1>';
echo isCommandLine() ? '' : '<pre>';

// Structure hiérarchique des catégories ITIL pour une université
$university_categories = [
    // Catégories parentes (niveau 1)
    [
        'name' => __('Support Étudiant'),
        'code' => 'SUP_ETU',
        'comment' => __('Support technique pour les étudiants'),
        'is_incident' => 1,
        'is_request' => 1,
        'is_helpdeskvisible' => 1,
        'is_problem' => 0,
        'is_change' => 0,
        'children' => [
            [
                'name' => __('Problème de connexion'),
                'code' => 'SUP_ETU_CONN',
                'comment' => __('Problèmes de connexion WiFi, réseau, authentification'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Demande de compte'),
                'code' => 'SUP_ETU_COMPTE',
                'comment' => __('Création, réinitialisation de mot de passe, accès aux services'),
                'is_incident' => 0,
                'is_request' => 1,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Logiciel pédagogique'),
                'code' => 'SUP_ETU_LOGICIEL',
                'comment' => __('Installation, accès aux logiciels pédagogiques, licences'),
                'is_incident' => 1,
                'is_request' => 1,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Plateforme pédagogique'),
                'code' => 'SUP_ETU_PLATEFORME',
                'comment' => __('Problèmes d\'accès aux plateformes d\'apprentissage en ligne'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Imprimante / Impression'),
                'code' => 'SUP_ETU_IMPR',
                'comment' => __('Problèmes d\'impression, quotas, imprimantes étudiantes'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
        ]
    ],
    [
        'name' => __('Support Enseignant'),
        'code' => 'SUP_ENS',
        'comment' => __('Support technique pour les enseignants et formateurs'),
        'is_incident' => 1,
        'is_request' => 1,
        'is_helpdeskvisible' => 1,
        'is_problem' => 0,
        'is_change' => 0,
        'children' => [
            [
                'name' => __('Équipement salle de cours'),
                'code' => 'SUP_ENS_SALLE',
                'comment' => __('Vidéoprojecteur, tableau interactif, système audio'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Vidéoprojecteur'),
                'code' => 'SUP_ENS_VIDEO',
                'comment' => __('Panne, configuration, connexion vidéoprojecteur'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Ordinateur portable / Bureau'),
                'code' => 'SUP_ENS_ORDI',
                'comment' => __('Problèmes avec l\'ordinateur de l\'enseignant'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Plateforme pédagogique'),
                'code' => 'SUP_ENS_PLATEFORME',
                'comment' => __('Accès, configuration, problèmes avec les plateformes d\'enseignement'),
                'is_incident' => 1,
                'is_request' => 1,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Logiciel pédagogique'),
                'code' => 'SUP_ENS_LOGICIEL',
                'comment' => __('Installation, configuration de logiciels spécialisés'),
                'is_incident' => 1,
                'is_request' => 1,
                'is_helpdeskvisible' => 1,
            ],
        ]
    ],
    [
        'name' => __('Support Réseau'),
        'code' => 'SUP_RESEAU',
        'comment' => __('Problèmes et demandes liés au réseau informatique'),
        'is_incident' => 1,
        'is_request' => 1,
        'is_helpdeskvisible' => 1,
        'is_problem' => 1,
        'is_change' => 1,
        'children' => [
            [
                'name' => __('WiFi / Sans fil'),
                'code' => 'SUP_RESEAU_WIFI',
                'comment' => __('Problèmes de connexion WiFi, points d\'accès'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Câblage réseau'),
                'code' => 'SUP_RESEAU_CABLE',
                'comment' => __('Problèmes de câblage, prises réseau, switches'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 0,
            ],
            [
                'name' => __('Serveurs'),
                'code' => 'SUP_RESEAU_SERVEUR',
                'comment' => __('Pannes serveurs, maintenance, configuration'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 0,
                'is_problem' => 1,
                'is_change' => 1,
            ],
            [
                'name' => __('Infrastructure réseau'),
                'code' => 'SUP_RESEAU_INFRA',
                'comment' => __('Routers, switches, pare-feu, configuration réseau'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 0,
                'is_problem' => 1,
                'is_change' => 1,
            ],
        ]
    ],
    [
        'name' => __('Support Matériel'),
        'code' => 'SUP_MAT',
        'comment' => __('Problèmes et demandes liés au matériel informatique'),
        'is_incident' => 1,
        'is_request' => 1,
        'is_helpdeskvisible' => 1,
        'is_problem' => 0,
        'is_change' => 0,
        'children' => [
            [
                'name' => __('Ordinateur'),
                'code' => 'SUP_MAT_ORDI',
                'comment' => __('Panne, réparation, remplacement d\'ordinateur'),
                'is_incident' => 1,
                'is_request' => 1,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Écran / Moniteur'),
                'code' => 'SUP_MAT_ECRAN',
                'comment' => __('Problèmes d\'affichage, remplacement d\'écran'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Imprimante'),
                'code' => 'SUP_MAT_IMPR',
                'comment' => __('Panne imprimante, maintenance, configuration'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Périphérique'),
                'code' => 'SUP_MAT_PERIPH',
                'comment' => __('Souris, clavier, webcam, casque, etc.'),
                'is_incident' => 1,
                'is_request' => 1,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Téléphone / VoIP'),
                'code' => 'SUP_MAT_TEL',
                'comment' => __('Problèmes téléphoniques, configuration VoIP'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
        ]
    ],
    [
        'name' => __('Support Logiciel'),
        'code' => 'SUP_LOG',
        'comment' => __('Problèmes et demandes liés aux logiciels'),
        'is_incident' => 1,
        'is_request' => 1,
        'is_helpdeskvisible' => 1,
        'is_problem' => 0,
        'is_change' => 0,
        'children' => [
            [
                'name' => __('Installation logiciel'),
                'code' => 'SUP_LOG_INSTALL',
                'comment' => __('Demande d\'installation de logiciel'),
                'is_incident' => 0,
                'is_request' => 1,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Licence logicielle'),
                'code' => 'SUP_LOG_LICENCE',
                'comment' => __('Demande de licence, activation, renouvellement'),
                'is_incident' => 0,
                'is_request' => 1,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Panne logicielle'),
                'code' => 'SUP_LOG_PANNE',
                'comment' => __('Logiciel qui ne fonctionne pas, erreurs, plantages'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Mise à jour / Mise à niveau'),
                'code' => 'SUP_LOG_MAJ',
                'comment' => __('Demande de mise à jour de logiciel'),
                'is_incident' => 0,
                'is_request' => 1,
                'is_helpdeskvisible' => 1,
            ],
        ]
    ],
    [
        'name' => __('Support Administratif'),
        'code' => 'SUP_ADMIN',
        'comment' => __('Support pour le personnel administratif'),
        'is_incident' => 1,
        'is_request' => 1,
        'is_helpdeskvisible' => 1,
        'is_problem' => 0,
        'is_change' => 0,
        'children' => [
            [
                'name' => __('Système de gestion'),
                'code' => 'SUP_ADMIN_SYS',
                'comment' => __('Problèmes avec les systèmes de gestion administratifs'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Accès aux données'),
                'code' => 'SUP_ADMIN_ACCES',
                'comment' => __('Demande d\'accès, permissions, partages'),
                'is_incident' => 0,
                'is_request' => 1,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Équipement bureautique'),
                'code' => 'SUP_ADMIN_BUREAU',
                'comment' => __('Problèmes avec les équipements de bureau'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
        ]
    ],
    [
        'name' => __('Sécurité'),
        'code' => 'SUP_SEC',
        'comment' => __('Incidents et demandes liés à la sécurité informatique'),
        'is_incident' => 1,
        'is_request' => 0,
        'is_helpdeskvisible' => 1,
        'is_problem' => 1,
        'is_change' => 0,
        'children' => [
            [
                'name' => __('Virus / Malware'),
                'code' => 'SUP_SEC_VIRUS',
                'comment' => __('Détection de virus, malware, infection'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
            [
                'name' => __('Tentative d\'intrusion'),
                'code' => 'SUP_SEC_INTRUSION',
                'comment' => __('Tentative d\'intrusion, accès non autorisé'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 0,
                'is_problem' => 1,
            ],
            [
                'name' => __('Perte de données'),
                'code' => 'SUP_SEC_DONNEES',
                'comment' => __('Perte, corruption, récupération de données'),
                'is_incident' => 1,
                'is_request' => 0,
                'is_helpdeskvisible' => 1,
            ],
        ]
    ],
];

$category = new ITILCategory();
$created_parents = 0;
$created_children = 0;
$skipped = 0;
$parent_ids = [];

echo __('Création des catégories ITIL...') . PHP_EOL;
echo PHP_EOL;

// Créer d'abord les catégories parentes
foreach ($university_categories as $parent_data) {
    // Vérifier si la catégorie parente existe déjà
    $iterator = $DB->request([
        'FROM' => 'glpi_itilcategories',
        'WHERE' => [
            'name' => $DB->escape($parent_data['name']),
            'entities_id' => 0,
            'itilcategories_id' => 0
        ]
    ]);
    
    if (count($iterator) > 0) {
        $existing = $iterator->current();
        $parent_ids[$parent_data['code']] = $existing['id'];
        echo sprintf(__('⚠ Catégorie parente "%s" existe déjà (ID: %d)'), $parent_data['name'], $existing['id']) . PHP_EOL;
        $skipped++;
        continue;
    }
    
    // Préparer les données pour la création
    $input = [
        'name' => $DB->escape($parent_data['name']), // Échapper le nom
        'code' => $parent_data['code'],
        'comment' => $DB->escape($parent_data['comment']), // Échapper les apostrophes
        'entities_id' => 0,
        'is_recursive' => 1,
        'itilcategories_id' => 0, // Catégorie racine
        'is_incident' => $parent_data['is_incident'] ?? 1,
        'is_request' => $parent_data['is_request'] ?? 1,
        'is_helpdeskvisible' => $parent_data['is_helpdeskvisible'] ?? 1,
        'is_problem' => $parent_data['is_problem'] ?? 0,
        'is_change' => $parent_data['is_change'] ?? 0,
    ];
    
    // Créer la catégorie parente
    if ($parent_id = $category->add($input)) {
        $parent_ids[$parent_data['code']] = $parent_id;
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
foreach ($university_categories as $parent_data) {
    if (!isset($parent_ids[$parent_data['code']]) || !isset($parent_data['children'])) {
        continue;
    }
    
    $parent_id = $parent_ids[$parent_data['code']];
    
    foreach ($parent_data['children'] as $child_data) {
        // Vérifier si la sous-catégorie existe déjà
        $iterator = $DB->request([
            'FROM' => 'glpi_itilcategories',
            'WHERE' => [
                'name' => $DB->escape($child_data['name']),
                'entities_id' => 0,
                'itilcategories_id' => $parent_id
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
            'name' => $DB->escape($child_data['name']), // Échapper le nom
            'code' => $child_data['code'],
            'comment' => $DB->escape($comment), // Échapper les apostrophes
            'entities_id' => 0,
            'is_recursive' => 1,
            'itilcategories_id' => $parent_id,
            'is_incident' => $child_data['is_incident'] ?? 1,
            'is_request' => $child_data['is_request'] ?? 1,
            'is_helpdeskvisible' => $child_data['is_helpdeskvisible'] ?? 1,
            'is_problem' => $child_data['is_problem'] ?? 0,
            'is_change' => $child_data['is_change'] ?? 0,
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

