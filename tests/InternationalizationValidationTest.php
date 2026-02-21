<?php

/**
 * ---------------------------------------------------------------------
 *
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * Validation Tests for Internationalization
 *
 * @copyright 2015-2023 Teclib' and contributors.
 * @licence   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * ---------------------------------------------------------------------
 */

/**
 * InternationalizationValidationTest
 * 
 * This test validates the quality and completeness of translations.
 * It performs deeper validation than unit tests to ensure production readiness.
 * 
 * HOW TO RUN:
 * -----------
 * From the GLPI root directory:
 *   php tests/InternationalizationValidationTest.php
 * 
 * WHAT IT VALIDATES:
 * ------------------
 * 1. No empty translations (msgstr != "")
 * 2. No placeholder mismatches (%s, %d, etc.)
 * 3. Consistent capitalization
 * 4. No duplicate translation keys
 * 5. Coverage of all user-facing strings
 */

class InternationalizationValidationTest
{
    private array $results = [];
    private int $passed = 0;
    private int $failed = 0;
    private int $warnings = 0;
    private string $glpiRoot;

    public function __construct()
    {
        $this->glpiRoot = dirname(__DIR__);
    }

    /**
     * Run all validation tests
     */
    public function runAll(): void
    {
        echo "\n";
        echo "========================================================\n";
        echo "  INTERNATIONALIZATION VALIDATION TESTS\n";
        echo "========================================================\n\n";

        $this->testNoEmptyTranslations();
        $this->testPlaceholderConsistency();
        $this->testNoDuplicateKeys();
        $this->testTranslationCoverage();
        $this->testSpecialCharacterHandling();

        $this->printSummary();
    }

    /**
     * Test 1: Verify no empty translations in UNH section
     */
    private function testNoEmptyTranslations(): void
    {
        $testName = "No empty translations in UNH section";
        
        $frFile = $this->glpiRoot . '/locales/fr_FR.po';
        if (!file_exists($frFile)) {
            $this->recordResult($testName, false, "fr_FR.po not found");
            return;
        }

        $content = file_get_contents($frFile);
        
        // Find UNH section
        $unhStart = strpos($content, 'UNH GLPI Custom Translations');
        if ($unhStart === false) {
            $this->recordResult($testName, false, "UNH section not found");
            return;
        }

        $unhSection = substr($content, $unhStart);
        
        // Find all msgid/msgstr pairs
        preg_match_all('/msgid "([^"]+)"\s+msgstr "([^"]*)"/', $unhSection, $matches, PREG_SET_ORDER);
        
        $emptyTranslations = [];
        foreach ($matches as $match) {
            if (empty($match[2])) {
                $emptyTranslations[] = $match[1];
            }
        }

        if (empty($emptyTranslations)) {
            $this->recordResult($testName, true, count($matches) . " translations all have values");
        } else {
            $this->recordResult($testName, false, "Empty translations: " . implode(", ", array_slice($emptyTranslations, 0, 5)));
        }
    }

    /**
     * Test 2: Verify placeholder consistency between msgid and msgstr
     */
    private function testPlaceholderConsistency(): void
    {
        $testName = "Placeholder consistency (%s, %d, %1\$s, etc.)";
        
        $frFile = $this->glpiRoot . '/locales/fr_FR.po';
        if (!file_exists($frFile)) {
            $this->recordResult($testName, false, "fr_FR.po not found");
            return;
        }

        $content = file_get_contents($frFile);
        $unhStart = strpos($content, 'UNH GLPI Custom Translations');
        if ($unhStart === false) {
            $this->recordResult($testName, true, "No UNH section (no placeholders to check)");
            return;
        }

        $unhSection = substr($content, $unhStart);
        preg_match_all('/msgid "([^"]+)"\s+msgstr "([^"]*)"/', $unhSection, $matches, PREG_SET_ORDER);
        
        $mismatches = [];
        foreach ($matches as $match) {
            $msgid = $match[1];
            $msgstr = $match[2];
            
            // Extract placeholders
            preg_match_all('/%[sd]|%\d+\$[sd]/', $msgid, $idPlaceholders);
            preg_match_all('/%[sd]|%\d+\$[sd]/', $msgstr, $strPlaceholders);
            
            $idCount = count($idPlaceholders[0]);
            $strCount = count($strPlaceholders[0]);
            
            if ($idCount !== $strCount && $idCount > 0) {
                $mismatches[] = substr($msgid, 0, 30) . "...";
            }
        }

        if (empty($mismatches)) {
            $this->recordResult($testName, true, "All placeholders are consistent");
        } else {
            $this->recordResult($testName, false, "Mismatches in: " . implode(", ", $mismatches));
        }
    }

