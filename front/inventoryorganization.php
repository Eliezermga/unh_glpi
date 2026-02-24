<?php

/**
 * ---------------------------------------------------------------------
 *
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * http://glpi-project.org
 *
 * @copyright 2015-2023 Teclib' and contributors.
 * @copyright 2003-2014 by the INDEPNET Development Team.
 * @licence   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * ---------------------------------------------------------------------
 */

include('../inc/includes.php');

if (!InventoryOrganization::canView()) {
    Html::displayRightError();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Session::checkCSRF($_POST);
}

$summary = InventoryOrganization::getSummary();

Html::header(
    InventoryOrganization::getTypeName(),
    $_SERVER['PHP_SELF'],
    'helpdesk',
    'inventoryorganization'
);

Glpi\Application\View\TemplateRenderer::getInstance()->display('pages/inventoryorganization/main.html.twig', [
    'title'         => InventoryOrganization::getTypeName(),
    'stats'         => $summary['stats'],
    'issues'        => $summary['issues'],
    'issue_summary' => $summary['issue_summary'],
    'can_create'    => InventoryOrganization::canCreate(),
    'menu_items'    => [
        [
            'title'       => __('Entities'),
            'description' => __('Create and manage the GLPI entity hierarchy'),
            'icon'        => 'ti ti-building',
            'link'        => 'inventoryorganization.entity.php',
            'color'       => 'primary',
        ],
        [
            'title'       => __('Locations'),
            'description' => __('Define locations (campus, buildings, floors, rooms)'),
            'icon'        => 'ti ti-map-pin',
            'link'        => 'inventoryorganization.location.php',
            'color'       => 'success',
        ],
        [
            'title'       => __('Asset types'),
            'description' => __('Create asset types (PC, laptop, projector)'),
            'icon'        => 'ti ti-devices',
            'link'        => 'inventoryorganization.type.php',
            'color'       => 'info',
        ],
        [
            'title'       => __('Labeling'),
            'description' => __('Configure the format UNH-FAC-BAT-TYPE-NNN'),
            'icon'        => 'ti ti-tag',
            'link'        => 'inventoryorganization.labeling.php',
            'color'       => 'warning',
        ],
        [
            'title'       => __('Coherence check'),
            'description' => __('Check inventory coherence'),
            'icon'        => 'ti ti-checkbox',
            'link'        => 'inventoryorganization.coherence.php',
            'color'       => 'danger',
        ],
    ],
]);

Html::footer();
