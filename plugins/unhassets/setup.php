<?php
/**
 * Plugin UNH Assets pour GLPI
 */

define('PLUGIN_UNHASSETS_VERSION', '1.0.0');
define('PLUGIN_UNHASSETS_MIN_GLPI', '10.0.0');
define('PLUGIN_UNHASSETS_MAX_GLPI', '10.0.99');

function plugin_init_unhassets() {
    global $PLUGIN_HOOKS, $CFG_GLPI;

    $PLUGIN_HOOKS['csrf_compliant']['unhassets'] = true;
    
    // Charger TOUTES les classes dès le début
    $inc_dir = __DIR__ . '/inc/';
    foreach (glob($inc_dir . '*.class.php') as $file) {
        require_once($file);
    }
    
    $plugin = new Plugin();
    if ($plugin->isActivated('unhassets')) {
        
        // Plugin::registerClass() sert UNIQUEMENT pour :
        // - addtabon    : ajouter un onglet sur un type natif
        // - ticket_types, contract_types, etc. : intégration dans des listes GLPI
        //
        // Pour une classe de données pure (CRUD sur sa propre table),
        // PAS besoin de registerClass(). L'autoloader suffit.
        //
        // PROBLÈME RACINE du "Duplicate key 23" :
        // Plugin::registerClass('PluginUnhassetsAsset') sans paramètre
        // fait que GLPI appelle getSearchOptionsToAdd() de cette classe
        // sur TOUS les itemtypes natifs (Computer, Monitor, etc.).
        // CommonDBTM fournit une implémentation par défaut de
        // getSearchOptionsToAdd() qui retourne rawSearchOptions() de la classe,
        // laquelle hérite des clés de CommonDBTM dont la clé 23.
        // → collision avec la clé 23 de Monitor/Computer/etc.
        //
        // Solution : seul AssetTab (qui étend CommonGLPI, sans clé héritée)
        // est enregistré avec addtabon. Les classes de données ne sont pas
        // enregistrées du tout — elles sont chargées via l'autoloader.

        Plugin::registerClass('PluginUnhassetsAssetTab', [
            'addtabon' => ['Computer', 'Monitor', 'Printer', 'NetworkEquipment', 'Peripheral', 'Phone']
        ]);

        if (Session::getLoginUserID()) {

            $PLUGIN_HOOKS['config_page']['unhassets'] = 'front/config.form.php';
            $PLUGIN_HOOKS['redefine_menus']['unhassets'] = 'plugin_unhassets_redefine_menus';
        }
    }
}

function plugin_version_unhassets() {
    return [
        'name'    => 'UNH Assets Management',
        'version' => PLUGIN_UNHASSETS_VERSION,
        'author'  => 'Université',
        'license' => 'GPLv2+',
        'requirements' => [
            'glpi' => [
                'min' => PLUGIN_UNHASSETS_MIN_GLPI,
                'max' => PLUGIN_UNHASSETS_MAX_GLPI
            ]
        ]
    ];
}

function plugin_unhassets_check_prerequisites() {
    return version_compare(GLPI_VERSION, PLUGIN_UNHASSETS_MIN_GLPI, 'ge') 
        && version_compare(GLPI_VERSION, PLUGIN_UNHASSETS_MAX_GLPI, 'lt');
}

function plugin_unhassets_check_config() {
    return true;
}

/**
 * Fonction pour redéfinir les menus et masquer Assets
 */
function plugin_unhassets_redefine_menus($menus) {

    if (!class_exists('PluginUnhassetsMenu')) {
        return $menus;
    }

    $menucontent = PluginUnhassetsMenu::getMenuContent();

    // ---------------------------------------------------------------
    // ETAPE 1 : Masquer le menu 'assets' de la navbar
    // On le supprime du tableau $menus (rendu Twig courant).
    // $_SESSION['glpimenu']['assets'] reste intact → les boutons "+"
    // sur les pages natives continuent de fonctionner.
    // ---------------------------------------------------------------
    unset($menus['assets']);

    // ---------------------------------------------------------------
    // ETAPE 2 : Construire notre menu 'unhassets'
    // ---------------------------------------------------------------
    $menus['unhassets'] = [
        'title'   => PluginUnhassetsMenu::getMenuName(),
        'default' => '/plugins/unhassets/front/dashboard.php',
        'icon'    => 'ti ti-building',
        'content' => $menucontent['options'] ?? [],
    ];

    // ---------------------------------------------------------------
    // ETAPE 3 : Fil d'Ariane pour les pages natives réutilisées
    //
    // Les pages natives (computer.php, monitor.php...) appellent :
    //   Html::header(..., 'assets', 'computer')
    // GLPI cherche le titre du menu parent dans $_SESSION['glpimenu']
    // à la clé 'assets'. Comme le menu assets existe toujours en session
    // (on a fait unset() sur $menus mais pas sur $_SESSION), le breadcrumb
    // affiche encore "Assets" ou rien selon la version.
    //
    // Pour forcer "UNH Assets" dans le breadcrumb des pages natives,
    // on écrase la clé 'assets' de la SESSION avec le titre de notre menu.
    // Les boutons "+" restent fonctionnels car $_SESSION['glpimenu']['assets']['content']
    // est préservé.
    // ---------------------------------------------------------------
    if (isset($_SESSION['glpimenu']['assets'])) {
        // Renommer le menu assets en session pour le breadcrumb
        $_SESSION['glpimenu']['assets']['title'] = PluginUnhassetsMenu::getMenuName();
        $_SESSION['glpimenu']['assets']['icon']  = 'ti ti-building';
    }

    // Injecter aussi notre menu dans la session pour le breadcrumb
    // des pages propres au plugin (asset.php, reservation.php, license.php)
    if (!isset($_SESSION['glpimenu']['unhassets'])) {
        $_SESSION['glpimenu']['unhassets'] = $menus['unhassets'];
    }

    return $menus;
}