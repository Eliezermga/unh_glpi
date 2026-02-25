<?php
include('../../../inc/includes.php');
Session::checkRight("plugin_unhassets", READ);

global $DB;
$today = date('Y-m-d');

function safeCount($DB, $table, $where = []) {
    $res = $DB->request([
        'COUNT'=>'cpt',
        'FROM'=>$table,
        'WHERE'=>$where
    ])->current();
    return $res['cpt'] ?? 0;
}

// Récupération filtres
$location   = (int) ($_POST['location'] ?? 0);
$department = (int) ($_POST['department'] ?? 0);
$category   = $_POST['category'] ?? '';

// Conditions pour assets
$whereAssets = ['is_deleted'=>0];
if($location)   $whereAssets['locations_id']=$location;
if($department) $whereAssets['entities_id']=$department;
if($category)   $whereAssets['asset_category']=$category;

// KPI
$kpi = [
    'assets_total'        => safeCount($DB,'glpi_plugin_unhassets_assets',$whereAssets),
    'assets_broken'       => safeCount($DB,'glpi_plugin_unhassets_assets',array_merge($whereAssets,['status'=>4])),
    'reservations_pending'=> safeCount($DB,'glpi_plugin_unhassets_reservations',['status'=>1]),
    'licenses_expired'    => safeCount($DB,'glpi_plugin_unhassets_licenses',['is_deleted'=>0,'expiration_date<'=>$today]),
    'incidents_opened'    => safeCount($DB,'glpi_tickets',['status'=>1]),
    'incidents_resolved'  => safeCount($DB,'glpi_tickets',['status'=>6])
];

// Graphiques
$categories = ['PC','Imprimante','Projecteur','Serveur','Switch','Autre'];
$assetsByCategory = [];
foreach ($categories as $cat) {
    $assetsByCategory[] = safeCount($DB,'glpi_plugin_unhassets_assets',array_merge($whereAssets,['asset_category'=>$cat]));
}

$assetsByStatus = [];
for($i=1;$i<=5;$i++){
    $assetsByStatus[] = safeCount($DB,'glpi_plugin_unhassets_assets',array_merge($whereAssets,['status'=>$i]));
}

echo json_encode([
    'kpi'=>$kpi,
    'chartCategories'=>$categories,
    'assetsByCategory'=>$assetsByCategory,
    'assetsByStatus'=>$assetsByStatus
]);
