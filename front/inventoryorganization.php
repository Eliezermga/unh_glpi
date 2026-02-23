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
    'title'      => InventoryOrganization::getTypeName(),
    'stats'      => $summary['stats'],
    'issues'     => $summary['issues'],
    'issue_summary' => $summary['issue_summary'],
    'can_create' => InventoryOrganization::canCreate(),
    'menu_items' => [
        [
            'title' => __('Entités'),
            'description' => __('Créer et gérer la hiérarchie des entités GLPI'),
            'icon' => 'ti ti-building',
            'link' => 'inventoryorganization.entity.php',
            'color' => 'primary',
        ],
        [
            'title' => __('Lieux'),
            'description' => __('Définir les lieux (campus, bâtiments, étages, salles)'),
            'icon' => 'ti ti-map-pin',
            'link' => 'inventoryorganization.location.php',
            'color' => 'success',
        ],
        [
            'title' => __('Types de matériel'),
            'description' => __('Créer les types de matériel (PC, laptop, projecteur)'),
            'icon' => 'ti ti-devices',
            'link' => 'inventoryorganization.type.php',
            'color' => 'info',
        ],
        [
            'title' => __('Étiquetage'),
            'description' => __('Configurer le format UNH-FAC-BAT-TYPE-NNN'),
            'icon' => 'ti ti-tag',
            'link' => 'inventoryorganization.labeling.php',
            'color' => 'warning',
        ],
        [
            'title' => __('Vérification de cohérence'),
            'description' => __('Contrôler la cohérence de l’inventaire'),
            'icon' => 'ti ti-checkbox',
            'link' => 'inventoryorganization.coherence.php',
            'color' => 'danger',
        ],
    ],
]);


Html::footer();
