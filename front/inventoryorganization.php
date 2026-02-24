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
            'title'       => __('Entites'),
            'description' => __('Creer et gerer la hierarchie des entites GLPI'),
            'icon'        => 'ti ti-building',
            'link'        => 'inventoryorganization.entity.php',
            'color'       => 'primary',
        ],
        [
            'title'       => __('Lieux'),
            'description' => __('Definir les lieux (campus, batiments, etages, salles)'),
            'icon'        => 'ti ti-map-pin',
            'link'        => 'inventoryorganization.location.php',
            'color'       => 'success',
        ],
        [
            'title'       => __('Types de materiel'),
            'description' => __('Creer les types de materiel (PC, laptop, projecteur)'),
            'icon'        => 'ti ti-devices',
            'link'        => 'inventoryorganization.type.php',
            'color'       => 'info',
        ],
        [
            'title'       => __('Etiquetage'),
            'description' => __('Configurer le format UNH-FAC-BAT-TYPE-NNN'),
            'icon'        => 'ti ti-tag',
            'link'        => 'inventoryorganization.labeling.php',
            'color'       => 'warning',
        ],
        [
            'title'       => __('Verification de coherence'),
            'description' => __('Controler la coherence de l inventaire'),
            'icon'        => 'ti ti-checkbox',
            'link'        => 'inventoryorganization.coherence.php',
            'color'       => 'danger',
        ],
    ],
]);

Html::footer();
