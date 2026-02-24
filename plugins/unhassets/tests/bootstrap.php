<?php

/**
 * Bootstrap file for the UNH Assets plugin tests.
 *
 * This file prepares the GLPI testing environment before running the Atoum test
 * suite.  It is based on the official GLPI developer documentation which
 * explains that each plugin must provide a bootstrap to load GLPI, include
 * the core test classes and ensure the plugin is installed and activated
 *【426500206292199†L47-L80】.  Without this bootstrap, the tests will not be able to
 * instantiate GLPI classes or access plugin functions.
 */

use Plugin;

// Determine the GLPI root directory.  The tests directory is located at
// plugins/unhassets/tests, so GLPI_ROOT is three directories up.
define('GLPI_ROOT', dirname(dirname(dirname(__DIR__))));

// Point GLPI to a temporary configuration directory for testing.  The GLPI
// core tests use the `tests` directory under the root as configuration
// storage【426500206292199†L56-L63】.  Adjust this if your GLPI installation uses a
// different layout.
define('GLPI_CONFIG_DIR', GLPI_ROOT . '/tests');

// Load the GLPI includes.  This will bootstrap the autoloader and initialize
// constants used by many GLPI classes.
require_once GLPI_ROOT . '/inc/includes.php';

// Include the base test case classes provided by GLPI.  DbTestCase is used
// when a test requires a database connection; GLPITestCase is the base for
// most unit tests.
require_once GLPI_ROOT . '/tests/GLPITestCase.php';
require_once GLPI_ROOT . '/tests/DbTestCase.php';

// Instantiate the plugin and ensure it is installed and activated.  If the
// plugin has not been installed, install and activate it so that its classes
// are available during the tests【426500206292199†L65-L79】.
$plugin = new Plugin();
$plugin->checkStates(true);
$plugin->getFromDBbyDir('unhassets');

// Check prerequisites defined by the plugin.  If they are not met, stop
// execution with an informative message.  plugin_unhassets_check_prerequisites
// resides in setup.php.
if (!function_exists('plugin_unhassets_check_prerequisites')) {
    include_once __DIR__ . '/../setup.php';
}
if (!plugin_unhassets_check_prerequisites()) {
    echo "\nPrerequisites are not met!";
    exit(1);
}

// Install and activate the plugin if necessary.
if (!$plugin->isInstalled('unhassets')) {
    $plugin->install($plugin->getID());
}
if (!$plugin->isActivated('unhassets')) {
    $plugin->activate($plugin->getID());
}