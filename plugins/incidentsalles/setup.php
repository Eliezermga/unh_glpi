<?php

/**
 * Plugin Gestion des incidents en salles
 */

define('PLUGIN_INCIDENTSALLES_VERSION', '1.0.0');
define('PLUGIN_INCIDENTSALLES_MIN_GLPI', '10.0.0');
define('PLUGIN_INCIDENTSALLES_MAX_GLPI', '10.0.99');

function plugin_version_incidentsalles() {
    return [
        'name'           => 'Gestion des incidents en salles',
        'version'        => PLUGIN_INCIDENTSALLES_VERSION,
        'author'         => 'Votre nom',
        'license'        => 'GPLv3+',
        'homepage'       => '',
        'requirements'   => [
            'glpi' => [
                'min' => PLUGIN_INCIDENTSALLES_MIN_GLPI,
                'max' => PLUGIN_INCIDENTSALLES_MAX_GLPI
            ]
        ]
    ];
}

function plugin_init_incidentsalles() {
    global $PLUGIN_HOOKS;

    $PLUGIN_HOOKS['csrf_compliant']['incidentsalles'] = true;
    
    Plugin::registerClass('PluginIncidentsallesInstall');
    
    $PLUGIN_HOOKS['menu_toadd']['incidentsalles'] = ['tools' => 'PluginIncidentsallesMenu'];
}

function plugin_incidentsalles_check_prerequisites() {
    if (version_compare(GLPI_VERSION, PLUGIN_INCIDENTSALLES_MIN_GLPI, 'lt') 
        || version_compare(GLPI_VERSION, PLUGIN_INCIDENTSALLES_MAX_GLPI, 'gt')) {
        return false;
    }
    return true;
}

function plugin_incidentsalles_check_config() {
    return true;
}

class PluginIncidentsallesMenu extends CommonGLPI {
    static function getMenuName() {
        return 'Incidents en salles';
    }

    static function getMenuContent() {
        $menu = [];
        $menu['title'] = self::getMenuName();
        $menu['page']  = '/plugins/incidentsalles/front/incident.php';
        $menu['icon']  = 'fas fa-exclamation-triangle';
        return $menu;
    }
}
