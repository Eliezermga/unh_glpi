<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginUnhassetsMenu extends CommonGLPI {

    static $rightname = 'config';

    static function getMenuName() {
        return __('UNH Assets', 'unhassets');
    }

    static function getMenuContent() {
        global $CFG_GLPI;
        
        $menu = [];
        
        // Configuration du menu principal
        $menu['title'] = self::getMenuName();
        $menu['page']  = '/plugins/unhassets/front/dashboard.php';
        $menu['icon']  = 'ti ti-building';
        $menu['default'] = '/plugins/unhassets/front/dashboard.php';

        // Sous-menus - IMPORTANT : utiliser la clé 'options'
        $menu['options'] = [];
        
        // Toujours visible
        $menu['types'] = [__CLASS__];
        
        // === VOS MODULES PERSONNALISÉS ===
        
        $menu['options']['dashboard'] = [
            'title' => __('Tableau de bord', 'unhassets'),
            'page'  => '/plugins/unhassets/front/dashboard.php',
            'icon'  => 'ti ti-chart-line',
            'links' => [
                'search' => '/plugins/unhassets/front/dashboard.php',
            ]
        ];

        $menu['options']['asset'] = [
            'title' => __('Gestion du parc', 'unhassets'),
            'page'  => '/plugins/unhassets/front/asset.php',
            'icon'  => 'ti ti-device-desktop',
            'links' => [
                'search' => '/plugins/unhassets/front/asset.php',
                'add'    => '/plugins/unhassets/front/asset.form.php?id=-1',
            ]
        ];

        $menu['options']['reservation'] = [
            'title' => __('Réservations', 'unhassets'),
            'page'  => '/plugins/unhassets/front/reservation.php',
            'icon'  => 'ti ti-calendar-check',
            'links' => [
                'search' => '/plugins/unhassets/front/reservation.php',
                'add'    => '/plugins/unhassets/front/reservation.form.php?id=-1',
            ]
        ];

        $menu['options']['license'] = [
            'title' => __('Licences logicielles', 'unhassets'),
            'page'  => '/plugins/unhassets/front/license.php',
            'icon'  => 'ti ti-key',
            'links' => [
                'search' => '/plugins/unhassets/front/license.php',
                'add'    => '/plugins/unhassets/front/license.form.php?id=-1',
            ]
        ];

        // === ÉLÉMENTS DU PARC (pages natives GLPI réintégrées) ===
        //
        // Les pages natives (Computer, Monitor, etc.) ne sont plus intégrées
        // dans le menu du plugin. Le module UNH Assets propose désormais
        // uniquement ses propres écrans (dashboard, asset, reservation, license).

        return $menu;
    }

    // NOTE : on ne modifie jamais $_SESSION['glpimenu'] dans un plugin.
    // Le menu est géré via le hook redefine_menus dans setup.php.
}