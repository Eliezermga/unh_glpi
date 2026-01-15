<?php
if (!defined('GLPI_ROOT')) {
    die("Direct access not allowed");

}


define('PLUGIN_UNH_ASSETS_DIR', GLPI_ROOT . '/plugins/unh_assets');
define('PLUGIN_UNH_ASSETS_INC_DIR', PLUGIN_UNH_ASSETS_DIR . '/inc');
define('PLUGIN_UNH_ASSETS_FRONT_DIR', PLUGIN_UNH_ASSETS_DIR . '/front');

function plugin_version_unh_assets() {
    return [
        'name'           => 'UNH Assets',
        'version'        => '1.0.4',
        'author'         => 'David Fabrizi',
        'license'        => 'GPL-3.0',
        'homepage'       => 'https://example.org',
        'minGlpiVersion' => '9.5',   
        'maxGlpiVersion' => '10.0.7'   
    ];
}

function plugin_unh_assets_getRights() {
    return [
        'plugin_unh_assets' => [
            'label'   => 'Accès UNH Assets',
            'default' => false 
        ]
    ];
}



function plugin_init_unh_assets() {
    global $PLUGIN_HOOKS;

    // Plugin conforme CSRF
    $PLUGIN_HOOKS['csrf_compliant']['unh_assets'] = true;

    // ===== MENU =====
    $PLUGIN_HOOKS['menu_entry']['unh_assets'] = 'front/index.php';
    $PLUGIN_HOOKS['menu_name']['unh_assets']  = 'UNH Assets';

    // ===== DROITS =====
    $PLUGIN_HOOKS['change_profile']['unh_assets'] = 'plugin_unh_assets_change_profile';

    $PLUGIN_HOOKS['menu_entry']['unh_assets'] = [
    'file'   => 'front/index.php',
    'icon'   => 'fas fa-cubes',
    'name'   => 'UNH Assets',
    'rights' => ['plugin_unh_assets' => [READ]]
];


    // ===== CHARGEMENT DES CLASSES =====
    include_once PLUGIN_UNH_ASSETS_INC_DIR . '/Equipment.php';
    include_once PLUGIN_UNH_ASSETS_INC_DIR . '/EquipmentType.php';
    include_once PLUGIN_UNH_ASSETS_INC_DIR . '/Building.php';
    include_once PLUGIN_UNH_ASSETS_INC_DIR . '/Alert.php';
}



class PluginUNHAssetsSetup
{
    public static function registerHooks()
    {
        $plugin = new Plugin();
        if ($plugin->isActivated('unh_assets')) {
        }
    }

    public static function initPermissions()
    {
        return [
            'unh_assets:assets' => __('Consulter le parc informatique', 'unh_assets'),
            'unh_assets:manage' => __('Gérer les équipements', 'unh_assets'),
            'unh_assets:alerts' => __('Gérer les alertes', 'unh_assets'),
        ];
    }
}
