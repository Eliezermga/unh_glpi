<?php

include ('../../../inc/includes.php');

Session::checkRight("plugin_unhassets", READ);

Html::header(
    __('Tableau de bord', 'unhassets'),
    $_SERVER['PHP_SELF'],
    "unhassets",
    "dashboard"
);

global $DB;
$today = date('Y-m-d');

/* ============================
   LOGIQUE & REQUÊTES (Du Code 1)
============================ */

// 1. Statistiques des assets par catégorie
$stats_assets = [];
$categories =['PC', 'Imprimante', 'Projecteur', 'Serveur', 'Switch', 'Autre'];
$assets_total = 0;

foreach ($categories as $cat) {
    $count = $DB->request([
        'COUNT' => 'cpt',
        'FROM'  => 'glpi_plugin_unhassets_assets',
        'WHERE' =>[
            'asset_category' => $cat,
            'is_deleted'     => 0
        ]
    ])->current()['cpt'];
    $stats_assets[$cat] = $count;
    $assets_total += $count;
}

// 2. Statistiques par statut
$status_stats = [];
$statuses =['active', 'inactive', 'maintenance', 'broken', 'retired'];

foreach ($statuses as $status) {
    $count = $DB->request([
        'COUNT' => 'cpt',
        'FROM'  => 'glpi_plugin_unhassets_assets',
        'WHERE' =>[
            'status'     => $status,
            'is_deleted' => 0
        ]
    ])->current()['cpt'];
    $status_stats[$status] = $count;
}

// 3. Statistiques des réservations
$reservations_pending = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_reservations',
    'WHERE' =>['status' => 'pending']
])->current()['cpt'];

$reservations_today = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_reservations',
    'WHERE' =>[
        'reservation_date' => $today,
        'status'          => ['approved', 'pending']
    ]
])->current()['cpt'];

// 4. Statistiques des licences
$licenses_total = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_licenses',
    'WHERE' => ['is_deleted' => 0]
])->current()['cpt'];

$licenses_expiring = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_licenses',
    'WHERE' =>[
        'is_deleted' => 0,
        'AND' => [
            ['expiration_date' =>['<=', date('Y-m-d', strtotime('+30 days'))]],['expiration_date' => ['>', $today]]
        ]
    ]
])->current()['cpt'];

$licenses_expired = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_licenses',
    'WHERE' =>[
        'is_deleted'      => 0,
        'expiration_date' => ['<', $today]
    ]
])->current()['cpt'];


/* ============================
   PRÉPARATION DES DONNÉES KPI
============================ */
$kpi =[
    'assets_total'         => $assets_total,
    'assets_broken'        => $status_stats['broken'],
    'reservations_pending' => $reservations_pending,
    'reservations_today'   => $reservations_today,
    'licenses_expired'     => $licenses_expired,
    'licenses_expiring'    => $licenses_expiring
];


/* ============================
   CSS + Chart.js (Du Code 2)
============================ */
echo "<link rel='stylesheet' href='".Plugin::getWebDir('unhassets')."/css/dashboard.css'>";
echo "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>";


/* ============================
   INTERFACE DASHBOARD (Du Code 2)
============================ */
echo "<div class='unh-dashboard'>";

echo "<h1 class='dashboard-title'>" . __('Vue d\'ensemble du parc informatique', 'unhassets') . "</h1>";

// ----------------------
// FILTRES DYNAMIQUES
// ----------------------
echo "<div class='dashboard-filters'>";

echo "<select id='filter-location'>
        <option value=''>" . __('Tous les bâtiments', 'unhassets') . "</option>";
foreach ($DB->request('glpi_locations') as $loc) {
    echo "<option value='{$loc['id']}'>{$loc['name']}</option>";
}
echo "</select>";

echo "<select id='filter-department'>
        <option value=''>" . __('Tous les départements', 'unhassets') . "</option>";
foreach ($DB->request('glpi_departments') as $dep) {
    echo "<option value='{$dep['id']}'>{$dep['name']}</option>";
}
echo "</select>";

echo "<select id='filter-category'>
        <option value=''>" . __('Tous les types', 'unhassets') . "</option>";
foreach ($categories as $cat) {
    echo "<option value='$cat'>$cat</option>";
}
echo "</select>";

echo "<button id='apply-filters'>" . __('Appliquer', 'unhassets') . "</button>";
echo "</div>";

