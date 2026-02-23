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

// Get location hierarchy
$locations = InventoryOrganization::getLocationHierarchy(0);

// Get entities for dropdown
$entities = InventoryOrganization::getEntityTree(0);

// Flatten entities for dropdown
function flattenEntities($entities, $level = 0) {
    $result = [];
    foreach ($entities as $entity) {
        $result[] = [
            'id' => $entity['id'],
            'name' => str_repeat('&nbsp;&nbsp;&nbsp;', $level) . $entity['name'],
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
            'name' => str_repeat('&nbsp;&nbsp;&nbsp;', $level) . $location['name'],
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
    'Gestion des Lieux',
    $_SERVER['PHP_SELF'],
    'helpdesk',
    'inventoryorganization'
);

// Render the location management template
Glpi\Application\View\TemplateRenderer::getInstance()->display('pages/inventoryorganization/locations.html.twig', [
    'title'          => 'Gestion des Lieux',
    'locations'      => $locations,
    'flat_locations' => $flat_locations,
    'entities'       => $flat_entities,
    'can_create'     => Location::canCreate(),
    'active_entity'  => Session::getActiveEntity(),
]);

Html::footer();
