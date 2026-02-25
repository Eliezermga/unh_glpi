<?php
/**
 * UNH GLPI - Inventory Organization - Location Management
 */

include('../inc/includes.php');

if (!InventoryOrganization::canView()) {
    
    Html::displayRightError();
}

$success       = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 🔒 CSRF
    Session::checkCSRF($_POST);

    $action = $_POST['action'] ?? '';

    if ($action === 'create_location') {
        if (!Location::canCreate()) {
            $error_message = __('The action you have requested is not allowed.');
        } else {
            $location_data = [
                'name'      => trim($_POST['name'] ?? ''),
                'parent_id' => (int)($_POST['parent_id'] ?? 0),
                'entity_id' => (int)($_POST['entity_id'] ?? Session::getActiveEntity()),
                'building'  => trim($_POST['building'] ?? ''),
                'room'      => trim($_POST['room'] ?? ''),
                'comment'   => trim($_POST['comment'] ?? ''),
            ];

            if ($location_data['name'] === '') {
                $error_message = __('Location name is required');
            } else {
                $location_id = InventoryOrganization::createLocation($location_data);
                if ($location_id) {
                    $success = true;

                    // 📋 AUDIT LOG
                    Event::log(
                        $location_id,
                        'inventoryorganization',
                        4,
                        'UNH Inventory',
                        sprintf(
                            __('%s created location "%s"'),
                            $_SESSION['glpiname'],
                            $location_data['name']
                        )
                    );
                } else {
                    $error_message = __('Failed to create location');
                }
            }
        }
    }
}

$locations = InventoryOrganization::getLocationHierarchy(0);
$entities  = InventoryOrganization::getEntityTree(0);

function flattenEntities($entities, $level = 0) {
    $result = [];
    foreach ($entities as $entity) {
        if (!Session::haveAccessToEntity((int)($entity['id'] ?? 0), true)) {
            continue;
        }
        $result[] = [
<<<<<<< HEAD
            'id'   => $entity['id'],
            'name' => str_repeat('   ', $level) . $entity['name'],
=======
            'id' => $entity['id'],
            'name' => (string) ($entity['name'] ?? ''),
            'level' => (int) $level,
>>>>>>> origin/pre-product
        ];
        if (!empty($entity['children'])) {
            $result = array_merge($result, flattenEntities($entity['children'], $level + 1));
        }
    }
    return $result;
}

function flattenLocations($locations, $level = 0) {
    $result = [];
    foreach ($locations as $location) {
        $result[] = [
<<<<<<< HEAD
            'id'          => $location['id'],
            'name'        => str_repeat('   ', $level) . $location['name'],
=======
            'id' => $location['id'],
            'name' => (string) ($location['name'] ?? ''),
            'level' => (int) $level,
>>>>>>> origin/pre-product
            'asset_count' => $location['asset_count'] ?? 0,
        ];
        if (!empty($location['children'])) {
            $result = array_merge($result, flattenLocations($location['children'], $level + 1));
        }
    }
    return $result;
}

$flat_entities  = flattenEntities($entities);
$flat_locations = flattenLocations($locations);

Html::header(
    __('Location Management'),
    $_SERVER['PHP_SELF'],
    'helpdesk',
    'inventoryorganization'
);

<<<<<<< HEAD
Glpi\Application\View\TemplateRenderer::getInstance()->display(
    'pages/inventoryorganization/locations.html.twig',
    [
        'title'          => __('Location Management'),
        'locations'      => $locations,
        'flat_locations' => $flat_locations,
        'entities'       => $flat_entities,
        'can_create'     => Location::canCreate(),
        'active_entity'  => Session::getActiveEntity(),
        'success'        => $success,
        'error_message'  => $error_message,
    ]
);

=======
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
    'csrf_token_value' => Session::getNewCSRFToken(true),
]);
>>>>>>> origin/pre-product

Html::footer();


