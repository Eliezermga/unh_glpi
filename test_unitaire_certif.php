<?php 
$files = ['templates/pages/management/certificate.html.twig', 'templates/pages/management/contract.html.twig']; 
foreach($files as $f) { echo "Test $f : " . (file_exists($f) ? '[OK]' : '[MANQUANT]') . "\n"; } 
