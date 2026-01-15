<?php
/**
 * Générateur de données de test - Plugin UNH Assets
 * Université Nouveaux Horizons
 * 
 * Usage: Accéder à /plugins/unh_assets/front/test_data_generator.php
 * Ou exécuter via CLI: php test_data_generator.php
 */

// Vérifier que GLPI est chargé
if (!defined('GLPI_ROOT')) {
    die('Accès refusé - GLPI non chargé');
}

require_once(dirname(__FILE__) . '/../../../inc/includes.php');


// Vérifier authentification et droits admin
if (!isset($_SESSION['glpiID']) || $_SESSION['glpiactiveprofile']['interface'] !== 'central') {
    die('Erreur: Accès administrateur requis');
}

/**
 * Classe de génération des données de test
 */
class TestDataGenerator
{
    private $db;
    private $messages = [];
    private $errors = [];
    private $count = 0;

    public function __construct()
    {
        global $DB;
        $this->db = $DB;
    }

    /**
     * Générer tous les données de test
     */
    public function generateAll()
    {
        echo '<h2>🧪 Générateur de données de test - UNH Assets</h2>';
        echo '<hr>';

        try {
            $this->generateLocations();
            $this->generateComputers();
            $this->generatePrinters();
            $this->generateNetworkEquipments();
            $this->generateServers();
            $this->generateAlerts();
            
            $this->displayResults();
        } catch (Exception $e) {
            echo '<div class="alert alert-danger">❌ Erreur : ' . $e->getMessage() . '</div>';
        }
    }

    /**
     * Générer les bâtiments/emplacements
     */
    private function generateLocations()
    {
        echo '<h3>📍 Génération des bâtiments...</h3>';

        $locations = [
            ['name' => 'Bâtiment Rector', 'address' => '123 Rue de l\'Université', 'comment' => 'Bâtiment principal'],
            ['name' => 'Bâtiment Scientifique', 'address' => '125 Rue de l\'Université', 'comment' => 'Laboratoires'],
            ['name' => 'Bâtiment Administratif', 'address' => '127 Rue de l\'Université', 'comment' => 'Bureaux'],
            ['name' => 'Résidence Étudiante A', 'address' => '200 Avenue du Campus', 'comment' => 'Dortoirs'],
            ['name' => 'Bibliothèque Centrale', 'address' => '130 Rue de l\'Université', 'comment' => 'Documentations'],
        ];

        foreach ($locations as $loc) {
            try {
                $location = new Location();
                $location->add([
                    'name' => $loc['name'],
                    'address' => $loc['address'],
                    'postcode' => '1000',
                    'town' => 'Kinshasa',
                    'state' => 'Kinshasa',
                    'country' => 'Congo RDC',
                    'comments' => $loc['comment'],
                    'entities_id' => $_SESSION['glpiactive_entity'],
                ]);
                
                $this->count++;
                echo '✅ ' . $loc['name'] . ' créé<br>';
            } catch (Exception $e) {
                echo '❌ Erreur: ' . $loc['name'] . '<br>';
                $this->errors[] = $loc['name'];
            }
        }
        echo '<hr>';
    }

    /**
     * Générer les ordinateurs
     */
    private function generateComputers()
    {
        echo '<h3>💻 Génération des ordinateurs...</h3>';

        $computers = [
            ['name' => 'PC-RECT-001', 'serial' => 'SN20240501001', 'location' => 'Bâtiment Rector', 'comment' => 'Ordinateur de direction'],
            ['name' => 'PC-RECT-002', 'serial' => 'SN20240501002', 'location' => 'Bâtiment Rector', 'comment' => 'Bureau vice-recteur'],
            ['name' => 'PC-SCI-001', 'serial' => 'SN20240502001', 'location' => 'Bâtiment Scientifique', 'comment' => 'Labo informatique'],
            ['name' => 'PC-SCI-002', 'serial' => 'SN20240502002', 'location' => 'Bâtiment Scientifique', 'comment' => 'Labo électronique'],
            ['name' => 'PC-ADM-001', 'serial' => 'SN20240503001', 'location' => 'Bâtiment Administratif', 'comment' => 'Finances'],
            ['name' => 'PC-ADM-002', 'serial' => 'SN20240503002', 'location' => 'Bâtiment Administratif', 'comment' => 'RH'],
            ['name' => 'PC-ADM-003', 'serial' => 'SN20240503003', 'location' => 'Bâtiment Administratif', 'comment' => 'Scolarité'],
            ['name' => 'PC-DORM-001', 'serial' => 'SN20240504001', 'location' => 'Résidence Étudiante A', 'comment' => 'Salle informatique'],
            ['name' => 'PC-BIB-001', 'serial' => 'SN20240505001', 'location' => 'Bibliothèque Centrale', 'comment' => 'Catalogue'],
            ['name' => 'PC-BIB-002', 'serial' => 'SN20240505002', 'location' => 'Bibliothèque Centrale', 'comment' => 'Accueil'],
        ];

        foreach ($computers as $comp) {
            try {
                $computer = new Computer();
                $computer->add([
                    'name' => $comp['name'],
                    'serial' => $comp['serial'],
                    'comment' => $comp['comment'],
                    'entities_id' => $_SESSION['glpiactive_entity'],
                    'states_id' => 1, // Opérationnel
                ]);
                
                $this->count++;
                echo '✅ ' . $comp['name'] . ' créé<br>';
            } catch (Exception $e) {
                echo '❌ Erreur: ' . $comp['name'] . '<br>';
                $this->errors[] = $comp['name'];
            }
        }
        echo '<hr>';
    }

