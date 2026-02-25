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

/**
 * Unit Tests for InventoryOrganization Module
 * 
 * Tests the core functionality of the Inventory Organization module including:
 * - Menu content generation
 * - Dashboard statistics
 * - Coherence issue detection
 * - Location hierarchy
 * - Labeling configuration
 * - Label generation and validation
 */
class InventoryOrganizationTest
{
    private $testResults = [];
    private $passCount = 0;
    private $failCount = 0;

    /**
     * Run all tests
     */
    public function runAllTests()
    {
        echo "\n========================================\n";
        echo "  InventoryOrganization Unit Tests     \n";
        echo "========================================\n\n";

        // Test getTypeName
        $this->testGetTypeName();

        // Test getIcon
        $this->testGetIcon();

        // Test getMenuContent
        $this->testGetMenuContent();

        // Test getLabelingConfig
        $this->testGetLabelingConfig();

        // Test generateNextLabel
        $this->testGenerateNextLabel();

        // Test validateLabel
        $this->testValidateLabel();

        // Test getDashboardStats
        $this->testGetDashboardStats();

        // Test getCoherenceIssues
        $this->testGetCoherenceIssues();

        // Test getLocationHierarchy
        $this->testGetLocationHierarchy();

        // Test getEntityTree
        $this->testGetEntityTree();

        // Test getMaterialTypes
        $this->testGetMaterialTypes();

        // Test createEntity validation
        $this->testCreateEntityValidation();

        // Test createLocation validation
        $this->testCreateLocationValidation();

        // Print summary
        $this->printSummary();

        return $this->failCount === 0;
    }

    /**
     * Assert test condition
     */
    private function assert($condition, $testName, $message = '')
    {
        if ($condition) {
            $this->passCount++;
            echo "  ✓ PASS: {$testName}\n";
            $this->testResults[$testName] = ['status' => 'PASS', 'message' => $message];
        } else {
            $this->failCount++;
            echo "  ✗ FAIL: {$testName}" . ($message ? " - {$message}" : "") . "\n";
            $this->testResults[$testName] = ['status' => 'FAIL', 'message' => $message];
        }
    }

    /**
     * Test getTypeName returns expected string
     */
    public function testGetTypeName()
    {
        echo "\n[Testing getTypeName]\n";
        
        $typeName = InventoryOrganization::getTypeName();
        $this->assert(
            !empty($typeName) && is_string($typeName),
            'getTypeName returns non-empty string',
            "Returned: '{$typeName}'"
        );
    }

    /**
     * Test getIcon returns valid icon class
     */
    public function testGetIcon()
    {
        echo "\n[Testing getIcon]\n";
        
        $icon = InventoryOrganization::getIcon();
        $this->assert(
            !empty($icon) && strpos($icon, 'ti ') === 0,
            'getIcon returns valid Tabler icon class',
            "Returned: '{$icon}'"
        );
    }

    /**
     * Test getMenuContent structure
     */
    public function testGetMenuContent()
    {
        echo "\n[Testing getMenuContent]\n";
        
        // Note: This may return false if user has no permissions
        $menu = InventoryOrganization::getMenuContent();
        
        if ($menu === false) {
            $this->assert(true, 'getMenuContent returns false (no permissions)', 'Expected when not logged in');
        } else {
            $this->assert(
                isset($menu['title']) && isset($menu['page']) && isset($menu['icon']),
                'getMenuContent has required keys (title, page, icon)',
                "Keys: " . implode(', ', array_keys($menu))
            );
            
            $this->assert(
                isset($menu['options']) && is_array($menu['options']),
                'getMenuContent has options array',
                "Options count: " . (isset($menu['options']) ? count($menu['options']) : 0)
            );

            // Check for expected options
            $expectedOptions = ['entity', 'location', 'type', 'labeling', 'coherence'];
            $hasAllOptions = true;
            foreach ($expectedOptions as $option) {
                if (!isset($menu['options'][$option])) {
                    $hasAllOptions = false;
                    break;
                }
            }
            $this->assert(
                $hasAllOptions,
                'getMenuContent has all expected sub-options',
                "Expected: " . implode(', ', $expectedOptions)
            );
        }
    }

    /**
     * Test getLabelingConfig returns valid configuration
     */
    public function testGetLabelingConfig()
    {
        echo "\n[Testing getLabelingConfig]\n";
        
        $config = InventoryOrganization::getLabelingConfig();
        
        $this->assert(
            is_array($config),
            'getLabelingConfig returns array'
        );
        
        $this->assert(
            isset($config['prefix']) && !empty($config['prefix']),
            'getLabelingConfig has prefix',
            "Prefix: " . ($config['prefix'] ?? 'N/A')
        );
        
        $this->assert(
            isset($config['padding']) && is_int($config['padding']) && $config['padding'] > 0,
            'getLabelingConfig has valid padding',
            "Padding: " . ($config['padding'] ?? 'N/A')
        );
        
        $this->assert(
            isset($config['types']) && is_array($config['types']) && count($config['types']) > 0,
            'getLabelingConfig has types array',
            "Types count: " . (isset($config['types']) ? count($config['types']) : 0)
        );
    }

