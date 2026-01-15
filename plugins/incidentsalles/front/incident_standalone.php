<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../../../inc/includes.php');

global $DB;

$table = 'glpi_plugin_incidentsalles_incidents';

// Vérifier si la table existe
if (!$DB->tableExists($table)) {
    echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Erreur</title></head><body>";
    echo "<h1 style='color: red;'>❌ La table n'existe pas</h1>";
    echo "<p>La table <code>$table</code> n'existe pas dans la base de données.</p>";
    echo "<p><a href='migrate.php' style='padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 4px;'>Créer la table maintenant</a></p>";
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
    $equipement = $DB->escape($_POST['equipement'] ?? '');
    $priorite = $DB->escape($_POST['priorite'] ?? 'normale');
    $users_id = Session::getLoginUserID();
    $date_incident = date('Y-m-d H:i:s');

    if (!empty($salle) && !empty($type_incident) && !empty($description)) {
        $query = "INSERT INTO $table 
                  (users_id, salle, laboratoire, type_incident, description, date_incident, heure_incident, equipement, priorite, statut, date_creation) 
                  VALUES ($users_id, '$salle', '$laboratoire', '$type_incident', '$description', '$date_incident', '$heure_incident', '$equipement', '$priorite', 'ouvert', NOW())";
        
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
    
    $query = "UPDATE $table SET statut = '$statut', date_resolution = $date_resolution, date_modification = NOW() WHERE id = $id";
    
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
        
        <ul class="tabs">
            <li><a href="?tab=form" class="<?= $tab == 'form' ? 'active' : '' ?>">📝 Déclarer un incident</a></li>
            <li><a href="?tab=list" class="<?= $tab == 'list' ? 'active' : '' ?>">📋 Liste des incidents</a></li>
            <li><a href="?tab=stats" class="<?= $tab == 'stats' ? 'active' : '' ?>">📊 Statistiques</a></li>
        </ul>
        
        <?php if ($tab == 'form'): ?>
            <div class="card">
                <h3>Déclarer un nouvel incident</h3>
                <form method="post">
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
        
        <?php if ($tab == 'list'): ?>
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
                            <th>Salle/Labo</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Priorité</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                        <?php while ($row = $DB->fetchAssoc($result)): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['salle'] . ($row['laboratoire'] ? " / " . $row['laboratoire'] : "") ?></td>
                                <td><?= $row['type_incident'] ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($row['date_incident'])) ?></td>
                                <td><span class="badge badge-<?= $row['priorite'] ?>"><?= strtoupper($row['priorite']) ?></span></td>
                                <td><span class="badge badge-<?= $row['statut'] ?>"><?= strtoupper($row['statut']) ?></span></td>
                                <td>
                                    <?php if ($row['statut'] != 'resolu'): ?>
                                        <form method="post" style="display: inline;">
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
        
        <?php if ($tab == 'stats'): ?>
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
    </div>
</body>
</html>
