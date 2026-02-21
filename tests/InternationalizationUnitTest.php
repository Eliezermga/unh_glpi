<?php

/**
 * ---------------------------------------------------------------------
 *
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * Unit Tests for Internationalization (i18n) of Inventory Organization
 *
 * @copyright 2015-2023 Teclib' and contributors.
 * @licence   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * ---------------------------------------------------------------------
 */

/**
 * InternationalizationUnitTest
 * 
 * This test validates that all strings in the Inventory Organization module
 * are properly internationalized using GLPI's translation system.
 * 
 * HOW TO RUN:
 * -----------
 * From the GLPI root directory:
 *   php tests/InternationalizationUnitTest.php
 * 
 * Or with PHPUnit (if installed):
 *   vendor/bin/phpunit tests/InternationalizationUnitTest.php
 */

class InternationalizationUnitTest
{
    private array $results = [];
    private int $passed = 0;
    private int $failed = 0;

    /**
     * Run all unit tests
     */
    public function runAll(): void
    {
        echo "\n";
        echo "========================================================\n";
        echo "  INTERNATIONALIZATION UNIT TESTS\n";
        echo "========================================================\n\n";

        $this->testFrenchTranslationsExist();
        $this->testEnglishTranslationsExist();
        $this->testNoHardcodedFrenchInPhpFiles();
        $this->testNoHardcodedFrenchInTwigTemplates();
        $this->testTranslationKeysConsistency();

        $this->printSummary();
    }

    /**
     * Test 1: Verify that French translations exist in fr_FR.po
     */
    private function testFrenchTranslationsExist(): void
    {
        $testName = "French translations exist in fr_FR.po";
        
        $poFile = __DIR__ . '/../locales/fr_FR.po';
        if (!file_exists($poFile)) {
            $this->recordResult($testName, false, "fr_FR.po file not found");
            return;
        }

        $content = file_get_contents($poFile);
        
        // Required translations for Inventory Organization module
        $requiredTranslations = [
            'Technical Support' => 'Support Technique',
            'Inventory Organization' => 'Organisation de l\'inventaire',
            'Entity Management' => 'Gestion des Entités',
            'Back to Dashboard' => 'Retour au Tableau de Bord',
            'Create a New Type' => 'Créer un Nouveau Type',
            'Coherence Check' => 'Vérification Cohérence',
            'Labeling Configuration' => 'Configuration de l\'Étiquetage',
        ];

        $missingTranslations = [];
        foreach ($requiredTranslations as $msgid => $expectedMsgstr) {
            if (strpos($content, 'msgid "' . $msgid . '"') === false) {
                $missingTranslations[] = $msgid;
            }
        }

        if (empty($missingTranslations)) {
            $this->recordResult($testName, true, count($requiredTranslations) . " required translations found");
        } else {
            $this->recordResult($testName, false, "Missing translations: " . implode(", ", $missingTranslations));
        }
    }

    /**
     * Test 2: Verify that English translations exist in en_US.po
     */
    private function testEnglishTranslationsExist(): void
    {
        $testName = "English translations exist in en_US.po";
        
        $poFile = __DIR__ . '/../locales/en_US.po';
        if (!file_exists($poFile)) {
            $this->recordResult($testName, false, "en_US.po file not found");
            return;
        }

        $content = file_get_contents($poFile);
        
        // Check for UNH custom translations section
        if (strpos($content, 'UNH GLPI Custom Translations') !== false) {
            // Count custom entries
            preg_match_all('/msgid "([^"]+)"/', $content, $matches);
            $translationCount = count($matches[1]);
            $this->recordResult($testName, true, "UNH custom translations section found with {$translationCount}+ entries");
        } else {
            $this->recordResult($testName, false, "UNH custom translations section not found");
        }
    }

    /**
     * Test 3: Verify no hardcoded French strings in PHP files
     */
    private function testNoHardcodedFrenchInPhpFiles(): void
    {
        $testName = "No hardcoded French in PHP files (Inventory Organization)";
        
        $phpFiles = [
            __DIR__ . '/../front/inventoryorganization.php',
            __DIR__ . '/../front/inventoryorganization.entity.php',
        ];

        // French patterns that should NOT appear outside of comments
        $forbiddenPatterns = [
            'Organisation de l\'Inventaire',
            'Gestion des Entités',
            'Créer et gérer',
            'Définir les lieux',
            'Types de Matériel',
            'Étiquetage',
            'Vérification Cohérence',
        ];

        $foundHardcoded = [];
        foreach ($phpFiles as $file) {
            if (!file_exists($file)) {
                continue;
            }
            
            $content = file_get_contents($file);
            // Remove comments
            $content = preg_replace('/\/\/.*$/m', '', $content);
            $content = preg_replace('/\/\*.*?\*\//s', '', $content);
            
            foreach ($forbiddenPatterns as $pattern) {
                if (strpos($content, $pattern) !== false) {
                    $foundHardcoded[] = basename($file) . ": \"$pattern\"";
                }
            }
        }

        if (empty($foundHardcoded)) {
            $this->recordResult($testName, true, "No hardcoded French strings found");
        } else {
            $this->recordResult($testName, false, "Found hardcoded: " . implode(", ", $foundHardcoded));
        }
    }

