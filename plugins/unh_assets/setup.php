<?php
/**
 * Configuration du Plugin UNH Assets
 * Université Nouveaux Horizons
 */

// Éviter l'accès direct
if (!defined('GLPI_ROOT')) {
    die("Direct access not allowed");
}

/**
 * Classe de configuration du plugin
 */

// in plugins/unh_assets/setup.php (or plugin.php)
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

/**
 * Initialisation du plugin - Déclarer la conformité CSRF
 */
function plugin_init_unh_assets() {
    global $PLUGIN_HOOKS;
    
    // Déclarer le plugin conforme CSRF (OBLIGATOIRE)
    $PLUGIN_HOOKS['csrf_compliant']['unh_assets'] = true;
    
    // Enregistrer les hooks du plugin
    PluginUNHAssetsSetup::registerHooks();
}

class PluginUNHAssetsSetup
{
    /**
     * Enregistrer les hooks du plugin
     */
    public static function registerHooks()
    {
        $plugin = new Plugin();
        if ($plugin->isActivated('unh_assets')) {
            // Ajouter des hooks si nécessaire
        }
    }

    /**
     * Initialiser les permissions
     */
    public static function initPermissions()
    {
        // Définir les droits personnalisés du plugin
        return [
            'unh_assets:assets' => __('Consulter le parc informatique', 'unh_assets'),
            'unh_assets:manage' => __('Gérer les équipements', 'unh_assets'),
            'unh_assets:alerts' => __('Gérer les alertes', 'unh_assets'),
        ];
    }
}
