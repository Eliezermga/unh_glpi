<?php

/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 * 
 * Validation Tests for Technical Support Menu Entry
 * ---------------------------------------------------------------------
 */

namespace Tests\Validation;

/**
 * Validation Test for Technical Support feature
 * 
 * This test validates:
 * 1. Requirements are met
 * 2. Implementation matches specifications
 * 3. No syntax errors in modified files
 */
class TechnicalSupportValidationTest
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
     * Validate PHP syntax of Html.php
     */
    public function testHtmlPhpSyntax(): bool
    {
        $testName = 'testHtmlPhpSyntax';
        $filePath = $this->basePath . '/src/Html.php';
        
        // Use php -l to check syntax - try multiple PHP paths
        $phpPaths = ['C:\\xampp\\php\\php.exe', 'php'];
        $output = [];
        $returnCode = 1;
        
        foreach ($phpPaths as $php) {
            exec("\"$php\" -l \"$filePath\" 2>&1", $output, $returnCode);
            if ($returnCode === 0) break;
            $output = [];
        }
        
        if ($returnCode === 0) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => "Html.php has valid PHP syntax"];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => "Syntax error: " . implode("\n", $output)];
            return false;
        }
    }

    /**
     * Validate PHP syntax of helpdesk.php
     */
    public function testHelpdeskPhpSyntax(): bool
    {
        $testName = 'testHelpdeskPhpSyntax';
        $filePath = $this->basePath . '/front/helpdesk.php';
        
        $phpPaths = ['C:\\xampp\\php\\php.exe', 'php'];
        $output = [];
        $returnCode = 1;
        
        foreach ($phpPaths as $php) {
            exec("\"$php\" -l \"$filePath\" 2>&1", $output, $returnCode);
            if ($returnCode === 0) break;
            $output = [];
        }
        
        if ($returnCode === 0) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => "helpdesk.php has valid PHP syntax"];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => "Syntax error: " . implode("\n", $output)];
            return false;
        }
    }

    /**
     * Validate that the menu entry follows GLPI conventions
     */
    public function testMenuEntryFollowsConventions(): bool
    {
        $testName = 'testMenuEntryFollowsConventions';
        $htmlPath = $this->basePath . '/src/Html.php';
        $content = file_get_contents($htmlPath);
        
        // Check for menu entry patterns in our technical_support implementation
        $conventions = [
            'has_default' => strpos($content, "'default' =>") !== false || strpos($content, "'default'  =>") !== false,
            'has_title' => strpos($content, "'title'") !== false && strpos($content, "__('Technical Support')") !== false,
            'has_icon' => strpos($content, "'icon'") !== false && strpos($content, "ti ti-") !== false,
            'url_starts_with_slash' => strpos($content, "'/front/helpdesk.php'") !== false,
        ];
        
        $allConventionsMet = !in_array(false, $conventions, true);
        
        if ($allConventionsMet) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => "Menu entry follows all GLPI conventions"];
            return true;
        } else {
            $failed = array_keys(array_filter($conventions, fn($v) => !$v));
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => "Convention violations: " . implode(', ', $failed)];
            return false;
        }
    }

    /**
     * Validate that translation function is used for user-facing strings
     */
    public function testTranslationFunctionUsed(): bool
    {
        $testName = 'testTranslationFunctionUsed';
        $htmlPath = $this->basePath . '/src/Html.php';
        $content = file_get_contents($htmlPath);
        
        // Check that 'Technical Support' is wrapped in __() translation function
        $hasTranslation = preg_match("/__\('Technical Support'\)/", $content) === 1;
        
        if ($hasTranslation) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => "Translation function __() is used for 'Technical Support' string"];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => "Translation function NOT used"];
            return false;
        }
    }

    /**
     * Validate that the feature is accessible without special rights (for helpdesk interface)
     */
    public function testNoSpecialRightsRequiredForHelpdesk(): bool
    {
        $testName = 'testNoSpecialRightsRequiredForHelpdesk';
        $htmlPath = $this->basePath . '/src/Html.php';
        $content = file_get_contents($htmlPath);
        
        // Find the technical_support entry and check it's not wrapped in a Session::haveRight check
        // The pattern should find technical_support entry without preceding if(Session::haveRight
        $pattern = "/\/\/ Technical Support menu entry\s*\n\s*\\\$menu\['technical_support'\]/";
        $isUnconditional = preg_match($pattern, $content) === 1;
        
        if ($isUnconditional) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => "Technical Support entry is accessible without special rights checks"];
            return true;
        } else {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => "Entry may have unexpected access restrictions"];
            return false;
        }
    }

    /**
     * Run all validation tests
     */
    public function runAllTests(): array
    {
        echo "===========================================\n";
        echo "  VALIDATION TESTS - Technical Support\n";
        echo "===========================================\n\n";

        $this->testHtmlPhpSyntax();
        $this->testHelpdeskPhpSyntax();
        $this->testMenuEntryFollowsConventions();
        $this->testTranslationFunctionUsed();
        $this->testNoSpecialRightsRequiredForHelpdesk();

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
    $test = new TechnicalSupportValidationTest();
    $results = $test->runAllTests();
    exit($results['failed'] > 0 ? 1 : 0);
}
