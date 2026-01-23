<?php

$logos = [
    'https://github.com/Eliezermga/unh_glpi/raw/main/pics/login_logo_glpi.png' => 'c:\xampp\htdocs\unh_glpi\pics\login_logo_glpi.png',
    'https://github.com/Eliezermga/unh_glpi/raw/main/pics/logos/logo-GLPI-100-black.png' => 'c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-100-black.png',
    'https://github.com/Eliezermga/unh_glpi/raw/main/pics/logos/logo-GLPI-100-grey.png' => 'c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-100-grey.png',
    'https://github.com/Eliezermga/unh_glpi/raw/main/pics/logos/logo-GLPI-100-white.png' => 'c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-100-white.png'
];

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Logo UNH</title></head><body>";
echo "<h2>🎨 Installation des logos UNH</h2>";

foreach ($logos as $url => $dest) {
    echo "<p>Téléchargement de " . basename($url) . "...</p>";
    
    $context = stream_context_create([
        'http' => [
            'timeout' => 30,
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            'follow_location' => true
        ]
    ]);
    
    $data = @file_get_contents($url, false, $context);
    
    if ($data !== false && strlen($data) > 100) {
        if (file_put_contents($dest, $data)) {
            echo "<p style='color: green;'>✅ " . basename($dest) . " installé</p>";
        } else {
            echo "<p style='color: red;'>❌ Erreur écriture " . basename($dest) . "</p>";
        }
    } else {
        echo "<p style='color: orange;'>⚠️ Échec téléchargement " . basename($url) . "</p>";
    }
}

echo "<hr>";
echo "<p><a href='../../../index.php' style='padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 4px;'>➡️ Voir le résultat</a></p>";
echo "</body></html>";