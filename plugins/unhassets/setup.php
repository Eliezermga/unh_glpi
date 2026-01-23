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
        
        // Enregistrement basique
        Plugin::registerClass('PluginUnhassetsAsset');
        Plugin::registerClass('PluginUnhassetsReservation');
        Plugin::registerClass('PluginUnhassetsLicense');
        Plugin::registerClass('PluginUnhassetsProfile');
        Plugin::registerClass('PluginUnhassetsMenu');

        if (Session::getLoginUserID()) {

            // IMPORTANT : ne jamais forcer de droits dans la session.
            // Les droits doivent venir de glpi_profilerights (chargés au login).

            $PLUGIN_HOOKS['config_page']['unhassets'] = 'front/config.form.php';

            // Remplacer entièrement le menu natif « Parc/Assets » par « UNH Assets ».
            // On ne touche pas à $_SESSION['glpimenu'] et on n'utilise pas menu_entry,
            // afin de ne pas écraser les autres menus de GLPI.
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
    // Masquer le menu « Assets/Parc »
    if (isset($menus['assets'])) {
        unset($menus['assets']);
    }
    
    // Ajouter notre menu UNH Assets sans toucher aux autres menus
    if (class_exists('PluginUnhassetsMenu')) {
        $menucontent = PluginUnhassetsMenu::getMenuContent();
        $menus['unhassets'] = [
            'title'   => PluginUnhassetsMenu::getMenuName(),
            'default' => '/plugins/unhassets/front/dashboard.php',
            'icon'    => 'ti ti-building',
            // GLPI 10.0.x attend ici la liste des sous-menus (options)
            'content' => $menucontent['options'] ?? [],
        ];
    }
    
    return $menus;
}