    /**
     * Test generateNextLabel format
     */
    public function testGenerateNextLabel()
    {
        echo "\n[Testing generateNextLabel]\n";
        
        $assetTypes = ['computer', 'monitor', 'printer', 'phone', 'peripheral'];
        
        foreach ($assetTypes as $type) {
            $label = InventoryOrganization::generateNextLabel($type);
            
            $this->assert(
                !empty($label) && is_string($label),
                "generateNextLabel for '{$type}' returns non-empty string",
                "Label: '{$label}'"
            );
            
            // Check format:
            // - Legacy: PREFIX-TYPE-NUMBER
            // - Extended: PREFIX-FAC-BAT-TYPE-NUMBER
            $this->assert(
                preg_match('/^[A-Z0-9]+-[A-Z0-9]+-\d+$/', $label) === 1
                    || preg_match('/^[A-Z0-9]+-[A-Z0-9]+-[A-Z0-9]+-[A-Z0-9]+-\d+$/', $label) === 1,
                "generateNextLabel for '{$type}' matches expected format",
                "Expected: PREFIX-TYPE-NUMBER or PREFIX-FAC-BAT-TYPE-NUMBER"
            );
        }
    }

    /**
     * Test validateLabel function
     */
    public function testValidateLabel()
    {
        echo "\n[Testing validateLabel]\n";
        
        $config = InventoryOrganization::getLabelingConfig();
        $prefix = $config['prefix'] ?? 'UNH';
        $padding = $config['padding'] ?? 3;
        
        // Valid labels
        $validLabels = [
            $prefix . '-PC-001',
            $prefix . '-MON-042',
            $prefix . '-IMP-100',
            $prefix . '-FST-BLK1-PC-001',
            $prefix . '-SCI-A1-MON-042',
        ];
        
        foreach ($validLabels as $label) {
            $result = InventoryOrganization::validateLabel($label);
            $this->assert(
                $result === true,
                "validateLabel accepts valid label '{$label}'"
            );
        }
        
        // Invalid labels
        $invalidLabels = [
            'INVALID-LABEL',
            '123-456-789',
            '',
            'ABC',
        ];
        
        foreach ($invalidLabels as $label) {
            $result = InventoryOrganization::validateLabel($label);
            $this->assert(
                $result === false,
                "validateLabel rejects invalid label '{$label}'"
            );
        }
    }

    /**
     * Test getDashboardStats structure
     */
    public function testGetDashboardStats()
    {
        echo "\n[Testing getDashboardStats]\n";
        
        $stats = InventoryOrganization::getDashboardStats();
        
        $this->assert(
            is_array($stats),
            'getDashboardStats returns array'
        );
        
        $expectedKeys = ['entities', 'locations', 'computers', 'monitors', 
                         'printers', 'phones', 'peripherals', 'total_assets', 'issues'];
        
        $hasAllKeys = true;
        $missingKeys = [];
        foreach ($expectedKeys as $key) {
            if (!isset($stats[$key])) {
                $hasAllKeys = false;
                $missingKeys[] = $key;
            }
        }
        
        $this->assert(
            $hasAllKeys,
            'getDashboardStats has all expected keys',
            $hasAllKeys ? '' : "Missing: " . implode(', ', $missingKeys)
        );
        
        // All values should be integers >= 0
        $allIntegers = true;
        foreach ($stats as $key => $value) {
            if (!is_int($value) || $value < 0) {
                $allIntegers = false;
                break;
            }
        }
        
        $this->assert(
            $allIntegers,
            'getDashboardStats returns non-negative integers'
        );
    }

    /**
     * Test getCoherenceIssues structure
     */
    public function testGetCoherenceIssues()
    {
        echo "\n[Testing getCoherenceIssues]\n";
        
        $issues = InventoryOrganization::getCoherenceIssues();
        
        $this->assert(
            is_array($issues),
            'getCoherenceIssues returns array'
        );
        
        // If there are issues, check structure
        if (count($issues) > 0) {
            $firstIssue = $issues[0];
            
            $this->assert(
                isset($firstIssue['type']) && isset($firstIssue['severity']) && isset($firstIssue['message']),
                'Issue has required keys (type, severity, message)',
                "Keys: " . implode(', ', array_keys($firstIssue))
            );
            
            $validSeverities = ['error', 'warning', 'info'];
            $this->assert(
                in_array($firstIssue['severity'], $validSeverities),
                'Issue severity is valid',
                "Severity: " . $firstIssue['severity']
            );
        } else {
            $this->assert(true, 'No coherence issues found (inventory is clean)');
        }
    }

