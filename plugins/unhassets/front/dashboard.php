<?php
include('../../../inc/includes.php');
Session::checkRight("plugin_unhassets", READ);

Html::header(
    __('Tableau de bord', 'unhassets'),
    $_SERVER['PHP_SELF'],
    "unhassets",
    "unhassets",
    "dashboard"
);

global $DB;
$today = date('Y-m-d');

/* ============================
   FONCTION SAFE COUNT
============================ */
function safeCount($DB, $table, $where = []) {
    $res = $DB->request([
        'COUNT'=>'cpt',
        'FROM'=>$table,
        'WHERE'=>$where
    ])->current();
    return $res['cpt'] ?? 0;
}

/* ============================
   DONNÉES INITIALES KPI
============================ */
$kpi = [
    'assets_total'        => safeCount($DB,'glpi_plugin_unhassets_assets',['is_deleted'=>0]),
    'assets_broken'       => safeCount($DB,'glpi_plugin_unhassets_assets',['status'=>4,'is_deleted'=>0]),
    'reservations_pending'=> safeCount($DB,'glpi_plugin_unhassets_reservations',['status'=>1]),
    'licenses_expired'    => safeCount($DB,'glpi_plugin_unhassets_licenses',['is_deleted'=>0,'expiration_date<'=>$today]),
    'incidents_opened'    => safeCount($DB,'glpi_tickets',['status'=>1]),
    'incidents_resolved'  => safeCount($DB,'glpi_tickets',['status'=>6])
];

/* ============================
   DONNÉES INITIALES GRAPHIQUES
============================ */
$categories = ['PC','Imprimante','Projecteur','Serveur','Switch','Autre'];
$assets_by_category = [];
foreach ($categories as $cat) {
    $assets_by_category[] = safeCount(
        $DB,
        'glpi_plugin_unhassets_assets',
        ['asset_category' => $cat, 'is_deleted' => 0]
    );
}

$assets_by_status = [];
for($i=1;$i<=5;$i++){
    $assets_by_status[] = safeCount($DB,'glpi_plugin_unhassets_assets',['status'=>$i,'is_deleted'=>0]);
}

/* ============================
   CSS + Chart.js
============================ */
echo "<link rel='stylesheet' href='".Plugin::getWebDir('unhassets')."/css/dashboard.css'>";
echo "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>";

/* ============================
   DASHBOARD HTML
============================ */
echo "<div class='unh-dashboard'>";

echo "<h1 class='dashboard-title'>Vue d’ensemble du parc informatique</h1>";

// ----------------------
// FILTRES DYNAMIQUES
// ----------------------
echo "<div class='dashboard-filters'>";

// Bâtiment
echo "<select id='filter-location'>
        <option value=''>Tous les bâtiments</option>";
$locations = $DB->request('glpi_locations');
foreach ($locations as $loc) {
    echo "<option value='{$loc['id']}'>{$loc['name']}</option>";
}
echo "</select>";

// Département
echo "<select id='filter-department'>
        <option value=''>Tous les départements</option>";
$departments = $DB->request('glpi_departments');
foreach ($departments as $dep) {
    echo "<option value='{$dep['id']}'>{$dep['name']}</option>";
}
echo "</select>";

// Type de matériel
echo "<select id='filter-category'>
        <option value=''>Tous les types</option>";
foreach ($categories as $cat) {
    echo "<option value='$cat'>$cat</option>";
}
echo "</select>";

echo "<button id='apply-filters'>Appliquer</button>";
echo "</div>";

// ----------------------
// KPI
// ----------------------
echo "<div class='kpi-grid'>";
$titleMap = [
    'assets_total'=>'Équipements',
    'assets_broken'=>'Équipements en panne',
    'reservations_pending'=>'Réservations en attente',
    'licenses_expired'=>'Licences expirées',
    'incidents_opened'=>'Incidents ouverts',
    'incidents_resolved'=>'Incidents résolus'
];

foreach ($kpi as $key => $value) {
    $class = '';
    if(in_array($key,['assets_broken','incidents_opened'])) $class='danger';
    if(in_array($key,['reservations_pending'])) $class='warning';
    if(in_array($key,['licenses_expired','incidents_resolved'])) $class='info';

    echo "<a class='kpi-card $class' data-key='$key'>
            <span class='kpi-title'>{$titleMap[$key]}</span>
            <span class='kpi-value'>$value</span>
          </a>";
}
echo "</div>";

// ----------------------
// CHARTS
// ----------------------
echo "<div class='charts-grid'>
        <div class='chart-card'>
          <h3>Équipements par catégorie</h3>
          <canvas id='chartCategory'></canvas>
        </div>

        <div class='chart-card'>
          <h3>Équipements par statut</h3>
          <canvas id='chartStatus'></canvas>
        </div>

        <div class='chart-card'>
          <h3>Suivi des incidents</h3>
          <canvas id='chartIncidents'></canvas>
        </div>
      </div>";

// ----------------------
// EXPORTS
// ----------------------
echo "<div class='dashboard-actions'>
        <a class='vsubmit' href='".Plugin::getWebDir('unhassets')."/front/export.php?type=pdf'>Exporter PDF</a>
        <a class='vsubmit' href='".Plugin::getWebDir('unhassets')."/front/export.php?type=excel'>Exporter Excel</a>
      </div>";

echo "</div>"; // fin unh-dashboard

/* ============================
   DONNÉES JS INIT
============================ */
echo "<script>
window.UNH_DASHBOARD_DATA = {
  kpi: ".json_encode($kpi).",
  categories: ".json_encode($categories).",
  assetsByCategory: ".json_encode($assets_by_category).",
  assetsByStatus: ".json_encode($assets_by_status)."
};
</script>";

// ----------------------
// JS Dashboard AJAX
// ----------------------
echo "<script src='".Plugin::getWebDir('unhassets')."/js/dashboard.js'></script>";

Html::footer();
?>
