<?php
$localesPath = __DIR__ . '/locales/';
$files = glob($localesPath . '*.po');

foreach ($files as $poFile) {
    $moFile = str_replace('.po', '.mo', $poFile);
    $output = shell_exec("msgfmt " . escapeshellarg($poFile) . " -o " . escapeshellarg($moFile));
    echo "Compilé : " . basename($poFile) . " → " . basename($moFile) . "<br>";
}

echo "Terminé !";
