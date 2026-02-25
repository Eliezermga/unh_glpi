<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginProjetProfile extends Profile {
    
    static $rightname = "profile";
    
    static function getAllRights() {
        return [
            ['itemtype' => 'PluginProjetProjet',
             'label'    => __('Projets Étudiants', 'projet'),
             'field'    => 'plugin_projet']
        ];
    }
    
    static function addDefaultProfileInfos($profiles_id, $rights) {
        $profileRight = new ProfileRight();
        foreach ($rights as $right => $value) {
            if (!countElementsInTable('glpi_profilerights',
                ['profiles_id' => $profiles_id, 'name' => $right])) {
                $myright['profiles_id'] = $profiles_id;
                $myright['name'] = $right;
                $myright['rights'] = $value;
                $profileRight->add($myright);
            }
        }
    }
    
    static function createFirstAccess($profiles_id) {
        self::addDefaultProfileInfos($profiles_id,
            ['plugin_projet' => ALLSTANDARDRIGHT]);
    }
    
    static function removeRightsFromSession() {
        if (isset($_SESSION['glpiactiveprofile']['plugin_projet'])) {
            unset($_SESSION['glpiactiveprofile']['plugin_projet']);
        }
    }
}
