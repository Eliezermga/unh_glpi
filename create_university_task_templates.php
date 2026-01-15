<?php

/**
 * Script pour créer des gabarits de tâches adaptés à un contexte universitaire
 * 
 * Usage: php create_university_task_templates.php
 * Ou accès via navigateur: http://localhost/unh_glpi/create_university_task_templates.php
 */

require_once(__DIR__ . '/inc/includes.php');

if (!isCommandLine()) {
    Session::checkLoginUser();
}

global $DB;

echo isCommandLine() ? '' : '<html><head><meta charset="UTF-8"><title>Création des gabarits de tâches universitaires</title></head><body>';
echo isCommandLine() ? '' : '<h1>Création des gabarits de tâches pour contexte universitaire</h1>';
echo isCommandLine() ? '' : '<pre>';

// Fonction pour récupérer l'ID d'une catégorie de tâche par son nom
function getTaskCategoryId($name, $parent_name = null) {
    global $DB;
    
    $where = [
        'name' => $DB->escape($name),
        'entities_id' => 0
    ];
    
    if ($parent_name !== null) {
        // Chercher d'abord le parent
        $parent_iterator = $DB->request([
            'FROM' => 'glpi_taskcategories',
            'WHERE' => [
                'name' => $DB->escape($parent_name),
                'entities_id' => 0,
                'taskcategories_id' => 0
            ]
        ]);
        
        if (count($parent_iterator) > 0) {
            $parent = $parent_iterator->current();
            $where['taskcategories_id'] = $parent['id'];
        }
    } else {
        $where['taskcategories_id'] = 0;
    }
    
    $iterator = $DB->request([
        'FROM' => 'glpi_taskcategories',
        'WHERE' => $where
    ]);
    
    if (count($iterator) > 0) {
        return $iterator->current()['id'];
    }
    
    return 0;
}

