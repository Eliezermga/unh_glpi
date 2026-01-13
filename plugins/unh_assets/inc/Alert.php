<?php
/**
 * Classe Alert - Gestion des alertes
 * Université Nouveaux Horizons
 */

namespace GlpiPlugin\UnhAssets\Assets;

use CommonDBTM;

class Alert extends CommonDBTM
{
    public static $rightname = 'plugin_unh_assets_alerts';
    public $dohistory = true;

    public static function getTable($classname = __CLASS__)
    {
        return 'glpi_plugin_unh_assets_alerts';
    }

    /**
     * Créer une alerte
     */
    public static function createAlert($equipment_id, $type, $message, $level = 'warning')
    {
        global $DB, $CURRENT_USER;

        $query = "INSERT INTO " . self::getTable() . " 
                  (equipments_id, alert_type, alert_level, message, created_by) 
                  VALUES (
                    " . (int)$equipment_id . ",
                    '" . $DB->escape($type) . "',
                    '" . $DB->escape($level) . "',
                    '" . $DB->escape($message) . "',
                    " . (int)($CURRENT_USER['id'] ?? 0) . "
                  )";

        return $DB->query($query);
    }

    /**
     * Résoudre une alerte
     */
    public static function resolveAlert($alert_id, $resolution_notes = '')
    {
        global $DB, $CURRENT_USER;

        $query = "UPDATE " . self::getTable() . " 
                  SET is_resolved = 1, 
                      resolved_at = NOW(), 
                      resolved_by = " . (int)($CURRENT_USER['id'] ?? 0) . ",
                      resolution_notes = '" . $DB->escape($resolution_notes) . "'
                  WHERE id = " . (int)$alert_id;

        return $DB->query($query);
    }

    /**
     * Obtenir les alertes non résolues
     */
    public static function getUnresolvedAlerts()
    {
        global $DB;

        $query = "SELECT a.*, e.name as equipment_name, t.name as type_name
                  FROM " . self::getTable() . " a
                  LEFT JOIN glpi_plugin_unh_assets_equipments e ON a.equipments_id = e.id
                  LEFT JOIN glpi_plugin_unh_assets_types t ON e.unh_asset_types_id = t.id
                  WHERE a.is_resolved = 0
                  ORDER BY 
                    CASE 
                      WHEN a.alert_level = 'critical' THEN 1
                      WHEN a.alert_level = 'warning' THEN 2
                      WHEN a.alert_level = 'info' THEN 3
                      ELSE 4
                    END,
                    a.date_creation DESC";

        $result = $DB->query($query);
        $alerts = [];

        while ($row = $DB->fetchAssoc($result)) {
            $alerts[] = $row;
        }

        return $alerts;
    }

    /**
     * Compter les alertes non résolues
     */
    public static function countUnresolvedAlerts()
    {
        global $DB;

        $query = "SELECT COUNT(*) as count FROM " . self::getTable() . " WHERE is_resolved = 0";
        $result = $DB->query($query);
        $row = $DB->fetchAssoc($result);

        return $row['count'] ?? 0;
    }

    /**
     * Obtenir les alertes par niveau
     */
    public static function getAlertsBySeverity()
    {
        global $DB;

        $severity = [
            'critical' => 0,
            'warning' => 0,
            'info' => 0
        ];

        $query = "SELECT alert_level, COUNT(*) as count FROM " . self::getTable() . " 
                  WHERE is_resolved = 0 GROUP BY alert_level";
        $result = $DB->query($query);

        while ($row = $DB->fetchAssoc($result)) {
            if (isset($severity[$row['alert_level']])) {
                $severity[$row['alert_level']] = $row['count'];
            }
        }

        return $severity;
    }
}
