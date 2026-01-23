<?php

// Script pour mettre à jour le logo GLPI vers UNH

$logo_urls = [
    'https://github.com/Eliezermga/unh_glpi/raw/2a4424b44a5943b3afb7ad8d20eba4cad0acf7c8/pics/logos/logo-UNH-100-black.png',
    'https://github.com/Eliezermga/unh_glpi/raw/2a4424b44a5943b3afb7ad8d20eba4cad0acf7c8/pics/login_logo_glpi.png'
];

$destinations = [
    'c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-100-black.png',
    'c:\xampp\htdocs\unh_glpi\pics\login_logo_glpi.png'
];

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Mise à jour logo</title></head><body>";
echo "<h2>🎨 Mise à jour du logo GLPI vers UNH</h2>";

for ($i = 0; $i < count($logo_urls); $i++) {
    $url = $logo_urls[$i];
    $dest = $destinations[$i];
    
    echo "<p>Téléchargement de " . basename($url) . "...</p>";
    
    $context = stream_context_create([
        'http' => [
            'timeout' => 30,
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        ]
    ]);
    
    $data = file_get_contents($url, false, $context);
    
    if ($data !== false) {
        if (file_put_contents($dest, $data)) {
            echo "<p style='color: green;'>✅ " . basename($dest) . " mis à jour avec succès</p>";
        } else {
            echo "<p style='color: red;'>❌ Erreur lors de l'écriture de " . basename($dest) . "</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Erreur lors du téléchargement de " . basename($url) . "</p>";
    }
}

echo "<hr>";
echo "<p><strong>✅ Mise à jour terminée !</strong></p>";
echo "<p>Le logo UNH remplace maintenant le logo GLPI.</p>";
echo "<p><a href='../../../index.php' style='padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 4px;'>➡️ Voir le résultat</a></p>";
echo "</body></html>";