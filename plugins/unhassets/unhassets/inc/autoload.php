<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

/**
 * Autoloader pour le plugin UNH Assets
 */
spl_autoload_register(function ($classname) {
    // Vérifier que c'est une classe du plugin
    if (strpos($classname, 'PluginUnhassets') === 0) {
        
        // Extraire le nom de la classe sans le préfixe
        $filename = strtolower(str_replace('PluginUnhassets', '', $classname));
        
        // Construire le chemin du fichier
        $filepath = __DIR__ . '/' . $filename . '.class.php';
        
        // Charger le fichier s'il existe
        if (file_exists($filepath)) {
            include_once($filepath);
            return true;
        }
    }
    
    return false;
});