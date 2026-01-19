<?php
/**
 * Plugin UNH Assets pour GLPI - VERSION MINIMALE DE TEST
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
            
            // Définir le droit par défaut
            if (!isset($_SESSION['glpiactiveprofile']['plugin_unhassets'])) {
                $_SESSION['glpiactiveprofile']['plugin_unhassets'] = 0;
            }
            
            $PLUGIN_HOOKS['config_page']['unhassets'] = 'front/config.form.php';
            $PLUGIN_HOOKS['menu_entry']['unhassets'] = 'PluginUnhassetsMenu';
            
            // MASQUER le menu "Parc" d'origine
            $PLUGIN_HOOKS['redefine_menus']['unhassets'] = 'plugin_unhassets_redefine_menus';
        }
    }
}

function plugin_version_unhassets() {
    return [
        'name'    => 'UNH Assets Management',
        'version' => PLUGIN_UNHASSETS_VERSION,
        'author'  => 'David, Adriel, Tracy et Alex',
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
 * Fonction pour masquer le menu "Parc" et le remplacer par UNH Assets
 */
function plugin_unhassets_redefine_menus($menu) {
    if (isset($menu['assets'])) {
        unset($menu['assets']);
    }
    
    return $menu;
}