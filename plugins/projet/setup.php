<?php

define('PLUGIN_PROJET_VERSION', '1.0.0');
define('PLUGIN_PROJET_MIN_GLPI', '10.0.0');
define('PLUGIN_PROJET_MAX_GLPI', '10.0.99');

function plugin_init_projet() {
    global $PLUGIN_HOOKS, $CFG_GLPI;

    $PLUGIN_HOOKS['csrf_compliant']['projet'] = true;
    
    $inc_dir = __DIR__ . '/inc/';
    foreach (glob($inc_dir . '*.class.php') as $file) {
        require_once($file);
    }
    
    $plugin = new Plugin();
    if ($plugin->isActivated('projet')) {
        
        Plugin::registerClass('PluginProjetProjet', [
            'addtabon' => ['Central']
        ]);
        Plugin::registerClass('PluginProjetProfile', [
            'addtabon' => ['Profile']
        ]);
        
        if (Session::getLoginUserID()) {
            
            if (!isset($_SESSION['glpiactiveprofile']['plugin_projet'])) {
                $_SESSION['glpiactiveprofile']['plugin_projet'] = ALLSTANDARDRIGHT;
            }
            
            $PLUGIN_HOOKS['menu_toadd']['projet'] = ['tools' => 'PluginProjetProjet'];
        }
    }
}

function plugin_version_projet() {
    return [
        'name'    => __('Gestion des Projets', 'projet'),
        'version' => PLUGIN_PROJET_VERSION,
        'author'  => 'UNH',
        'license' => 'GPLv2+',
        'requirements' => [
            'glpi' => [
                'min' => PLUGIN_PROJET_MIN_GLPI,
                'max' => PLUGIN_PROJET_MAX_GLPI
            ]
        ]
    ];
}

function plugin_projet_check_prerequisites() {
    return version_compare(GLPI_VERSION, PLUGIN_PROJET_MIN_GLPI, 'ge') 
        && version_compare(GLPI_VERSION, PLUGIN_PROJET_MAX_GLPI, 'lt');
}

function plugin_projet_check_config() {
    return true;
}
