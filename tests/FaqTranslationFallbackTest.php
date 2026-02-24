<?php

/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * Unit Tests for FAQ translation fallback behavior
 * ---------------------------------------------------------------------
 */

namespace Tests\Unit;

class FaqTranslationFallbackTest
{
    private $testsPassed = 0;
    private $testsFailed = 0;
    private $testResults = [];

    private function assertContains(string $testName, string $haystack, string $needle, string $okMessage, string $failMessage): bool
    {
        if (strpos($haystack, $needle) !== false) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => $okMessage];
            return true;
        }

        $this->testsFailed++;
        $this->testResults[$testName] = ['status' => 'FAILED', 'message' => $failMessage];
        return false;
    }

    public function testPreferredLanguageFallbackExists(): bool
    {
        $testName = 'testPreferredLanguageFallbackExists';
        $filePath = dirname(__DIR__) . '/src/KnowbaseItemTranslation.php';
        $content = file_get_contents($filePath);

        return $this->assertContains(
            $testName,
            $content,
            'private static function getPreferredLanguages',
            'Fallback language resolver found in KnowbaseItemTranslation',
            'Fallback language resolver missing in KnowbaseItemTranslation'
        );
    }

    public function testEnglishFallbackLocalesIncluded(): bool
    {
        $testName = 'testEnglishFallbackLocalesIncluded';
        $filePath = dirname(__DIR__) . '/src/KnowbaseItemTranslation.php';
        $content = file_get_contents($filePath);

        $hasEnUs = strpos($content, "'en_US'") !== false;
        $hasEnGb = strpos($content, "'en_GB'") !== false;

        if ($hasEnUs && $hasEnGb) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'en_US and en_GB fallback locales found'];
            return true;
        }

        $this->testsFailed++;
        $this->testResults[$testName] = ['status' => 'FAILED', 'message' => 'English locale fallback list is incomplete'];
        return false;
    }

    public function testFaqListFallbackCallsTranslationGetter(): bool
    {
        $testName = 'testFaqListFallbackCallsTranslationGetter';
        $filePath = dirname(__DIR__) . '/src/KnowbaseItem.php';
        $content = file_get_contents($filePath);

        $nameFallback = strpos($content, "KnowbaseItemTranslation::getTranslatedValue(\$item, 'name')") !== false;
        $answerFallback = strpos($content, "KnowbaseItemTranslation::getTranslatedValue(\$item, 'answer')") !== false;

        if ($nameFallback && $answerFallback) {
            $this->testsPassed++;
            $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'FAQ list fallback uses translation getter for name and answer'];
            return true;
        }

        $this->testsFailed++;
        $this->testResults[$testName] = ['status' => 'FAILED', 'message' => 'FAQ list fallback does not call translation getter for both fields'];
        return false;
    }

    public function testGettextFallbackIsPresent(): bool
    {
        $testName = 'testGettextFallbackIsPresent';
        $filePath = dirname(__DIR__) . '/src/KnowbaseItemTranslation.php';
        $content = file_get_contents($filePath);

        return $this->assertContains(
            $testName,
            $content,
            '$gettext_fallback = __($item->fields[$field]);',
            'Gettext fallback found for FAQ translation values',
            'Gettext fallback missing for FAQ translation values'
        );
    }

    public function runAllTests(): array
    {
        echo "===========================================\n";
        echo "  UNIT TESTS - FAQ Translation Fallback\n";
        echo "===========================================\n\n";

        $this->testPreferredLanguageFallbackExists();
        $this->testEnglishFallbackLocalesIncluded();
        $this->testFaqListFallbackCallsTranslationGetter();
        $this->testGettextFallbackIsPresent();

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

if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    $test = new FaqTranslationFallbackTest();
    $results = $test->runAllTests();
    exit($results['failed'] > 0 ? 1 : 0);
}
