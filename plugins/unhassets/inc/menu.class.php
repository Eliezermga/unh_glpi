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

        // Sous-menus
        $menu['options'] = [];
        
        // === SECTION TABLEAU DE BORD ===
        $menu['options']['dashboard'] = [
            'title' => __('Tableau de bord', 'unhassets'),
            'page'  => '/plugins/unhassets/front/dashboard.php',
            'icon'  => 'ti ti-chart-line'
        ];

        // === SECTION GESTION PERSONNALISÉE ===
        $menu['options']['asset'] = [
            'title' => __('Gestion du parc', 'unhassets'),
            'page'  => '/plugins/unhassets/front/asset.php',
            'icon'  => 'ti ti-device-desktop'
        ];

        $menu['options']['reservation'] = [
            'title' => __('Réservations', 'unhassets'),
            'page'  => '/plugins/unhassets/front/reservation.php',
            'icon'  => 'ti ti-calendar-check'
        ];

        $menu['options']['license'] = [
            'title' => __('Licences logicielles', 'unhassets'),
            'page'  => '/plugins/unhassets/front/license.php',
            'icon'  => 'ti ti-key'
        ];

        // === SECTION MATÉRIEL (éléments de Parc) ===
        
        // Ordinateurs
        if (Computer::canView()) {
            $menu['options']['computer'] = [
                'title' => Computer::getTypeName(Session::getPluralNumber()),
                'page'  => '/front/computer.php',
                'icon'  => Computer::getIcon(),
                'links' => [
                    'search' => '/front/computer.php',
                    'add'    => '/front/computer.form.php',
                ]
            ];
        }

        // Moniteurs
        if (Monitor::canView()) {
            $menu['options']['monitor'] = [
                'title' => Monitor::getTypeName(Session::getPluralNumber()),
                'page'  => '/front/monitor.php',
                'icon'  => Monitor::getIcon(),
                'links' => [
                    'search' => '/front/monitor.php',
                    'add'    => '/front/monitor.form.php',
                ]
            ];
        }

        // Logiciels
        if (Software::canView()) {
            $menu['options']['software'] = [
                'title' => Software::getTypeName(Session::getPluralNumber()),
                'page'  => '/front/software.php',
                'icon'  => Software::getIcon(),
                'links' => [
                    'search' => '/front/software.php',
                    'add'    => '/front/software.form.php',
                ]
            ];
        }

        // Équipements réseau
        if (NetworkEquipment::canView()) {
            $menu['options']['networkequipment'] = [
                'title' => NetworkEquipment::getTypeName(Session::getPluralNumber()),
                'page'  => '/front/networkequipment.php',
                'icon'  => NetworkEquipment::getIcon(),
                'links' => [
                    'search' => '/front/networkequipment.php',
                    'add'    => '/front/networkequipment.form.php',
                ]
            ];
        }

        // Imprimantes
        if (Printer::canView()) {
            $menu['options']['printer'] = [
                'title' => Printer::getTypeName(Session::getPluralNumber()),
                'page'  => '/front/printer.php',
                'icon'  => Printer::getIcon(),
                'links' => [
                    'search' => '/front/printer.php',
                    'add'    => '/front/printer.form.php',
                ]
            ];
        }

        // Périphériques
        if (Peripheral::canView()) {
            $menu['options']['peripheral'] = [
                'title' => Peripheral::getTypeName(Session::getPluralNumber()),
                'page'  => '/front/peripheral.php',
                'icon'  => Peripheral::getIcon(),
                'links' => [
                    'search' => '/front/peripheral.php',
                    'add'    => '/front/peripheral.form.php',
                ]
            ];
        }

        // Téléphones
        if (Phone::canView()) {
            $menu['options']['phone'] = [
                'title' => Phone::getTypeName(Session::getPluralNumber()),
                'page'  => '/front/phone.php',
                'icon'  => Phone::getIcon(),
                'links' => [
                    'search' => '/front/phone.php',
                    'add'    => '/front/phone.form.php',
                ]
            ];
        }

        return $menu;
    }

    static function removeRightsFromSession() {
        if (isset($_SESSION['glpimenu']['unhassets'])) {
            unset($_SESSION['glpimenu']['unhassets']);
        }
    }
}