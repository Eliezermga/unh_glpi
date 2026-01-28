<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginUniversiteMenu extends CommonGLPI {
    
    static $rightname = 'plugin_universite_cours';
    
    /**
     * Obtenir le nom du menu
     */
    static function getMenuName() {
        return __('Base de Connaissances Universitaire', 'universite');
    }
    
    /**
     * Afficher le contenu du menu
     */
    static function getMenuContent() {
        global $CFG_GLPI;
        
        $menu = [];
        $menu['title'] = self::getMenuName();
        $menu['page']  = "/plugins/universite/front/cours.php";
        $menu['icon']  = 'fas fa-book';
        
        $menu['options'] = [];
        
        // Cours
        if (Session::haveRight('plugin_universite_cours', READ)) {
            $menu['options']['cours'] = [
                'title' => __('Cours', 'universite'),
                'page'  => "/plugins/universite/front/cours.php",
                'icon'  => 'fas fa-book-open',
                'links' => [
                    'list'   => "/plugins/universite/front/cours.php",
                    'add'    => "/plugins/universite/front/cours.form.php",
                    'search' => "/plugins/universite/front/cours.php"
                ]
            ];
        }
        
        // Ressources
        if (Session::haveRight('plugin_universite_ressource', READ)) {
            $menu['options']['ressources'] = [
                'title' => __('Ressources', 'universite'),
                'page'  => "/plugins/universite/front/ressource.php",
                'icon'  => 'fas fa-file-pdf',
                'links' => [
                    'list'   => "/plugins/universite/front/ressource.php",
                    'add'    => "/plugins/universite/front/ressource.form.php",
                    'search' => "/plugins/universite/front/ressource.php"
                ]
            ];
        }
        
        // Catégories
        if (Session::haveRight('plugin_universite_categorie', READ)) {
            $menu['options']['categories'] = [
                'title' => __('Catégories', 'universite'),
                'page'  => "/plugins/universite/front/categorie.php",
                'icon'  => 'fas fa-tags',
                'links' => [
                    'list'   => "/plugins/universite/front/categorie.php",
                    'add'    => "/plugins/universite/front/categorie.form.php",
                    'search' => "/plugins/universite/front/categorie.php"
                ]
            ];
        }
        
        return $menu;
    }
    
    /**
     * Afficher le compte de cours et ressources (pour le tableau de bord)
     */
    static function getCountContent() {
        if (Session::haveRight('plugin_universite_cours', READ)) {
            $courses   = countElementsInTable('glpi_plugin_universite_cours', ['is_deleted' => 0]);
            $resources = countElementsInTable('glpi_plugin_universite_ressources', ['is_deleted' => 0]);
            
            return [
                'courses'   => $courses,
                'resources' => $resources
            ];
        }
        return [];
    }
}

