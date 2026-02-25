<?php
/**
 * UNH GLPI - Inventory Organization - Coherence Check
 * Ce fichier est en lecture seule (GET uniquement) - pas de POST
 */

include('../inc/includes.php');

if (!InventoryOrganization::canView()) {
    Html::displayRightError();
}

// Export CSV (GET uniquement - pas besoin de CSRF)
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    $all_issues = InventoryOrganization::getCoherenceIssues();

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="inventory_coherence_report_' . date('Y-m-d') . '.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, [
        __('Severity'),
        __('Type'),
        __('Message'),
        __('Asset Type'),
        __('Asset Name'),
    ]);

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

$filter_type     = $_GET['filter_type'] ?? 'all';
$filter_severity = $_GET['filter_severity'] ?? 'all';
$all_issues      = InventoryOrganization::getCoherenceIssues();

$issues = array_filter($all_issues, function ($issue) use ($filter_type, $filter_severity) {
    if ($filter_type !== 'all' && $issue['type'] !== $filter_type) {
        return false;
    }
    if ($filter_severity !== 'all' && $issue['severity'] !== $filter_severity) {
        return false;
    }
    return true;
});

$summary = [
    'total'    => count($all_issues),
    'errors'   => count(array_filter($all_issues, fn($i) => $i['severity'] === 'error')),
    'warnings' => count(array_filter($all_issues, fn($i) => $i['severity'] === 'warning')),
    'info'     => count(array_filter($all_issues, fn($i) => $i['severity'] === 'info')),
];

$issue_types = [
    'no_location'      => __('No location assigned'),
    'root_entity'      => __('In root entity'),
    'duplicate_serial' => __('Duplicate serial number'),
];

Html::header(
    __('Inventory Coherence Check'),
    $_SERVER['PHP_SELF'],
    'helpdesk',
    'inventoryorganization'
);

Glpi\Application\View\TemplateRenderer::getInstance()->display(
    'pages/inventoryorganization/coherence.html.twig',
    [
        'title'           => __('Inventory Coherence Check'),
        'issues'          => array_values($issues),
        'summary'         => $summary,
        'issue_types'     => $issue_types,
        'filter_type'     => $filter_type,
        'filter_severity' => $filter_severity,
        'can_create'      => InventoryOrganization::canCreate(),
        'status_ok'       => count($all_issues) === 0,
    ]
);

Html::footer();
