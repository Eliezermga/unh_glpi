<?php

/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * 
 * Test Runner - Run all tests for Technical Support feature
 * ---------------------------------------------------------------------
 */

require_once __DIR__ . '/HtmlMenuUnitTest.php';
require_once __DIR__ . '/TechnicalSupportIntegrationTest.php';
require_once __DIR__ . '/TechnicalSupportValidationTest.php';
require_once __DIR__ . '/InventoryOrganizationTest.php';

use Tests\Unit\HtmlMenuTest;
use Tests\Integration\TechnicalSupportIntegrationTest;
use Tests\Validation\TechnicalSupportValidationTest;

echo "\n";
echo "###############################################\n";
echo "#                                             #\n";
echo "#   GLPI - TECHNICAL SUPPORT TEST SUITE       #\n";
echo "#                                             #\n";
echo "###############################################\n\n";

$totalPassed = 0;
$totalFailed = 0;

// Run Unit Tests
$unitTest = new HtmlMenuTest();
$unitResults = $unitTest->runAllTests();
$totalPassed += $unitResults['passed'];
$totalFailed += $unitResults['failed'];

echo "\n";

// Run Integration Tests
$integrationTest = new TechnicalSupportIntegrationTest();
$integrationResults = $integrationTest->runAllTests();
$totalPassed += $integrationResults['passed'];
$totalFailed += $integrationResults['failed'];

echo "\n";

// Run Validation Tests
$validationTest = new TechnicalSupportValidationTest();
$validationResults = $validationTest->runAllTests();
$totalPassed += $validationResults['passed'];
$totalFailed += $validationResults['failed'];

echo "\n";
echo "###############################################\n";
echo "#           FINAL TEST SUMMARY                #\n";
echo "###############################################\n\n";
echo "Total Tests Run: " . ($totalPassed + $totalFailed) . "\n";
echo "Total Passed:    \033[32m$totalPassed\033[0m\n";
echo "Total Failed:    \033[31m$totalFailed\033[0m\n";
echo "\n";

if ($totalFailed === 0) {
    echo "\033[42m\033[30m  ALL TESTS PASSED!  \033[0m\n";
} else {
    echo "\033[41m\033[37m  SOME TESTS FAILED  \033[0m\n";
}

echo "\n###############################################\n\n";

exit($totalFailed > 0 ? 1 : 0);
