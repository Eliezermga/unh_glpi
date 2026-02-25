<?php
/**
 * UNH GLPI - Inventory Organization - Labeling Configuration
 */

include('../inc/includes.php');

if (!InventoryOrganization::canView()) {
    Html::displayRightError();
}

$success       = false;
$error_message = '';
$config        = InventoryOrganization::getLabelingConfig();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 🔒 CSRF
    Session::checkCSRF($_POST);

    $action = $_POST['action'] ?? '';

    if ($action === 'save_config' && InventoryOrganization::canCreate()) {
        $new_config = [
            'format'  => $_POST['format'] ?? $config['format'],
            'prefix'  => strtoupper(trim($_POST['prefix'] ?? $config['prefix'])),
            'padding' => max(1, min(6, (int)($_POST['padding'] ?? $config['padding']))),
            'types'   => [],
        ];

        $type_keys = ['computer', 'laptop', 'monitor', 'printer', 'phone', 'projector', 'peripheral'];
        foreach ($type_keys as $key) {
            $code = strtoupper(trim($_POST['type_' . $key] ?? $config['types'][$key] ?? ''));
            if (!empty($code)) {
                $new_config['types'][$key] = $code;
            }
        }

        if (empty($new_config['prefix'])) {
            $error_message = __('Prefix is required');
        } elseif (!preg_match('/^[A-Z]{2,5}$/', $new_config['prefix'])) {
            $error_message = __('Prefix must be between 2 and 5 uppercase letters');
        } else {
            if (InventoryOrganization::saveLabelingConfig($new_config)) {
                $success = true;
                $config  = $new_config;

                // 📋 AUDIT LOG
                Event::log(
                    0,
                    'inventoryorganization',
                    4,
                    'UNH Inventory',
                    sprintf(
                        __('%s updated labeling configuration (prefix: %s)'),
                        $_SESSION['glpiname'],
                        $new_config['prefix']
                    )
                );
                Session::addMessageAfterRedirect(__('Labeling configuration saved'), false, INFO);
            } else {
                $error_message = __('Failed to save configuration');
            }
        }
    }
}

$preview_labels = [];
$asset_types    = ['computer', 'laptop', 'monitor', 'printer', 'phone', 'projector', 'peripheral'];
foreach ($asset_types as $type) {
    $preview_labels[$type] = InventoryOrganization::generateNextLabel($type);
}

Html::header(
    __('Labeling Configuration'),
    $_SERVER['PHP_SELF'],
    'helpdesk',
    'inventoryorganization'
);

<<<<<<< HEAD
Glpi\Application\View\TemplateRenderer::getInstance()->display(
    
    'pages/inventoryorganization/labeling.html.twig',
    [
        'title'          => __('Labeling Configuration'),
        'config'         => $config,
        'preview_labels' => $preview_labels,
        'success'        => $success,
        'error_message'  => $error_message,
        'can_create'     => InventoryOrganization::canCreate(),
        'asset_types'    => [
            'computer'   => __('Computer'),
            'laptop'     => __('Laptop'),
            'monitor'    => __('Monitor'),
            'printer'    => __('Printer'),
            'phone'      => __('Phone'),
            'projector'  => __('Projector'),
            'peripheral' => __('Peripheral'),
        ],
    ]
);
=======
// Render the labeling configuration template
Glpi\Application\View\TemplateRenderer::getInstance()->display('pages/inventoryorganization/labeling.html.twig', [
    'title'          => __('Configuration de l etiquetage'),
    'config'         => $config,
    'preview_labels' => $preview_labels,
    'success'        => $success,
    'error_message'  => $error_message,
    'can_create'     => InventoryOrganization::canCreate(),
    'csrf_token_value' => Session::getNewCSRFToken(true),
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
>>>>>>> origin/pre-product

Html::footer();

