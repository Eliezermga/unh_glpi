<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}


/**
 * Gestion du menu principal du plugin UNH Assets.
 *
 * Cette classe étend CommonGLPI afin de fournir à GLPI les informations
 * nécessaires pour construire le menu (nom, droits et contenu). Elle ne doit
 * contenir que la définition du contenu (sous‑menus et liens) ; les éléments
 * comme l'icône, la page par défaut ou la liste des types sont définis
 * dans setup.php via le hook `redefine_menus` et via `defineMenu()`.
 */
class PluginUnhassetsMenu extends CommonGLPI {

    /**
     * Nom du droit utilisé pour afficher ce menu. On utilise le droit spécifique
     * du plugin afin que seuls les profils disposant des droits "UNH Assets"
     * puissent accéder au menu. Ceci est cohérent avec les droits déclarés
     * lors de l'installation du plugin.
     */
    static $rightname = 'plugin_unhassets';

    static function getMenuName() {
        return __('UNH Assets', 'unhassets');
    }

    static function getMenuContent() {
        global $CFG_GLPI;
        $menu = [];
        // Titre du menu principal (affiché dans la barre latérale du plugin)
        $menu['title'] = self::getMenuName();
        // Page principale accessible en cliquant sur le lien racine du plugin
        $menu['page']  = '/plugins/unhassets/front/dashboard.php';
        // Lien de recherche par défaut pour le menu racine
        $menu['links']['search'] = '/plugins/unhassets/front/dashboard.php';

        // Sous‑menus du plugin — utiliser la clé 'options'
        $menu['options'] = [];

        // === Modules personnalisés du plugin ===
        $menu['options']['dashboard'] = [
            'title' => __('Tableau de bord', 'unhassets'),
            'page'  => '/plugins/unhassets/front/dashboard.php',
            'shortcut' => '',
            'links' => [
                'search' => '/plugins/unhassets/front/dashboard.php',
            ]
        ];

        $menu['options']['asset'] = [
            'title' => __('Gestion du parc', 'unhassets'),
            'page'  => '/plugins/unhassets/front/asset.php',
            'shortcut' => '',
            'links' => [
                'search' => '/plugins/unhassets/front/asset.php',
                // GLPI attend généralement id=-1 pour ouvrir un formulaire "nouveau"
                'add'    => '/plugins/unhassets/front/asset.form.php?id=-1',
            ]
        ];

        $menu['options']['reservation'] = [
            'title' => __('Réservations', 'unhassets'),
            'page'  => '/plugins/unhassets/front/reservation.php',
            'shortcut' => '',
            'links' => [
                'search' => '/plugins/unhassets/front/reservation.php',
                'add'    => '/plugins/unhassets/front/reservation.form.php?id=-1',
            ]
        ];

        $menu['options']['license'] = [
            'title' => __('Licences logicielles', 'unhassets'),
            'page'  => '/plugins/unhassets/front/license.php',
            'shortcut' => '',
            'links' => [
                'search' => '/plugins/unhassets/front/license.php',
                'add'    => '/plugins/unhassets/front/license.form.php?id=-1',
            ]
        ];

        // === Éléments du parc standard (inventaire GLPI) ===
        // Pour les objets natifs GLPI, le plus fiable est de réutiliser leur
        // getMenuContent() : cela garantit la même structure que le menu Parc
        // d'origine (dont l'icône/bouton "+" si l'utilisateur a le droit CREATE).
        $native_types = [
            'computer'          => 'Computer',
            'monitor'           => 'Monitor',
            'software'          => 'Software',
            'networkequipment'  => 'NetworkEquipment',
            'printer'           => 'Printer',
            'peripheral'        => 'Peripheral',
            'phone'             => 'Phone',
        ];

        foreach ($native_types as $key => $type) {
            if (class_exists($type) && $type::canView()) {
                $menu['options'][$key] = $type::getMenuContent();
            }
        }

        return $menu;
    }

    static function removeRightsFromSession() {
        if (isset($_SESSION['glpimenu']['unhassets'])) {
            unset($_SESSION['glpimenu']['unhassets']);
        }
    }
    
    /**
     * Définir le menu dans la session GLPI
     */
    static function defineMenu() {
        global $CFG_GLPI;
        
        $_SESSION['glpimenu']['unhassets'] = [
            'title'   => self::getMenuName(),
            'types'   => [__CLASS__],
            'default' => '/plugins/unhassets/front/dashboard.php',
            'icon'    => 'ti ti-building',
            'content' => self::getMenuContent()
        ];
    }
}