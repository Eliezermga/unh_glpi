<?php

// Appliquer les changements du commit GitHub
$files = [
    'https://github.com/Eliezermga/unh_glpi/raw/2a4424b44a5943b3afb7ad8d20eba4cad0acf7c8/pics/logos/logo-UNH-100-black.png' => 'c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-100-black.png',
    'https://github.com/Eliezermga/unh_glpi/raw/2a4424b44a5943b3afb7ad8d20eba4cad0acf7c8/pics/login_logo_glpi.png' => 'c:\xampp\htdocs\unh_glpi\pics\login_logo_glpi.png'
];

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Application commit GitHub</title></head><body>";
echo "<h2>🔄 Application du commit GitHub</h2>";

foreach ($files as $url => $dest) {
    echo "<p>Téléchargement de " . basename($url) . "...</p>";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($data !== false && $httpCode == 200 && strlen($data) > 100) {
        if (file_put_contents($dest, $data)) {
            echo "<p style='color: green;'>✅ " . basename($dest) . " mis à jour</p>";
        } else {
            echo "<p style='color: red;'>❌ Erreur écriture " . basename($dest) . "</p>";
        }
    } else {
        echo "<p style='color: orange;'>⚠️ Échec téléchargement " . basename($url) . " (Code: $httpCode)</p>";
    }
}

// Copier vers les autres versions
$logo_files = [
    'c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-100-grey.png',
    'c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-100-white.png',
    'c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-250-black.png',
    'c:\xampp\htdocs\unh_glpi\pics\glpi.png'
];

foreach ($logo_files as $file) {
    if (copy('c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-100-black.png', $file)) {
        echo "<p style='color: green;'>✅ " . basename($file) . " copié</p>";
    }
}

// Vider le cache
$cache_dirs = ['c:\xampp\htdocs\unh_glpi\files\_cache', 'c:\xampp\htdocs\unh_glpi\css_compiled'];
foreach ($cache_dirs as $dir) {
    if (is_dir($dir)) {
        $files = glob($dir . '/*');
        foreach ($files as $file) {
            if (is_file($file)) unlink($file);
        }
        echo "<p style='color: blue;'>🗑️ Cache " . basename($dir) . " vidé</p>";
    }
}

echo "<hr>";
echo "<p><strong>✅ Commit appliqué !</strong></p>";
echo "<p><a href='../../../index.php' style='padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 4px;'>➡️ Voir GLPI UNH</a></p>";
echo "</body></html>";