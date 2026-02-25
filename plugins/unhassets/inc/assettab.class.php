<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

/**
 * Classe dédiée UNIQUEMENT à l'onglet "Info UNH Assets" sur les types natifs.
 *
 * Elle étend CommonGLPI (et NON CommonDBTM) pour deux raisons :
 * 1. CommonGLPI n'a pas de rawSearchOptions() → pas de clé 23 héritée
 *    → plus de "Duplicate key 23 in Computer searchOptions"
 * 2. Une classe d'onglet n'a pas besoin de gérer une table SQL propre.
 *    La lecture/écriture des données est déléguée à PluginUnhassetsAsset.
 *
 * Séparation des responsabilités :
 * - PluginUnhassetsAssetTab → onglet visuel sur Computer, Monitor, etc.
 * - PluginUnhassetsAsset    → CRUD sur glpi_plugin_unhassets_assets
 */
class PluginUnhassetsAssetTab extends CommonGLPI {

    static $rightname = 'plugin_unhassets';

    static function getTypeName($nb = 0) {
        return __('Info UNH Assets', 'unhassets');
    }

    /**
     * Retourne [] : on n'injecte AUCUNE colonne dans les recherches natives.
     * Cette méthode est appelée par GLPI quand addtabon est déclaré.
     */
    static function getSearchOptionsToAdd($itemtype = null) {
        return [];
    }

    function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {
        if (!$withtemplate) {
            $types = ['Computer', 'Printer', 'NetworkEquipment', 'Peripheral', 'Monitor', 'Phone'];
            if (in_array($item->getType(), $types)) {
                return self::createTabEntry(__('Info UNH Assets', 'unhassets'));
            }
        }
        return '';
    }

    static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {
        // Déléguer l'affichage du formulaire à la vraie classe de données
        $asset = new PluginUnhassetsAsset();
        $asset->showFormForItem($item);
        return true;
    }
}
