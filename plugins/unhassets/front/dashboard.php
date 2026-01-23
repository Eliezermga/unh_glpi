<?php

include ('../../../inc/includes.php');

Session::checkRight("plugin_unhassets", READ);

Html::header(
    __('Tableau de bord', 'unhassets'),
    $_SERVER['PHP_SELF'],
    "unhassets",
    "unhassets",
    "dashboard"
);

global $DB;

echo "<div class='center'>";
echo "<table class='tab_cadre_fixe'>";
echo "<tr><th colspan='4'>" . __('Vue d\'ensemble du parc informatique', 'unhassets') . "</th></tr>";

// Statistiques des assets
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

echo "<tr class='tab_bg_1'>";
echo "<td colspan='4'><strong>" . __('Équipements par catégorie', 'unhassets') . "</strong></td>";
echo "</tr>";

echo "<tr class='tab_bg_2'>";
$i = 0;
foreach ($stats_assets as $cat => $count) {
    if ($i > 0 && $i % 4 == 0) {
        echo "</tr><tr class='tab_bg_2'>";
    }
    echo "<td>" . $cat . ": <strong>" . $count . "</strong></td>";
    $i++;
}
// Compléter la ligne si nécessaire
while ($i % 4 != 0) {
    echo "<td></td>";
    $i++;
}
echo "</tr>";

// Statistiques par statut
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

echo "<tr class='tab_bg_1'>";
echo "<td colspan='4'><strong>" . __('Équipements par statut', 'unhassets') . "</strong></td>";
echo "</tr>";

echo "<tr class='tab_bg_2'>";
echo "<td>" . __('Actif', 'unhassets') . ": <strong style='color: green;'>" . 
     $status_stats['active'] . "</strong></td>";
echo "<td>" . __('Inactif', 'unhassets') . ": <strong>" . 
     $status_stats['inactive'] . "</strong></td>";
echo "<td>" . __('En maintenance', 'unhassets') . ": <strong style='color: orange;'>" . 
     $status_stats['maintenance'] . "</strong></td>";
echo "<td>" . __('En panne', 'unhassets') . ": <strong style='color: red;'>" . 
     $status_stats['broken'] . "</strong></td>";
echo "</tr>";

// Statistiques des réservations
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

echo "<tr class='tab_bg_1'>";
echo "<td colspan='4'><strong>" . __('Réservations', 'unhassets') . "</strong></td>";
echo "</tr>";

echo "<tr class='tab_bg_2'>";
echo "<td>" . __('En attente', 'unhassets') . ": <strong style='color: orange;'>" . 
     $reservations_pending . "</strong></td>";
echo "<td>" . __('Aujourd\'hui', 'unhassets') . ": <strong>" . 
     $reservations_today . "</strong></td>";
echo "<td colspan='2'></td>";
echo "</tr>";

// Statistiques des licences
$licenses_total = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_licenses',
    'WHERE' => ['is_deleted' => 0]
])->current()['cpt'];

$licenses_expiring = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_licenses',
    'WHERE' => [
        'is_deleted'      => 0,
        'expiration_date' => ['<=', date('Y-m-d', strtotime('+30 days'))],
        'expiration_date' => ['>', $today]
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

echo "<tr class='tab_bg_1'>";
echo "<td colspan='4'><strong>" . __('Licences logicielles', 'unhassets') . "</strong></td>";
echo "</tr>";

echo "<tr class='tab_bg_2'>";
echo "<td>" . __('Total', 'unhassets') . ": <strong>" . $licenses_total . "</strong></td>";
echo "<td>" . __('Expirent bientôt (30j)', 'unhassets') . ": <strong style='color: orange;'>" . 
     $licenses_expiring . "</strong></td>";
echo "<td>" . __('Expirées', 'unhassets') . ": <strong style='color: red;'>" . 
     $licenses_expired . "</strong></td>";
echo "<td></td>";
echo "</tr>";

echo "</table>";
echo "</div>";

// Alertes
if ($status_stats['broken'] > 0 || $licenses_expired > 0 || $reservations_pending > 0) {
    echo "<br>";
    echo "<div class='center'>";
    echo "<table class='tab_cadre_fixe'>";
    echo "<tr><th>" . __('Alertes et actions requises', 'unhassets') . "</th></tr>";
    
    if ($status_stats['broken'] > 0) {
        echo "<tr class='tab_bg_2'>";
        echo "<td><span style='color: red;'>⚠</span> " . 
             sprintf(__('%d équipement(s) en panne nécessitent votre attention', 'unhassets'), 
                    $status_stats['broken']) . "</td>";
        echo "</tr>";
    }
    
    if ($licenses_expired > 0) {
        echo "<tr class='tab_bg_2'>";
        echo "<td><span style='color: red;'>⚠</span> " . 
             sprintf(__('%d licence(s) expirée(s) - renouvellement nécessaire', 'unhassets'), 
                    $licenses_expired) . "</td>";
        echo "</tr>";
    }
    
    if ($licenses_expiring > 0) {
        echo "<tr class='tab_bg_2'>";
        echo "<td><span style='color: orange;'>⚠</span> " . 
             sprintf(__('%d licence(s) expire(nt) dans les 30 prochains jours', 'unhassets'), 
                    $licenses_expiring) . "</td>";
        echo "</tr>";
    }
    
    if ($reservations_pending > 0) {
        echo "<tr class='tab_bg_2'>";
        echo "<td><span style='color: orange;'>⚠</span> " . 
             sprintf(__('%d réservation(s) en attente d\'approbation', 'unhassets'), 
                    $reservations_pending) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "</div>";
}

// Boutons d'export
echo "<br>";
echo "<div class='center'>";
echo "<a href='" . Plugin::getWebDir('unhassets') . "/front/export.php?type=pdf' class='vsubmit'>";
echo __('Exporter en PDF', 'unhassets');
echo "</a> ";
echo "<a href='" . Plugin::getWebDir('unhassets') . "/front/export.php?type=excel' class='vsubmit'>";
echo __('Exporter en Excel', 'unhassets');
echo "</a>";
echo "</div>";

Html::footer();