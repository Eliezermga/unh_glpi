<?php
/**
 * Contrôleur frontal - Dashboard des Assets
 * Université Nouveaux Horizons
 */

require_once(dirname(__FILE__) . '/../../../inc/includes.php');

Html::header(
    __('UNH Assets', 'unh_assets'),
    $_SERVER['PHP_SELF'],
    'assets',
    'unh_assets'
);

// Vérifier l'authentification
if (!isset($_SESSION['glpiID'])) {
    Html::redirect(GLPI_ROOT . '/index.php');
}

// Charger les classes du plugin
require_once(PLUGIN_UNH_ASSETS_INC_DIR . '/Equipment.php');
require_once(PLUGIN_UNH_ASSETS_INC_DIR . '/EquipmentType.php');
require_once(PLUGIN_UNH_ASSETS_INC_DIR . '/Building.php');
require_once(PLUGIN_UNH_ASSETS_INC_DIR . '/Alert.php');
require_once(PLUGIN_UNH_ASSETS_INC_DIR . '/Logo.php');

// Déterminer l'action
$action = $_GET['action'] ?? 'dashboard';

// Données communes
$loader = new \Twig\Loader\FilesystemLoader(PLUGIN_UNH_ASSETS_DIR . '/templates');
$twig = new \Twig\Environment($loader, [
    'auto_reload' => true
]);

// Ajouter les filtres personnalisés Twig
$twig->addFilter(new \Twig\TwigFilter('badge_status', function($status) {
    $badges = [
        'operational' => ['label' => 'Opérationnel', 'class' => 'operational'],
        'maintenance' => ['label' => 'En maintenance', 'class' => 'maintenance'],
        'out_of_service' => ['label' => 'Hors service', 'class' => 'out-of-service'],
    ];
    return $badges[$status] ?? ['label' => 'Inconnu', 'class' => 'unknown'];
}));

try {
    switch ($action) {
        case 'list':
            handleListAction($twig);
            break;

        case 'view':
            handleViewAction($twig);
            break;

        case 'alerts':
            handleAlertsAction($twig);
            break;

        case 'statistics':
            handleStatisticsAction($twig);
            break;

        default:
            handleDashboardAction($twig);
            break;
    }
} catch (Exception $e) {
    Html::displayErrorAndDie(__('Une erreur s\'est produite', 'unh_assets') . ': ' . $e->getMessage());
}

// ============================================================================
// Fonctions de traitement des actions
// ============================================================================

/**
 * Traiter l'action du tableau de bord
 */
function handleDashboardAction($twig)
{
    // Vérifier les alertes et créer les automatiques

    $stats = Equipment::getStatistics();
    $alertedEquipments = Equipment::getAlertedEquipments();
    $unresolvedAlerts = Alert::getUnresolvedAlerts();
    $alertsBySeverity = Alert::getAlertsBySeverity();
    
    // Générer le token CSRF pour les formulaires
    $csrf_token = Session::getNewCSRFToken();

    $template = $twig->load('dashboard.html.twig');
    echo $template->render([
        'stats' => $stats,
        'alerted_equipments' => array_slice($alertedEquipments, 0, 5),
        'unresolved_alerts' => array_slice($unresolvedAlerts, 0, 10),
        'alerts_by_severity' => $alertsBySeverity,
        'csrf_token' => $csrf_token,
        'page_title' => __('Tableau de bord - Gestion du Parc', 'unh_assets'),
        'is_admin' => $_SESSION['glpiactiveprofile']['interface'] === 'central'
    ]);
}

/**
 * Traiter l'action de listing des équipements
 */
function handleListAction($twig)
{
    // Récupérer les filtres
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

    $equipments = Equipment::getAllEquipments($filters, 'name ASC', 100);
    $types = EquipmentType::getAllTypes();
    $buildings = Building::getAllBuildings();

    $template = $twig->load('equipment_list.html.twig');
    echo $template->render([
        'equipments' => $equipments,
        'types' => $types,
        'buildings' => $buildings,
        'filters' => $filters,
        'page_title' => __('Liste des équipements', 'unh_assets'),
        'is_admin' => $_SESSION['glpiactiveprofile']['interface'] === 'central'
    ]);
}

/**
 * Traiter l'action de détail d'un équipement
 */
function handleViewAction($twig)
{
    if (!isset($_GET['id'])) {
        Html::displayErrorAndDie(__('ID d\'équipement manquant', 'unh_assets'));
    }

    global $DB;
    $equipment_id = (int)$_GET['id'];

    // Récupérer l'équipement
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
        Html::displayErrorAndDie(__('Équipement non trouvé', 'unh_assets'));
    }

    $equipment = $DB->fetchAssoc($result);

    // Récupérer les alertes liées
    $alerts = [];
    $query = "SELECT * FROM glpi_plugin_unh_assets_alerts 
              WHERE equipments_id = $equipment_id 
              ORDER BY date_creation DESC";
    $result = $DB->query($query);
    while ($row = $DB->fetchAssoc($result)) {
        $alerts[] = $row;
    }

    // Récupérer le journal de maintenance
    $maintenance_logs = [];
    $query = "SELECT * FROM glpi_plugin_unh_assets_maintenance_logs 
              WHERE equipments_id = $equipment_id 
              ORDER BY date_creation DESC LIMIT 10";
    $result = $DB->query($query);
    while ($row = $DB->fetchAssoc($result)) {
        $maintenance_logs[] = $row;
    }

    $template = $twig->load('equipment_view.html.twig');
    echo $template->render([
        'equipment' => $equipment,
        'alerts' => $alerts,
        'maintenance_logs' => $maintenance_logs,
        'page_title' => __('Détail - ', 'unh_assets') . $equipment['name'],
        'is_admin' => $_SESSION['glpiactiveprofile']['interface'] === 'central'
    ]);
}

/**
 * Traiter l'action des alertes
 */
function handleAlertsAction($twig)
{
    $unresolvedAlerts = Alert::getUnresolvedAlerts();
    $alertsBySeverity = Alert::getAlertsBySeverity();
    
    // Générer le token CSRF pour les formulaires
    $csrf_token = Session::getNewCSRFToken();

    $template = $twig->load('alerts.html.twig');
    echo $template->render([
        'unresolved_alerts' => $unresolvedAlerts,
        'alerts_by_severity' => $alertsBySeverity,
        'csrf_token' => $csrf_token,
        'page_title' => __('Gestion des alertes', 'unh_assets'),
        'is_admin' => $_SESSION['glpiactiveprofile']['interface'] === 'central'
    ]);
}

/**
 * Traiter l'action des statistiques
 */
function handleStatisticsAction($twig)
{
    $stats = Equipment::getStatistics();

    $template = $twig->load('statistics.html.twig');
    echo $template->render([
        'stats' => $stats,
        'page_title' => __('Statistiques du parc', 'unh_assets'),
        'is_admin' => $_SESSION['glpiactiveprofile']['interface'] === 'central'
    ]);
}

Html::footer();
?>