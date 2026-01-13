<?php
/**
 * API REST - Plugin UNH Assets
 * Université Nouveaux Horizons
 */

require_once(dirname(__FILE__) . '/../../../inc/includes.php');

// Vérifier l'authentification
if (!isset($_SESSION['glpiID'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Charger les classes du plugin
require_once(PLUGIN_UNH_ASSETS_INC_DIR . '/Equipment.php');
require_once(PLUGIN_UNH_ASSETS_INC_DIR . '/Alert.php');
require_once(PLUGIN_UNH_ASSETS_INC_DIR . '/Building.php');

use GlpiPlugin\UnhAssets\Assets\Equipment;
use GlpiPlugin\UnhAssets\Assets\Alert;
use GlpiPlugin\UnhAssets\Assets\Building;
use GlpiPlugin\UnhAssets\Assets\Room;

// En-têtes JSON
header('Content-Type: application/json');

// Récupérer l'action
$action = isset($_GET['action']) ? $_GET['action'] : null;
$input = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pour les requêtes POST, récupérer le JSON
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
    $action = $input['action'] ?? $action;
    
    // Vérifier le token CSRF pour les actions sensibles
    $sensibleActions = ['create_alert', 'resolve_alert'];
    if (in_array($action, $sensibleActions)) {
        // Ajouter le token CSRF à $_POST pour la vérification GLPI
        $_POST['_glpi_csrf_token'] = $input['_glpi_csrf_token'] ?? '';
        Session::checkCSRF($_POST);
    }
}

try {
    switch ($action) {
        case 'list_equipments':
            listEquipments();
            break;

        case 'get_equipment':
            getEquipment();
            break;

        case 'create_alert':
            createAlert();
            break;

        case 'resolve_alert':
            resolveAlert();
            break;

        case 'get_statistics':
            getStatistics();
            break;

        case 'get_building_rooms':
            getBuildingRooms();
            break;

        default:
            http_response_code(400);
            echo json_encode(['error' => 'Action not found']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
}

// ============================================================================
// Fonctions API
// ============================================================================

/**
 * Lister les équipements avec filtres
 */
function listEquipments()
{
    $filters = [];
    
    if (isset($_GET['status'])) {
        $filters['status'] = $_GET['status'];
    }
    if (isset($_GET['type_id'])) {
        $filters['type_id'] = (int)$_GET['type_id'];
    }
    if (isset($_GET['building_id'])) {
        $filters['building_id'] = (int)$_GET['building_id'];
    }
    if (isset($_GET['search'])) {
        $filters['search'] = $_GET['search'];
    }

    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 50;
    $order = isset($_GET['order']) ? $_GET['order'] : 'date_creation DESC';

    $equipments = Equipment::getAllEquipments($filters, $order, $limit);

    echo json_encode([
        'success' => true,
        'count' => count($equipments),
        'data' => $equipments
    ]);
}

/**
 * Récupérer un équipement spécifique
 */
function getEquipment()
{
    if (!isset($_GET['id'])) {
        throw new Exception('Equipment ID required');
    }

    global $DB;
    $equipment_id = (int)$_GET['id'];

    $query = "SELECT e.*, 
                     t.name as type_name, 
                     b.name as building_name, 
                     r.name as room_name
              FROM glpi_plugin_unh_assets_equipments e
              LEFT JOIN glpi_plugin_unh_assets_types t ON e.unh_asset_types_id = t.id
              LEFT JOIN glpi_plugin_unh_assets_buildings b ON e.buildings_id = b.id
              LEFT JOIN glpi_plugin_unh_assets_rooms r ON e.rooms_id = r.id
              WHERE e.id = $equipment_id";

    $result = $DB->query($query);

    if (!$result || $DB->numrows($result) === 0) {
        throw new Exception('Equipment not found');
    }

    $equipment = $DB->fetchAssoc($result);

    echo json_encode([
        'success' => true,
        'data' => $equipment
    ]);
}

/**
 * Créer une alerte
 */
function createAlert()
{
    // Token CSRF vérifié en haut du fichier
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['equipment_id']) || !isset($input['type']) || !isset($input['message'])) {
        throw new Exception('Missing required fields');
    }

    $level = $input['level'] ?? 'warning';

    $result = Alert::createAlert(
        $input['equipment_id'],
        $input['type'],
        $input['message'],
        $level
    );

    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Alert created successfully'
        ]);
    } else {
        throw new Exception('Failed to create alert');
    }
}

/**
 * Résoudre une alerte
 */
function resolveAlert()
{
    // Token CSRF vérifié en haut du fichier
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['alert_id'])) {
        throw new Exception('Alert ID required');
    }

    $notes = $input['notes'] ?? '';

    $result = Alert::resolveAlert($input['alert_id'], $notes);

    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Alert resolved successfully'
        ]);
    } else {
        throw new Exception('Failed to resolve alert');
    }
}

/**
 * Obtenir les statistiques
 */
function getStatistics()
{
    $stats = Equipment::getStatistics();

    echo json_encode([
        'success' => true,
        'data' => $stats
    ]);
}

/**
 * Obtenir les salles d'un bâtiment
 */
function getBuildingRooms()
{
    if (!isset($_GET['building_id'])) {
        throw new Exception('Building ID required');
    }

    $building_id = (int)$_GET['building_id'];
    $rooms = Room::getRoomsByBuilding($building_id);

    echo json_encode([
        'success' => true,
        'count' => count($rooms),
        'data' => $rooms
    ]);
}
