<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginUniversiteProfile extends Profile {
    
    static $rightname = 'config';
    
    function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {
        if ($item->getType() == 'Profile') {
            return self::createTabEntry('Base de Connaissances');
        }
        return '';
    }

    static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {
        if ($item->getType() == 'Profile') {
            $profile = new self();
            $profile->showForm($item->getID());
        }
        return true;
    }
    
    function showForm($profiles_id = 0, $openform = true, $closeform = true) {
        
        if (!self::canView()) {
            return false;
        }
        
        $profile = new Profile();
        $profile->getFromDB($profiles_id);
        
        $rights = [
            [
                'itemtype'  => 'PluginUniversiteCours',
                'label'     => 'Gérer les cours',
                'field'     => 'plugin_universite_cours'
            ],
            [
                'itemtype'  => 'PluginUniversiteRessource',
                'label'     => 'Gérer les ressources',
                'field'     => 'plugin_universite_ressource'
            ],
            [
                'itemtype'  => 'PluginUniversiteCategorie',
                'label'     => 'Gérer les catégories',
                'field'     => 'plugin_universite_categorie'
            ]
        ];
        
        if ($openform) {
            echo "<div class='firstbloc'>";
            echo "<form method='post' action='".$profile->getFormURL()."'>";
        }
        
        // Tableau des droits
        $rights_table = [];
        foreach ($rights as $right) {
            $rights_table[] = [
                'item'    => $right,
                'right'   => [
                    'read'    => 1,
                    'write'   => 1,
                    'create'  => 1,
                    'delete'  => 1,
                    'all'     => 1
                ]
            ];
        }
        
        $profile->displayRightsChoiceMatrix($rights_table, ['canedit'       => true,
                                                          'default_class' => 'tab_bg_2',
                                                          'title'         => __('Droits de la Base de Connaissances Universitaire')]);
        
        if ($closeform) {
            echo "<div class='center'>";
            echo Html::hidden('id', ['value' => $profiles_id]);
            echo Html::submit(_sx('button', 'Save'), ['name' => 'update']);
            echo "</div>\n";
            Html::closeForm();
            echo "</div>";
        }
    }
    
    static function uninstallProfile() {
        $pfProfile = new self();
        $a_rights = $pfProfile->getAllRights();
        foreach ($a_rights as $data) {
            ProfileRight::deleteProfileRights([$data['field']]);
        }
    }
    
    static function getAllRights($all = false) {
        $rights = [
            [
                'itemtype'  => 'PluginUniversiteCours',
                'label'     => 'Gérer les cours',
                'field'     => 'plugin_universite_cours'
            ],
            [
                'itemtype'  => 'PluginUniversiteRessource',
                'label'     => 'Gérer les ressources',
                'field'     => 'plugin_universite_ressource'
            ],
            [
                'itemtype'  => 'PluginUniversiteCategorie',
                'label'     => 'Gérer les catégories',
                'field'     => 'plugin_universite_categorie'
            ]
        ];
        
        return $rights;
    }
    
    static function addDefaultProfileInfos($profiles_id, $rights) {
        $profileRight = new ProfileRight();
        foreach ($rights as $right => $value) {
            if (!countElementsInTable('glpi_profilerights',
                                   ['profiles_id' => $profiles_id, 'name' => $right])) {
                $myright['profiles_id'] = $profiles_id;
                $myright['name']        = $right;
                $myright['rights']      = $value;
                $profileRight->add($myright);
                
                // Ajout du droit dans la session
                if (isset($_SESSION['glpiactiveprofile'][$right])) {
                    $_SESSION['glpiactiveprofile'][$right] = $value;
                }
            }
        }
    }
}
