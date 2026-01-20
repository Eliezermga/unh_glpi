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
            
            // Définir le droit par défaut
            if (!isset($_SESSION['glpiactiveprofile']['plugin_unhassets'])) {
                $_SESSION['glpiactiveprofile']['plugin_unhassets'] = READ;
            }
            
            $PLUGIN_HOOKS['config_page']['unhassets'] = 'front/config.form.php';
            
            /*
             * Nous souhaitons que le menu « UNH Assets » remplace entièrement
             * le menu « Parc/Assets ». Pour cela, nous utilisons le hook
             * « redefine_menus » afin de supprimer l’entrée « assets » du
             * menu et d’ajouter une entrée « unhassets » contenant nos
             * sous‑menus. Le code du hook est défini plus bas dans ce fichier.
             */
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
    // Masquer le menu "Assets" (Parc) si présent. Le plugin offre sa propre vue du parc,
    // il n'est donc pas nécessaire de conserver l'entrée native. On supprime
    // l'entrée sans affecter les autres menus.
    if (isset($menus['assets'])) {
        unset($menus['assets']);
    }

    // Ajouter notre menu UNH Assets.
    // IMPORTANT (GLPI 10.0.x) : la clé 'content' attend directement la liste des
    // entrées de sous‑menu (title/page/links). Notre méthode getMenuContent()
    // retourne une structure plus large (avec 'options'). On injecte donc
    // uniquement $menucontent['options'] pour que le menu latéral affiche bien
    // les sous‑menus.
    if (class_exists('PluginUnhassetsMenu')) {
        $menucontent = PluginUnhassetsMenu::getMenuContent();
        $menus['unhassets'] = [
            'title'   => PluginUnhassetsMenu::getMenuName(),
            'default' => '/plugins/unhassets/front/dashboard.php',
            'icon'    => 'ti ti-building',
            'content' => $menucontent['options'] ?? [],
        ];
    }

    return $menus;
}