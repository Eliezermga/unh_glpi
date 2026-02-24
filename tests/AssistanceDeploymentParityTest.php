<?php

/**
 * ---------------------------------------------------------------------
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * Deployment parity checks for Assistance module and i18n assets
 * ---------------------------------------------------------------------
 */

namespace Tests\Integration;

class AssistanceDeploymentParityTest
{
    private $testsPassed = 0;
    private $testsFailed = 0;
    private $testResults = [];

    private function pass(string $name, string $message): bool
    {
        $this->testsPassed++;
        $this->testResults[$name] = ['status' => 'PASSED', 'message' => $message];
        return true;
    }

    private function fail(string $name, string $message): bool
    {
        $this->testsFailed++;
        $this->testResults[$name] = ['status' => 'FAILED', 'message' => $message];
        return false;
    }

    public function testFaqRoutingPatchPresent(): bool
    {
        $testName = 'testFaqRoutingPatchPresent';
        $htmlPath = dirname(__DIR__) . '/src/Html.php';
        $content = file_get_contents($htmlPath);

        $ok = strpos($content, "'page'     => '/front/knowbaseitem.php'") !== false
           && strpos($content, "'default' => '/front/knowbaseitem.php'") !== false;

        return $ok
            ? $this->pass($testName, 'FAQ routing patch to /front/knowbaseitem.php is present')
            : $this->fail($testName, 'FAQ routing patch is missing in src/Html.php');
    }

    public function testFaqRightsPatchPresent(): bool
    {
        $testName = 'testFaqRightsPatchPresent';
        $sessionPath = dirname(__DIR__) . '/src/Session.php';
        $content = file_get_contents($sessionPath);

        $ok = strpos($content, "haveRightsOr('knowbase', [READ, KnowbaseItem::READFAQ])") !== false;

        return $ok
            ? $this->pass($testName, 'FAQ rights patch (READ or READFAQ) is present')
            : $this->fail($testName, 'FAQ rights patch is missing in src/Session.php');
    }

    public function testFaqTranslationFallbackPresent(): bool
    {
        $testName = 'testFaqTranslationFallbackPresent';
        $translationPath = dirname(__DIR__) . '/src/KnowbaseItemTranslation.php';
        $content = file_get_contents($translationPath);

        $ok = strpos($content, 'getPreferredLanguages') !== false
           && strpos($content, '$gettext_fallback = __($item->fields[$field]);') !== false;

        return $ok
            ? $this->pass($testName, 'FAQ translation fallback code is present')
            : $this->fail($testName, 'FAQ translation fallback code is missing');
    }

    public function testMoFilesAreFreshComparedToPo(): bool
    {
        $testName = 'testMoFilesAreFreshComparedToPo';
        $root = dirname(__DIR__);
        $locales = ['fr_FR', 'fr_CA', 'fr_BE', 'en_US', 'en_GB'];
        $stale = [];

        foreach ($locales as $locale) {
            $po = $root . "/locales/{$locale}.po";
            $mo = $root . "/locales/{$locale}.mo";

            if (!file_exists($po) || !file_exists($mo)) {
                $stale[] = "{$locale} (missing po/mo)";
                continue;
            }

            if (filemtime($mo) < filemtime($po)) {
                $stale[] = "{$locale} (.mo older than .po)";
            }
        }

        if (empty($stale)) {
            return $this->pass($testName, 'All .mo files are up-to-date vs .po files');
        }

        return $this->fail($testName, 'Stale locale assets: ' . implode(', ', $stale));
    }

    public function runAllTests(): array
    {
        echo "========================================================\n";
        echo "  ASSISTANCE DEPLOYMENT PARITY TESTS\n";
        echo "========================================================\n\n";

        $this->testFaqRoutingPatchPresent();
        $this->testFaqRightsPatchPresent();
        $this->testFaqTranslationFallbackPresent();
        $this->testMoFilesAreFreshComparedToPo();

        foreach ($this->testResults as $name => $result) {
            $status = $result['status'] === 'PASSED' ? "\033[32mPASSED\033[0m" : "\033[31mFAILED\033[0m";
            echo "[$status] $name\n";
            echo "         {$result['message']}\n\n";
        }

        echo "--------------------------------------------------------\n";
        echo "Total: " . ($this->testsPassed + $this->testsFailed) . " tests\n";
        echo "Passed: \033[32m{$this->testsPassed}\033[0m\n";
        echo "Failed: \033[31m{$this->testsFailed}\033[0m\n";
        echo "========================================================\n";

        return [
            'passed' => $this->testsPassed,
            'failed' => $this->testsFailed,
            'results' => $this->testResults
        ];
    }
}

if (php_sapi_name() === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    $test = new AssistanceDeploymentParityTest();
    $results = $test->runAllTests();
    exit($results['failed'] > 0 ? 1 : 0);
}
