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

// Ajout de styles personnalisés pour améliorer l'apparence
echo "<style>
.dashboard-stats {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin: 20px 0;
}
.stat-card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    flex: 1 1 calc(25% - 20px);
    min-width: 200px;
}
.stat-card h3 {
    margin: 0 0 10px 0;
    font-size: 16px;
    color: #555;
    border-bottom: 1px solid #eee;
    padding-bottom: 5px;
}
.stat-card .stat-value {
    font-size: 28px;
    font-weight: bold;
    margin: 5px 0;
}
.stat-card .stat-value small {
    font-size: 14px;
    font-weight: normal;
    color: #777;
}
.stat-card .stat-detail {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}
.stat-item {
    flex: 1 1 auto;
    background: #f8f9fa;
    border-radius: 20px;
    padding: 5px 10px;
    text-align: center;
    font-size: 14px;
}
.text-green { color: #28a745; }
.text-orange { color: #fd7e14; }
.text-red { color: #dc3545; }
.badge {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
}
.badge-green { background: #d4edda; color: #155724; }
.badge-orange { background: #fff3cd; color: #856404; }
.badge-red { background: #f8d7da; color: #721c24; }
.alert-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.alert-list li {
    padding: 10px;
    border-left: 4px solid;
    margin-bottom: 8px;
    background: #fff;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.export-buttons {
    margin: 20px 0;
    text-align: center;
}
.export-buttons a {
    margin: 0 10px;
}
</style>";

// Récupération des statistiques (identique au code original)
$stats_assets = [];
$categories = ['PC', 'Imprimante', 'Projecteur', 'Serveur', 'Switch', 'Autre'];
foreach ($categories as $cat) {
    $count = $DB->request([
        'COUNT' => 'cpt',
        'FROM'  => 'glpi_plugin_unhassets_assets',
        'WHERE' => [
            'asset_category' => $cat,
            'is_deleted'     => 0
        ]
    ])->current()['cpt'];
    $stats_assets[$cat] = $count;
}

$status_stats = [];
$statuses = ['active', 'inactive', 'maintenance', 'broken', 'retired'];
foreach ($statuses as $status) {
    $count = $DB->request([
        'COUNT' => 'cpt',
        'FROM'  => 'glpi_plugin_unhassets_assets',
        'WHERE' => [
            'status'     => $status,
            'is_deleted' => 0
        ]
    ])->current()['cpt'];
    $status_stats[$status] = $count;
}

$today = date('Y-m-d');
$reservations_pending = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_reservations',
    'WHERE' => ['status' => 'pending']
])->current()['cpt'];

$reservations_today = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_reservations',
    'WHERE' => [
        'reservation_date' => $today,
        'status'          => ['approved', 'pending']
    ]
])->current()['cpt'];

$licenses_total = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_licenses',
    'WHERE' => ['is_deleted' => 0]
])->current()['cpt'];

$licenses_expiring = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_licenses',
    'WHERE' => [
        'is_deleted' => 0,
        'AND' => [
            ['expiration_date' => ['<=', date('Y-m-d', strtotime('+30 days'))]],
            ['expiration_date' => ['>', $today]]
        ]
    ]
])->current()['cpt'];

$licenses_expired = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_licenses',
    'WHERE' => [
        'is_deleted'      => 0,
        'expiration_date' => ['<', $today]
    ]
])->current()['cpt'];

// Début de l'affichage du tableau de bord
echo "<div class='dashboard'>";

// Titre principal
echo "<h2>" . __('Vue d\'ensemble du parc informatique', 'unhassets') . "</h2>";

// Équipements par catégorie
echo "<div class='dashboard-stats'>";
foreach ($stats_assets as $cat => $count) {
    echo "<div class='stat-card'>";
    echo "<h3>" . $cat . "</h3>";
    echo "<div class='stat-value'>" . $count . "</div>";
    echo "</div>";
}
echo "</div>";

