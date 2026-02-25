<?php

define('PLUGIN_ACCESSSECURITE_VERSION', '1.0.0');
define('PLUGIN_ACCESSSECURITE_MIN_GLPI', '10.0.0');
define('PLUGIN_ACCESSSECURITE_MAX_GLPI', '10.0.99');

function plugin_version_accesssecurite() {
    return [
        'name'           => 'Accès et sécurité des utilisateurs',
        'version'        => PLUGIN_ACCESSSECURITE_VERSION,
        'author'         => 'Admin',
        'license'        => 'GPLv3+',
        'homepage'       => '',
        'requirements'   => [
            'glpi' => [
                'min' => PLUGIN_ACCESSSECURITE_MIN_GLPI,
                'max' => PLUGIN_ACCESSSECURITE_MAX_GLPI
            ]
        ]
    ];
}

function plugin_init_accesssecurite() {
    global $PLUGIN_HOOKS;

    $PLUGIN_HOOKS['csrf_compliant']['accesssecurite'] = true;
    
    $PLUGIN_HOOKS['menu_toadd']['accesssecurite'] = ['tools' => 'PluginAccesssecuriteMenu'];
}

function plugin_accesssecurite_check_prerequisites() {
    if (version_compare(GLPI_VERSION, PLUGIN_ACCESSSECURITE_MIN_GLPI, 'lt') 
        || version_compare(GLPI_VERSION, PLUGIN_ACCESSSECURITE_MAX_GLPI, 'gt')) {
        return false;
    }
    return true;
}

function plugin_accesssecurite_check_config() {
    return true;
}

class PluginAccesssecuriteMenu extends CommonGLPI {
    static function getMenuName() {
        return 'Accès et sécurité';
    }

    static function getMenuContent() {
        $menu = [];
        $menu['title'] = self::getMenuName();
        $menu['page']  = '/plugins/accesssecurite/front/security.php';
        $menu['icon']  = 'fas fa-shield-alt';
        return $menu;
    }
}
