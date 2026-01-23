<?php

// Créer un logo UNH simple
$width = 100;
$height = 37;

// Créer une image
$image = imagecreate($width, $height);

// Couleurs
$bg_color = imagecolorallocate($image, 44, 62, 80); // Bleu foncé
$text_color = imagecolorallocate($image, 255, 255, 255); // Blanc

// Remplir le fond
imagefill($image, 0, 0, $bg_color);

// Ajouter le texte UNH
$font_size = 5;
$text = "UNH";
$text_width = imagefontwidth($font_size) * strlen($text);
$text_height = imagefontheight($font_size);
$x = ($width - $text_width) / 2;
$y = ($height - $text_height) / 2;

imagestring($image, $font_size, $x, $y, $text, $text_color);

// Sauvegarder les logos
$logos = [
    'c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-100-black.png',
    'c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-100-grey.png',
    'c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-100-white.png',
    'c:\xampp\htdocs\unh_glpi\pics\logos\logo-GLPI-250-black.png',
    'c:\xampp\htdocs\unh_glpi\pics\login_logo_glpi.png'
];

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Logo UNH</title></head><body>";
echo "<h2>🎨 Création du logo UNH</h2>";

foreach ($logos as $logo_path) {
    if (imagepng($image, $logo_path)) {
        echo "<p style='color: green;'>✅ " . basename($logo_path) . " créé avec succès</p>";
    } else {
        echo "<p style='color: red;'>❌ Erreur pour " . basename($logo_path) . "</p>";
    }
}

// Libérer la mémoire
imagedestroy($image);

echo "<hr>";
echo "<p><strong>✅ Logo UNH appliqué !</strong></p>";
echo "<p><a href='../../../index.php' style='padding: 10px 20px; background: #2c3e50; color: white; text-decoration: none; border-radius: 4px;'>➡️ Voir le résultat</a></p>";
echo "</body></html>";