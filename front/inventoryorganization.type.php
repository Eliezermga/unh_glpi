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

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Session::checkCSRF($_POST);
    
    $action = $_POST['action'] ?? '';
    
    if ($action === 'create_type' && InventoryOrganization::canCreate()) {
        $type_category = $_POST['type_category'] ?? 'computer';
        $type_name = trim($_POST['type_name'] ?? '');
        
        if (empty($type_name)) {
            $error_message = 'Le nom du type est requis';
        } else {
            // Create the type based on category
            $type_classes = [
                'computer'   => 'ComputerType',
                'monitor'    => 'MonitorType',
                'printer'    => 'PrinterType',
                'phone'      => 'PhoneType',
                'peripheral' => 'PeripheralType',
            ];
            
            $class_name = $type_classes[$type_category] ?? 'ComputerType';
            $type_obj = new $class_name();
            
            $input = [
                'name' => $type_name,
                'comment' => $_POST['comment'] ?? '',
            ];
            
            if ($type_obj->add($input)) {
                $success = true;
                Session::addMessageAfterRedirect(
                    sprintf('Type "%s" créé avec succès', $type_name),
                    false,
                    INFO
                );
            } else {
                $error_message = 'Échec de la création du type';
            }
        }
    }
    
    if ($action === 'delete_type' && InventoryOrganization::canCreate()) {
        $type_category = $_POST['type_category'] ?? '';
        $type_id = $_POST['type_id'] ?? 0;
        
        $type_classes = [
            'computer'   => 'ComputerType',
            'monitor'    => 'MonitorType',
            'printer'    => 'PrinterType',
            'phone'      => 'PhoneType',
            'peripheral' => 'PeripheralType',
        ];
        
        if (isset($type_classes[$type_category]) && $type_id > 0) {
            $class_name = $type_classes[$type_category];
            $type_obj = new $class_name();
            
            if ($type_obj->delete(['id' => $type_id])) {
                Session::addMessageAfterRedirect('Type supprimé avec succès', false, INFO);
            } else {
                Session::addMessageAfterRedirect('Échec de la suppression du type', false, ERROR);
            }
        }
        Html::redirect($_SERVER['PHP_SELF']);
    }
}

// Get material types
$types = InventoryOrganization::getMaterialTypes();

// Prepare type categories for the form
$type_categories = [
    'computer'   => 'Ordinateurs',
    'monitor'    => 'Moniteurs',
    'printer'    => 'Imprimantes',
    'phone'      => 'Téléphones',
    'peripheral' => 'Périphériques',
];

// Display header
Html::header(
    'Gestion des Types de Matériel',
    $_SERVER['PHP_SELF'],
    'helpdesk',
    'inventoryorganization'
);

// Render the type management template
Glpi\Application\View\TemplateRenderer::getInstance()->display('pages/inventoryorganization/types.html.twig', [
    'title'           => 'Gestion des Types de Matériel',
    'types'           => $types,
    'type_categories' => $type_categories,
    'success'         => $success,
    'error_message'   => $error_message,
    'can_create'      => InventoryOrganization::canCreate(),
]);

Html::footer();
