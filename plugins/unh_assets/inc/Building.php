<?php
/**
 * Classe Building - Gestion des bâtiments
 * Université Nouveaux Horizons
 */

namespace GlpiPlugin\UnhAssets\Assets;

use CommonDBTM;

class Building extends CommonDBTM
{
    public static $rightname = 'plugin_unh_assets_manage';
    public $dohistory = true;

    public static function getTable($classname = __CLASS__)
    {
        return 'glpi_plugin_unh_assets_buildings';
    }

    /**
     * Récupérer tous les bâtiments actifs
     */
    public static function getAllBuildings()
    {
        global $DB;

        $query = "SELECT * FROM " . self::getTable() . " WHERE is_active = 1 ORDER BY name ASC";
        $result = $DB->query($query);
        $buildings = [];

        while ($row = $DB->fetchAssoc($result)) {
            $buildings[] = $row;
        }

        return $buildings;
    }

    /**
     * Obtenir un bâtiment par ID
     */
    public static function getBuildingById($building_id)
    {
        global $DB;

        $query = "SELECT * FROM " . self::getTable() . " WHERE id = " . (int)$building_id;
        $result = $DB->query($query);

        return $DB->fetchAssoc($result) ?: null;
    }

    /**
     * Compter les équipements par bâtiment
     */
    public static function countEquipments($building_id)
    {
        global $DB;

        $query = "SELECT COUNT(*) as count FROM glpi_plugin_unh_assets_equipments 
                  WHERE buildings_id = " . (int)$building_id . " AND is_active = 1";
        $result = $DB->query($query);
        $row = $DB->fetchAssoc($result);

        return $row['count'] ?? 0;
    }
}

/**
 * Classe Room - Gestion des salles/bureaux
 * Université Nouveaux Horizons
 */
class Room extends CommonDBTM
{
    public static $rightname = 'plugin_unh_assets_manage';
    public $dohistory = true;

    public static function getTable($classname = __CLASS__)
    {
        return 'glpi_plugin_unh_assets_rooms';
    }

    /**
     * Récupérer toutes les salles d'un bâtiment
     */
    public static function getRoomsByBuilding($building_id)
    {
        global $DB;

        $query = "SELECT * FROM " . self::getTable() . " 
                  WHERE buildings_id = " . (int)$building_id . " AND is_active = 1 
                  ORDER BY name ASC";
        $result = $DB->query($query);
        $rooms = [];

        while ($row = $DB->fetchAssoc($result)) {
            $rooms[] = $row;
        }

        return $rooms;
    }

    /**
     * Obtenir une salle par ID
     */
    public static function getRoomById($room_id)
    {
        global $DB;

        $query = "SELECT * FROM " . self::getTable() . " WHERE id = " . (int)$room_id;
        $result = $DB->query($query);

        return $DB->fetchAssoc($result) ?: null;
    }

    /**
     * Compter les équipements par salle
     */
    public static function countEquipments($room_id)
    {
        global $DB;

        $query = "SELECT COUNT(*) as count FROM glpi_plugin_unh_assets_equipments 
                  WHERE rooms_id = " . (int)$room_id . " AND is_active = 1";
        $result = $DB->query($query);
        $row = $DB->fetchAssoc($result);

        return $row['count'] ?? 0;
    }
}
