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
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * ---------------------------------------------------------------------
 */

include('../inc/includes.php');

// Check permissions
if (!InventoryOrganization::canView()) {
    Html::displayRightError();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF check
    Session::checkCSRF($_POST);
    
    // Handle any POST actions here
}

// Get dashboard data
$summary = InventoryOrganization::getSummary();

// Display header
Html::header(
    InventoryOrganization::getTypeName(),
    $_SERVER['PHP_SELF'],
    'helpdesk',
    'inventoryorganization'
);

// Render the main dashboard template
Glpi\Application\View\TemplateRenderer::getInstance()->display('pages/inventoryorganization/main.html.twig', [
    'title'      => __('Inventory Organization'),
    'stats'      => $summary['stats'],
    'issues'     => $summary['issues'],
    'issue_summary' => $summary['issue_summary'],
    'can_create' => InventoryOrganization::canCreate(),
    'menu_items' => [
        [
            'title' => __('Entities'),
            'description' => __('Create and manage GLPI entities'),
            'icon' => 'ti ti-building',
            'link' => 'inventoryorganization.entity.php',
            'color' => 'primary',
        ],
        [
            'title' => __('Locations'),
            'description' => __('Define locations (offices, amphitheaters, rooms)'),
            'icon' => 'ti ti-map-pin',
            'link' => 'inventoryorganization.location.php',
            'color' => 'success',
        ],
        [
            'title' => __('Equipment Types'),
            'description' => __('Create equipment types (PCs, laptops, projectors)'),
            'icon' => 'ti ti-devices',
            'link' => 'inventoryorganization.type.php',
            'color' => 'info',
        ],
        [
            'title' => __('Labeling'),
            'description' => __('Configure standardized labeling'),
            'icon' => 'ti ti-tag',
            'link' => 'inventoryorganization.labeling.php',
            'color' => 'warning',
        ],
        [
            'title' => __('Coherence Check'),
            'description' => __('Check inventory coherence'),
            'icon' => 'ti ti-checkbox',
            'link' => 'inventoryorganization.coherence.php',
            'color' => 'danger',
        ],
    ],
]);


Html::footer();
