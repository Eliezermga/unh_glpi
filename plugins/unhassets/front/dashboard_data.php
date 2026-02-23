<?php
include('../../../inc/includes.php');
Session::checkRight("plugin_unhassets", READ);

global $DB;
$today = date('Y-m-d');

function safeCount($DB, $table, $where = []) {
    $res = $DB->request([
        'COUNT' => 'cpt',
        'FROM'  => $table,
        'WHERE' => $where
    ])->current();
    return $res['cpt'] ?? 0;
}

// Lecture filtres
$entity   = $_GET['entity'] ?? null;
$category = $_GET['category'] ?? null;
$status   = $_GET['status'] ?? null;

// WHERE dynamique
$where_assets = ['is_deleted' => 0];
if ($entity)   { $where_assets['entities_id'] = $entity; }
if ($category) { $where_assets['asset_category'] = $category; }
if ($status) {
    $status_map = ['active'=>1,'inactive'=>2,'maintenance'=>3,'broken'=>4,'retired'=>5];
    $where_assets['status'] = $status_map[$status] ?? $status;
}

// KPI filtrés
$data = [
    'assets_total'        => safeCount($DB, 'glpi_plugin_unhassets_assets', $where_assets),
    'assets_broken'       => safeCount($DB, 'glpi_plugin_unhassets_assets', array_merge($where_assets,['status'=>4])),
    'reservations_pending'=> safeCount($DB, 'glpi_plugin_unhassets_reservations', ['status'=>1]),
    'licenses_expired'    => $DB->request([
        'COUNT'=>'cpt',
        'FROM'=>'glpi_plugin_unhassets_licenses',
        'WHERE'=>['is_deleted'=>0,'expiration_date<'=>$today]
    ])->current()['cpt'] ?? 0
];

// Graphiques
$categories = ['PC','Imprimante','Projecteur','Serveur','Switch','Autre'];
$assets_by_category = [];
foreach ($categories as $cat) {
    $where_cat = $where_assets;
    if ($category) $where_cat['asset_category'] = $cat;
    $assets_by_category[] = safeCount($DB,'glpi_plugin_unhassets_assets',$where_cat);
}

$assets_by_status = [];
for ($i=1;$i<=5;$i++){
    $where_status = $where_assets;
    $where_status['status'] = $i;
    $assets_by_status[] = safeCount($DB,'glpi_plugin_unhassets_assets',$where_status);
}

$data['categories'] = $categories;
$data['assetsByCategory'] = $assets_by_category;
$data['assetsByStatus'] = $assets_by_status;

header('Content-Type: application/json');
echo json_encode($data);
?>
