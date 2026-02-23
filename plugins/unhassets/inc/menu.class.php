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
        // IMPORTANT : pour que le bouton "+" apparaisse sur les pages natives
        // (computer.php, printer.php, etc.), GLPI doit pouvoir retrouver le
        // contexte de menu via Html::header(). Ces pages appellent en interne
        // Html::header(..., "assets", "computer") ce qui fait référence à
        // $_SESSION['glpimenu']['assets']['content']['computer'].
        //
        // On injecte donc ces sous-menus AUSSI dans notre menu 'unhassets',
        // mais les droits (canCreate, canView) sont gérés nativement par GLPI
        // car les classes (Computer, Printer, etc.) ont leur propre $rightname.
        // On n'a donc rien à forcer ici : si l'utilisateur a le droit "computer"
        // dans son profil, le bouton "+" s'affichera automatiquement.

        // Ordinateurs
        if (Computer::canView()) {
            $menu['options']['computer'] = [
                'title'    => Computer::getTypeName(Session::getPluralNumber()),
                'page'     => Computer::getSearchURL(false),
                'icon'     => Computer::getIcon(),
                'itemtype' => 'Computer',   // ← clé critique pour les droits
                'links'    => [
                    'search' => Computer::getSearchURL(false),
                    'add'    => Computer::canCreate() ? Computer::getFormURL(false).'?id=-1' : '',
                ]
            ];
        }

        // Moniteurs
        if (Monitor::canView()) {
            $menu['options']['monitor'] = [
                'title'    => Monitor::getTypeName(Session::getPluralNumber()),
                'page'     => Monitor::getSearchURL(false),
                'icon'     => Monitor::getIcon(),
                'itemtype' => 'Monitor',
                'links'    => [
                    'search' => Monitor::getSearchURL(false),
                    'add'    => Monitor::canCreate() ? Monitor::getFormURL(false).'?id=-1' : '',
                ]
            ];
        }

        // Logiciels
        if (Software::canView()) {
            $menu['options']['software'] = [
                'title'    => Software::getTypeName(Session::getPluralNumber()),
                'page'     => Software::getSearchURL(false),
                'icon'     => Software::getIcon(),
                'itemtype' => 'Software',
                'links'    => [
                    'search' => Software::getSearchURL(false),
                    'add'    => Software::canCreate() ? Software::getFormURL(false).'?id=-1' : '',
                ]
            ];
        }

        // Équipements réseau
        if (NetworkEquipment::canView()) {
            $menu['options']['networkequipment'] = [
                'title'    => NetworkEquipment::getTypeName(Session::getPluralNumber()),
                'page'     => NetworkEquipment::getSearchURL(false),
                'icon'     => NetworkEquipment::getIcon(),
                'itemtype' => 'NetworkEquipment',
                'links'    => [
                    'search' => NetworkEquipment::getSearchURL(false),
                    'add'    => NetworkEquipment::canCreate() ? NetworkEquipment::getFormURL(false).'?id=-1' : '',
                ]
            ];
        }

        // Imprimantes
        if (Printer::canView()) {
            $menu['options']['printer'] = [
                'title'    => Printer::getTypeName(Session::getPluralNumber()),
                'page'     => Printer::getSearchURL(false),
                'icon'     => Printer::getIcon(),
                'itemtype' => 'Printer',
                'links'    => [
                    'search' => Printer::getSearchURL(false),
                    'add'    => Printer::canCreate() ? Printer::getFormURL(false).'?id=-1' : '',
                ]
            ];
        }

        // Périphériques
        if (Peripheral::canView()) {
            $menu['options']['peripheral'] = [
                'title'    => Peripheral::getTypeName(Session::getPluralNumber()),
                'page'     => Peripheral::getSearchURL(false),
                'icon'     => Peripheral::getIcon(),
                'itemtype' => 'Peripheral',
                'links'    => [
                    'search' => Peripheral::getSearchURL(false),
                    'add'    => Peripheral::canCreate() ? Peripheral::getFormURL(false).'?id=-1' : '',
                ]
            ];
        }

        // Téléphones
        if (Phone::canView()) {
            $menu['options']['phone'] = [
                'title'    => Phone::getTypeName(Session::getPluralNumber()),
                'page'     => Phone::getSearchURL(false),
                'icon'     => Phone::getIcon(),
                'itemtype' => 'Phone',
                'links'    => [
                    'search' => Phone::getSearchURL(false),
                    'add'    => Phone::canCreate() ? Phone::getFormURL(false).'?id=-1' : '',
                ]
            ];
        }

        return $menu;
    }

    // NOTE : on ne modifie jamais $_SESSION['glpimenu'] dans un plugin.
    // Le menu est géré via le hook redefine_menus dans setup.php.
}