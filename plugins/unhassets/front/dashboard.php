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
   FONCTION SAFE
============================ */
function safeCount($DB, $table, $where = []) {
    $res = $DB->request([
        'COUNT' => 'cpt',
        'FROM'  => $table,
        'WHERE' => $where
    ])->current();
    return $res['cpt'] ?? 0;
}

/* ============================
   DONNÉES KPI
============================ */
$assets_total  = safeCount($DB, 'glpi_plugin_unhassets_assets', ['is_deleted' => 0]);
$assets_broken = safeCount($DB, 'glpi_plugin_unhassets_assets', ['status' => 'broken', 'is_deleted' => 0]);
$reservations_pending = safeCount($DB, 'glpi_plugin_unhassets_reservations', ['status' => 'pending']);
$licenses_expired = safeCount(
    $DB,
    'glpi_plugin_unhassets_licenses',
    ['is_deleted' => 0, 'expiration_date' => ['<', $today]]
);

/* ============================
   DONNÉES GRAPHIQUES
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

$assets_by_status = [
    safeCount($DB,'glpi_plugin_unhassets_assets',['status'=>'active','is_deleted'=>0]),
    safeCount($DB,'glpi_plugin_unhassets_assets',['status'=>'inactive','is_deleted'=>0]),
    safeCount($DB,'glpi_plugin_unhassets_assets',['status'=>'maintenance','is_deleted'=>0]),
    safeCount($DB,'glpi_plugin_unhassets_assets',['status'=>'broken','is_deleted'=>0]),
    safeCount($DB,'glpi_plugin_unhassets_assets',['status'=>'retired','is_deleted'=>0])
];

/* ============================
   AFFICHAGE HTML
============================ */

echo "<link rel='stylesheet' href='".Plugin::getWebDir('unhassets')."/css/dashboard.css'>";
echo "<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>";

echo "<div class='unh-dashboard'>";

echo "<h1 class='dashboard-title'>Vue d’ensemble du parc informatique</h1>";

echo "<div class='kpi-grid'>
        <div class='kpi-card'>
          <span class='kpi-title'>Équipements</span>
          <span class='kpi-value'>$assets_total</span>
        </div>

        <div class='kpi-card danger'>
          <span class='kpi-title'>Équipements en panne</span>
          <span class='kpi-value'>$assets_broken</span>
        </div>

        <div class='kpi-card warning'>
          <span class='kpi-title'>Réservations en attente</span>
          <span class='kpi-value'>$reservations_pending</span>
        </div>

        <div class='kpi-card info'>
          <span class='kpi-title'>Licences expirées</span>
          <span class='kpi-value'>$licenses_expired</span>
        </div>
      </div>";

echo "<div class='charts-grid'>
        <div class='chart-card'>
          <h3>Équipements par catégorie</h3>
          <canvas id='chartCategory'></canvas>
        </div>

        <div class='chart-card'>
          <h3>Équipements par statut</h3>
          <canvas id='chartStatus'></canvas>
        </div>
      </div>";

echo "<div class='dashboard-actions'>
        <a class='vsubmit' href='".Plugin::getWebDir('unhassets')."/front/export.php?type=pdf'>Exporter PDF</a>
        <a class='vsubmit' href='".Plugin::getWebDir('unhassets')."/front/export.php?type=excel'>Exporter Excel</a>
      </div>";

echo "</div>";

/* ============================
   DONNÉES JS (SAFE)
============================ */
echo "<script>
window.UNH_DASHBOARD_DATA = {
  categories: ".json_encode($categories).",
  assetsByCategory: ".json_encode($assets_by_category).",
  assetsByStatus: ".json_encode($assets_by_status)."
};
</script>";

echo "<script src='".Plugin::getWebDir('unhassets')."/js/dashboard.js'></script>";

Html::footer();