// Définition des gabarits de tâches pour une université
$university_task_templates = [
    // Diagnostic
    [
        'name' => __('Diagnostic matériel - Ordinateur'),
        'content' => __('<p><strong>Diagnostic matériel effectué :</strong></p><ul><li>Vérification des composants internes</li><li>Test de la mémoire RAM</li><li>Vérification du disque dur</li><li>Test de l\'alimentation</li><li>Vérification des connexions</li></ul><p><strong>Résultat :</strong></p><p>[À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Diagnostic matériel'), __('Diagnostic / Analyse')),
        'actiontime' => 2 * HOUR_TIMESTAMP, // 2 heures
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    [
        'name' => __('Diagnostic réseau - Connexion'),
        'content' => __('<p><strong>Diagnostic réseau effectué :</strong></p><ul><li>Vérification de la connectivité physique</li><li>Test de ping vers la passerelle</li><li>Vérification de la configuration IP</li><li>Test de résolution DNS</li><li>Vérification des ports réseau</li></ul><p><strong>Résultat :</strong></p><p>[À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Diagnostic réseau'), __('Diagnostic / Analyse')),
        'actiontime' => 1 * HOUR_TIMESTAMP, // 1 heure
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    [
        'name' => __('Diagnostic logiciel - Plantage'),
        'content' => __('<p><strong>Diagnostic logiciel effectué :</strong></p><ul><li>Analyse des logs système</li><li>Vérification des erreurs d\'application</li><li>Test de compatibilité</li><li>Vérification des mises à jour</li><li>Analyse des conflits logiciels</li></ul><p><strong>Résultat :</strong></p><p>[À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Diagnostic logiciel'), __('Diagnostic / Analyse')),
        'actiontime' => 1.5 * HOUR_TIMESTAMP, // 1h30
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    
    // Réparation / Maintenance
    [
        'name' => __('Maintenance préventive - Ordinateur'),
        'content' => __('<p><strong>Maintenance préventive effectuée :</strong></p><ul><li>Nettoyage physique de l\'équipement</li><li>Vérification des composants</li><li>Nettoyage des fichiers temporaires</li><li>Vérification de l\'antivirus</li><li>Mise à jour des pilotes</li><li>Vérification de l\'espace disque</li></ul><p><strong>État de l\'équipement :</strong> [À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Maintenance préventive'), __('Réparation / Maintenance')),
        'actiontime' => 1.5 * HOUR_TIMESTAMP, // 1h30
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    [
        'name' => __('Remplacement d\'équipement'),
        'content' => __('<p><strong>Remplacement d\'équipement effectué :</strong></p><ul><li>Récupération de l\'ancien équipement</li><li>Installation du nouvel équipement</li><li>Configuration de base</li><li>Transfert des données si nécessaire</li><li>Test de fonctionnement</li><li>Formation de l\'utilisateur</li></ul><p><strong>Équipement remplacé :</strong> [À compléter]</p><p><strong>Nouvel équipement :</strong> [À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Remplacement d\'équipement'), __('Réparation / Maintenance')),
        'actiontime' => 3 * HOUR_TIMESTAMP, // 3 heures
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    [
        'name' => __('Mise à jour firmware - Équipement réseau'),
        'content' => __('<p><strong>Mise à jour firmware effectuée :</strong></p><ul><li>Sauvegarde de la configuration actuelle</li><li>Téléchargement de la nouvelle version</li><li>Vérification de la compatibilité</li><li>Application de la mise à jour</li><li>Vérification du fonctionnement</li><li>Restauration de la configuration si nécessaire</li></ul><p><strong>Version précédente :</strong> [À compléter]</p><p><strong>Nouvelle version :</strong> [À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Mise à jour firmware'), __('Réparation / Maintenance')),
        'actiontime' => 2 * HOUR_TIMESTAMP, // 2 heures
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    
    // Installation / Configuration
    [
        'name' => __('Installation logicielle - Application'),
        'content' => __('<p><strong>Installation logicielle effectuée :</strong></p><ul><li>Vérification des prérequis système</li><li>Téléchargement/obtention du logiciel</li><li>Installation du logiciel</li><li>Configuration initiale</li><li>Vérification du fonctionnement</li><li>Formation de l\'utilisateur si nécessaire</li></ul><p><strong>Logiciel installé :</strong> [À compléter]</p><p><strong>Version :</strong> [À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Installation logicielle'), __('Installation / Configuration')),
        'actiontime' => 1.5 * HOUR_TIMESTAMP, // 1h30
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    [
        'name' => __('Configuration système - Nouveau poste'),
        'content' => __('<p><strong>Configuration système effectuée :</strong></p><ul><li>Configuration réseau (IP, DNS, passerelle)</li><li>Configuration des imprimantes</li><li>Configuration des accès partagés</li><li>Installation des logiciels de base</li><li>Configuration du profil utilisateur</li><li>Vérification des accès</li></ul><p><strong>Poste configuré :</strong> [À compléter]</p><p><strong>Utilisateur :</strong> [À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Configuration système'), __('Installation / Configuration')),
        'actiontime' => 2.5 * HOUR_TIMESTAMP, // 2h30
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    [
        'name' => __('Configuration utilisateur - Nouveau compte'),
        'content' => __('<p><strong>Configuration utilisateur effectuée :</strong></p><ul><li>Création du compte utilisateur</li><li>Configuration des droits d\'accès</li><li>Configuration de la messagerie</li><li>Configuration des accès réseau</li><li>Configuration des applications</li><li>Formation de base</li></ul><p><strong>Utilisateur :</strong> [À compléter]</p><p><strong>Profil :</strong> [À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Configuration utilisateur'), __('Installation / Configuration')),
        'actiontime' => 1 * HOUR_TIMESTAMP, // 1 heure
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    
    // Formation / Support utilisateur
    [
        'name' => __('Formation logicielle - Utilisateur'),
        'content' => __('<p><strong>Formation logicielle effectuée :</strong></p><ul><li>Présentation des fonctionnalités de base</li><li>Démonstration des opérations courantes</li><li>Exercices pratiques</li><li>Réponses aux questions</li><li>Fourniture de documentation</li></ul><p><strong>Logiciel formé :</strong> [À compléter]</p><p><strong>Utilisateur formé :</strong> [À compléter]</p><p><strong>Durée :</strong> [À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Formation logicielle'), __('Formation / Support utilisateur')),
        'actiontime' => 2 * HOUR_TIMESTAMP, // 2 heures
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    [
        'name' => __('Support à distance - Assistance'),
        'content' => __('<p><strong>Support à distance effectué :</strong></p><ul><li>Prise de contact avec l\'utilisateur</li><li>Établissement de la connexion à distance</li><li>Diagnostic du problème</li><li>Résolution du problème</li><li>Vérification du fonctionnement</li><li>Explication à l\'utilisateur</li></ul><p><strong>Problème résolu :</strong> [À compléter]</p><p><strong>Solution appliquée :</strong> [À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Support à distance'), __('Formation / Support utilisateur')),
        'actiontime' => 1 * HOUR_TIMESTAMP, // 1 heure
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    [
        'name' => __('Support sur site - Intervention'),
        'content' => __('<p><strong>Support sur site effectué :</strong></p><ul><li>Déplacement sur le lieu d\'intervention</li><li>Diagnostic du problème sur place</li><li>Résolution du problème</li><li>Test de fonctionnement</li><li>Explication à l\'utilisateur</li><li>Documentation de l\'intervention</li></ul><p><strong>Lieu :</strong> [À compléter]</p><p><strong>Problème résolu :</strong> [À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Support sur site'), __('Formation / Support utilisateur')),
        'actiontime' => 2 * HOUR_TIMESTAMP, // 2 heures
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    
    // Tests / Validation
    [
        'name' => __('Tests fonctionnels - Équipement'),
        'content' => __('<p><strong>Tests fonctionnels effectués :</strong></p><ul><li>Test de démarrage</li><li>Test des fonctionnalités principales</li><li>Test de performance</li><li>Test de stabilité</li><li>Vérification des périphériques</li><li>Validation globale</li></ul><p><strong>Équipement testé :</strong> [À compléter]</p><p><strong>Résultat :</strong> [À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Tests fonctionnels'), __('Tests / Validation')),
        'actiontime' => 1.5 * HOUR_TIMESTAMP, // 1h30
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    [
        'name' => __('Validation utilisateur - Intervention'),
        'content' => __('<p><strong>Validation utilisateur effectuée :</strong></p><ul><li>Présentation de la solution à l\'utilisateur</li><li>Test en présence de l\'utilisateur</li><li>Vérification de la satisfaction</li><li>Collecte du retour utilisateur</li><li>Clôture de l\'intervention</li></ul><p><strong>Utilisateur :</strong> [À compléter]</p><p><strong>Validation :</strong> [À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Validation utilisateur'), __('Tests / Validation')),
        'actiontime' => 0.5 * HOUR_TIMESTAMP, // 30 minutes
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    
    // Communication
    [
        'name' => __('Contact utilisateur - Prise de rendez-vous'),
        'content' => __('<p><strong>Contact utilisateur effectué :</strong></p><ul><li>Prise de contact avec l\'utilisateur</li><li>Évaluation de la demande</li><li>Planification de l\'intervention</li><li>Confirmation du rendez-vous</li></ul><p><strong>Utilisateur contacté :</strong> [À compléter]</p><p><strong>Rendez-vous planifié :</strong> [À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Contact utilisateur'), __('Communication')),
        'actiontime' => 0.25 * HOUR_TIMESTAMP, // 15 minutes
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    [
        'name' => __('Mise à jour du statut - Communication'),
        'content' => __('<p><strong>Mise à jour du statut effectuée :</strong></p><ul><li>Évaluation de l\'avancement</li><li>Communication à l\'utilisateur</li><li>Mise à jour du ticket</li><li>Information des parties prenantes</li></ul><p><strong>Statut communiqué :</strong> [À compléter]</p><p><strong>Prochaine étape :</strong> [À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Mise à jour du statut'), __('Communication')),
        'actiontime' => 0.25 * HOUR_TIMESTAMP, // 15 minutes
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
    
    // Recherche / Investigation
    [
        'name' => __('Recherche de solution - Problème complexe'),
        'content' => __('<p><strong>Recherche de solution effectuée :</strong></p><ul><li>Analyse approfondie du problème</li><li>Recherche dans la base de connaissances</li><li>Consultation de la documentation</li><li>Recherche en ligne</li><li>Consultation de collègues</li><li>Élaboration de solutions possibles</li></ul><p><strong>Problème analysé :</strong> [À compléter]</p><p><strong>Solutions identifiées :</strong> [À compléter]</p>'),
        'taskcategories_id' => getTaskCategoryId(__('Recherche de solution'), __('Recherche / Investigation')),
        'actiontime' => 2 * HOUR_TIMESTAMP, // 2 heures
        'state' => Planning::TODO,
        'is_private' => 0,
    ],
];