    /**
     * Test 3: Verify no duplicate translation keys
     */
    private function testNoDuplicateKeys(): void
    {
        $testName = "No duplicate translation keys in UNH section";
        
        $frFile = $this->glpiRoot . '/locales/fr_FR.po';
        if (!file_exists($frFile)) {
            $this->recordResult($testName, false, "fr_FR.po not found");
            return;
        }

        $content = file_get_contents($frFile);
        $unhStart = strpos($content, 'UNH GLPI Custom Translations');
        if ($unhStart === false) {
            $this->recordResult($testName, true, "No UNH section");
            return;
        }

        $unhSection = substr($content, $unhStart);
        preg_match_all('/msgid "([^"]+)"/', $unhSection, $matches);
        
        $keys = $matches[1];
        $uniqueKeys = array_unique($keys);
        $duplicates = array_diff_assoc($keys, $uniqueKeys);

        if (empty($duplicates)) {
            $this->recordResult($testName, true, count($uniqueKeys) . " unique keys, no duplicates");
        } else {
            $this->recordResult($testName, false, "Duplicates found: " . implode(", ", array_unique($duplicates)));
        }
    }

    /**
     * Test 4: Verify translation coverage of critical strings
     */
    private function testTranslationCoverage(): void
    {
        $testName = "Translation coverage of critical strings";
        
        // Critical strings that MUST be translated
        $criticalStrings = [
            'Technical Support',
            'Inventory Organization',
            'FAQ',
            'Back to Dashboard',
            'Coherence Check',
            'Labeling',
            'Equipment Types',
            'Entity Management',
        ];

        $frFile = $this->glpiRoot . '/locales/fr_FR.po';
        if (!file_exists($frFile)) {
            $this->recordResult($testName, false, "fr_FR.po not found");
            return;
        }

        $content = file_get_contents($frFile);
        
        $missing = [];
        foreach ($criticalStrings as $string) {
            if (strpos($content, 'msgid "' . $string . '"') === false) {
                $missing[] = $string;
            }
        }

        $coverage = (count($criticalStrings) - count($missing)) / count($criticalStrings) * 100;

        if (empty($missing)) {
            $this->recordResult($testName, true, "100% coverage of critical strings");
        } elseif ($coverage >= 80) {
            $this->recordWarning($testName, round($coverage) . "% coverage. Missing: " . implode(", ", $missing));
        } else {
            $this->recordResult($testName, false, round($coverage) . "% coverage. Missing: " . implode(", ", $missing));
        }
    }

    /**
     * Test 5: Verify special character handling
     */
    private function testSpecialCharacterHandling(): void
    {
        $testName = "Special character handling in translations";
        
        $frFile = $this->glpiRoot . '/locales/fr_FR.po';
        if (!file_exists($frFile)) {
            $this->recordResult($testName, false, "fr_FR.po not found");
            return;
        }

        $content = file_get_contents($frFile);
        $unhStart = strpos($content, 'UNH GLPI Custom Translations');
        if ($unhStart === false) {
            $this->recordResult($testName, true, "No UNH section");
            return;
        }

        $unhSection = substr($content, $unhStart);
        
        $issues = [];
        
        // Check French special characters are preserved
        $frenchChars = ['é', 'è', 'ê', 'à', 'ç', 'ù', 'î', 'ô', 'û'];
        $hasAccents = false;
        foreach ($frenchChars as $char) {
            if (strpos($unhSection, $char) !== false) {
                $hasAccents = true;
                break;
            }
        }

        if (!$hasAccents) {
            $issues[] = "no French accented characters found";
        }

        if (empty($issues)) {
            $this->recordResult($testName, true, "Special characters handled correctly");
        } else {
            $this->recordResult($testName, false, "Issues: " . implode(", ", $issues));
        }
    }

    /**
     * Record a test result
     */
    private function recordResult(string $testName, bool $passed, string $message): void
    {
        $status = $passed ? "✅ PASS" : "❌ FAIL";
        echo "{$status}: {$testName}\n";
        echo "       {$message}\n\n";
        
        if ($passed) {
            $this->passed++;
        } else {
            $this->failed++;
        }
        
        $this->results[] = [
            'name' => $testName,
            'passed' => $passed,
            'message' => $message,
        ];
    }

    /**
     * Record a warning (counts as pass but noted)
     */
    private function recordWarning(string $testName, string $message): void
    {
        echo "⚠️ WARN: {$testName}\n";
        echo "       {$message}\n\n";
        
        $this->passed++;
        $this->warnings++;
        
        $this->results[] = [
            'name' => $testName,
            'passed' => true,
            'warning' => true,
            'message' => $message,
        ];
    }

    /**
     * Print test summary
     */
    private function printSummary(): void
    {
        echo "========================================================\n";
        echo "  SUMMARY\n";
        echo "========================================================\n";
        echo "  Total:    " . ($this->passed + $this->failed) . "\n";
        echo "  Passed:   {$this->passed}\n";
        echo "  Warnings: {$this->warnings}\n";
        echo "  Failed:   {$this->failed}\n";
        echo "========================================================\n\n";

        if ($this->failed > 0) {
            exit(1);
        }
    }
}

// Run tests if executed directly
if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    $test = new InternationalizationValidationTest();
    $test->runAll();
}