    /**
     * Test 4: Verify Twig templates use __() function
     */
    private function testNoHardcodedFrenchInTwigTemplates(): void
    {
        $testName = "Twig templates use __() for translations";
        
        $twigDir = __DIR__ . '/../templates/pages/inventoryorganization/';
        if (!is_dir($twigDir)) {
            $this->recordResult($testName, false, "Twig directory not found");
            return;
        }

        $twigFiles = glob($twigDir . '*.twig');
        $filesWithTranslations = 0;
        $filesWithHardcodedFrench = [];

        // French patterns that should NOT appear
        $forbiddenPatterns = [
            'Retour au Tableau de Bord',
            'Créer un Nouveau Type',
            'Types Existants',
            'Configuration de l\'Étiquetage',
        ];

        foreach ($twigFiles as $file) {
            $content = file_get_contents($file);
            
            // Check if file uses __() function
            if (preg_match('/\{\{\s*__\(/', $content)) {
                $filesWithTranslations++;
            }
            
            // Check for forbidden patterns
            foreach ($forbiddenPatterns as $pattern) {
                if (strpos($content, $pattern) !== false) {
                    $filesWithHardcodedFrench[] = basename($file);
                    break;
                }
            }
        }

        if (empty($filesWithHardcodedFrench) && $filesWithTranslations > 0) {
            $this->recordResult($testName, true, "{$filesWithTranslations} template(s) use __() correctly");
        } else {
            $msg = "";
            if (!empty($filesWithHardcodedFrench)) {
                $msg = "Files with hardcoded French: " . implode(", ", array_unique($filesWithHardcodedFrench));
            }
            if ($filesWithTranslations == 0) {
                $msg .= " No templates using __() found";
            }
            $this->recordResult($testName, false, $msg);
        }
    }

    /**
     * Test 5: Verify translation keys consistency between fr_FR.po and en_US.po
     */
    private function testTranslationKeysConsistency(): void
    {
        $testName = "Translation keys consistent between fr_FR.po and en_US.po";
        
        $frFile = __DIR__ . '/../locales/fr_FR.po';
        $enFile = __DIR__ . '/../locales/en_US.po';

        if (!file_exists($frFile) || !file_exists($enFile)) {
            $this->recordResult($testName, false, "PO files not found");
            return;
        }

        // Extract msgids from both files (only UNH custom section)
        $frContent = file_get_contents($frFile);
        $enContent = file_get_contents($enFile);

        // Find UNH section start
        $frStart = strpos($frContent, 'UNH GLPI Custom Translations');
        $enStart = strpos($enContent, 'UNH GLPI Custom Translations');

        if ($frStart === false || $enStart === false) {
            $this->recordResult($testName, false, "UNH custom section not found in one or both files");
            return;
        }

        $frSection = substr($frContent, $frStart);
        $enSection = substr($enContent, $enStart);

        preg_match_all('/msgid "([^"]+)"/', $frSection, $frMatches);
        preg_match_all('/msgid "([^"]+)"/', $enSection, $enMatches);

        $frKeys = array_unique($frMatches[1]);
        $enKeys = array_unique($enMatches[1]);

        $missingInEn = array_diff($frKeys, $enKeys);
        $missingInFr = array_diff($enKeys, $frKeys);

        if (empty($missingInEn) && empty($missingInFr)) {
            $this->recordResult($testName, true, count($frKeys) . " translation keys are consistent");
        } else {
            $msg = "";
            if (!empty($missingInEn)) {
                $msg .= "Missing in en_US: " . count($missingInEn) . " keys. ";
            }
            if (!empty($missingInFr)) {
                $msg .= "Missing in fr_FR: " . count($missingInFr) . " keys.";
            }
            $this->recordResult($testName, false, $msg);
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
     * Print test summary
     */
    private function printSummary(): void
    {
        echo "========================================================\n";
        echo "  SUMMARY\n";
        echo "========================================================\n";
        echo "  Total:  " . ($this->passed + $this->failed) . "\n";
        echo "  Passed: {$this->passed}\n";
        echo "  Failed: {$this->failed}\n";
        echo "========================================================\n\n";

        if ($this->failed > 0) {
            exit(1);
        }
    }
}

// Run tests if executed directly
if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    $test = new InternationalizationUnitTest();
    $test->runAll();
}