    /**
     * Générer les imprimantes
     */
    private function generatePrinters()
    {
        echo '<h3>🖨️ Génération des imprimantes...</h3>';

        $printers = [
            ['name' => 'IMP-RECT-001', 'serial' => 'SN-IMP-001', 'comment' => 'Imprimante direction'],
            ['name' => 'IMP-RECT-002', 'serial' => 'SN-IMP-002', 'comment' => 'Photocopieur multifonction'],
            ['name' => 'IMP-ADM-001', 'serial' => 'SN-IMP-003', 'comment' => 'Imprimante administrative'],
            ['name' => 'IMP-SCI-001', 'serial' => 'SN-IMP-004', 'comment' => 'Imprimante 3D'],
            ['name' => 'IMP-BIB-001', 'serial' => 'SN-IMP-005', 'comment' => 'Imprimante bibliothèque'],
        ];

        foreach ($printers as $printer) {
            try {
                $print = new Printer();
                $print->add([
                    'name' => $printer['name'],
                    'serial' => $printer['serial'],
                    'comment' => $printer['comment'],
                    'entities_id' => $_SESSION['glpiactive_entity'],
                    'states_id' => 1,
                ]);
                
                $this->count++;
                echo '✅ ' . $printer['name'] . ' créé<br>';
            } catch (Exception $e) {
                echo '❌ Erreur: ' . $printer['name'] . '<br>';
                $this->errors[] = $printer['name'];
            }
        }
        echo '<hr>';
    }

    /**
     * Générer les équipements réseau
     */
    private function generateNetworkEquipments()
    {
        echo '<h3>🌐 Génération des équipements réseau...</h3>';

        $equipments = [
            ['name' => 'ROUTER-PRINCIPAL', 'serial' => 'SN-ROUTER-001', 'comment' => 'Routeur principal'],
            ['name' => 'SWITCH-RECT', 'serial' => 'SN-SWITCH-001', 'comment' => 'Commutateur Rector'],
            ['name' => 'SWITCH-SCI', 'serial' => 'SN-SWITCH-002', 'comment' => 'Commutateur Scientifique'],
            ['name' => 'SWITCH-ADM', 'serial' => 'SN-SWITCH-003', 'comment' => 'Commutateur Administratif'],
            ['name' => 'AP-WIFI-001', 'serial' => 'SN-AP-001', 'comment' => 'Point accès WiFi principal'],
            ['name' => 'AP-WIFI-002', 'serial' => 'SN-AP-002', 'comment' => 'Point accès WiFi labo'],
            ['name' => 'AP-WIFI-003', 'serial' => 'SN-AP-003', 'comment' => 'Point accès WiFi bibliothèque'],
        ];

        foreach ($equipments as $equip) {
            try {
                $net = new NetworkEquipment();
                $net->add([
                    'name' => $equip['name'],
                    'serial' => $equip['serial'],
                    'comment' => $equip['comment'],
                    'entities_id' => $_SESSION['glpiactive_entity'],
                    'states_id' => 1,
                ]);
                
                $this->count++;
                echo '✅ ' . $equip['name'] . ' créé<br>';
            } catch (Exception $e) {
                echo '❌ Erreur: ' . $equip['name'] . '<br>';
                $this->errors[] = $equip['name'];
            }
        }
        echo '<hr>';
    }

