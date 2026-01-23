<?php

// Créer les logos UNH directement
function createUNHLogo($width, $height, $filename) {
    $image = imagecreate($width, $height);
    
    // Couleurs UNH
    $bg_color = imagecolorallocate($image, 0, 51, 102); // Bleu UNH
    $text_color = imagecolorallocate($image, 255, 255, 255); // Blanc
    
    // Remplir le fond
    imagefill($image, 0, 0, $bg_color);
    
    // Texte UNH
    $font_size = ($width > 150) ? 20 : 12;
    $text = "UNH";
    
    // Calculer position centré
    $text_width = imagefontwidth(5) * strlen($text);
    $text_height = imagefontheight(5);
    $x = ($width - $text_width) / 2;
    $y = ($height - $text_height) / 2;
    imagestring($image, 5, $x, $y, $text, $text_color);
    
    // Sauvegarder
    $result = imagepng($image, $filename);
    imagedestroy($image);
    return $result;
}

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Logo UNH</title></head><body>";
echo "<h2>🎨 Création des logos UNH</h2>";

$logos = [
    ['c:\xampp\htdocs\unh_glpi\pics\login_logo_glpi.png', 200, 74],
    ['c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-100-black.png', 100, 37],
    ['c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-100-grey.png', 100, 37],
    ['c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-100-white.png', 100, 37],
    ['c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-250-black.png', 250, 92]
];

foreach ($logos as $logo) {
    if (createUNHLogo($logo[1], $logo[2], $logo[0])) {
        echo "<p style='color: green;'>✅ " . basename($logo[0]) . " créé</p>";
    } else {
        echo "<p style='color: red;'>❌ Erreur " . basename($logo[0]) . "</p>";
    }
}

echo "<hr>";
echo "<p><strong>✅ Logos UNH installés !</strong></p>";
echo "<p><a href='../../../index.php' style='padding: 10px 20px; background: #003366; color: white; text-decoration: none; border-radius: 4px;'>➡️ Voir GLPI UNH</a></p>";
echo "</body></html>";