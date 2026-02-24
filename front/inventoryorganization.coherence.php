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

// Get filter parameters
$filter_type = $_GET['filter_type'] ?? 'all';
$filter_severity = $_GET['filter_severity'] ?? 'all';

// Get coherence issues
$all_issues = InventoryOrganization::getCoherenceIssues();

// Apply filters
$issues = array_filter($all_issues, function($issue) use ($filter_type, $filter_severity) {
    if ($filter_type !== 'all' && $issue['type'] !== $filter_type) {
        return false;
    }
    if ($filter_severity !== 'all' && $issue['severity'] !== $filter_severity) {
        return false;
    }
    return true;
});

// Calculate summary
$summary = [
    'total'    => count($all_issues),
    'errors'   => count(array_filter($all_issues, fn($i) => $i['severity'] === 'error')),
    'warnings' => count(array_filter($all_issues, fn($i) => $i['severity'] === 'warning')),
    'info'     => count(array_filter($all_issues, fn($i) => $i['severity'] === 'info')),
];

// Get issue types for filter
$issue_types = [
    'no_location'      => __('Aucun lieu assigne'),
    'root_entity'      => __('Dans l entite racine'),
    'duplicate_serial' => __('Numero de serie en doublon'),
];

// Export functionality
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="inventory_coherence_report_' . date('Y-m-d') . '.csv"');
    
    $output = fopen('php://output', 'w');
    
    // CSV header
    fputcsv($output, [
        __('Severite'),
        __('Type'),
        __('Message'),
        __('Type d actif'),
        __('Nom de l actif'),
    ]);
    
    // CSV data
    foreach ($all_issues as $issue) {
        fputcsv($output, [
            $issue['severity'],
            $issue['type'],
            strip_tags($issue['message']),
            $issue['asset_type'] ?? '',
            $issue['asset_name'] ?? '',
        ]);
    }
    
    fclose($output);
    exit;
}

// Display header
Html::header(
    __('Verification de coherence de l inventaire'),
    $_SERVER['PHP_SELF'],
    'helpdesk',
    'inventoryorganization'
);

// Render the coherence check template
Glpi\Application\View\TemplateRenderer::getInstance()->display('pages/inventoryorganization/coherence.html.twig', [
    'title'           => __('Verification de coherence de l inventaire'),
    'issues'          => array_values($issues),
    'summary'         => $summary,
    'issue_types'     => $issue_types,
    'filter_type'     => $filter_type,
    'filter_severity' => $filter_severity,
    'can_create'      => InventoryOrganization::canCreate(),
    'status_ok'       => count($all_issues) === 0,
]);

Html::footer();
