<?php

include ('../../../inc/includes.php');

// Vérification des droits
Session::checkRight("plugin_unhassets", READ);

// Header GLPI
Html::header(
    __('Tableau de bord - UNH Assets', 'unhassets'),
    $_SERVER['PHP_SELF'],
    "unhassets",
    "dashboard"
);

global $DB;

// --- 1. RÉCUPÉRATION DES DONNÉES (LOGIQUE DU CODE 2) ---

// Statistiques par catégorie
$categories = ['PC', 'Imprimante', 'Projecteur', 'Serveur', 'Switch', 'Autre'];
$stats_assets = [];
foreach ($categories as $cat) {
    $res = $DB->request([
        'COUNT' => 'cpt',
        'FROM'  => 'glpi_plugin_unhassets_assets',
        'WHERE' => ['asset_category' => $cat, 'is_deleted' => 0]
    ])->current();
    $stats_assets[$cat] = $res['cpt'] ?? 0;
}

// Statistiques par statut
$statuses = ['active', 'inactive', 'maintenance', 'broken', 'retired'];
$status_stats = [];
foreach ($statuses as $status) {
    $res = $DB->request([
        'COUNT' => 'cpt',
        'FROM'  => 'glpi_plugin_unhassets_assets',
        'WHERE' => ['status' => $status, 'is_deleted' => 0]
    ])->current();
    $status_stats[$status] = $res['cpt'] ?? 0;
}

// Labels traduits pour les statuts
$status_labels = [
    'active'      => __('Actif', 'unhassets'),
    'inactive'    => __('Inactif', 'unhassets'),
    'maintenance' => __('En maintenance', 'unhassets'),
    'broken'      => __('En panne', 'unhassets'),
    'retired'     => __('Retiré', 'unhassets')
];

// Réservations
$today = date('Y-m-d');
$res_pending = $DB->request(['COUNT' => 'cpt', 'FROM' => 'glpi_plugin_unhassets_reservations', 'WHERE' => ['status' => 'pending']])->current();
$res_today   = $DB->request(['COUNT' => 'cpt', 'FROM' => 'glpi_plugin_unhassets_reservations', 'WHERE' => ['reservation_date' => $today]])->current();

// Licences
$lic_total = $DB->request(['COUNT' => 'cpt', 'FROM' => 'glpi_plugin_unhassets_licenses', 'WHERE' => ['is_deleted' => 0]])->current();
$lic_expired = $DB->request(['COUNT' => 'cpt', 'FROM' => 'glpi_plugin_unhassets_licenses', 'WHERE' => ['is_deleted' => 0, 'expiration_date' => ['<', $today]]])->current();
$lic_warning = $DB->request(['COUNT' => 'cpt', 'FROM' => 'glpi_plugin_unhassets_licenses', 'WHERE' => ['is_deleted' => 0, 'expiration_date' => ['<=', date('Y-m-d', strtotime('+30 days'))], 'expiration_date' => ['>=', $today]]])->current();

