<?php

/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * 
 * Unit Tests for FAQ / Knowledge Base Menu Entry (Issue #50)
 * ---------------------------------------------------------------------
 */

namespace Tests\Unit;

/**
 * Unit Test for FAQ Menu Configuration
 * 
 * This test validates that the FAQ menu entry is correctly added
 * to the Assistance menu and that Knowledge Base is removed from Tools.
 */
class FaqMenuTest
{
    private $testsPassed = 0;
    private $testsFailed = 0;
    private $testResults = [];

    /**
     * Test that FAQ entry exists in Assistance menu (generateMenuSession)
     */
    public function testFaqEntryExistsInAssistanceMenu(): bool
    {
        $testName = 'testFaqEntryExistsInAssistanceMenu';
        
        $htmlPath = dirname(__DIR__) . '/src/Html.php';
        $content = file_get_contents($htmlPath);
        
        // Check that FAQ menu entry exists in helpdesk content
        $pattern = "/\\\$menu\['helpdesk'\]\['content'\]\['faq'\]\s*=\s*\[/";
        $hasEntry = preg_match($pattern, $content) === 1;
        
        if ($hasEntry) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'FAQ entry found in Assistance menu'];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => 'FAQ entry NOT found in Assistance menu'];
            return false;
        }
    }

    /**
     * Test that FAQ has correct page URL (/front/knowbaseitem.php)
     */
    public function testFaqHasCorrectUrl(): bool
    {
        $testName = 'testFaqHasCorrectUrl';
        
        $htmlPath = dirname(__DIR__) . '/src/Html.php';
        $content = file_get_contents($htmlPath);
        
        // Check for FAQ title followed by knowbaseitem.php URL
        $hasFaqTitle = strpos($content, "'title'    => __('FAQ')") !== false;
        $hasKbUrl = strpos($content, "'page'     => '/front/knowbaseitem.php'") !== false;
        
        if ($hasFaqTitle && $hasKbUrl) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'FAQ points to /front/knowbaseitem.php'];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => 'FAQ URL incorrect or missing'];
            return false;
        }
    }

    /**
     * Test that KnowbaseItem is removed from Tools menu
     */
    public function testKnowbaseItemRemovedFromToolsMenu(): bool
    {
        $testName = 'testKnowbaseItemRemovedFromToolsMenu';
        
        $htmlPath = dirname(__DIR__) . '/src/Html.php';
        $content = file_get_contents($htmlPath);
        
        // Find the tools menu types array and check if KnowbaseItem is NOT there
        // Pattern: 'tools' => [...'types' => [...'KnowbaseItem'...
        $toolsSection = preg_match("/'tools'\s*=>\s*\[\s*'title'.*?'types'\s*=>\s*\[(.*?)\]/s", $content, $matches);
        
        if ($toolsSection && isset($matches[1])) {
            $hasKnowbaseInTools = strpos($matches[1], 'KnowbaseItem') !== false;
            
            if (!$hasKnowbaseInTools) {
                $this->testsPassed++;
                $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'KnowbaseItem correctly removed from Tools menu'];
                return true;
            }
        }
        
        $this->testsFailed++;
        $this->testResults[$testName] = ['status' => 'FAILED', 'message' => 'KnowbaseItem still present in Tools menu'];
        return false;
    }

    /**
     * Test that knowbaseitem.php uses helpdesk sector
     */
    public function testKnowbaseItemPageUsesHelpdeskSector(): bool
    {
        $testName = 'testKnowbaseItemPageUsesHelpdeskSector';
        
        $kbPath = dirname(__DIR__) . '/front/knowbaseitem.php';
        $content = file_get_contents($kbPath);
        
        // Check that Html::header uses "helpdesk" sector
        $usesHelpdeskSector = strpos($content, '"helpdesk", "faq"') !== false;
        
        if ($usesHelpdeskSector) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'knowbaseitem.php uses helpdesk sector'];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => 'knowbaseitem.php does NOT use helpdesk sector'];
            return false;
        }
    }

    /**
     * Test that knowbaseitem.form.php uses helpdesk sector
     */
    public function testKnowbaseItemFormUsesHelpdeskSector(): bool
    {
        $testName = 'testKnowbaseItemFormUsesHelpdeskSector';
        
        $kbFormPath = dirname(__DIR__) . '/front/knowbaseitem.form.php';
        $content = file_get_contents($kbFormPath);
        
        // Check that menus array uses helpdesk for central interface
        $usesHelpdesk = strpos($content, "'central'  => [\"helpdesk\", \"faq\"]") !== false;
        
        if ($usesHelpdesk) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'knowbaseitem.form.php uses helpdesk sector for central'];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => 'knowbaseitem.form.php does NOT use helpdesk sector'];
            return false;
        }
    }

    /**
     * Test that FAQ has a keyboard shortcut
     */
    public function testFaqHasKeyboardShortcut(): bool
    {
        $testName = 'testFaqHasKeyboardShortcut';
        
        $htmlPath = dirname(__DIR__) . '/src/Html.php';
        $content = file_get_contents($htmlPath);
        
        // Check for shortcut 'b' in FAQ entry
        $hasShortcut = strpos($content, "'shortcut' => 'b'") !== false;
        
        if ($hasShortcut) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'FAQ has keyboard shortcut "b"'];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => 'FAQ keyboard shortcut missing'];
            return false;
        }
    }

    /**
     * Run all unit tests
     */
    public function runAllTests(): array
    {
        echo "===========================================\n";
        echo "  UNIT TESTS - FAQ Menu Configuration\n";
        echo "  Issue #50 - Base de connaissances\n";
        echo "===========================================\n\n";

        $this->testFaqEntryExistsInAssistanceMenu();
        $this->testFaqHasCorrectUrl();
        $this->testKnowbaseItemRemovedFromToolsMenu();
        $this->testKnowbaseItemPageUsesHelpdeskSector();
        $this->testKnowbaseItemFormUsesHelpdeskSector();
        $this->testFaqHasKeyboardShortcut();

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
    $test = new FaqMenuTest();
    $results = $test->runAllTests();
    exit($results['failed'] > 0 ? 1 : 0);
}
