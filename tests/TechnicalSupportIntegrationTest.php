<?php

/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * 
 * Integration Tests for Technical Support Menu Entry
 * ---------------------------------------------------------------------
 */

namespace Tests\Integration;

/**
 * Integration Test for Technical Support functionality
 * 
 * This test validates that:
 * 1. The menu entry integrates correctly with the GLPI menu system
 * 2. The target page (helpdesk.php) exists and is accessible
 * 3. The template file is present
 */
class TechnicalSupportIntegrationTest
{
    private $testsPassed = 0;
    private $testsFailed = 0;
    private $testResults = [];
    private $basePath;

    public function __construct()
    {
        $this->basePath = dirname(__DIR__);
    }

    /**
     * Test that front/helpdesk.php exists
     */
    public function testHelpdeskPhpExists(): bool
    {
        $testName = 'testHelpdeskPhpExists';
        $filePath = $this->basePath . '/front/helpdesk.php';
        
        if (file_exists($filePath)) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => "File exists: front/helpdesk.php"];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => "File NOT found: front/helpdesk.php"];
            return false;
        }
    }

    /**
     * Test that anonymous_helpdesk.html.twig template exists
     */
    public function testAnonymousHelpdeskTemplateExists(): bool
    {
        $testName = 'testAnonymousHelpdeskTemplateExists';
        $filePath = $this->basePath . '/templates/anonymous_helpdesk.html.twig';
        
        if (file_exists($filePath)) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => "Template exists: templates/anonymous_helpdesk.html.twig"];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => "Template NOT found: templates/anonymous_helpdesk.html.twig"];
            return false;
        }
    }

    /**
     * Test that helpdesk.php renders the anonymous_helpdesk template
     */
    public function testHelpdeskRendersTemplate(): bool
    {
        $testName = 'testHelpdeskRendersTemplate';
        $filePath = $this->basePath . '/front/helpdesk.php';
        $content = file_get_contents($filePath);
        
        $hasTemplateReference = strpos($content, 'anonymous_helpdesk.html.twig') !== false;
        
        if ($hasTemplateReference) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => "helpdesk.php correctly references anonymous_helpdesk.html.twig"];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => "Template reference NOT found in helpdesk.php"];
            return false;
        }
    }

    /**
     * Test that Html.php has both menu entries (helpdesk and central interfaces)
     */
    public function testBothMenuEntriesExist(): bool
    {
        $testName = 'testBothMenuEntriesExist';
        $htmlPath = $this->basePath . '/src/Html.php';
        $content = file_get_contents($htmlPath);
        
        // Check for menu entry in generateHelpMenu (helpdesk interface)
        $hasHelpdeskEntry = preg_match("/\\\$menu\['technical_support'\]/", $content) === 1;
        
        // Check for menu entry in generateMenuSession (central interface)
        $hasCentralEntry = preg_match("/\\\$menu\['helpdesk'\]\['content'\]\['support_technique'\]/", $content) === 1;
        
        if ($hasHelpdeskEntry && $hasCentralEntry) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => "Both menu entries exist (helpdesk & central interfaces)"];
            return true;
        } else {
            $messages = [];
            if (!$hasHelpdeskEntry) $messages[] = "Helpdesk interface entry missing";
            if (!$hasCentralEntry) $messages[] = "Central interface entry missing";
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => implode(', ', $messages)];
            return false;
        }
    }

    /**
     * Test that the template has required form elements
     */
    public function testTemplateHasRequiredElements(): bool
    {
        $testName = 'testTemplateHasRequiredElements';
        $templatePath = $this->basePath . '/templates/anonymous_helpdesk.html.twig';
        $content = file_get_contents($templatePath);
        
        $hasForm = strpos($content, '<form') !== false;
        $hasSubmitButton = strpos($content, 'btn-primary') !== false;
        $hasTitle = strpos($content, 'name="name"') !== false;
        $hasContent = strpos($content, 'name="content"') !== false;
        
        if ($hasForm && $hasSubmitButton && $hasTitle && $hasContent) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => "Template has all required form elements (form, submit, title, content)"];
            return true;
        } else {
            $missing = [];
            if (!$hasForm) $missing[] = 'form';
            if (!$hasSubmitButton) $missing[] = 'submit button';
            if (!$hasTitle) $missing[] = 'title field';
            if (!$hasContent) $missing[] = 'content field';
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => "Missing elements: " . implode(', ', $missing)];
            return false;
        }
    }

    /**
     * Run all integration tests
     */
    public function runAllTests(): array
    {
        echo "===========================================\n";
        echo "  INTEGRATION TESTS - Technical Support\n";
        echo "===========================================\n\n";

        $this->testHelpdeskPhpExists();
        $this->testAnonymousHelpdeskTemplateExists();
        $this->testHelpdeskRendersTemplate();
        $this->testBothMenuEntriesExist();
        $this->testTemplateHasRequiredElements();

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
    $test = new TechnicalSupportIntegrationTest();
    $results = $test->runAllTests();
    exit($results['failed'] > 0 ? 1 : 0);
}
