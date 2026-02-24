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

// Handle entity creation directly on this page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Session::checkCSRF($_POST);
    $action = $_POST['action'] ?? '';

    if ($action === 'create_entity') {
        if (!Entity::canCreate()) {
            $error_message = __('The action you have requested is not allowed.');
        } else {
            $entity_data = [
                'name'      => trim($_POST['name'] ?? ''),
                'parent_id' => (int) ($_POST['parent_id'] ?? 0),
                'comment'   => trim($_POST['comment'] ?? ''),
                'address'   => trim($_POST['address'] ?? ''),
                'postcode'  => trim($_POST['postcode'] ?? ''),
                'town'      => trim($_POST['town'] ?? ''),
                'country'   => trim($_POST['country'] ?? ''),
            ];

            if ($entity_data['name'] === '') {
                $error_message = __('Le nom de l entite est requis');
            } else {
                $entity_id = InventoryOrganization::createEntity($entity_data);
                if ($entity_id) {
                    $success = true;
                } else {
                    $error_message = __('Echec de la creation de l entite');
                }
            }
        }
    }
}

// Get existing entities for display
$entities = InventoryOrganization::getEntityTree(0);

// Flatten entities for display
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
            'completename' => $entity['completename'] ?? $entity['name'],
        ];
        if (!empty($entity['children'])) {
            $result = array_merge($result, flattenEntities($entity['children'], $level + 1));
        }
    }
    return $result;
}

$flat_entities = flattenEntities($entities);
$active_entity = (int) Session::getActiveEntity();

// Display header
Html::header(
    __("Gestion des entites"),
    $_SERVER['PHP_SELF'],
    'helpdesk',
    'inventoryorganization'
);

// Render the entity page template
Glpi\Application\View\TemplateRenderer::getInstance()->display('pages/inventoryorganization/entity_wizard.html.twig', [
    'title'       => __("Gestion des entites"),
    'entities'    => $flat_entities,
    'can_create'  => Entity::canCreate(),
    'success'     => $success,
    'error_message' => $error_message,
    'active_entity' => $active_entity,
]);

Html::footer();
