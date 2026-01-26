<?php
/**
 * Script de génération de données de test pour UNH Assets
 * 
 * Ce script génère :
 * - 50 équipements variés (PC, imprimantes, projecteurs, etc.)
 * - 20 réservations (passées, en cours, futures)
 * - 15 licences logicielles (certaines expirées, d'autres proches de l'expiration)
 * 
 * Usage : Placez ce fichier dans plugins/unhassets/scripts/
 * Exécutez via : http://localhost/glpi/plugins/unhassets/scripts/generate_test_data.php
 */

// Charger GLPI
$GLPI_ROOT = dirname(dirname(dirname(dirname(__FILE__))));
define('GLPI_ROOT', $GLPI_ROOT);

include (GLPI_ROOT . "/inc/includes.php");

// Vérifier les droits
Session::checkRight("config", UPDATE);

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'>";
echo "<title>Génération de données de test - UNH Assets</title>";
echo "<style>
body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
.container { max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
h1 { color: #333; border-bottom: 3px solid #4CAF50; padding-bottom: 10px; }
h2 { color: #666; margin-top: 30px; }
.success { color: #4CAF50; background: #e8f5e9; padding: 10px; border-radius: 4px; margin: 10px 0; }
.error { color: #f44336; background: #ffebee; padding: 10px; border-radius: 4px; margin: 10px 0; }
.info { color: #2196F3; background: #e3f2fd; padding: 10px; border-radius: 4px; margin: 10px 0; }
.item { padding: 5px 10px; margin: 3px 0; background: #fafafa; border-left: 3px solid #4CAF50; }
.stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin: 20px 0; }
.stat-box { background: #f5f5f5; padding: 15px; border-radius: 4px; text-align: center; }
.stat-box h3 { margin: 0; color: #4CAF50; font-size: 32px; }
.stat-box p { margin: 5px 0 0 0; color: #666; }
.btn { display: inline-block; padding: 10px 20px; background: #4CAF50; color: white; text-decoration: none; border-radius: 4px; margin: 10px 5px; }
.btn:hover { background: #45a049; }
.btn-danger { background: #f44336; }
.btn-danger:hover { background: #da190b; }
</style></head><body><div class='container'>";

echo "<h1>🧪 Génération de données de test - UNH Assets</h1>";

global $DB;

// Vérifier que le plugin est installé
$plugin_check = $DB->request([
    'FROM' => 'glpi_plugins',
    'WHERE' => ['directory' => 'unhassets', 'state' => 1]
])->current();

if (!$plugin_check) {
    echo "<div class='error'>❌ Le plugin UNH Assets n'est pas installé ou activé !</div>";
    echo "</div></body></html>";
    exit;
}

echo "<div class='info'>✅ Plugin UNH Assets détecté et activé</div>";

// Compteurs
$count_assets = 0;
$count_reservations = 0;
$count_licenses = 0;
$errors = [];

// ========================================
// 1. GÉNÉRATION DES ÉQUIPEMENTS
// ========================================

echo "<h2>📦 Génération des équipements</h2>";

$buildings = ['Bâtiment A', 'Bâtiment B', 'Bâtiment C', 'Bâtiment Sciences', 'Bâtiment Lettres'];
$departments = ['Informatique', 'Mathématiques', 'Physique', 'Chimie', 'Lettres', 'Économie', 'Droit', 'Médecine'];
$statuses = ['active', 'active', 'active', 'inactive', 'maintenance', 'broken'];

// Équipements à créer
$equipment_templates = [
    // PC
    ['category' => 'PC', 'brands' => ['Dell', 'HP', 'Lenovo', 'Asus'], 'models' => ['OptiPlex 7090', 'EliteDesk 800', 'ThinkCentre M90', 'ExpertCenter'], 'count' => 20],
    // Imprimantes
    ['category' => 'Imprimante', 'brands' => ['HP', 'Canon', 'Epson', 'Brother'], 'models' => ['LaserJet Pro', 'PIXMA', 'EcoTank', 'MFC-L2750DW'], 'count' => 10],
    // Projecteurs
    ['category' => 'Projecteur', 'brands' => ['Epson', 'BenQ', 'ViewSonic'], 'models' => ['EB-2250U', 'MW535', 'PA503S'], 'count' => 8],
    // Serveurs
    ['category' => 'Serveur', 'brands' => ['Dell', 'HP'], 'models' => ['PowerEdge R740', 'ProLiant DL380'], 'count' => 5],
    // Switchs
    ['category' => 'Switch', 'brands' => ['Cisco', 'Netgear', 'TP-Link'], 'models' => ['Catalyst 2960', 'GS724T', 'TL-SG3428'], 'count' => 7],
];

$asset = new PluginUnhassetsAsset();

foreach ($equipment_templates as $template) {
    for ($i = 1; $i <= $template['count']; $i++) {
        $brand = $template['brands'][array_rand($template['brands'])];
        $model = $template['models'][array_rand($template['models'])];
        $building = $buildings[array_rand($buildings)];
        $department = $departments[array_rand($departments)];
        $status = $statuses[array_rand($statuses)];
        
        $room_number = rand(100, 599);
        $floor = floor($room_number / 100);
        
        // Date d'achat aléatoire dans les 5 dernières années
        $days_ago = rand(0, 1825);
        $purchase_date = date('Y-m-d', strtotime("-{$days_ago} days"));
        
        $data = [
            'entities_id' => 0,
            'name' => $template['category'] . ' ' . $brand . ' ' . str_pad($i, 3, '0', STR_PAD_LEFT),
            'asset_category' => $template['category'],
            'brand' => $brand,
            'model' => $model,
            'serial_number' => strtoupper(substr($brand, 0, 3)) . rand(100000, 999999),
            'building' => $building,
            'room' => 'Salle ' . $room_number,
            'floor' => 'Étage ' . $floor,
            'department' => $department,
            'status' => $status,
            'purchase_date' => $purchase_date,
            'comment' => 'Équipement de test généré automatiquement',
            'date_creation' => $_SESSION['glpi_currenttime']
        ];
        
        if ($asset->add($data)) {
            $count_assets++;
            echo "<div class='item'>✅ {$data['name']} - {$building} / {$data['room']} - {$department}</div>";
        } else {
            $errors[] = "Erreur lors de la création de " . $data['name'];
        }
    }
}

// ========================================
// 2. GÉNÉRATION DES RÉSERVATIONS
// ========================================

echo "<h2>📅 Génération des réservations</h2>";

// Récupérer les équipements créés
$assets_list = [];
$iterator = $DB->request([
    'SELECT' => ['id', 'name'],
    'FROM' => 'glpi_plugin_unhassets_assets',
    'WHERE' => ['asset_category' => ['Projecteur', 'PC']],
    'LIMIT' => 10
]);

foreach ($iterator as $data) {
    $assets_list[] = $data;
}

// Récupérer un utilisateur (l'admin actuel)
$user_id = Session::getLoginUserID();

$reservation = new PluginUnhassetsReservation();

$reservation_statuses = ['pending', 'approved', 'completed', 'cancelled'];

for ($i = 1; $i <= 20; $i++) {
    if (empty($assets_list)) {
        echo "<div class='error'>⚠️ Aucun équipement disponible pour les réservations</div>";
        break;
    }
    
    $selected_asset = $assets_list[array_rand($assets_list)];
    
    // Dates variées : passé, présent, futur
    $days_offset = rand(-30, 30);
    $reservation_date = date('Y-m-d', strtotime("{$days_offset} days"));
    $start_hour = rand(8, 16);
    $duration = rand(1, 4);
    
    $start_time = date('Y-m-d H:i:s', strtotime("{$reservation_date} {$start_hour}:00:00"));
    $end_time = date('Y-m-d H:i:s', strtotime("{$reservation_date} " . ($start_hour + $duration) . ":00:00"));
    
    // Statut basé sur la date
    if ($days_offset < -7) {
        $status = 'completed';
    } elseif ($days_offset < 0) {
        $status = 'approved';
    } else {
        $status = $reservation_statuses[array_rand($reservation_statuses)];
    }
    
    $purposes = [
        'Présentation de projet',
        'Cours de formation',
        'Réunion départementale',
        'Conférence étudiante',
        'Atelier pratique',
        'Examen',
        'Soutenance de thèse'
    ];
    
    $data = [
        'entities_id' => 0,
        'assets_id' => $selected_asset['id'],
        'users_id' => $user_id,
        'reservation_date' => $reservation_date,
        'start_time' => $start_time,
        'end_time' => $end_time,
        'status' => $status,
        'purpose' => $purposes[array_rand($purposes)],
        'comment' => 'Réservation de test',
        'date_creation' => $_SESSION['glpi_currenttime']
    ];
    
    if ($reservation->add($data)) {
        $count_reservations++;
        $status_icon = $status == 'approved' ? '✅' : ($status == 'pending' ? '⏳' : '📋');
        echo "<div class='item'>{$status_icon} {$selected_asset['name']} - {$reservation_date} de {$start_hour}h à " . ($start_hour + $duration) . "h - {$status}</div>";
    } else {
        $errors[] = "Erreur lors de la création de la réservation #" . $i;
    }
}

// ========================================
// 3. GÉNÉRATION DES LICENCES
// ========================================

echo "<h2>🔑 Génération des licences</h2>";

$license = new PluginUnhassetsLicense();

$software_list = [
    ['name' => 'Microsoft Office 365', 'type' => 'subscription', 'supplier' => 'Microsoft'],
    ['name' => 'Adobe Creative Cloud', 'type' => 'subscription', 'supplier' => 'Adobe'],
    ['name' => 'AutoCAD', 'type' => 'perpetual', 'supplier' => 'Autodesk'],
    ['name' => 'MATLAB', 'type' => 'volume', 'supplier' => 'MathWorks'],
    ['name' => 'Windows Server 2022', 'type' => 'volume', 'supplier' => 'Microsoft'],
    ['name' => 'VMware vSphere', 'type' => 'subscription', 'supplier' => 'VMware'],
    ['name' => 'Antivirus Kaspersky', 'type' => 'subscription', 'supplier' => 'Kaspersky'],
    ['name' => 'SPSS Statistics', 'type' => 'volume', 'supplier' => 'IBM'],
    ['name' => 'Zoom Pro', 'type' => 'subscription', 'supplier' => 'Zoom'],
    ['name' => 'SolidWorks', 'type' => 'perpetual', 'supplier' => 'Dassault Systèmes'],
    ['name' => 'EndNote', 'type' => 'volume', 'supplier' => 'Clarivate'],
    ['name' => 'LabVIEW', 'type' => 'perpetual', 'supplier' => 'National Instruments'],
    ['name' => 'ArcGIS', 'type' => 'subscription', 'supplier' => 'Esri'],
    ['name' => 'Tableau', 'type' => 'subscription', 'supplier' => 'Salesforce'],
    ['name' => 'JetBrains IntelliJ IDEA', 'type' => 'subscription', 'supplier' => 'JetBrains'],
];

foreach ($software_list as $software) {
    // Date d'achat aléatoire
    $purchase_days_ago = rand(180, 1095);
    $purchase_date = date('Y-m-d', strtotime("-{$purchase_days_ago} days"));
    
    // Date d'expiration variée
    if ($software['type'] == 'perpetual') {
        $expiration_date = null; // Pas d'expiration
    } else {
        // Certaines expirées, d'autres bientôt, d'autres OK
        $expiration_days = rand(-60, 365);
        $expiration_date = date('Y-m-d', strtotime("{$expiration_days} days"));
    }
    
    $nb_licenses = rand(5, 100);
    $used_licenses = rand(0, $nb_licenses);
    
    // Déterminer le statut
    if ($expiration_date && strtotime($expiration_date) < time()) {
        $status = 'expired';
    } else {
        $status = 'active';
    }
    
    $data = [
        'entities_id' => 0,
        'name' => 'Licence ' . $software['name'],
        'software_name' => $software['name'],
        'version' => rand(2020, 2025) . '.0',
        'license_key' => strtoupper(bin2hex(random_bytes(8))),
        'license_type' => $software['type'],
        'supplier' => $software['supplier'],
        'purchase_date' => $purchase_date,
        'expiration_date' => $expiration_date,
        'number_licenses' => $nb_licenses,
        'used_licenses' => $used_licenses,
        'department' => $departments[array_rand($departments)],
        'status' => $status,
        'alert_threshold' => 30,
        'comment' => 'Licence de test générée automatiquement',
        'date_creation' => $_SESSION['glpi_currenttime']
    ];
    
    if ($license->add($data)) {
        $count_licenses++;
        $status_icon = $status == 'expired' ? '❌' : '✅';
        $exp_info = $expiration_date ? " (expire le {$expiration_date})" : " (perpétuelle)";
        echo "<div class='item'>{$status_icon} {$software['name']} - {$nb_licenses} licences{$exp_info}</div>";
    } else {
        $errors[] = "Erreur lors de la création de la licence " . $software['name'];
    }
}

// ========================================
// RÉSUMÉ
// ========================================

echo "<h2>📊 Résumé de la génération</h2>";

echo "<div class='stats'>";
echo "<div class='stat-box'><h3>{$count_assets}</h3><p>Équipements créés</p></div>";
echo "<div class='stat-box'><h3>{$count_reservations}</h3><p>Réservations créées</p></div>";
echo "<div class='stat-box'><h3>{$count_licenses}</h3><p>Licences créées</p></div>";
echo "</div>";

if (!empty($errors)) {
    echo "<h3>⚠️ Erreurs rencontrées :</h3>";
    foreach ($errors as $error) {
        echo "<div class='error'>{$error}</div>";
    }
}

echo "<div class='success'><strong>✅ Génération terminée avec succès !</strong></div>";

echo "<h2>🔗 Liens rapides</h2>";
echo "<a href='" . $CFG_GLPI['root_doc'] . "/plugins/unhassets/front/asset.php' class='btn'>📦 Voir les équipements</a>";
echo "<a href='" . $CFG_GLPI['root_doc'] . "/plugins/unhassets/front/reservation.php' class='btn'>📅 Voir les réservations</a>";
echo "<a href='" . $CFG_GLPI['root_doc'] . "/plugins/unhassets/front/license.php' class='btn'>🔑 Voir les licences</a>";
echo "<a href='" . $CFG_GLPI['root_doc'] . "/plugins/unhassets/front/dashboard.php' class='btn'>📊 Tableau de bord</a>";

echo "<br><br>";
echo "<a href='delete_test_data.php' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer toutes les données de test ?\")'>🗑️ Supprimer les données de test</a>";

echo "</div></body></html>";