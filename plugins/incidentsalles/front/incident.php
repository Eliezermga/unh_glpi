<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../../../inc/includes.php');

global $DB;

$table = 'glpi_incidentsalles';

// Vérifier les droits d'accès
$is_admin = Session::haveRight('config', UPDATE);
$current_user_id = Session::getLoginUserID();

// Vérifier si la table existe
if (!$DB->tableExists($table)) {
    echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Erreur</title></head><body>";
    echo "<h1 style='color: red;'>❌ La table n'existe pas</h1>";
    echo "<p>La table <code>$table</code> n'existe pas dans la base de données.</p>";
    echo "<p><a href='create_table.php' style='padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 4px;'>Créer la table maintenant</a></p>";
    echo "</body></html>";
    exit;
}

// Traitement du formulaire
if (isset($_POST['submit_incident'])) {
    $salle = $DB->escape($_POST['salle'] ?? '');
    $laboratoire = $DB->escape($_POST['laboratoire'] ?? '');
    $type_incident = $DB->escape($_POST['type_incident'] ?? '');
    $description = $DB->escape($_POST['description'] ?? '');
    $heure_incident = $DB->escape($_POST['heure_incident'] ?? date('H:i'));
    $inventaire_glpi = $DB->escape($_POST['inventaire_glpi'] ?? '');
    $action_maintenance = $DB->escape($_POST['action_maintenance'] ?? '');
    $equipement = $DB->escape($_POST['equipement'] ?? '');
    $priorite = $DB->escape($_POST['priorite'] ?? 'normale');
    $users_id = Session::getLoginUserID();
    $date_incident = date('Y-m-d H:i:s');

    if (!empty($salle) && !empty($type_incident) && !empty($description)) {
// Ajouter la colonne priorité dans l'INSERT
        $query = "INSERT INTO $table 
                  (users_id, salle, laboratoire, type_incident, description, date_incident, heure_incident, equipement, inventaire_glpi, action_maintenance, priorite, statut, date_creation) 
                  VALUES ($users_id, '$salle', '$laboratoire', '$type_incident', '$description', '$date_incident', '$heure_incident', '$equipement', '$inventaire_glpi', '$action_maintenance', '$priorite', 'ouvert', NOW())";
        
        if ($DB->query($query)) {
            $message = "<div style='background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin: 20px 0;'>✅ Incident enregistré avec succès</div>";
        } else {
            $message = "<div style='background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin: 20px 0;'>❌ Erreur: " . $DB->error() . "</div>";
        }
    } else {
        $message = "<div style='background: #fff3cd; color: #856404; padding: 15px; border-radius: 4px; margin: 20px 0;'>⚠️ Tous les champs obligatoires doivent être remplis</div>";
    }
}

// Traitement changement de statut
if (isset($_POST['change_statut'])) {
    $id = intval($_POST['incident_id']);
    $statut = $DB->escape($_POST['statut']);
    $date_resolution = ($statut == 'resolu') ? "'" . date('Y-m-d H:i:s') . "'" : 'NULL';
    
    $query = "UPDATE $table SET statut = '$statut', date_resolution = $date_resolution WHERE id = $id";
    
    if ($DB->query($query)) {
        $message = "<div style='background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin: 20px 0;'>✅ Statut mis à jour</div>";
    } else {
        $message = "<div style='background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin: 20px 0;'>❌ Erreur lors de la mise à jour</div>";
    }
}