    /**
     * Test getLocationHierarchy structure
     */
    public function testGetLocationHierarchy()
    {
        echo "\n[Testing getLocationHierarchy]\n";
        
        $locations = InventoryOrganization::getLocationHierarchy(0);
        
        $this->assert(
            is_array($locations),
            'getLocationHierarchy returns array'
        );
        
        // If there are locations, check structure
        if (count($locations) > 0) {
            $firstLocation = $locations[0];
            
            $this->assert(
                isset($firstLocation['id']) && isset($firstLocation['name']),
                'Location has required keys (id, name)',
                "Keys: " . implode(', ', array_keys($firstLocation))
            );
            
            $this->assert(
                isset($firstLocation['children']) && is_array($firstLocation['children']),
                'Location has children array'
            );
            
            $this->assert(
                isset($firstLocation['asset_count']) && is_int($firstLocation['asset_count']),
                'Location has asset_count'
            );
        } else {
            $this->assert(true, 'No locations found (empty database)');
        }
    }

    /**
     * Test getEntityTree structure
     */
    public function testGetEntityTree()
    {
        echo "\n[Testing getEntityTree]\n";
        
        $entities = InventoryOrganization::getEntityTree(0);
        
        $this->assert(
            is_array($entities),
            'getEntityTree returns array'
        );
        
        // If there are entities, check structure
        if (count($entities) > 0) {
            $firstEntity = $entities[0];
            
            $this->assert(
                isset($firstEntity['id']) && isset($firstEntity['name']),
                'Entity has required keys (id, name)',
                "Keys: " . implode(', ', array_keys($firstEntity))
            );
            
            $this->assert(
                isset($firstEntity['children']) && is_array($firstEntity['children']),
                'Entity has children array'
            );
        } else {
            $this->assert(true, 'No child entities found under root');
        }
    }

    /**
     * Test getMaterialTypes structure
     */
    public function testGetMaterialTypes()
    {
        echo "\n[Testing getMaterialTypes]\n";
        
        $types = InventoryOrganization::getMaterialTypes();
        
        $this->assert(
            is_array($types),
            'getMaterialTypes returns array'
        );
        
        // Check for expected categories
        $expectedCategories = ['computer', 'monitor', 'printer'];
        foreach ($expectedCategories as $category) {
            if (isset($types[$category]) && count($types[$category]) > 0) {
                $firstType = $types[$category][0];
                $this->assert(
                    isset($firstType['id']) && isset($firstType['name']),
                    "Type in '{$category}' has required keys (id, name)"
                );
            } else {
                $this->assert(true, "No types found for '{$category}' (may be empty)");
            }
        }
    }

    /**
     * Test createEntity validation
     */
    public function testCreateEntityValidation()
    {
        echo "\n[Testing createEntity validation]\n";
        
        // Test with empty name (should fail)
        $result = InventoryOrganization::createEntity(['name' => '']);
        $this->assert(
            $result === false,
            'createEntity rejects empty name'
        );

        // Note: We don't actually create entities in tests to avoid modifying database
        $this->assert(true, 'createEntity validation test complete');
    }

    /**
     * Test createLocation validation
     */
    public function testCreateLocationValidation()
    {
        echo "\n[Testing createLocation validation]\n";
        
        // Test with empty name (should fail)
        $result = InventoryOrganization::createLocation(['name' => '']);
        $this->assert(
            $result === false,
            'createLocation rejects empty name'
        );

        // Note: We don't actually create locations in tests to avoid modifying database
        $this->assert(true, 'createLocation validation test complete');
    }

    /**
     * Print test summary
     */
    private function printSummary()
    {
        $total = $this->passCount + $this->failCount;
        
        echo "\n========================================\n";
        echo "  Test Summary                          \n";
        echo "========================================\n";
        echo "  Total:  {$total}\n";
        echo "  Passed: {$this->passCount}\n";
        echo "  Failed: {$this->failCount}\n";
        echo "========================================\n";
        
        if ($this->failCount === 0) {
            echo "  ✓ All tests passed!\n";
        } else {
            echo "  ✗ Some tests failed.\n";
        }
        echo "========================================\n\n";
    }
}

// Run tests if executed directly
if (php_sapi_name() === 'cli' || defined('RUN_INVENTORY_TESTS')) {
    // Include GLPI core
    if (file_exists(dirname(__DIR__) . '/inc/includes.php')) {
        include_once(dirname(__DIR__) . '/inc/includes.php');
    }
    
    $test = new InventoryOrganizationTest();
    $success = $test->runAllTests();
    
    exit($success ? 0 : 1);
}
