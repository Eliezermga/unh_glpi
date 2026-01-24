<?php
/**
 * Script de suppression des données de test pour UNH Assets
 * 
 * Usage : http://localhost/glpi/plugins/unhassets/scripts/delete_test_data.php
 */

// Charger GLPI
$GLPI_ROOT = dirname(dirname(dirname(dirname(__FILE__))));
define('GLPI_ROOT', $GLPI_ROOT);

include (GLPI_ROOT . "/inc/includes.php");

// Vérifier les droits
Session::checkRight("config", UPDATE);

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'>";
echo "<title>Suppression des données de test - UNH Assets</title>";
echo "<style>
body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
.container { max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
h1 { color: #333; border-bottom: 3px solid #f44336; padding-bottom: 10px; }
h2 { color: #666; margin-top: 30px; }
.success { color: #4CAF50; background: #e8f5e9; padding: 10px; border-radius: 4px; margin: 10px 0; }
.error { color: #f44336; background: #ffebee; padding: 10px; border-radius: 4px; margin: 10px 0; }
.warning { color: #ff9800; background: #fff3e0; padding: 15px; border-radius: 4px; margin: 10px 0; border-left: 4px solid #ff9800; }
.item { padding: 5px 10px; margin: 3px 0; background: #fafafa; border-left: 3px solid #f44336; }
.stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin: 20px 0; }
.stat-box { background: #f5f5f5; padding: 15px; border-radius: 4px; text-align: center; }
.stat-box h3 { margin: 0; color: #f44336; font-size: 32px; }
.stat-box p { margin: 5px 0 0 0; color: #666; }
.btn { display: inline-block; padding: 10px 20px; background: #4CAF50; color: white; text-decoration: none; border-radius: 4px; margin: 10px 5px; }
.btn:hover { background: #45a049; }
</style></head><body><div class='container'>";

echo "<h1>🗑️ Suppression des données de test - UNH Assets</h1>";

global $DB;

if (!isset($_GET['confirm']) || $_GET['confirm'] != 'yes') {
    echo "<div class='warning'>";
    echo "<h2>⚠️ ATTENTION</h2>";
    echo "<p><strong>Cette action va supprimer TOUTES les données de test du plugin UNH Assets :</strong></p>";
    echo "<ul>";
    echo "<li>Tous les équipements avec le commentaire 'généré automatiquement'</li>";
    echo "<li>Toutes les réservations de test</li>";
    echo "<li>Toutes les licences de test</li>";
    echo "</ul>";
    echo "<p><strong style='color: #f44336;'>Cette action est IRRÉVERSIBLE !</strong></p>";
    echo "</div>";
    
    // Compter les éléments à supprimer
    $count_assets = $DB->request([
        'COUNT' => 'cpt',
        'FROM' => 'glpi_plugin_unhassets_assets',
        'WHERE' => ['comment' => ['LIKE', '%généré automatiquement%']]
    ])->current()['cpt'];
    
    $count_reservations = $DB->request([
        'COUNT' => 'cpt',
        'FROM' => 'glpi_plugin_unhassets_reservations',
        'WHERE' => ['comment' => 'Réservation de test']
    ])->current()['cpt'];
    
    $count_licenses = $DB->request([
        'COUNT' => 'cpt',
        'FROM' => 'glpi_plugin_unhassets_licenses',
        'WHERE' => ['comment' => ['LIKE', '%généré automatiquement%']]
    ])->current()['cpt'];
    
    echo "<div class='stats'>";
    echo "<div class='stat-box'><h3>{$count_assets}</h3><p>Équipements</p></div>";
    echo "<div class='stat-box'><h3>{$count_reservations}</h3><p>Réservations</p></div>";
    echo "<div class='stat-box'><h3>{$count_licenses}</h3><p>Licences</p></div>";
    echo "</div>";
    
    echo "<h2>Confirmer la suppression</h2>";
    echo "<a href='?confirm=yes' class='btn' style='background: #f44336;' onclick='return confirm(\"Êtes-vous VRAIMENT sûr ?\")'>🗑️ OUI, supprimer toutes les données de test</a> ";
    echo "<a href='generate_test_data.php' class='btn'>❌ Non, annuler</a>";
    
} else {
    // Suppression confirmée
    echo "<h2>🗑️ Suppression en cours...</h2>";
    
    $deleted_assets = 0;
    $deleted_reservations = 0;
    $deleted_licenses = 0;
    
    // Supprimer les équipements
    $assets = $DB->request([
        'FROM' => 'glpi_plugin_unhassets_assets',
        'WHERE' => ['comment' => ['LIKE', '%généré automatiquement%']]
    ]);
    
    foreach ($assets as $asset) {
        if ($DB->delete('glpi_plugin_unhassets_assets', ['id' => $asset['id']])) {
            $deleted_assets++;
            echo "<div class='item'>✅ Équipement supprimé : {$asset['name']}</div>";
        }
    }
    
    // Supprimer les réservations
    $reservations = $DB->request([
        'FROM' => 'glpi_plugin_unhassets_reservations',
        'WHERE' => ['comment' => 'Réservation de test']
    ]);
    
    foreach ($reservations as $reservation) {
        if ($DB->delete('glpi_plugin_unhassets_reservations', ['id' => $reservation['id']])) {
            $deleted_reservations++;
            echo "<div class='item'>✅ Réservation supprimée : ID {$reservation['id']}</div>";
        }
    }
    
    // Supprimer les licences
    $licenses = $DB->request([
        'FROM' => 'glpi_plugin_unhassets_licenses',
        'WHERE' => ['comment' => ['LIKE', '%généré automatiquement%']]
    ]);
    
    foreach ($licenses as $license) {
        if ($DB->delete('glpi_plugin_unhassets_licenses', ['id' => $license['id']])) {
            $deleted_licenses++;
            echo "<div class='item'>✅ Licence supprimée : {$license['name']}</div>";
        }
    }
    
    echo "<h2>📊 Résumé de la suppression</h2>";
    
    echo "<div class='stats'>";
    echo "<div class='stat-box'><h3>{$deleted_assets}</h3><p>Équipements supprimés</p></div>";
    echo "<div class='stat-box'><h3>{$deleted_reservations}</h3><p>Réservations supprimées</p></div>";
    echo "<div class='stat-box'><h3>{$deleted_licenses}</h3><p>Licences supprimées</p></div>";
    echo "</div>";
    
    echo "<div class='success'><strong>✅ Suppression terminée avec succès !</strong></div>";
    
    echo "<h2>🔗 Liens rapides</h2>";
    echo "<a href='generate_test_data.php' class='btn'>🔄 Régénérer des données de test</a>";
    echo "<a href='" . $CFG_GLPI['root_doc'] . "/plugins/unhassets/front/dashboard.php' class='btn'>📊 Tableau de bord</a>";
}

echo "</div></body></html>";