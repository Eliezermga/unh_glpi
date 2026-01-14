<?php

/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * 
 * Unit Tests for Technical Support Menu Entry
 * ---------------------------------------------------------------------
 */

namespace Tests\Unit;

/**
 * Unit Test for Html::generateHelpMenu() - Technical Support Entry
 * 
 * This test validates that the Technical Support menu entry is correctly
 * added to the helpdesk interface menu.
 */
class HtmlMenuTest
{
    private $testsPassed = 0;
    private $testsFailed = 0;
    private $testResults = [];

    /**
     * Test that generateHelpMenu includes technical_support entry
     */
    public function testGenerateHelpMenuIncludesTechnicalSupport(): bool
    {
        $testName = 'testGenerateHelpMenuIncludesTechnicalSupport';
        
        // Load Html.php and check for the technical_support entry pattern
        $htmlPath = dirname(__DIR__) . '/src/Html.php';
        $content = file_get_contents($htmlPath);
        
        // Check that the technical_support menu entry exists in generateHelpMenu
        $pattern = "/\\\$menu\['technical_support'\]\s*=\s*\[/";
        $hasEntry = preg_match($pattern, $content) === 1;
        
        if ($hasEntry) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'technical_support entry found in generateHelpMenu()'];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => 'technical_support entry NOT found in generateHelpMenu()'];
            return false;
        }
    }

    /**
     * Test that technical_support menu has correct default URL
     */
    public function testTechnicalSupportHasCorrectUrl(): bool
    {
        $testName = 'testTechnicalSupportHasCorrectUrl';
        
        $htmlPath = dirname(__DIR__) . '/src/Html.php';
        $content = file_get_contents($htmlPath);
        
        // Check for the correct URL pattern
        $pattern = "/'default'\s*=>\s*'\/front\/helpdesk\.php'/";
        $hasCorrectUrl = preg_match($pattern, $content) === 1;
        
        if ($hasCorrectUrl) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'Correct URL /front/helpdesk.php found'];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => 'Correct URL NOT found'];
            return false;
        }
    }

    /**
     * Test that technical_support menu has a title
     */
    public function testTechnicalSupportHasTitle(): bool
    {
        $testName = 'testTechnicalSupportHasTitle';
        
        $htmlPath = dirname(__DIR__) . '/src/Html.php';
        $content = file_get_contents($htmlPath);
        
        // Check for title pattern with __() translation function
        $pattern = "/'title'\s*=>\s*__\('Technical Support'\)/";
        $hasTitle = preg_match($pattern, $content) === 1;
        
        if ($hasTitle) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'Title "Technical Support" with translation found'];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => 'Title NOT found'];
            return false;
        }
    }

    /**
     * Test that technical_support menu has an icon
     */
    public function testTechnicalSupportHasIcon(): bool
    {
        $testName = 'testTechnicalSupportHasIcon';
        
        $htmlPath = dirname(__DIR__) . '/src/Html.php';
        $content = file_get_contents($htmlPath);
        
        // Check for icon pattern
        $pattern = "/'icon'\s*=>\s*'ti ti-/";
        $hasIcon = preg_match($pattern, $content) === 1;
        
        if ($hasIcon) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'Icon with Tabler Icons prefix found'];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => 'Icon NOT found'];
            return false;
        }
    }

    /**
     * Run all unit tests
     */
    public function runAllTests(): array
    {
        echo "===========================================\n";
        echo "  UNIT TESTS - Technical Support Menu\n";
        echo "===========================================\n\n";

        $this->testGenerateHelpMenuIncludesTechnicalSupport();
        $this->testTechnicalSupportHasCorrectUrl();
        $this->testTechnicalSupportHasTitle();
        $this->testTechnicalSupportHasIcon();

        foreach ($this->testResults as $name => $result) {
            $status = $result['status'] === 'PASSED' ? "\033[32mPASSED\033[0m" : "\033[31mFAILED\033[0m";
            echo "[$status] $name\n";
            echo "         {$result['message']}\n\n";
        }

        echo "-------------------------------------------\n";
        echo "Total: " . ($this->testsPassed + $this->testsFailed) . " tests\n";
        echo "Passed: \033[32m{$this->testsPassed}\033[0m\n";
        echo "Failed: \033[31m{$this->testsFailed}\033[0m\n";
        echo "===========================================\n";

        return [
            'passed' => $this->testsPassed,
            'failed' => $this->testsFailed,
            'results' => $this->testResults
        ];
    }
}

// Run tests if executed directly
if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    $test = new HtmlMenuTest();
    $results = $test->runAllTests();
    exit($results['failed'] > 0 ? 1 : 0);
}
