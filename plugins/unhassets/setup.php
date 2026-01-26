```php
<?php
/**
 * Plugin UNH Assets pour GLPI
 */

define('PLUGIN_UNHASSETS_VERSION', '1.0.0');
define('PLUGIN_UNHASSETS_MIN_GLPI', '10.0.0');
define('PLUGIN_UNHASSETS_MAX_GLPI', '10.0.99');

function plugin_init_unhassets() {
    global $PLUGIN_HOOKS, $CFG_GLPI;

    $PLUGIN_HOOKS['csrf_compliant']['unhassets'] = true;

    // Charger TOUTES les classes dès le début
    $inc_dir = __DIR__ . '/inc/';
    foreach (glob($inc_dir . '*.class.php') as $file) {
        require_once($file);
    }

    $plugin = new Plugin();
    if ($plugin->isActivated('unhassets')) {

        // Enregistrement basique
        Plugin::registerClass('PluginUnhassetsAsset');
        Plugin::registerClass('PluginUnhassetsReservation');
        Plugin::registerClass('PluginUnhassetsLicense');
        Plugin::registerClass('PluginUnhassetsProfile');
        Plugin::registerClass('PluginUnhassetsMenu');

        if (Session::getLoginUserID()) {

            // Hook pour recharger les droits quand on change de profil
            $PLUGIN_HOOKS['change_profile']['unhassets'] = ['PluginUnhassetsProfile', 'changeProfile'];

            $PLUGIN_HOOKS['config_page']['unhassets'] = 'front/config.form.php';
            $PLUGIN_HOOKS['redefine_menus']['unhassets'] = 'plugin_unhassets_redefine_menus';
        }
    }
}

function plugin_version_unhassets() {
    return [
        'name'    => 'UNH Assets Management',
        'version' => PLUGIN_UNHASSETS_VERSION,
        'author'  => 'Université',
        'license' => 'GPLv2+',
        'requirements' => [
            'glpi' => [
                'min' => PLUGIN_UNHASSETS_MIN_GLPI,
                'max' => PLUGIN_UNHASSETS_MAX_GLPI
            ]
        ]
    ];
}

function plugin_unhassets_check_prerequisites() {
    return version_compare(GLPI_VERSION, PLUGIN_UNHASSETS_MIN_GLPI, 'ge')
        && version_compare(GLPI_VERSION, PLUGIN_UNHASSETS_MAX_GLPI, 'lt');
}

function plugin_unhassets_check_config() {
    return true;
}

/**
 * Déclaration des droits du plugin (visible dans Administration > Profils > Droits plugins)
 */
function plugin_unhassets_getRights() {
    return [
        'plugin_unhassets' => [
            'itemtype' => 'PluginUnhassetsLicense',
            'label'    => __('UNH Assets Management', 'unhassets'),
            'rights'   => [
                READ   => __('Lecture', 'unhassets'),
                UPDATE => __('Écriture (ajout/modif)', 'unhassets'),
                PURGE  => __('Suppression', 'unhassets')
            ]
        ]
    ];
}

/**
 * Fonction pour redéfinir les menus et masquer Assets
 */
function plugin_unhassets_redefine_menus($menus) {

    // Si l'utilisateur n'a pas le droit de lecture, on ne montre pas le menu du plugin
    if (!Session::haveRight('plugin_unhassets', READ)) {
        unset($menus['unhassets']);
        return $menus;
    }

    if (isset($menus['assets'])) {
        unset($menus['assets']);
    }

    if (class_exists('PluginUnhassetsMenu')) {
        $menucontent = PluginUnhassetsMenu::getMenuContent();
        $menus['unhassets'] = [
            'title'   => PluginUnhassetsMenu::getMenuName(),
            'default' => '/plugins/unhassets/front/dashboard.php',
            'icon'    => 'ti ti-building',
            'content' => $menucontent['options'] ?? [],
        ];
    }

    return $menus;
}
```
