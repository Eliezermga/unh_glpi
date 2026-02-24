<?php

/**
 * ---------------------------------------------------------------------
 *
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * http://glpi-project.org
 *
 * @copyright 2015-2023 Teclib' and contributors.
 * @licence   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * ---------------------------------------------------------------------
 */

include('../inc/includes.php');

// Check permissions
if (!InventoryOrganization::canView()) {
    Html::displayRightError();
}

$success = false;
$error_message = '';

// Handle location creation directly on this page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Session::checkCSRF($_POST);
    $action = $_POST['action'] ?? '';

    if ($action === 'create_location') {
        if (!Location::canCreate()) {
            $error_message = __('The action you have requested is not allowed.');
        } else {
            $location_data = [
                'name'      => trim($_POST['name'] ?? ''),
                'parent_id' => (int) ($_POST['parent_id'] ?? 0),
                'entity_id' => (int) ($_POST['entity_id'] ?? Session::getActiveEntity()),
                'building'  => trim($_POST['building'] ?? ''),
                'room'      => trim($_POST['room'] ?? ''),
                'comment'   => trim($_POST['comment'] ?? ''),
            ];

            if ($location_data['name'] === '') {
                $error_message = __('Le nom du lieu est requis');
            } else {
                $location_id = InventoryOrganization::createLocation($location_data);
                if ($location_id) {
                    $success = true;
                } else {
                    $error_message = __('Echec de la creation du lieu');
                }
            }
        }
    }
}

// Get location hierarchy
$locations = InventoryOrganization::getLocationHierarchy(0);

// Get entities for dropdown
$entities = InventoryOrganization::getEntityTree(0);

// Flatten entities for dropdown
function flattenEntities($entities, $level = 0) {
    $result = [];
    foreach ($entities as $entity) {
        if (!Session::haveAccessToEntity((int) ($entity['id'] ?? 0), true)) {
            continue;
        }
        $result[] = [
            'id' => $entity['id'],
            'name' => (string) ($entity['name'] ?? ''),
            'level' => (int) $level,
        ];
        if (!empty($entity['children'])) {
            $result = array_merge($result, flattenEntities($entity['children'], $level + 1));
        }
    }
    return $result;
}

$flat_entities = flattenEntities($entities);

// Flatten locations for display
function flattenLocations($locations, $level = 0) {
    $result = [];
    foreach ($locations as $location) {
        $result[] = [
            'id' => $location['id'],
            'name' => (string) ($location['name'] ?? ''),
            'level' => (int) $level,
            'asset_count' => $location['asset_count'] ?? 0,
        ];
        if (!empty($location['children'])) {
            $result = array_merge($result, flattenLocations($location['children'], $level + 1));
        }
    }
    return $result;
}

$flat_locations = flattenLocations($locations);

// Display header
Html::header(
    __('Gestion des lieux'),
    $_SERVER['PHP_SELF'],
    'helpdesk',
    'inventoryorganization'
);

// Render the location management template
Glpi\Application\View\TemplateRenderer::getInstance()->display('pages/inventoryorganization/locations.html.twig', [
    'title'          => __('Gestion des lieux'),
    'locations'      => $locations,
    'flat_locations' => $flat_locations,
    'entities'       => $flat_entities,
    'can_create'     => Location::canCreate(),
    'active_entity'  => Session::getActiveEntity(),
    'success'        => $success,
    'error_message'  => $error_message,
]);

Html::footer();
