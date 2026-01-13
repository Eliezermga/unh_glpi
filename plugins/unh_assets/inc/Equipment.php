<?php
/**
 * Classe Equipment - Gestion des équipements du parc
 * Université Nouveaux Horizons
 */

namespace GlpiPlugin\UnhAssets\Assets;

use CommonDBTM;

class Equipment extends CommonDBTM
{
    public static $rightname = 'plugin_unh_assets_manage';
    
    protected static $forward_entity_to = [];
    public $dohistory = true;

    /**
     * Obtenir le nom de la table
     */
    public static function getTable($classname = __CLASS__)
    {
        return 'glpi_plugin_unh_assets_equipments';
    }

    /**
     * Obtenir tous les équipements avec filtres
     */
    public static function getAllEquipments($filters = [], $order = 'date_creation DESC', $limit = 50)
    {
        global $DB;

        $query = 'SELECT * FROM ' . self::getTable() . ' WHERE 1=1';

        if (!empty($filters['status'])) {
            $query .= " AND status = '" . $DB->escape($filters['status']) . "'";
        }

        if (!empty($filters['type_id'])) {
            $query .= " AND unh_asset_types_id = " . (int)$filters['type_id'];
        }

        if (!empty($filters['building_id'])) {
            $query .= " AND buildings_id = " . (int)$filters['building_id'];
        }

        if (!empty($filters['room_id'])) {
            $query .= " AND rooms_id = " . (int)$filters['room_id'];
        }

        if (!empty($filters['search'])) {
            $search = $DB->escape('%' . $filters['search'] . '%');
            $query .= " AND (name LIKE '$search' OR serial_number LIKE '$search' OR brand LIKE '$search')";
        }

        if (!empty($filters['alert_only'])) {
            $query .= ' AND is_alert = 1';
        }

        $query .= " ORDER BY $order LIMIT $limit";

        $result = $DB->query($query);
        $equipments = [];

        while ($row = $DB->fetchAssoc($result)) {
            $equipments[] = $row;
        }

        return $equipments;
    }

    /**
     * Obtenir les statistiques du parc
     */
    public static function getStatistics()
    {
        global $DB;

        $stats = [
            'total' => 0,
            'operational' => 0,
            'maintenance' => 0,
            'out_of_service' => 0,
            'alerts' => 0,
            'by_type' => [],
            'by_building' => []
        ];

        // Statistiques globales par état
        $query = "SELECT status, COUNT(*) as count FROM " . self::getTable() . " WHERE is_active = 1 GROUP BY status";
        $result = $DB->query($query);

        while ($row = $DB->fetchAssoc($result)) {
            switch ($row['status']) {
                case 'operational':
                    $stats['operational'] = $row['count'];
                    break;
                case 'maintenance':
                    $stats['maintenance'] = $row['count'];
                    break;
                case 'out_of_service':
                    $stats['out_of_service'] = $row['count'];
                    break;
            }
            $stats['total'] += $row['count'];
        }

        // Alertes
        $result = $DB->query("SELECT COUNT(*) as count FROM " . self::getTable() . " WHERE is_alert = 1");
        $row = $DB->fetchAssoc($result);
        $stats['alerts'] = $row['count'] ?? 0;

        // Par type
        $query = "SELECT t.name, COUNT(e.id) as count 
                  FROM " . self::getTable() . " e
                  LEFT JOIN glpi_plugin_unh_assets_types t ON e.unh_asset_types_id = t.id
                  WHERE e.is_active = 1
                  GROUP BY t.id, t.name";
        $result = $DB->query($query);

        while ($row = $DB->fetchAssoc($result)) {
            $stats['by_type'][$row['name']] = $row['count'];
        }

        // Par bâtiment
        $query = "SELECT b.name, COUNT(e.id) as count 
                  FROM " . self::getTable() . " e
                  LEFT JOIN glpi_plugin_unh_assets_buildings b ON e.buildings_id = b.id
                  WHERE e.is_active = 1
                  GROUP BY b.id, b.name";
        $result = $DB->query($query);

        while ($row = $DB->fetchAssoc($result)) {
            $stats['by_building'][$row['name']] = $row['count'];
        }

        return $stats;
    }

    /**
     * Vérifier et créer des alertes
     */
    public static function checkAndCreateAlerts()
    {
        global $DB;

        // Créer une alerte si le statut est en panne
        $query = "SELECT id, status FROM " . self::getTable() . " WHERE is_active = 1";
        $result = $DB->query($query);

        while ($row = $DB->fetchAssoc($result)) {
            $has_alert = ($DB->query(
                "SELECT COUNT(*) as count FROM glpi_plugin_unh_assets_alerts 
                 WHERE equipments_id = " . $row['id'] . " AND is_resolved = 0"
            ))->fetch_assoc()['count'] > 0;

            if ($row['status'] === 'out_of_service' && !$has_alert) {
                // Créer une alerte
                $DB->query(
                    "INSERT INTO glpi_plugin_unh_assets_alerts 
                     (equipments_id, alert_type, alert_level, message) 
                     VALUES (" . $row['id'] . ", 'equipment_failure', 'critical', 
                     'Équipement hors service')"
                );
                
                // Mettre à jour le flag
                $DB->query("UPDATE " . self::getTable() . " SET is_alert = 1 WHERE id = " . $row['id']);
            } elseif ($row['status'] !== 'out_of_service' && $has_alert) {
                // Marquer l'alerte comme résolue
                $DB->query(
                    "UPDATE glpi_plugin_unh_assets_alerts 
                     SET is_resolved = 1, resolved_at = NOW() 
                     WHERE equipments_id = " . $row['id'] . " AND is_resolved = 0"
                );
                
                // Mettre à jour le flag
                $DB->query("UPDATE " . self::getTable() . " SET is_alert = 0 WHERE id = " . $row['id']);
            }
        }
    }

    /**
     * Obtenir les équipements avec alertes
     */
    public static function getAlertedEquipments()
    {
        global $DB;

        $query = "SELECT e.*, t.name as type_name, b.name as building_name, r.name as room_name,
                         COUNT(a.id) as alert_count
                  FROM " . self::getTable() . " e
                  LEFT JOIN glpi_plugin_unh_assets_types t ON e.unh_asset_types_id = t.id
                  LEFT JOIN glpi_plugin_unh_assets_buildings b ON e.buildings_id = b.id
                  LEFT JOIN glpi_plugin_unh_assets_rooms r ON e.rooms_id = r.id
                  LEFT JOIN glpi_plugin_unh_assets_alerts a ON e.id = a.equipments_id AND a.is_resolved = 0
                  WHERE e.is_alert = 1
                  GROUP BY e.id
                  ORDER BY e.date_creation DESC";

        $result = $DB->query($query);
        $equipments = [];

        while ($row = $DB->fetchAssoc($result)) {
            $equipments[] = $row;
        }

        return $equipments;
    }
}
