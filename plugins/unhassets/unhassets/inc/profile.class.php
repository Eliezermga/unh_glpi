<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginUnhassetsProfile extends CommonDBTM {

    static $rightname = 'profile';

    static function getTypeName($nb = 0) {
        return __('Droits sur UNH Assets', 'unhassets');
    }

    static function canCreate() {
        return Session::haveRight('profile', UPDATE);
    }

    static function canView() {
        return Session::haveRight('profile', READ);
    }

    /**
     * Installer les droits pour tous les profils
     */
    static function installRights() {
        global $DB;

        $profiles = $DB->request(['FROM' => 'glpi_profiles']);

        foreach ($profiles as $profile) {
            // Ajouter le droit plugin_unhassets
            $DB->updateOrInsert(
                'glpi_profilerights',
                [
                    'rights' => CREATE | READ | UPDATE | DELETE | PURGE
                ],
                [
                    'profiles_id' => $profile['id'],
                    'name'        => 'plugin_unhassets'
                ]
            );

            // Ajouter dans la table des profils du plugin
            $profile_right = new self();
            $existing = $profile_right->find(['profiles_id' => $profile['id']]);
            
            if (count($existing) == 0) {
                $profile_right->add([
                    'profiles_id' => $profile['id'],
                    'unhassets'   => 'w',
                    'open_ticket' => 'w'
                ]);
            }
        }

        return true;
    }

    /**
     * Initialiser les profils
     */
    static function initProfile() {
        global $DB;

        $profile = new Profile();
        $profiles = $DB->request([
            'FROM' => Profile::getTable()
        ]);

        foreach ($profiles as $profile_data) {
            $profile_right = new self();
            $profile_right->getFromDBByCrit([
                'profiles_id' => $profile_data['id']
            ]);

            if (empty($profile_right->fields)) {
                $profile_right->add([
                    'profiles_id' => $profile_data['id'],
                    'unhassets'   => 'r',
                    'open_ticket' => 'r'
                ]);
            }
        }
    }

    /**
     * Créer l'accès pour le profil actuel
     */
    static function createFirstAccess($profiles_id) {
        global $DB;

        $profile_right = new self();
        $profile_right->getFromDBByCrit([
            'profiles_id' => $profiles_id
        ]);

        if (empty($profile_right->fields)) {
            $profile_right->add([
                'profiles_id' => $profiles_id,
                'unhassets'   => 'w',
                'open_ticket' => 'w'
            ]);
        }

        // Ajouter le droit dans le profil GLPI
        $profile = new Profile();
        if ($profile->getFromDB($profiles_id)) {
            $profile->update([
                'id'                  => $profiles_id,
                'plugin_unhassets'    => CREATE | READ | UPDATE | DELETE | PURGE
            ]);
        }
    }

    static function uninstallProfile() {
        global $DB;

        $DB->delete(
            'glpi_profilerights',
            ['name' => 'plugin_unhassets']
        );
    }
}