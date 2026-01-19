<?php
/**
 * Classe EquipmentType - Types d'équipements
 * Université Nouveaux Horizons
 */

use CommonDBTM;

class EquipmentType extends CommonDBTM
{
    public static $rightname = 'plugin_unh_assets_manage';
    public $dohistory = true;

    public static function getTable($classname = __CLASS__)
    {
        return 'glpi_plugin_unh_assets_types';
    }

    /**
     * Récupérer tous les types actifs
     */
    public static function getAllTypes()
    {
        global $DB;

        $query = "SELECT * FROM " . self::getTable() . " WHERE is_active = 1 ORDER BY name ASC";
        $result = $DB->query($query);
        $types = [];

        while ($row = $DB->fetchAssoc($result)) {
            $types[] = $row;
        }

        return $types;
    }

    /**
     * Obtenir un type par ID
     */
    public static function getTypeById($type_id)
    {
        global $DB;

        $query = "SELECT * FROM " . self::getTable() . " WHERE id = " . (int)$type_id;
        $result = $DB->query($query);

        return $DB->fetchAssoc($result) ?: null;
    }
}
