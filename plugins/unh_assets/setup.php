<?php
if (!defined('GLPI_ROOT')) {
    die("Direct access not allowed");
}


function plugin_version_unh_assets() {
    return [
        'name'           => 'UNH Assets',
        'version'        => '1.0.2',
        'author'         => 'David Fabrizi',
        'license'        => 'GPL-3.0',
        'homepage'       => 'https://example.org',
        'minGlpiVersion' => '9.5',   
        'maxGlpiVersion' => '10.0'   
    ];
}


function plugin_init_unh_assets() {
    global $PLUGIN_HOOKS;
    
    $PLUGIN_HOOKS['csrf_compliant']['unh_assets'] = true;
    PluginUNHAssetsSetup::registerHooks();
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
