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

// Get existing entities for display
$entities = InventoryOrganization::getEntityTree(0);

// Flatten entities for display
function flattenEntities($entities, $level = 0) {
    $result = [];
    foreach ($entities as $entity) {
        $result[] = [
            'id' => $entity['id'],
            'name' => str_repeat('&nbsp;&nbsp;&nbsp;', $level) . $entity['name'],
            'completename' => $entity['completename'] ?? $entity['name'],
        ];
        if (!empty($entity['children'])) {
            $result = array_merge($result, flattenEntities($entity['children'], $level + 1));
        }
    }
    return $result;
}

$flat_entities = flattenEntities($entities);

// Display header
Html::header(
    'Gestion des Entités',
    $_SERVER['PHP_SELF'],
    'helpdesk',
    'inventoryorganization'
);

// Render the entity page template
Glpi\Application\View\TemplateRenderer::getInstance()->display('pages/inventoryorganization/entity_wizard.html.twig', [
    'title'       => 'Gestion des Entités',
    'entities'    => $flat_entities,
    'can_create'  => Entity::canCreate(),
]);

Html::footer();
