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

$success = false;
$error_message = '';

// Get current labeling configuration
$config = InventoryOrganization::getLabelingConfig();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Session::checkCSRF($_POST);
    $action = $_POST['action'] ?? '';
    
        if ($action === 'save_config' && InventoryOrganization::canCreate()) {
            $new_config = [
                'format'  => $_POST['format'] ?? $config['format'],
                'prefix'  => strtoupper(trim($_POST['prefix'] ?? $config['prefix'])),
                'padding' => max(1, min(6, (int)($_POST['padding'] ?? $config['padding']))),
                'types'   => [],
            ];
        
            // Process type codes
            $type_keys = ['computer', 'laptop', 'monitor', 'printer', 'phone', 'projector', 'peripheral'];
            foreach ($type_keys as $key) {
                $code = strtoupper(trim($_POST['type_' . $key] ?? $config['types'][$key] ?? ''));
                if (!empty($code)) {
                    $new_config['types'][$key] = $code;
                }
            }
        
            // Validate prefix
            if (empty($new_config['prefix'])) {
                $error_message = __('Le prefixe est requis');
            } elseif (!preg_match('/^[A-Z]{2,5}$/', $new_config['prefix'])) {
                $error_message = __('Le prefixe doit contenir entre 2 et 5 lettres majuscules');
            } else {
                if (InventoryOrganization::saveLabelingConfig($new_config)) {
                    $success = true;
                    $config = $new_config;
                    Session::addMessageAfterRedirect(__('Configuration de l etiquetage enregistree'), false, INFO);
                } else {
                    $error_message = __('Echec de l enregistrement de la configuration');
                }
            }
        }
        
    if ($action === 'generate_preview') {
        // Just reload with preview
    }
}

// Generate preview labels
$preview_labels = [];
$asset_types = ['computer', 'laptop', 'monitor', 'printer', 'phone', 'projector', 'peripheral'];
foreach ($asset_types as $type) {
    $preview_labels[$type] = InventoryOrganization::generateNextLabel($type);
}

// Display header
Html::header(
    __('Configuration de l etiquetage'),
    $_SERVER['PHP_SELF'],
    'helpdesk',
    'inventoryorganization'
);

// Render the labeling configuration template
Glpi\Application\View\TemplateRenderer::getInstance()->display('pages/inventoryorganization/labeling.html.twig', [
    'title'          => __('Configuration de l etiquetage'),
    'config'         => $config,
    'preview_labels' => $preview_labels,
    'success'        => $success,
    'error_message'  => $error_message,
    'can_create'     => InventoryOrganization::canCreate(),
    'asset_types'    => [
        'computer'   => __('Ordinateur'),
        'laptop'     => __('Ordinateur portable'),
        'monitor'    => __('Moniteur'),
        'printer'    => __('Imprimante'),
        'phone'      => __('Telephone'),
        'projector'  => __('Projecteur'),
        'peripheral' => __('Peripherique'),
    ],
]);

Html::footer();