    /**
     * Générer les serveurs
     */
    private function generateServers()
    {
        echo '<h3>🖥️ Génération des serveurs...</h3>';

        $servers = [
            ['name' => 'SRV-PRINCIPAL', 'serial' => 'SN-SRV-001', 'comment' => 'Serveur Active Directory'],
            ['name' => 'SRV-BD', 'serial' => 'SN-SRV-002', 'comment' => 'Serveur MySQL'],
            ['name' => 'SRV-WEB', 'serial' => 'SN-SRV-003', 'comment' => 'Serveur web'],
            ['name' => 'SRV-BACKUP', 'serial' => 'SN-SRV-004', 'comment' => 'Serveur sauvegarde'],
            ['name' => 'SRV-MAIL', 'serial' => 'SN-SRV-005', 'comment' => 'Serveur messagerie'],
        ];

        foreach ($servers as $server) {
            try {
                $srv = new Server();
                $srv->add([
                    'name' => $server['name'],
                    'serial' => $server['serial'],
                    'comment' => $server['comment'],
                    'entities_id' => $_SESSION['glpiactive_entity'],
                    'states_id' => 1,
                ]);
                
                $this->count++;
                echo '✅ ' . $server['name'] . ' créé<br>';
            } catch (Exception $e) {
                echo '❌ Erreur: ' . $server['name'] . '<br>';
                $this->errors[] = $server['name'];
            }
        }
        echo '<hr>';
    }

    /**
     * Générer les alertes de test
     */
    private function generateAlerts()
    {
        echo '<h3>⚠️ Génération des alertes...</h3>';
        echo '✅ Alertes générées par le système automatiquement lors des changements d\'état<br>';
        echo '<hr>';
    }

    /**
     * Afficher les résultats finaux
     */
    private function displayResults()
    {
        echo '<div class="alert alert-success">';
        echo '<h4>✅ Résumé de la génération</h4>';
        echo '<p><strong>Éléments créés:</strong> ' . $this->count . '</p>';
        
        if (!empty($this->errors)) {
            echo '<p><strong>Erreurs:</strong> ' . count($this->errors) . '</p>';
            echo '<ul>';
            foreach ($this->errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p><strong>Aucune erreur</strong></p>';
        }
        echo '</div>';
        
        echo '<div class="alert alert-info">';
        echo '<h4>📊 Données disponibles pour tester</h4>';
        echo '<ul>';
        echo '<li>5 bâtiments/emplacements</li>';
        echo '<li>10 ordinateurs</li>';
        echo '<li>5 imprimantes</li>';
        echo '<li>7 équipements réseau (routeur, switch, WiFi)</li>';
        echo '<li>5 serveurs</li>';
        echo '<li><strong>Total: ' . $this->count . ' équipements</strong></li>';
        echo '</ul>';
        echo '</div>';
        
        echo '<div class="alert alert-warning">';
        echo '<h4>🗑️ Pour supprimer les données de test</h4>';
        echo '<p>Ces données sont identifiables par leurs noms (SN2024*, PC-*, IMP-*, etc.)</p>';
        echo '<p>Vous pouvez les supprimer manuellement depuis l\'interface GLPI.</p>';
        echo '</div>';
    }
}

// ============================================================================
// Exécution du générateur
// ============================================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate'])) {
    // Vérifier CSRF token
    Session::checkCSRF($_POST);
    
    $generator = new TestDataGenerator();
    $generator->generateAll();
} else {
    // Afficher le formulaire
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Générateur données de test - UNH Assets</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h2 class="mb-0">🧪 Générateur de données de test</h2>
                        </div>
                        <div class="card-body">
                            <p class="lead">
                                Créer automatiquement des données de test pour le plugin UNH Assets.
                            </p>

                            <div class="alert alert-info">
                                <h4>Données qui seront créées:</h4>
                                <ul class="mb-0">
                                    <li>5 bâtiments/emplacements</li>
                                    <li>10 ordinateurs de bureau</li>
                                    <li>5 imprimantes</li>
                                    <li>7 équipements réseau (routeur, switch, WiFi)</li>
                                    <li>5 serveurs</li>
                                    <li><strong>Total: 32 équipements</strong></li>
                                </ul>
                            </div>

                            <div class="alert alert-warning">
                                <h4>⚠️ Important</h4>
                                <p class="mb-0">
                                    Cette action est irréversible. Les données créées peuvent être supprimées manuellement depuis l'interface GLPI.
                                </p>
                            </div>

                            <form method="post" action="">
                                <?php echo Session::getNewCSRFToken(); ?>
                                <button type="submit" name="generate" value="1" class="btn btn-primary btn-lg">
                                    ✅ Générer les données de test
                                </button>
                                <a href="index.php?action=dashboard" class="btn btn-secondary btn-lg">
                                    ❌ Annuler
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
}
