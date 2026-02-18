<?php
/**
 * GLPI UNH - Installation des catégories, SLA et groupes
 * Conforme aux bonnes pratiques GLPI
 * 
 * À exécuter en ligne de commande : php install/unh_customization.php
 */

define('GLPI_ROOT', dirname(__DIR__));
define('DO_NOT_CHECK_HTTP_REFERER', 1);

include (GLPI_ROOT . '/inc/includes.php');

// Initialiser la session en mode CLI
Session::setPath();
Session::start();

// Charger l'utilisateur admin
$auth = new Auth();
if (!$auth->getLoginAuthMethods()) {
    die("Erreur: Impossible d'initialiser l'authentification\n");
}

// Utiliser le compte glpi par défaut
$_SESSION['glpiID'] = 2; // ID de l'utilisateur glpi
$_SESSION['glpiname'] = 'glpi';
$_SESSION['glpiactiveprofile']['config'] = 'w';

echo "=== Installation GLPI UNH - Personnalisation des Tickets ===\n\n";

// 1. CATÉGORIES DE TICKETS
echo "[1/4] Création des catégories...\n";

$category = new ITILCategory();

$categories = [
    'Matériel' => [
        'comment' => 'Problèmes liés au matériel informatique',
        'children' => [
            'Ordinateur portable' => 'Problèmes avec les ordinateurs portables',
            'Ordinateur fixe' => 'Problèmes avec les ordinateurs de bureau',
            'Imprimante' => 'Problemes avec les imprimantes',
            'Projecteur' => 'Problèmes avec les projecteurs'
        ]
    ],
    'Logiciel' => [
        'comment' => 'Problèmes liés aux logiciels',
        'children' => [
            'Moodle' => 'Plateforme Moodle',
            'Office' => 'Suite Microsoft Office',
            'Antivirus' => 'Logiciel antivirus'
        ]
    ],
    'Réseau' => [
        'comment' => 'Problèmes de connectivité réseau',
        'children' => [
            'Wi-Fi campus' => 'Connexion Wi-Fi sur le campus',
            'VPN' => 'Accès VPN',
            'Ethernet' => 'Connexion filaire'
        ]
    ],
    'Compte' => [
        'comment' => 'Gestion des comptes utilisateurs',
        'children' => [
            'Réinitialisation mot de passe' => 'Réinitialisation de mot de passe',
            'Création compte' => 'Creation de nouveau compte',
            'Droits acces' => 'Modification des droits utilisateur'
        ]
    ]
];

foreach ($categories as $parent_name => $data) {
    $parent_id = $category->add([
        'name' => $parent_name,
        'comment' => $data['comment'],
        'is_incident' => 1,
        'is_request' => 1,
        'is_problem' => 1
    ]);
    
    if ($parent_id) {
        echo "  ✓ $parent_name\n";
        
        foreach ($data['children'] as $child_name => $child_comment) {
            $child_id = $category->add([
                'name' => $child_name,
                'comment' => $child_comment,
                'itilcategories_id' => $parent_id,
                'is_incident' => 1,
                'is_request' => 1,
                'is_problem' => 1
            ]);
            
            if ($child_id) {
                echo "    ✓ $child_name\n";
            }
        }
    }
}

// 2. TEMPLATES DE TICKETS
echo "\n[2/4] Création des templates...\n";

$template = new TicketTemplate();
$templates = [
    'Template Étudiant' => 'Template par défaut pour les étudiants',
    'Template Enseignant' => 'Template par défaut pour les enseignants',
    'Template Personnel' => 'Template par défaut pour le personnel administratif'
];

foreach ($templates as $name => $comment) {
    $id = $template->add([
        'name' => $name,
        'comment' => $comment,
        'is_recursive' => 1
    ]);
    
    if ($id) {
        echo "  ✓ $name\n";
    }
}

// 3. SLA
echo "\n[3/4] Création des SLA...\n";

$sla = new SLA();
$slas = [
    'SLA Étudiant - 72h' => ['time' => 72, 'comment' => 'Résolution sous 72 heures pour les étudiants'],
    'SLA Enseignant - 24h' => ['time' => 24, 'comment' => 'Résolution sous 24 heures pour les enseignants'],
    'SLA Personnel - 48h' => ['time' => 48, 'comment' => 'Résolution sous 48 heures pour le personnel'],
    'SLA Urgent - 4h' => ['time' => 4, 'comment' => 'Résolution urgente sous 4 heures']
];

foreach ($slas as $name => $data) {
    $id = $sla->add([
        'name' => $name,
        'comment' => $data['comment'],
        'type' => 1,
        'number_time' => $data['time'],
        'definition_time' => 'hour'
    ]);
    
    if ($id) {
        echo "  ✓ $name\n";
    }
}

// 4. GROUPES TECHNIQUES
echo "\n[4/4] Création des groupes...\n";

$group = new Group();
$groups = [
    'Support Réseau' => 'Équipe en charge des problèmes réseau',
    'Support Matériel' => 'Équipe en charge du matériel',
    'Support Logiciel' => 'Équipe en charge des logiciels',
    'Support Comptes' => 'Équipe en charge de la gestion des comptes'
];

foreach ($groups as $name => $comment) {
    $id = $group->add([
        'name' => $name,
        'comment' => $comment,
        'is_assign' => 1
    ]);
    
    if ($id) {
        echo "  ✓ $name\n";
    }
}

echo "\n=== Installation terminée avec succès ! ===\n";