// Équipements par statut
echo "<div class='dashboard-stats'>";
echo "<div class='stat-card'>";
echo "<h3>" . __('Statut des équipements', 'unhassets') . "</h3>";
echo "<div class='stat-detail'>";
echo "<div class='stat-item'><span class='text-green'>●</span> " . __('Actif', 'unhassets') . "<br><strong>" . $status_stats['active'] . "</strong></div>";
echo "<div class='stat-item'>" . __('Inactif', 'unhassets') . "<br><strong>" . $status_stats['inactive'] . "</strong></div>";
echo "<div class='stat-item'><span class='text-orange'>●</span> " . __('Maintenance', 'unhassets') . "<br><strong>" . $status_stats['maintenance'] . "</strong></div>";
echo "<div class='stat-item'><span class='text-red'>●</span> " . __('En panne', 'unhassets') . "<br><strong>" . $status_stats['broken'] . "</strong></div>";
echo "<div class='stat-item'>" . __('Retiré', 'unhassets') . "<br><strong>" . $status_stats['retired'] . "</strong></div>";
echo "</div>";
echo "</div>";
echo "</div>";

// Réservations et licences
echo "<div class='dashboard-stats'>";

// Carte Réservations
echo "<div class='stat-card'>";
echo "<h3>" . __('Réservations', 'unhassets') . "</h3>";
echo "<div class='stat-detail'>";
echo "<div class='stat-item'><span class='text-orange'>⏳</span> " . __('En attente', 'unhassets') . "<br><strong>" . $reservations_pending . "</strong></div>";
echo "<div class='stat-item'>📅 " . __('Aujourd\'hui', 'unhassets') . "<br><strong>" . $reservations_today . "</strong></div>";
echo "</div>";
echo "</div>";

// Carte Licences
echo "<div class='stat-card'>";
echo "<h3>" . __('Licences logicielles', 'unhassets') . "</h3>";
echo "<div class='stat-detail'>";
echo "<div class='stat-item'>" . __('Total', 'unhassets') . "<br><strong>" . $licenses_total . "</strong></div>";
echo "<div class='stat-item'><span class='text-orange'>⏳</span> " . __('Expirent bientôt (30j)', 'unhassets') . "<br><strong>" . $licenses_expiring . "</strong></div>";
echo "<div class='stat-item'><span class='text-red'>⚠</span> " . __('Expirées', 'unhassets') . "<br><strong>" . $licenses_expired . "</strong></div>";
echo "</div>";
echo "</div>";

echo "</div>"; // Fin dashboard-stats

// Alertes
if ($status_stats['broken'] > 0 || $licenses_expired > 0 || $licenses_expiring > 0 || $reservations_pending > 0) {
    echo "<div class='stat-card' style='margin-top:20px;'>";
    echo "<h3>" . __('Alertes et actions requises', 'unhassets') . "</h3>";
    echo "<ul class='alert-list'>";
    
    if ($status_stats['broken'] > 0) {
        echo "<li style='border-left-color: #dc3545;'>";
        echo "<span class='badge badge-red'>⚠</span> ";
        echo sprintf(__('%d équipement(s) en panne nécessitent votre attention', 'unhassets'), $status_stats['broken']);
        echo "</li>";
    }
    
    if ($licenses_expired > 0) {
        echo "<li style='border-left-color: #dc3545;'>";
        echo "<span class='badge badge-red'>⚠</span> ";
        echo sprintf(__('%d licence(s) expirée(s) - renouvellement nécessaire', 'unhassets'), $licenses_expired);
        echo "</li>";
    }
    
    if ($licenses_expiring > 0) {
        echo "<li style='border-left-color: #fd7e14;'>";
        echo "<span class='badge badge-orange'>⚠</span> ";
        echo sprintf(__('%d licence(s) expire(nt) dans les 30 prochains jours', 'unhassets'), $licenses_expiring);
        echo "</li>";
    }
    
    if ($reservations_pending > 0) {
        echo "<li style='border-left-color: #fd7e14;'>";
        echo "<span class='badge badge-orange'>⏳</span> ";
        echo sprintf(__('%d réservation(s) en attente d\'approbation', 'unhassets'), $reservations_pending);
        echo "</li>";
    }
    
    echo "</ul>";
    echo "</div>";
}

// Boutons d'export
echo "<div class='export-buttons'>";
echo "<a href='" . Plugin::getWebDir('unhassets') . "/front/export.php?type=pdf' class='vsubmit'>";
echo __('Exporter en PDF', 'unhassets');
echo "</a> ";
echo "<a href='" . Plugin::getWebDir('unhassets') . "/front/export.php?type=excel' class='vsubmit'>";
echo __('Exporter en Excel', 'unhassets');
echo "</a>";
echo "</div>";

echo "</div>"; // Fin dashboard

Html::footer();
?>