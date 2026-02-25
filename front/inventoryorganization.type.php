<?php
/**
 * UNH GLPI - Inventory Organization - Type Management
 */

include('../inc/includes.php');

// Vérification des droits
if (!InventoryOrganization::canView()) {
    Html::displayRightError();
}

$success = false;
$error_message = '';

// Traitement des formulaires POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 🔒 CSRF - Protection obligatoire sur tous les POST
    Session::checkCSRF($_POST);

    $action = $_POST['action'] ?? '';

    if ($action === 'create_type' && InventoryOrganization::canCreate()) {
        $type_category = $_POST['type_category'] ?? 'computer';
        $type_name     = trim($_POST['type_name'] ?? '');

        if (empty($type_name)) {
            $error_message = __('Type name is required');
        } else {
            $type_classes = [
                'computer'   => 'ComputerType',
                'monitor'    => 'MonitorType',
                'printer'    => 'PrinterType',
                'phone'      => 'PhoneType',
                'peripheral' => 'PeripheralType',
            ];

            $class_name = $type_classes[$type_category] ?? 'ComputerType';
            $type_obj   = new $class_name();

            if (!$type_obj->canCreate()) {
                $error_message = __('You do not have permission to create types.');
                goto render_page;
            }

            $input = [
                'name'    => $type_name,
                'comment' => $_POST['comment'] ?? '',
            ];

            if ($type_obj->add($input)) {
                $success = true;
                // 📋 AUDIT LOG
                Event::log(
                    0,
                    'inventoryorganization',
                    4,
                    'UNH Inventory',
                    sprintf(
                        __('%s created equipment type "%s" (category: %s)'),
                        $_SESSION['glpiname'],
                        $type_name,
                        $type_category
                    )
                );
                Session::addMessageAfterRedirect(
                    sprintf(__('Type "%s" created successfully'), $type_name),
                    false,
                    INFO
                );
            } else {
                $error_message = __('Failed to create type');
            }
        }
    }

    if ($action === 'delete_type' && InventoryOrganization::canCreate()) {
        $type_category = $_POST['type_category'] ?? '';
        $type_id       = (int)($_POST['type_id'] ?? 0);

        $type_classes = [
            'computer'   => 'ComputerType',
            'monitor'    => 'MonitorType',
            'printer'    => 'PrinterType',
            'phone'      => 'PhoneType',
            'peripheral' => 'PeripheralType',
        ];

        if (isset($type_classes[$type_category]) && $type_id > 0) {
            $class_name = $type_classes[$type_category];
            $type_obj   = new $class_name();

            if ($type_obj->delete(['id' => $type_id])) {
                // 📋 AUDIT LOG
                Event::log(
                    $type_id,
                    'inventoryorganization',
                    4,
                    'UNH Inventory',
                    sprintf(
                        __('%s deleted equipment type #%d (category: %s)'),
                        $_SESSION['glpiname'],
                        $type_id,
                        $type_category
                    )
                );
                Session::addMessageAfterRedirect(__('Type deleted successfully'), false, INFO);
            } else {
                Session::addMessageAfterRedirect(__('Failed to delete type'), false, ERROR);
            }
        }
        Html::redirect($_SERVER['PHP_SELF']);
    }
}

render_page:

$types = InventoryOrganization::getMaterialTypes();

$type_categories = [
    'computer'   => __('Computers'),
    'monitor'    => __('Monitors'),
    'printer'    => __('Printers'),
    'phone'      => __('Phones'),
    'peripheral' => __('Peripherals'),
];

Html::header(
    __('Material Type Management'),
    $_SERVER['PHP_SELF'],
    'helpdesk',
    'inventoryorganization'
);

Glpi\Application\View\TemplateRenderer::getInstance()->display(
    
    'pages/inventoryorganization/types.html.twig',
    [
        'title'           => __('Material Type Management'),
        'types'           => $types,
        'type_categories' => $type_categories,
        'success'         => $success,
        'error_message'   => $error_message,
        'can_create'      => InventoryOrganization::canCreate(),
    ]
);

Html::footer();