$task_template = new TaskTemplate();
$created = 0;
$skipped = 0;
$errors = 0;

echo __('Création des gabarits de tâches...') . PHP_EOL;
echo PHP_EOL;

foreach ($university_task_templates as $template_data) {
    // Vérifier si le gabarit existe déjà
    $iterator = $DB->request([
        'FROM' => 'glpi_tasktemplates',
        'WHERE' => [
            'name' => $DB->escape($template_data['name']),
            'entities_id' => 0
        ]
    ]);
    
    if (count($iterator) > 0) {
        $existing = $iterator->current();
        echo sprintf(__('⚠ Gabarit "%s" existe déjà (ID: %d)'), $template_data['name'], $existing['id']) . PHP_EOL;
        $skipped++;
        continue;
    }
    
    // Préparer les données pour l'ajout
    $input = [
        'name' => $template_data['name'],
        'content' => $template_data['content'],
        'entities_id' => 0,
        'is_recursive' => 1,
    ];
    
    // Ajouter les champs optionnels s'ils existent
    if (isset($template_data['taskcategories_id']) && $template_data['taskcategories_id'] > 0) {
        $input['taskcategories_id'] = $template_data['taskcategories_id'];
    }
    if (isset($template_data['actiontime'])) {
        $input['actiontime'] = $template_data['actiontime'];
    }
    if (isset($template_data['state'])) {
        $input['state'] = $template_data['state'];
    }
    if (isset($template_data['is_private'])) {
        $input['is_private'] = $template_data['is_private'];
    }
    
    // Créer le gabarit
    $new_id = $task_template->add($input);
    
    if ($new_id) {
        echo sprintf(__('✓ Gabarit "%s" créé (ID: %d)'), $template_data['name'], $new_id) . PHP_EOL;
        $created++;
    } else {
        echo sprintf(__('✗ Erreur lors de la création du gabarit "%s"'), $template_data['name']) . PHP_EOL;
        $errors++;
    }
}

echo PHP_EOL;
echo __('=== Résumé ===') . PHP_EOL;
echo sprintf(__('Gabarits créés : %d'), $created) . PHP_EOL;
echo sprintf(__('Gabarits ignorés (déjà existants) : %d'), $skipped) . PHP_EOL;
echo sprintf(__('Erreurs : %d'), $errors) . PHP_EOL;

echo isCommandLine() ? '' : '</pre></body></html>';

