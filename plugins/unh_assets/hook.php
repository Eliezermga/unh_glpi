<?php
/**
 * GLPI Plugin UNH Assets
 * Université Nouveaux Horizons
 * 
 * Module de gestion centralisée du parc informatique
 * Plugin pour GLPI 10.x+
 *
 * @author Université Nouveaux Horizons
 * @license GPL v3 or later
 */

define('PLUGIN_UNH_ASSETS_VERSION', '1.0.0');

// Définir le chemin du plugin
define('PLUGIN_UNH_ASSETS_DIR', GLPI_ROOT . '/plugins/unh_assets');
define('PLUGIN_UNH_ASSETS_WEB_DIR', GLPI_ROOT . '/plugins/unh_assets/front');
define('PLUGIN_UNH_ASSETS_INC_DIR', PLUGIN_UNH_ASSETS_DIR . '/inc');

/**
 * Fonction de chargement du plugin
 */
function plugin_unh_assets_getPluginName()
{
    return 'UNH Assets - Gestion du Parc';
}

/**
 * Fonction de vérification de la version de GLPI
 */
function plugin_unh_assets_checkCompat()
{
    if (version_compare(GLPI_VERSION, '10.0', '<')) {
        echo __('Ce plugin nécessite GLPI 10.0 ou supérieur', 'unh_assets');
        return false;
    }
    return true;
}

/**
 * Fonction d'activation du plugin
 */
function plugin_unh_assets_install()
{
    global $DB;

    // Créer les tables
    $sql_file = PLUGIN_UNH_ASSETS_DIR . '/install/schema.sql';
    
    if (file_exists($sql_file)) {
        $sql_content = file_get_contents($sql_file);
        $statements = array_filter(
            array_map('trim', explode(';', $sql_content)),
            function ($s) {
                return !empty($s) && !str_starts_with($s, '--');
            }
        );

        foreach ($statements as $statement) {
            if (!empty($statement)) {
                try {
                    $DB->query($statement);
                } catch (Exception $e) {
                    // Ignorer les erreurs si les tables existent déjà
                    error_log("SQL Error: " . $e->getMessage());
                }
            }
        }
    }

    return true;
}

/**
 * Fonction de désactivation du plugin
 */
function plugin_unh_assets_uninstall()
{
    global $DB;
    
    // Supprimer les tables
    $tables = [
        'glpi_plugin_unh_assets_types',
        'glpi_plugin_unh_assets_buildings',
        'glpi_plugin_unh_assets_rooms',
        'glpi_plugin_unh_assets_equipments',
        'glpi_plugin_unh_assets_alerts',
        'glpi_plugin_unh_assets_maintenance_logs'
    ];

    foreach ($tables as $table) {
        $DB->query("DROP TABLE IF EXISTS `$table`");
    }

    return true;
}

/**
 * Fonction de définition des droits
 */
function plugin_unh_assets_getAddSearchOptions($itemtype)
{
    $sopt = [];

    if ($itemtype === 'Computer' || $itemtype === 'Printer') {
        $sopt[5100] = [
            'id' => 5100,
            'table' => 'glpi_plugin_unh_assets_equipments',
            'field' => 'name',
            'name' => __('Fiche Asset UNH', 'unh_assets'),
        ];
    }

    return $sopt;
}
