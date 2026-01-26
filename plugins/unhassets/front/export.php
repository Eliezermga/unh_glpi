<?php

include ('../../../inc/includes.php');

Session::checkRight("plugin_unhassets", READ);

global $DB;

$type = $_GET['type'] ?? 'pdf';

// Récupérer les données
$assets_data = [];
$iterator = $DB->request([
    'FROM'  => 'glpi_plugin_unhassets_assets',
    'WHERE' => ['is_deleted' => 0],
    'ORDER' => ['asset_category', 'name']
]);

foreach ($iterator as $data) {
    $assets_data[] = $data;
}

if ($type == 'excel') {
    // Export Excel (CSV)
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=rapport_parc_' . date('Y-m-d') . '.csv');
    
    $output = fopen('php://output', 'w');
    
    // En-têtes
    fputcsv($output, [
        'Nom',
        'Catégorie',
        'Marque',
        'Modèle',
        'Numéro de série',
        'Bâtiment',
        'Salle',
        'Département',
        'Statut',
        'Date d\'achat'
    ], ';');
    
    // Données
    foreach ($assets_data as $asset) {
        fputcsv($output, [
            $asset['name'],
            $asset['asset_category'],
            $asset['brand'],
            $asset['model'],
            $asset['serial_number'],
            $asset['building'],
            $asset['room'],
            $asset['department'],
            $asset['status'],
            $asset['purchase_date']
        ], ';');
    }
    
    fclose($output);
    exit;
    
} else {
    // Export PDF (simple avec HTML)
    require_once(GLPI_ROOT . '/vendor/autoload.php');
    
    $html = '
    <html>
    <head>
        <meta charset="utf-8">
        <style>
            body { font-family: Arial, sans-serif; font-size: 12px; }
            h1 { color: #333; text-align: center; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th { background-color: #4CAF50; color: white; padding: 8px; text-align: left; }
            td { border: 1px solid #ddd; padding: 6px; }
            tr:nth-child(even) { background-color: #f2f2f2; }
            .header { text-align: center; margin-bottom: 20px; }
            .date { text-align: right; font-size: 10px; color: #666; }
        </style>
    </head>
    <body>
        <div class="header">
            <h1>Rapport du Parc Informatique</h1>
            <div class="date">Généré le ' . date('d/m/Y à H:i') . '</div>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Bâtiment</th>
                    <th>Salle</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>';
    
    foreach ($assets_data as $asset) {
        $html .= '<tr>
            <td>' . htmlspecialchars($asset['name']) . '</td>
            <td>' . htmlspecialchars($asset['asset_category']) . '</td>
            <td>' . htmlspecialchars($asset['building']) . '</td>
            <td>' . htmlspecialchars($asset['room']) . '</td>
            <td>' . htmlspecialchars($asset['status']) . '</td>
        </tr>';
    }
    
    $html .= '
            </tbody>
        </table>
        
        <div style="margin-top: 30px; font-size: 10px; color: #666;">
            <p><strong>Statistiques:</strong></p>
            <ul>
                <li>Nombre total d\'équipements: ' . count($assets_data) . '</li>
                <li>Date du rapport: ' . date('d/m/Y') . '</li>
            </ul>
        </div>
    </body>
    </html>';
    
    // Utilisation simple de DomPDF si disponible, sinon affichage HTML
    if (class_exists('Dompdf\Dompdf')) {
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('rapport_parc_' . date('Y-m-d') . '.pdf');
    } else {
        // Fallback: téléchargement HTML
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename=rapport_parc_' . date('Y-m-d') . '.html');
        echo $html;
    }
    
    exit;
}