// --- 2. STYLE CSS ---
echo "
<style>
    .unh-dashboard { padding: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f7f9; }
    .unh-title { margin-bottom: 25px; color: #333; font-weight: 600; border-left: 5px solid #4a90e2; padding-left: 15px; }
    
    /* Grille de KPI */
    .kpi-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 30px; }
    .kpi-card { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-bottom: 4px solid #ddd; transition: transform 0.2s; }
    .kpi-card:hover { transform: translateY(-5px); }
    .kpi-card.blue { border-color: #4a90e2; }
    .kpi-card.green { border-color: #2ecc71; }
    .kpi-card.orange { border-color: #f39c12; }
    .kpi-card.red { border-color: #e74c3c; }
    .kpi-label { font-size: 14px; color: #7f8c8d; text-transform: uppercase; font-weight: bold; }
    .kpi-value { font-size: 32px; font-weight: bold; color: #2c3e50; margin: 10px 0; }
    
    /* Grille Secondaire (Catégories) */
    .section-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 30px; }
    .dashboard-box { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    .box-title { font-size: 18px; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; font-weight: 600; }
    
    .cat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }
    .cat-item { padding: 15px; background: #f8f9fa; border-radius: 8px; text-align: center; border: 1px solid #eee; }
    .cat-name { display: block; font-size: 13px; color: #7f8c8d; }
    .cat-num { display: block; font-size: 20px; font-weight: bold; color: #2c3e50; }

    /* SECTION GRAPHIQUES (DÉPLACÉE) */
    .charts-section { 
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); 
        gap: 20px; 
        margin-bottom: 30px;
        max-width: 1200px; /* Légèrement élargi pour 3 graphiques */
    }
    .chart-container { background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); height: 320px; }

    /* Alertes */
    .alert-box { margin-top: 20px; padding: 15px; border-radius: 8px; display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
    .alert-danger { background: #fdeaea; color: #c0392b; border-left: 5px solid #e74c3c; }
    .alert-warning { background: #fef5e7; color: #d35400; border-left: 5px solid #f39c12; }

    /* Boutons */
    .actions-bar { text-align: center; margin-top: 30px; padding: 20px; background: #fff; border-radius: 10px; }
    .btn-export { padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; margin: 0 10px; display: inline-block; }
    .btn-pdf { background: #e74c3c; color: #fff !important; }
    .btn-excel { background: #27ae60; color: #fff !important; }
</style>
";

echo "<div class='unh-dashboard'>";

echo "<h2 class='unh-title'>" . __('Vue d\'ensemble du parc informatique', 'unhassets') . "</h2>";

// --- 3. AFFICHAGE DES KPI ---
echo "<div class='kpi-container'>";
    echo "<div class='kpi-card blue'><div class='kpi-label'>".__('Équipements Actifs', 'unhassets')."</div><div class='kpi-value'>{$status_stats['active']}</div></div>";
    $res_color = ($res_pending['cpt'] > 0) ? 'orange' : 'green';
    echo "<div class='kpi-card $res_color'><div class='kpi-label'>".__('Réservations en attente', 'unhassets')."</div><div class='kpi-value'>{$res_pending['cpt']}</div></div>";
    $lic_color = ($lic_expired['cpt'] > 0) ? 'red' : 'green';
    echo "<div class='kpi-card $lic_color'><div class='kpi-label'>".__('Licences expirées', 'unhassets')."</div><div class='kpi-value'>{$lic_expired['cpt']}</div></div>";
    $broken_color = ($status_stats['broken'] > 0) ? 'red' : 'blue';
    echo "<div class='kpi-card $broken_color'><div class='kpi-label'>".__('Matériel en panne', 'unhassets')."</div><div class='kpi-value'>{$status_stats['broken']}</div></div>";
echo "</div>";

// --- 4. SECTION CENTRALE (CATÉGORIES ET RÉSUMÉ) ---
echo "<div class='section-grid'>";
    echo "<div class='dashboard-box'>";
        echo "<div class='box-title'>" . __('Équipements par catégorie', 'unhassets') . "</div>";
        echo "<div class='cat-grid'>";
        foreach ($stats_assets as $cat => $count) {
            echo "<div class='cat-item'><span class='cat-name'>$cat</span><span class='cat-num'>$count</span></div>";
        }
        echo "</div>";
    echo "</div>";

    echo "<div class='dashboard-box'>";
        echo "<div class='box-title'>" . __('État de santé du parc', 'unhassets') . "</div>";
        echo "<ul>
                <li><strong>{$status_stats['maintenance']}</strong> " . __('En maintenance', 'unhassets') . "</li>
                <li><strong>{$status_stats['retired']}</strong> " . __('Réformé / Retiré', 'unhassets') . "</li>
                <li><strong>{$res_today['cpt']}</strong> " . __('Réservations pour aujourd\'hui', 'unhassets') . "</li>
              </ul>";
    echo "</div>";
echo "</div>";

// --- 5. NOUVELLE POSITION DES GRAPHIQUES (AVEC LE 3ème GRAPHIQUE) ---
echo "<div class='charts-section'>";
    // Graph 1 : Catégories
    echo "<div class='chart-container'>
            <div class='box-title'>" . __('Répartition Catégories', 'unhassets') . "</div>
            <canvas id='chartCategories'></canvas>
          </div>";
    // Graph 2 : Statuts
    echo "<div class='chart-container'>
            <div class='box-title'>" . __('État du Matériel', 'unhassets') . "</div>
            <canvas id='chartStatus'></canvas>
          </div>";
    // Graph 3 : Licences (Nouveau)
    echo "<div class='chart-container'>
            <div class='box-title'>" . __('Suivi des Licences', 'unhassets') . "</div>
            <canvas id='chartLicenses'></canvas>
          </div>";
echo "</div>";

// --- 6. ALERTES ET ACTIONS REQUISES ---
if ($status_stats['broken'] > 0 || $lic_expired['cpt'] > 0 || $lic_warning['cpt'] > 0 || $res_pending['cpt'] > 0) {
    echo "<div class='dashboard-box'>";
    echo "<div class='box-title'>" . __('Alertes et actions requises', 'unhassets') . "</div>";
    if ($status_stats['broken'] > 0) {
        echo "<div class='alert-box alert-danger'><span>⚠</span> " . sprintf(__('%d équipement(s) en panne', 'unhassets'), $status_stats['broken']) . "</div>";
    }
    if ($lic_expired['cpt'] > 0) {
        echo "<div class='alert-box alert-danger'><span>⚠</span> " . sprintf(__('%d licence(s) expirée(s)', 'unhassets'), $lic_expired['cpt']) . "</div>";
    }
    if ($lic_warning['cpt'] > 0) {
        echo "<div class='alert-box alert-warning'><span>⏳</span> " . sprintf(__('%d licence(s) expirant bientôt', 'unhassets'), $lic_warning['cpt']) . "</div>";
    }
    if ($res_pending['cpt'] > 0) {
        echo "<div class='alert-box alert-warning'><span>📅</span> " . sprintf(__('%d réservation(s) en attente', 'unhassets'), $res_pending['cpt']) . "</div>";
    }
    echo "</div>";
}

// --- 7. BARRE D'EXPORTATION ---
echo "<div class='actions-bar'>";
    echo "<a href='" . Plugin::getWebDir('unhassets') . "/front/export.php?type=pdf' class='btn-export btn-pdf'>" . __('Exporter en PDF', 'unhassets') . "</a>";
    echo "<a href='" . Plugin::getWebDir('unhassets') . "/front/export.php?type=excel' class='btn-export btn-excel'>" . __('Exporter en Excel', 'unhassets') . "</a>";
echo "</div>";

echo "</div>";

// --- SCRIPTS JAVASCRIPT ---
echo "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>";
echo "<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart Categories
    new Chart(document.getElementById('chartCategories'), {
        type: 'doughnut',
        data: {
            labels: " . json_encode(array_keys($stats_assets)) . ",
            datasets: [{
                data: " . json_encode(array_values($stats_assets)) . ",
                backgroundColor: ['#4a90e2', '#2ecc71', '#3498db', '#f39c12', '#e74c3c', '#95a5a6']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Chart Status
    new Chart(document.getElementById('chartStatus'), {
        type: 'pie',
        data: {
            labels: " . json_encode(array_values($status_labels)) . ",
            datasets: [{
                data: " . json_encode(array_values($status_stats)) . ",
                backgroundColor: ['#2ecc71', '#bdc3c7', '#f39c12', '#e74c3c', '#34495e']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Chart Licences (Bar Chart)
    new Chart(document.getElementById('chartLicenses'), {
        type: 'bar',
        data: {
            labels: ['" . __('Total', 'unhassets') . "', '" . __('Expirées', 'unhassets') . "', '" . __('Alerte', 'unhassets') . "'],
            datasets: [{
                label: '" . __('Nombre', 'unhassets') . "',
                data: [{$lic_total['cpt']}, {$lic_expired['cpt']}, {$lic_warning['cpt']}],
                backgroundColor: ['#4a90e2', '#e74c3c', '#f39c12']
            }]
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });
});
</script>";

Html::footer();