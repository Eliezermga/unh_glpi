<?php

function plugin_init_universite() {
    global $PLUGIN_HOOKS;
    
    $PLUGIN_HOOKS['csrf_compliant']['universite'] = true;
    
    // Enregistrement des classes
    Plugin::registerClass('PluginUniversiteCours', ['addtabon' => 'Entity']);
    Plugin::registerClass('PluginUniversiteRessource', ['addtabon' => 'PluginUniversiteCours']);
    Plugin::registerClass('PluginUniversiteProfile', ['addtabon' => 'Profile']);
    
    // Menu principal - À AJOUTER DANS LA SIDEBAR
    $PLUGIN_HOOKS['menu_toadd']['universite'] = [
        'tools' => 'PluginUniversiteMenu'  // Ajouter dans "Outils" ou "Administration"
    ];
    
    // CSS personnalisé
    $PLUGIN_HOOKS['add_css']['universite'] = 'css/styles.css';
    
    // Installation et désinstallation
    $PLUGIN_HOOKS['install']['universite'] = 'plugin_universite_install';
    $PLUGIN_HOOKS['uninstall']['universite'] = 'plugin_universite_uninstall';
    
    // Onglets
    $PLUGIN_HOOKS['add_tab']['Entity'] = 'PluginUniversiteCours';
    $PLUGIN_HOOKS['add_tab']['PluginUniversiteCours'] = 'PluginUniversiteRessource';
    
    // Droits
    $PLUGIN_HOOKS['add_rights']['universite'] = [
        'plugin_universite_cours' => __('Gérer les cours', 'universite'),
        'plugin_universite_ressource' => __('Gérer les ressources', 'universite'),
        'plugin_universite_categorie' => __('Gérer les catégories', 'universite')
    ];
}

function plugin_version_universite() {
    return [
        'name'           => 'Base de Connaissances Universitaire',
        'version'        => '1.0.0',
        'author'         => 'Équipe de développement',
        'license'        => 'GPLv2+',
        'homepage'       => 'https://votre-universite.fr',
        'requirements'   => [
            'glpi' => [
                'min' => '10.0.0',
                'max' => '10.0.99',
            ],
            'php' => [
                'min' => '7.4'
            ]
        ]
    ];
}

function plugin_universite_check_prerequisites() {
    if (version_compare(PHP_VERSION, '7.4', '<')) {
        echo "Ce plugin nécessite PHP 7.4 ou supérieur";
        return false;
    }
    
    if (!extension_loaded('mysqli')) {
        echo "L'extension mysqli est requise pour ce plugin";
        return false;
    }
    
    return true;
}

function plugin_universite_check_config($verbose = false) {
    if ($verbose) {
        echo 'Configuration OK';
    }
    return true;
}

function plugin_universite_install() {
    global $DB;
    
    // Utiliser la version depuis le fichier version
    $migration = new Migration(100);
    
    // Installation de la table cours si elle n'existe pas
    if (!$DB->tableExists('glpi_plugin_universite_cours')) {
        $migration->displayMessage("Creating table for PluginUniversiteCours");
    }
    
    // Installation de la table ressources si elle n'existe pas
    if (!$DB->tableExists('glpi_plugin_universite_ressources')) {
        $migration->displayMessage("Creating table for PluginUniversiteRessource");
    }
    
    // Création du répertoire pour les fichiers
    $dir = GLPI_ROOT . '/files/plugins/universite';
    if (!file_exists($dir)) {
        if (!mkdir($dir, 0755, true)) {
            error_log('Failed to create directory: ' . $dir);
        }
    }
    
    return true;
}

function plugin_universite_uninstall() {
    global $DB;
    
    // Suppression des tables
    if ($DB->tableExists('glpi_plugin_universite_cours')) {
        $DB->query('DROP TABLE IF EXISTS glpi_plugin_universite_cours');
    }
    
    if ($DB->tableExists('glpi_plugin_universite_ressources')) {
        $DB->query('DROP TABLE IF EXISTS glpi_plugin_universite_ressources');
    }
    
    // Suppression des fichiers (attention, demande confirmation)
    $dir = GLPI_ROOT . '/files/plugins/universite';
    if (file_exists($dir)) {
        // On ne supprime pas automatiquement pour éviter les pertes de données
        // rmdir_recursive($dir);
    }
    
    return true;
}
