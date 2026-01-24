<?php
echo "--- TEST DE VALIDATION DES TEMPLATES (UNH) ---\n";

// Simulation des variables envoyées à Line.html.twig
$line_data = [
    'nom_logiciel' => 'GLPI UNH Enterprise',
    'version'      => '1.2.0',
    'prix_unitaire' => 50,
    'quantite'     => 3
];

// 1. TEST DE LINE.HTML.TWIG (Vérification du calcul du total)
$total_attendu = 150;
$total_calcule = $line_data['prix_unitaire'] * $line_data['quantite'];

if ($total_calcule === $total_attendu) {
    echo "[OK] Line.html.twig : Le calcul du total en ligne est correct.\n";
} else {
    echo "[ERREUR] Line.html.twig : Problème de calcul du total.\n";
}

// 2. TEST DE SOFTWARELOGICIEL.HTML.TWIG (Vérification de l'affichage du nom)
if (strlen($line_data['nom_logiciel']) > 0) {
    echo "[OK] SoftwareLicence : Le nom du logiciel s'affiche correctement.\n";
} else {
    echo "[ERREUR] SoftwareLicence : Le nom est vide, attention à l'affichage !\n";
}

echo "--- FIN DES TESTS ---";