// ----------------------
// ALERTES ET ACTIONS REQUISES
// (Logique du code 1 adaptée à l'interface moderne)
// ----------------------
if ($status_stats['broken'] > 0 || $licenses_expired > 0 || $licenses_expiring > 0 || $reservations_pending > 0) {
    echo "<div style='margin-bottom: 20px; padding: 15px; background: #fff3cd; border: 1px solid #ffeeba; border-radius: 8px; color: #856404;'>";
    echo "<h3 style='margin-top:0; font-size: 16px;'>" . __('⚠ Alertes et actions requises', 'unhassets') . "</h3>";
    echo "<ul style='margin-bottom:0; padding-left: 20px; list-style-type: disc;'>";
    
    if ($status_stats['broken'] > 0) {
        echo "<li><strong style='color: red;'>" . sprintf(__('%d équipement(s) en panne nécessitent votre attention', 'unhassets'), $status_stats['broken']) . "</strong></li>";
    }
    if ($licenses_expired > 0) {
        echo "<li><strong style='color: red;'>" . sprintf(__('%d licence(s) expirée(s) - renouvellement nécessaire', 'unhassets'), $licenses_expired) . "</strong></li>";
    }
    if ($licenses_expiring > 0) {
        echo "<li><strong style='color: #d39e00;'>" . sprintf(__('%d licence(s) expire(nt) dans les 30 prochains jours', 'unhassets'), $licenses_expiring) . "</strong></li>";
    }
    if ($reservations_pending > 0) {
        echo "<li><strong style='color: #d39e00;'>" . sprintf(__('%d réservation(s) en attente d\'approbation', 'unhassets'), $reservations_pending) . "</strong></li>";
    }
    
    echo "</ul>";
    echo "</div>";
}

// ----------------------
// GRILLE DES KPI (6 blocs)
// ----------------------
echo "<div class='kpi-grid'>";

$titleMap =[
    'assets_total'         => __('Total Équipements', 'unhassets'),
    'assets_broken'        => __('Équipements en panne', 'unhassets'),
    'reservations_pending' => __('Réservations en attente', 'unhassets'),
    'reservations_today'   => __('Réservations (Aujourd\'hui)', 'unhassets'),
    'licenses_expired'     => __('Licences expirées', 'unhassets'),
    'licenses_expiring'    => __('Licences (expirent < 30j)', 'unhassets')
];

foreach ($kpi as $key => $value) {
    $class = '';
    // Gestion des couleurs selon la criticité
    if(in_array($key, ['assets_broken', 'licenses_expired'])) $class='danger';
    if(in_array($key, ['reservations_pending', 'licenses_expiring'])) $class='warning';
    if(in_array($key,['assets_total', 'reservations_today'])) $class='info';

    echo "<a class='kpi-card $class' data-key='$key'>
            <span class='kpi-title'>{$titleMap[$key]}</span>
            <span class='kpi-value'>$value</span>
          </a>";
}
echo "</div>";

// ----------------------
// GRAPHIQUES
// ----------------------
echo "<div class='charts-grid'>
        <div class='chart-card'>
          <h3>" . __('Équipements par catégorie', 'unhassets') . "</h3>
          <canvas id='chartCategory'></canvas>
        </div>

        <div class='chart-card'>
          <h3>" . __('Équipements par statut', 'unhassets') . "</h3>
          <canvas id='chartStatus'></canvas>
        </div>

        <div class='chart-card'>
          <h3>" . __('Statistiques Globales', 'unhassets') . "</h3>
          <canvas id='chartIncidents'></canvas> <!-- Identifiant conservé pour compatibilité avec dashboard.js -->
        </div>
      </div>";

// ----------------------
// BOUTONS D'EXPORTS
// ----------------------
echo "<div class='dashboard-actions'>
        <a class='vsubmit' href='".Plugin::getWebDir('unhassets')."/front/export.php?type=pdf'>" . __('Exporter PDF', 'unhassets') . "</a>
        <a class='vsubmit' href='".Plugin::getWebDir('unhassets')."/front/export.php?type=excel'>" . __('Exporter Excel', 'unhassets') . "</a>
      </div>";

echo "</div>"; // Fin de .unh-dashboard


/* ============================
   DONNÉES POUR JAVASCRIPT
============================ */

// Traduction des statuts pour le graphique JS
$translated_statuses =[
    __('Actif', 'unhassets'),
    __('Inactif', 'unhassets'),
    __('En maintenance', 'unhassets'),
    __('En panne', 'unhassets'),
    __('Retiré', 'unhassets')
];

echo "<script>
window.UNH_DASHBOARD_DATA = {
  kpi: " . json_encode($kpi) . ",
  categories: " . json_encode($categories) . ",
  assetsByCategory: " . json_encode(array_values($stats_assets)) . ",
  statuses: " . json_encode($translated_statuses) . ",
  assetsByStatus: " . json_encode(array_values($status_stats)) . "
};
</script>";

// ----------------------
// INCLUSION DU FICHIER JS
// ----------------------
echo "<script src='".Plugin::getWebDir('unhassets')."/js/dashboard.js'></script>";

Html::footer();
?>