$tab = $_GET['tab'] ?? 'form';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestion des Incidents en Salles et Laboratoires</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1400px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        h2 { color: #333; margin-top: 0; }
        .tabs { list-style: none; padding: 0; display: flex; border-bottom: 2px solid #667eea; margin-bottom: 20px; }
        .tabs li { margin-right: 5px; }
        .tabs a { display: block; padding: 12px 24px; text-decoration: none; color: #666; border-bottom: 3px solid transparent; }
        .tabs a.active { color: #667eea; border-bottom-color: #667eea; font-weight: 600; }
        .card { background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 5px; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        .btn { padding: 12px 30px; border: none; border-radius: 4px; cursor: pointer; font-weight: 600; }
        .btn-primary { background: #667eea; color: white; }
        .btn-sm { padding: 5px 10px; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8f9fa; padding: 12px; text-align: left; border-bottom: 2px solid #ddd; }
        td { padding: 12px; border-bottom: 1px solid #eee; }
        .badge { padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; display: inline-block; }
        .badge-ouvert { background: #fee; color: #c00; }
        .badge-en_cours { background: #ffeaa7; color: #d63031; }
        .badge-resolu { background: #d4edda; color: #155724; }
        .badge-critique { background: #dc3545; color: white; }
        .badge-haute { background: #fd7e14; color: white; }
        .badge-normale { background: #17a2b8; color: white; }
        .badge-basse { background: #6c757d; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h2>🔧 Gestion des Incidents en Salles et Laboratoires</h2>
        
        <?php if (isset($message)) echo $message; ?>
        
        <?php if ($is_admin): ?>
        <!-- Widget d'alertes pour les administrateurs -->
        <div id="alertWidget" style="margin-bottom: 20px;"></div>
        <script>
        function loadAlerts() {
            fetch('alerts.php?ajax=1')
                .then(response => response.json())
                .then(alertes => {
                    const widget = document.getElementById('alertWidget');
                    if (alertes.length > 0) {
                        let html = '<div style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 8px;">';
                        html += '<h4 style="margin: 0 0 10px 0; color: #856404;">🚨 Alertes actives</h4>';
                        alertes.forEach(alerte => {
                            html += `<div style="background: ${alerte.color}; color: white; padding: 8px 12px; margin: 5px 0; border-radius: 4px; font-size: 14px;">`;
                            html += `<strong>${alerte.message}</strong>`;
                            html += '</div>';
                        });
                        html += '<a href="?tab=alerts" style="color: #856404; text-decoration: none; font-weight: bold;">➡️ Gérer les alertes</a>';
                        html += '</div>';
                        widget.innerHTML = html;
                    }
                });
        }
        loadAlerts();
        setInterval(loadAlerts, 30000); // Actualiser toutes les 30 secondes
        </script>
        <?php endif; ?>
        
        <ul class="tabs">
            <li><a href="?tab=form" class="<?= $tab == 'form' ? 'active' : '' ?>">📝 Déclarer un incident</a></li>
            <?php if ($is_admin): ?>
            <li><a href="?tab=list" class="<?= $tab == 'list' ? 'active' : '' ?>">📋 Liste des incidents</a></li>
            <li><a href="?tab=stats" class="<?= $tab == 'stats' ? 'active' : '' ?>">📊 Statistiques</a></li>
            <li><a href="?tab=alerts" class="<?= $tab == 'alerts' ? 'active' : '' ?>">🚨 Alertes 
                <?php 
                $alert_count = $DB->query("SELECT COUNT(*) as c FROM $table WHERE statut != 'resolu' AND (priorite = 'critique' OR DATEDIFF(NOW(), date_incident) > 7)")->fetch_assoc()['c'];
                if ($alert_count > 0) echo "<span style='background: #dc3545; color: white; border-radius: 50%; padding: 2px 6px; font-size: 11px; margin-left: 5px;'>$alert_count</span>";
                ?>
            </a></li>
            <li><a href="?tab=historique" class="<?= $tab == 'historique' ? 'active' : '' ?>">📜 Historique</a></li>
            <?php else: ?>
            <li><a href="?tab=mes_incidents" class="<?= $tab == 'mes_incidents' ? 'active' : '' ?>">📋 Mes incidents</a></li>
            <?php endif; ?>
        </ul>
        
        <?php if ($tab == 'form'): ?>
            <div class="card">
                <h3>Déclarer un nouvel incident</h3>
                <form method="post">
                    <?php echo Html::hidden('_glpi_csrf_token', ['value' => Session::getNewCSRFToken()]); ?>
                    <div class="form-group">
                        <label>Salle *</label>
                        <input type="text" name="salle" class="form-control" placeholder="Ex: Salle A101" required />
                    </div>
                    
                    <div class="form-group">
                        <label>Laboratoire</label>
                        <input type="text" name="laboratoire" class="form-control" placeholder="Ex: Labo Informatique" />
                    </div>
                    
                    <div class="form-group">
                        <label>Type d'incident *</label>
                        <select name="type_incident" class="form-control" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="Matériel défectueux">Matériel défectueux</option>
                            <option value="Problème réseau">Problème réseau</option>
                            <option value="Logiciel">Logiciel</option>
                            <option value="Électricité">Électricité</option>
                            <option value="Climatisation">Climatisation</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Équipement concerné</label>
                        <input type="text" name="equipement" class="form-control" placeholder="Ex: PC-15, Projecteur" />
                    </div>
                    
                    <div class="form-group">
                        <label>Numéro d'inventaire GLPI</label>
                        <input type="text" name="inventaire_glpi" class="form-control" placeholder="Ex: INV001234" />
                    </div>
                    
                    <div class="form-group">
                        <label>Action de maintenance</label>
                        <select name="action_maintenance" class="form-control">
                            <option value="">-- Aucune --</option>
                            <option value="Réparation">Réparation</option>
                            <option value="Remplacement">Remplacement</option>
                            <option value="Maintenance préventive">Maintenance préventive</option>
                            <option value="Nettoyage">Nettoyage</option>
                            <option value="Mise à jour">Mise à jour</option>
                            <option value="Configuration">Configuration</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Priorité *</label>
                        <select name="priorite" class="form-control" required>
                            <option value="basse">Basse</option>
                            <option value="normale" selected>Normale</option>
                            <option value="haute">Haute</option>
                            <option value="critique">Critique</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Heure de l'incident</label>
                        <input type="time" name="heure_incident" class="form-control" value="<?= date('H:i') ?>" />
                    </div>
                    
                    <div class="form-group">
                        <label>Description *</label>
                        <textarea name="description" rows="5" class="form-control" placeholder="Décrivez l'incident en détail..." required></textarea>
                    </div>
                    
                    <button type="submit" name="submit_incident" class="btn btn-primary">Enregistrer l'incident</button>
                </form>
            </div>
        <?php endif; ?>
        
        <?php if ($tab == 'mes_incidents' && !$is_admin): ?>
            <div class="card">
                <h3>Mes incidents déclarés</h3>
                <?php
                $query = "SELECT i.*, u.name as user_name FROM $table i 
                          LEFT JOIN glpi_users u ON i.users_id = u.id 
                          WHERE i.users_id = $current_user_id
                          ORDER BY i.date_incident DESC";
                $result = $DB->query($query);
                
                if ($result && $DB->numrows($result) > 0):
                ?>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Salle</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Statut</th>
                        </tr>
                        <?php while ($row = $DB->fetchAssoc($result)): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['salle'] ?></td>
                                <td><?= $row['type_incident'] ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($row['date_incident'])) ?></td>
                                <td><span class="badge badge-<?= $row['statut'] ?>"><?= strtoupper($row['statut']) ?></span></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                <?php else: ?>
                    <p style="text-align: center; padding: 40px; color: #999;">Vous n'avez déclaré aucun incident</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($tab == 'list' && !$is_admin): ?>
            <div class="card">
                <p style="text-align: center; padding: 40px; color: red;">❌ Accès réservé aux administrateurs</p>
            </div>
        <?php endif; ?>
        
        <?php if ($tab == 'list' && $is_admin): ?>
            <div class="card">
                <h3>Liste des incidents</h3>
                <?php
                $query = "SELECT i.*, u.name as user_name FROM $table i 
                          LEFT JOIN glpi_users u ON i.users_id = u.id 
                          ORDER BY i.date_incident DESC";
                $result = $DB->query($query);
                
                if ($result && $DB->numrows($result) > 0):
                ?>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Salle</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Priorité</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                        <?php while ($row = $DB->fetchAssoc($result)): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['salle'] ?></td>
                                <td><?= $row['type_incident'] ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($row['date_incident'])) ?></td>
                                <td><span class="badge badge-<?= $row['priorite'] ?>"><?= strtoupper($row['priorite']) ?></span></td>
                                <td><span class="badge badge-<?= $row['statut'] ?>"><?= strtoupper($row['statut']) ?></span></td>
                                <td>
                                    <?php if ($row['statut'] != 'resolu'): ?>
                                        <form method="post" style="display: inline;">
                                            <?php echo Html::hidden('_glpi_csrf_token', ['value' => Session::getNewCSRFToken()]); ?>
                                            <input type="hidden" name="incident_id" value="<?= $row['id'] ?>" />
                                            <select name="statut" class="form-control" style="width: auto; display: inline-block; padding: 5px;">
                                                <option value="ouvert" <?= $row['statut'] == 'ouvert' ? 'selected' : '' ?>>Ouvert</option>
                                                <option value="en_cours" <?= $row['statut'] == 'en_cours' ? 'selected' : '' ?>>En cours</option>
                                                <option value="resolu">Résolu</option>
                                            </select>
                                            <button type="submit" name="change_statut" class="btn btn-primary btn-sm">Modifier</button>
                                        </form>
                                    <?php else: ?>
                                        ✅ Résolu
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                <?php else: ?>
                    <p style="text-align: center; padding: 40px; color: #999;">Aucun incident enregistré</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($tab == 'stats' && !$is_admin): ?>
            <div class="card">
                <p style="text-align: center; padding: 40px; color: red;">❌ Accès réservé aux administrateurs</p>
            </div>
        <?php endif; ?>
        
        <?php if ($tab == 'stats' && $is_admin): ?>
            <?php
            $total = $DB->query("SELECT COUNT(*) as c FROM $table")->fetch_assoc()['c'];
            $ouverts = $DB->query("SELECT COUNT(*) as c FROM $table WHERE statut='ouvert'")->fetch_assoc()['c'];
            $en_cours = $DB->query("SELECT COUNT(*) as c FROM $table WHERE statut='en_cours'")->fetch_assoc()['c'];
            $resolus = $DB->query("SELECT COUNT(*) as c FROM $table WHERE statut='resolu'")->fetch_assoc()['c'];
            ?>
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 8px; text-align: center;">
                    <h3 style="margin: 0; font-size: 32px;"><?= $total ?></h3>
                    <p style="margin: 10px 0 0 0;">Total incidents</p>
                </div>
                <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 20px; border-radius: 8px; text-align: center;">
                    <h3 style="margin: 0; font-size: 32px;"><?= $ouverts ?></h3>
                    <p style="margin: 10px 0 0 0;">Ouverts</p>
                </div>
                <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 20px; border-radius: 8px; text-align: center;">
                    <h3 style="margin: 0; font-size: 32px;"><?= $en_cours ?></h3>
                    <p style="margin: 10px 0 0 0;">En cours</p>
                </div>
                <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 20px; border-radius: 8px; text-align: center;">
                    <h3 style="margin: 0; font-size: 32px;"><?= $resolus ?></h3>
                    <p style="margin: 10px 0 0 0;">Résolus</p>
                </div>
            </div>
            
            <div class="card">
                <h3>📍 Salles les plus touchées</h3>
                <?php
                $query = "SELECT salle, COUNT(*) as nb FROM $table GROUP BY salle ORDER BY nb DESC LIMIT 10";
                $result = $DB->query($query);
                ?>
                <table>
                    <tr><th>Salle</th><th>Nombre d'incidents</th></tr>
                    <?php while ($row = $DB->fetchAssoc($result)): ?>
                        <tr>
                            <td><?= $row['salle'] ?></td>
                            <td><strong><?= $row['nb'] ?></strong></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        <?php endif; ?>
        
        <?php if ($tab == 'alerts' && !$is_admin): ?>
            <div class="card">
                <p style="text-align: center; padding: 40px; color: red;">❌ Accès réservé aux administrateurs</p>
            </div>
        <?php endif; ?>
        
        <?php if ($tab == 'alerts' && $is_admin): ?>
            <?php
            // Compter les alertes
            $alertes_7j = $DB->query("SELECT COUNT(*) as c FROM $table WHERE statut != 'resolu' AND DATEDIFF(NOW(), date_incident) > 7")->fetch_assoc()['c'];
            $alertes_critique = $DB->query("SELECT COUNT(*) as c FROM $table WHERE statut != 'resolu' AND priorite = 'critique'")->fetch_assoc()['c'];
            $alertes_haute = $DB->query("SELECT COUNT(*) as c FROM $table WHERE statut != 'resolu' AND priorite = 'haute'")->fetch_assoc()['c'];
            ?>
            
            <!-- Résumé des alertes -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 20px;">
                <div style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; padding: 20px; border-radius: 8px; text-align: center;">
                    <h3 style="margin: 0; font-size: 32px;"><?= $alertes_7j ?></h3>
                    <p style="margin: 10px 0 0 0;">Incidents > 7 jours</p>
                </div>
                <div style="background: linear-gradient(135deg, #fd7e14 0%, #e55a00 100%); color: white; padding: 20px; border-radius: 8px; text-align: center;">
                    <h3 style="margin: 0; font-size: 32px;"><?= $alertes_critique ?></h3>
                    <p style="margin: 10px 0 0 0;">Priorité critique</p>
                </div>
                <div style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%); color: white; padding: 20px; border-radius: 8px; text-align: center;">
                    <h3 style="margin: 0; font-size: 32px;"><?= $alertes_haute ?></h3>
                    <p style="margin: 10px 0 0 0;">Priorité haute</p>
                </div>
            </div>
            
            <!-- Incidents critiques -->
            <div class="card">
                <h3>🔥 Incidents critiques non résolus</h3>
                <?php
                $query_critique = "SELECT i.*, u.name as user_name, DATEDIFF(NOW(), i.date_incident) as jours 
                          FROM $table i 
                          LEFT JOIN glpi_users u ON i.users_id = u.id 
                          WHERE i.statut != 'resolu' AND i.priorite = 'critique'
                          ORDER BY i.date_incident ASC";
                $result_critique = $DB->query($query_critique);
                
                if ($result_critique && $DB->numrows($result_critique) > 0):
                ?>
                    <div style="background: #dc3545; color: white; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                        🚨 <strong><?= $DB->numrows($result_critique) ?></strong> incident(s) critique(s) nécessite(nt) une intervention immédiate !
                    </div>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Salle</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Jours</th>
                            <th>Action</th>
                        </tr>
                        <?php while ($row = $DB->fetchAssoc($result_critique)): ?>
                            <tr style="background: #ffebee;">
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['salle'] ?></td>
                                <td><?= $row['type_incident'] ?></td>
                                <td><?= date('d/m/Y', strtotime($row['date_incident'])) ?></td>
                                <td><strong style="color: red;"><?= $row['jours'] ?></strong></td>
                                <td>
                                    <form method="post" style="display: inline;">
                                        <?php echo Html::hidden('_glpi_csrf_token', ['value' => Session::getNewCSRFToken()]); ?>
                                        <input type="hidden" name="incident_id" value="<?= $row['id'] ?>" />
                                        <select name="statut" style="padding: 5px;">
                                            <option value="en_cours">Prendre en charge</option>
                                            <option value="resolu">Marquer résolu</option>
                                        </select>
                                        <button type="submit" name="change_statut" class="btn btn-primary btn-sm">OK</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                <?php else: ?>
                    <p style="text-align: center; padding: 20px; color: green;">✅ Aucun incident critique</p>
                <?php endif; ?>
            </div>
            
            <div class="card">
                <h3>🚨 Incidents non résolus depuis plus de 7 jours</h3>
                <?php
                $query = "SELECT i.*, u.name as user_name, DATEDIFF(NOW(), i.date_incident) as jours 
                          FROM $table i 
                          LEFT JOIN glpi_users u ON i.users_id = u.id 
                          WHERE i.statut != 'resolu' 
                          AND DATEDIFF(NOW(), i.date_incident) > 7
                          ORDER BY jours DESC";
                $result = $DB->query($query);
                
                if ($result && $DB->numrows($result) > 0):
                ?>
                    <div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                        ⚠️ <strong><?= $DB->numrows($result) ?></strong> incident(s) nécessite(nt) une attention urgente !
                    </div>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Salle</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Jours écoulés</th>
                            <th>Priorité</th>
                            <th>Statut</th>
                        </tr>
                        <?php while ($row = $DB->fetchAssoc($result)): ?>
                            <tr style="<?= $row['jours'] > 14 ? 'background: #ffebee;' : '' ?>">
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['salle'] ?></td>
                                <td><?= $row['type_incident'] ?></td>
                                <td><?= date('d/m/Y', strtotime($row['date_incident'])) ?></td>
                                <td><strong style="color: red;"><?= $row['jours'] ?> jours</strong></td>
                                <td><span class="badge badge-<?= $row['priorite'] ?>"><?= strtoupper($row['priorite']) ?></span></td>
                                <td><span class="badge badge-<?= $row['statut'] ?>"><?= strtoupper($row['statut']) ?></span></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                <?php else: ?>
                    <p style="text-align: center; padding: 40px; color: green;">✅ Aucun incident en retard</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($tab == 'historique' && !$is_admin): ?>
            <div class="card">
                <p style="text-align: center; padding: 40px; color: red;">❌ Accès réservé aux administrateurs</p>
            </div>
        <?php endif; ?>
        
        <?php if ($tab == 'historique' && $is_admin): ?>
            <div class="card">
                <h3>📜 Historique du matériel</h3>
                <?php
                $query = "SELECT equipement, inventaire_glpi, COUNT(*) as nb_incidents, 
                          MAX(date_incident) as dernier_incident,
                          MIN(date_incident) as premier_incident,
                          GROUP_CONCAT(DISTINCT salle ORDER BY salle SEPARATOR ', ') as salles,
                          GROUP_CONCAT(DISTINCT action_maintenance ORDER BY action_maintenance SEPARATOR ', ') as actions,
                          SUM(CASE WHEN statut = 'resolu' THEN 1 ELSE 0 END) as resolus,
                          AVG(CASE WHEN statut = 'resolu' AND date_resolution IS NOT NULL 
                              THEN DATEDIFF(date_resolution, date_incident) ELSE NULL END) as temps_moyen_resolution
                          FROM $table 
                          WHERE equipement IS NOT NULL AND equipement != ''
                          GROUP BY equipement, inventaire_glpi 
                          ORDER BY nb_incidents DESC";
                $result = $DB->query($query);
                
                if ($result && $DB->numrows($result) > 0):
                ?>
                    <div style="margin-bottom: 20px;">
                        <h4>🔍 Filtres</h4>
                        <input type="text" id="filterEquipement" placeholder="Rechercher un équipement..." 
                               style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; width: 300px;" 
                               onkeyup="filterTable()">
                        <select id="filterSalle" onchange="filterTable()" style="padding: 8px; margin-left: 10px;">
                            <option value="">Toutes les salles</option>
                            <?php
                            $salles_query = "SELECT DISTINCT salle FROM $table WHERE salle IS NOT NULL ORDER BY salle";
                            $salles_result = $DB->query($salles_query);
                            while ($salle_row = $DB->fetchAssoc($salles_result)) {
                                echo "<option value='{$salle_row['salle']}'>{$salle_row['salle']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <table id="historiqueTable">
                        <tr>
                            <th>Équipement</th>
                            <th>N° Inventaire</th>
                            <th>Salles</th>
                            <th>Actions maintenance</th>
                            <th>Nb incidents</th>
                            <th>Résolus</th>
                            <th>Taux résolution</th>
                            <th>Temps moyen</th>
                            <th>Premier incident</th>
                            <th>Dernier incident</th>
                            <th>Actions</th>
                        </tr>
                        <?php while ($row = $DB->fetchAssoc($result)): 
                            $taux_resolution = $row['nb_incidents'] > 0 ? round(($row['resolus'] / $row['nb_incidents']) * 100) : 0;
                            $temps_moyen = $row['temps_moyen_resolution'] ? round($row['temps_moyen_resolution'], 1) : 0;
                        ?>
                            <tr data-equipement="<?= strtolower($row['equipement']) ?>" data-salles="<?= strtolower($row['salles']) ?>">
                                <td><strong><?= htmlspecialchars($row['equipement']) ?></strong></td>
                                <td><?= htmlspecialchars($row['inventaire_glpi'] ?: 'N/A') ?></td>
                                <td><?= htmlspecialchars($row['salles']) ?></td>
                                <td><?= htmlspecialchars($row['actions'] ?: 'Aucune') ?></td>
                                <td><span class="badge badge-<?= $row['nb_incidents'] > 5 ? 'haute' : ($row['nb_incidents'] > 2 ? 'normale' : 'basse') ?>"><?= $row['nb_incidents'] ?></span></td>
                                <td><?= $row['resolus'] ?></td>
                                <td>
                                    <span class="badge badge-<?= $taux_resolution >= 80 ? 'resolu' : ($taux_resolution >= 50 ? 'normale' : 'ouvert') ?>">
                                        <?= $taux_resolution ?>%
                                    </span>
                                </td>
                                <td><?= $temps_moyen ?> j</td>
                                <td><?= date('d/m/Y', strtotime($row['premier_incident'])) ?></td>
                                <td><?= date('d/m/Y', strtotime($row['dernier_incident'])) ?></td>
                                <td>
                                    <button onclick="showDetails('<?= addslashes($row['equipement']) ?>')" class="btn btn-primary btn-sm">Détails</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                    
                    <script>
                    function filterTable() {
                        const equipementFilter = document.getElementById('filterEquipement').value.toLowerCase();
                        const salleFilter = document.getElementById('filterSalle').value.toLowerCase();
                        const rows = document.querySelectorAll('#historiqueTable tr:not(:first-child)');
                        
                        rows.forEach(row => {
                            const equipement = row.dataset.equipement;
                            const salles = row.dataset.salles;
                            const showEquipement = equipement.includes(equipementFilter);
                            const showSalle = !salleFilter || salles.includes(salleFilter);
                            
                            row.style.display = (showEquipement && showSalle) ? '' : 'none';
                        });
                    }
                    
                    function showDetails(equipement) {
                        window.open('historique_details.php?equipement=' + encodeURIComponent(equipement), '_blank', 'width=800,height=600');
                    }
                    </script>
                <?php else: ?>
                    <p style="text-align: center; padding: 40px; color: #999;">Aucun historique disponible</p>
                <?php endif; ?>
            </div>
            
            <!-- Statistiques générales -->
            <div class="card">
                <h3>📊 Statistiques générales</h3>
                <?php
                $stats_query = "SELECT 
                    COUNT(DISTINCT equipement) as nb_equipements,
                    COUNT(*) as total_incidents,
                    AVG(CASE WHEN statut = 'resolu' AND date_resolution IS NOT NULL 
                        THEN DATEDIFF(date_resolution, date_incident) ELSE NULL END) as temps_moyen_global,
                    COUNT(CASE WHEN statut = 'resolu' THEN 1 END) as total_resolus
                    FROM $table WHERE equipement IS NOT NULL AND equipement != ''";
                $stats = $DB->query($stats_query)->fetch_assoc();
                $taux_global = $stats['total_incidents'] > 0 ? round(($stats['total_resolus'] / $stats['total_incidents']) * 100) : 0;
                ?>
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px;">
                    <div style="background: #17a2b8; color: white; padding: 15px; border-radius: 8px; text-align: center;">
                        <h4 style="margin: 0; font-size: 24px;"><?= $stats['nb_equipements'] ?></h4>
                        <p style="margin: 5px 0 0 0;">Équipements suivis</p>
                    </div>
                    <div style="background: #6c757d; color: white; padding: 15px; border-radius: 8px; text-align: center;">
                        <h4 style="margin: 0; font-size: 24px;"><?= $stats['total_incidents'] ?></h4>
                        <p style="margin: 5px 0 0 0;">Total incidents</p>
                    </div>
                    <div style="background: #28a745; color: white; padding: 15px; border-radius: 8px; text-align: center;">
                        <h4 style="margin: 0; font-size: 24px;"><?= $taux_global ?>%</h4>
                        <p style="margin: 5px 0 0 0;">Taux résolution</p>
                    </div>
                    <div style="background: #fd7e14; color: white; padding: 15px; border-radius: 8px; text-align: center;">
                        <h4 style="margin: 0; font-size: 24px;"><?= $stats['temps_moyen_global'] ? round($stats['temps_moyen_global'], 1) : 0 ?> j</h4>
                        <p style="margin: 5px 0 0 0;">Temps moyen</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
