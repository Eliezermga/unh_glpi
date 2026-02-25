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

    public function testEnglishCatalogContainsFaqQuestions(): bool
    {
        $testName = 'testEnglishCatalogContainsFaqQuestions';
        $filePath = dirname(__DIR__) . '/locales/en_US.po';
        $content = file_get_contents($filePath);

        $required = [
            'msgid "Comment créer un ticket de support ?"',
            'msgid "Comment réinitialiser mon mot de passe ?"',
            'msgid "Comment se connecter au WiFi du campus ?"',
            'msgid "Mon ordinateur ne démarre plus, que faire ?"',
            'msgid "Comment installer un logiciel ?"',
            'msgid "L\'imprimante ne fonctionne pas"',
            'msgid "Comment accéder à mes fichiers à distance ?"',
            'msgid "Mon écran reste noir ou figé"',
            'msgid "Comment suivre l\'état de mon ticket ?"',
            'msgid "Les raccourcis clavier utiles"'
        ];

        foreach ($required as $entry) {
            if (strpos($content, $entry) === false) {
                $this->testsFailed++;
                $this->testResults[$testName] = ['status' => 'FAILED', 'message' => "Missing catalog entry: $entry"];
                return false;
            }
        }

        $this->testsPassed++;
        $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'FAQ French source titles are mapped in en_US catalog'];
        return true;
    }

    public function testEnglishCatalogContainsFaqQuestionsUtf8(): bool
    {
        $testName = 'testEnglishCatalogContainsFaqQuestionsUtf8';
        $filePaths = [
            dirname(__DIR__) . '/locales/en_US.po',
            dirname(__DIR__) . '/locales/en_GB.po',
        ];

        $required = [
            'msgid "Comment créer un ticket de support ?"',
            'msgid "Comment réinitialiser mon mot de passe ?"',
            'msgid "Comment se connecter au WiFi du campus ?"',
            'msgid "Mon ordinateur ne démarre plus, que faire ?"',
            'msgid "Comment installer un logiciel ?"',
            'msgid "L\'imprimante ne fonctionne pas"',
            'msgid "Comment accéder à mes fichiers à distance ?"',
            'msgid "Mon écran reste noir ou figé"',
            'msgid "Comment suivre l\'état de mon ticket ?"',
            'msgid "Les raccourcis clavier utiles"',
        ];

        foreach ($filePaths as $filePath) {
            $content = file_get_contents($filePath);
            foreach ($required as $entry) {
                if (strpos($content, $entry) === false) {
                    $this->testsFailed++;
                    $this->testResults[$testName] = ['status' => 'FAILED', 'message' => "Missing UTF-8 FAQ title in " . basename($filePath) . ": $entry"];
                    return false;
                }
            }
        }

        $this->testsPassed++;
        $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'UTF-8 FAQ titles are mapped in en_US and en_GB catalogs'];
        return true;
    }

    public function testEnglishCatalogContainsFaqAnswerKeys(): bool
    {
        $testName = 'testEnglishCatalogContainsFaqAnswerKeys';
        $filePaths = [
            dirname(__DIR__) . '/locales/en_US.po',
            dirname(__DIR__) . '/locales/en_GB.po',
        ];

        $requiredKeys = [
            'msgid "faq.answer.create_support_ticket"',
            'msgid "faq.answer.reset_password"',
            'msgid "faq.answer.connect_campus_wifi"',
            'msgid "faq.answer.computer_not_booting"',
            'msgid "faq.answer.install_software"',
            'msgid "faq.answer.printer_not_working"',
            'msgid "faq.answer.remote_file_access"',
            'msgid "faq.answer.black_or_frozen_screen"',
            'msgid "faq.answer.track_ticket_status"',
            'msgid "faq.answer.useful_keyboard_shortcuts"',
        ];

        foreach ($filePaths as $filePath) {
            $content = file_get_contents($filePath);
            foreach ($requiredKeys as $entry) {
                if (strpos($content, $entry) === false) {
                    $this->testsFailed++;
                    $this->testResults[$testName] = ['status' => 'FAILED', 'message' => "Missing FAQ answer key in " . basename($filePath) . ": $entry"];
                    return false;
                }
            }
        }

        $sourcePath = dirname(__DIR__) . '/src/KnowbaseItemTranslation.php';
        $source = file_get_contents($sourcePath);
        if (strpos($source, 'getFaqAnswerTranslationKey') === false) {
            $this->testsFailed++;
            $this->testResults[$testName] = ['status' => 'FAILED', 'message' => 'FAQ answer key resolver is missing in KnowbaseItemTranslation'];
            return false;
        }

        $this->testsPassed++;
        $this->testResults[$testName] = ['status' => 'PASSED', 'message' => 'FAQ answer translation keys exist in both English catalogs and resolver is present'];
        return true;
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
        $this->testEnglishCatalogContainsFaqQuestionsUtf8();
        $this->testEnglishCatalogContainsFaqAnswerKeys();

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
