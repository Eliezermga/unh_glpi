<?php

include('../../../inc/includes.php');

Session::checkRight('config', READ);

Html::header('Gestion des Incidents en Salles', $_SERVER['PHP_SELF'], 'tools', 'PluginIncidentsallesMenu');

global $DB;

// CSS personnalisé
echo "<style>
.incident-card { background: #fff; border-radius: 8px; padding: 20px; margin: 20px auto; max-width: 1400px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); animation: fadeIn 0.5s; }
.incident-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; border-radius: 8px 8px 0 0; margin: -20px -20px 20px -20px; }
.incident-header h2 { margin: 0; font-size: 24px; }
.stat-box { background: #f8f9fa; border-left: 4px solid #667eea; padding: 15px; margin: 10px 0; border-radius: 4px; transition: transform 0.3s, box-shadow 0.3s; cursor: pointer; }
.stat-box:hover { transform: translateY(-5px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
.stat-box h3 { margin: 0 0 10px 0; color: #667eea; font-size: 18px; }
.badge-status { padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase; }
.badge-ouvert { background: #fee; color: #c00; }
.badge-en_cours { background: #ffeaa7; color: #d63031; }
.badge-resolu { background: #d4edda; color: #155724; }
.alert-danger { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 4px; margin: 15px 0; }
.alert-success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 4px; margin: 15px 0; }
.form-control-custom { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; transition: all 0.3s; }
.form-control-custom:focus { border-color: #667eea; outline: none; box-shadow: 0 0 0 3px rgba(102,126,234,0.1); }
.btn-custom { background: #667eea; color: white; padding: 12px 30px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: 600; transition: all 0.3s; }
.btn-custom:hover { background: #5568d3; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(102,126,234,0.4); }
.stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin: 20px 0; }
.nav-tabs-custom { border-bottom: 2px solid #667eea; margin-bottom: 30px; }
.nav-tabs-custom .nav-link { color: #666; padding: 12px 24px; border: none; border-bottom: 3px solid transparent; transition: all 0.3s; }
.nav-tabs-custom .nav-link:hover { color: #667eea; background: #f8f9fa; }
.nav-tabs-custom .nav-link.active { color: #667eea; border-bottom-color: #667eea; font-weight: 600; }
.tab_bg_1:hover { background-color: #f8f9fa !important; }
button[name='change_statut'] { transition: all 0.2s; }
button[name='change_statut']:hover { transform: scale(1.1); }
@keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>

<script>
function filterTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toUpperCase();
    const table = document.querySelector('.tab_cadre_fixehov');
    const tr = table.getElementsByTagName('tr');
    
    for (let i = 1; i < tr.length; i++) {
        const td = tr[i].getElementsByTagName('td');
        let found = false;
        for (let j = 0; j < td.length; j++) {
            if (td[j]) {
                const txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }
        tr[i].style.display = found ? '' : 'none';
    }
}

function confirmStatusChange(form) {
    const select = form.querySelector('select[name=\"statut\"]');
    if (select.value === 'resolu') {
        return confirm('Êtes-vous sûr de vouloir marquer cet incident comme résolu ?');
    }
    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    const statBoxes = document.querySelectorAll('.stat-box');
    statBoxes.forEach((box, index) => {
        box.style.animationDelay = (index * 0.1) + 's';
    });
    
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        if (form.querySelector('button[name=\"change_statut\"]')) {
            form.addEventListener('submit', function(e) {
                if (!confirmStatusChange(this)) {
                    e.preventDefault();
                }
            });
        }
    });
});
</script>";

// Traitement changement de statut
if (isset($_POST['change_statut'])) {
    $id = intval($_POST['incident_id']);
    $statut = $_POST['statut'];
    $date_resolution = ($statut == 'resolu') ? date('Y-m-d H:i:s') : null;
    
    $query = "UPDATE glpi_incidentsalles SET statut = ?, date_resolution = ? WHERE id = ?";
    $stmt = $DB->prepare($query);
    $stmt->bind_param('ssi', $statut, $date_resolution, $id);
    $stmt->execute();
    $stmt->close();
    Session::addMessageAfterRedirect('Statut mis à jour', false, INFO);
    Html::redirect($_SERVER['PHP_SELF']);
}

// Traitement du formulaire
if (isset($_POST['submit_incident'])) {
    $salle = $_POST['salle'] ?? '';
    $type_incident = $_POST['type_incident'] ?? '';
    $description = $_POST['description'] ?? '';
    $heure_incident = $_POST['heure_incident'] ?? date('H:i');
    $equipement = $_POST['equipement'] ?? '';
    $user_id = Session::getLoginUserID();
    $date_incident = date('Y-m-d H:i:s');

    if (!empty($salle) && !empty($type_incident) && !empty($description)) {
        $query = "INSERT INTO glpi_incidentsalles 
                  (user_id, salle, type_incident, description, date_incident, heure_incident, equipement, statut) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, 'ouvert')";
        
        $stmt = $DB->prepare($query);
        $stmt->bind_param('issssss', $user_id, $salle, $type_incident, $description, $date_incident, $heure_incident, $equipement);
        
        if ($stmt->execute()) {
            Session::addMessageAfterRedirect('Incident enregistré avec succès', false, INFO);
        } else {
            Session::addMessageAfterRedirect('Erreur lors de l\'enregistrement', false, ERROR);
        }
        $stmt->close();
        Html::redirect($_SERVER['PHP_SELF'] . '?tab=list');
    } else {
        Session::addMessageAfterRedirect('Tous les champs obligatoires doivent être remplis', false, ERROR);
    }
}

// Onglets
$tab = $_GET['tab'] ?? 'form';

echo "<div class='incident-card'>";
echo "<ul class='nav nav-tabs nav-tabs-custom'>";
echo "<li class='nav-item'><a class='nav-link " . ($tab == 'form' ? 'active' : '') . "' href='?tab=form'>Déclarer un incident</a></li>";
echo "<li class='nav-item'><a class='nav-link " . ($tab == 'list' ? 'active' : '') . "' href='?tab=list'>Liste des incidents</a></li>";
echo "<li class='nav-item'><a class='nav-link " . ($tab == 'stats' ? 'active' : '') . "' href='?tab=stats'>Statistiques</a></li>";
echo "<li class='nav-item'><a class='nav-link " . ($tab == 'alerts' ? 'active' : '') . "' href='?tab=alerts'>Alertes</a></li>";
echo "</ul>";

// TAB: Formulaire
if ($tab == 'form') {
    echo "<div class='incident-header'>";
    echo "<h2>Déclarer un Nouvel Incident</h2>";
    echo "<p style='margin: 10px 0 0 0; opacity: 0.9;'>Remplissez le formulaire ci-dessous pour signaler un incident</p>";
    echo "</div>";
    echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "?tab=form'>";
    echo "<table class='tab_cadre_fixe' style='width: 100%;'>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td style='width: 200px; font-weight: 600;'>Salle * :</td>";
    echo "<td><input type='text' name='salle' class='form-control-custom' placeholder='Ex: Salle A101' required /></td>";
    echo "</tr>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td style='font-weight: 600;'>Type d'incident * :</td>";
    echo "<td><select name='type_incident' required class='form-control-custom'>";
    echo "<option value=''>-- Sélectionner un type --</option>";
    echo "<option value='Matériel défectueux'>Matériel défectueux</option>";
    echo "<option value='Problème réseau'>Problème réseau</option>";
    echo "<option value='Logiciel'>Logiciel</option>";
    echo "<option value='Électricité'>Électricité</option>";
    echo "<option value='Climatisation'>Climatisation</option>";
    echo "<option value='Autre'>Autre</option>";
    echo "</select></td>";
    echo "</tr>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td style='font-weight: 600;'>Équipement concerné :</td>";
    echo "<td><input type='text' name='equipement' class='form-control-custom' placeholder='Ex: PC-15, Projecteur, Switch...' /></td>";
    echo "</tr>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td style='font-weight: 600;'>Heure de l'incident :</td>";
    echo "<td><input type='time' name='heure_incident' class='form-control-custom' value='" . date('H:i') . "' /></td>";
    echo "</tr>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td style='font-weight: 600; vertical-align: top; padding-top: 15px;'>Description * :</td>";
    echo "<td><textarea name='description' rows='5' class='form-control-custom' placeholder='Décrivez l\'incident en détail...' required></textarea></td>";
    echo "</tr>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td colspan='2' class='center' style='padding: 20px;'>";
    echo "<button type='submit' name='submit_incident' class='btn-custom'>Enregistrer l'incident</button>";
    echo "</td>";
    echo "</tr>";
    
    echo "</table>";
    Html::closeForm();
}

// TAB: Liste
if ($tab == 'list') {
    echo "<div class='incident-header'>";
    echo "<h2>Liste Complète des Incidents</h2>";
    echo "<p style='margin: 10px 0 0 0; opacity: 0.9;'>Gestion et suivi de tous les incidents déclarés</p>";
    echo "</div>";
    
    echo "<div style='margin: 20px 0;'>";
    echo "<input type='text' id='searchInput' onkeyup='filterTable()' placeholder='Rechercher un incident (salle, type, équipement...)' style='width: 100%; padding: 12px; border: 2px solid #667eea; border-radius: 4px; font-size: 14px;' />";
    echo "</div>";
    
    $query = "SELECT i.*, u.name as user_name, u.realname, u.firstname 
              FROM glpi_incidentsalles i 
              LEFT JOIN glpi_users u ON i.user_id = u.id 
              ORDER BY i.date_incident DESC";
    
    $result = $DB->query($query);
    
    if ($DB->numrows($result) > 0) {
        echo "<table class='tab_cadre_fixehov' style='width: 100%;'>";
        echo "<tr class='tab_bg_2'>";
        echo "<th style='width: 50px;'>ID</th><th>Salle</th><th>Type</th><th>Équipement</th><th>Description</th>";
        echo "<th style='width: 130px;'>Date/Heure</th><th>Utilisateur</th><th style='width: 100px;'>Statut</th><th style='width: 180px;'>Action</th>";
        echo "</tr>";
        
        while ($row = $DB->fetchAssoc($result)) {
            $user_display = trim(($row['firstname'] ?? '') . ' ' . ($row['realname'] ?? ''));
            if (empty($user_display)) $user_display = $row['user_name'] ?? 'Inconnu';
            
            $badge_class = "badge-" . $row['statut'];
            
            echo "<tr class='tab_bg_1'>";
            echo "<td style='text-align: center; font-weight: bold;'>" . $row['id'] . "</td>";
            echo "<td><b>" . htmlspecialchars($row['salle']) . "</b></td>";
            echo "<td>" . htmlspecialchars($row['type_incident']) . "</td>";
            echo "<td>" . htmlspecialchars($row['equipement'] ?? '-') . "</td>";
            echo "<td style='max-width: 300px;'>" . htmlspecialchars(substr($row['description'], 0, 60)) . "...</td>";
            echo "<td>" . date('d/m/Y', strtotime($row['date_incident'])) . "<br><small>" . $row['heure_incident'] . "</small></td>";
            echo "<td>" . htmlspecialchars($user_display) . "</td>";
            echo "<td><span class='badge-status $badge_class'>" . $row['statut'] . "</span></td>";
            echo "<td>";
            echo "<form method='post' style='display:flex; gap: 5px;'>";
            echo "<input type='hidden' name='incident_id' value='" . $row['id'] . "' />";
            echo "<select name='statut' style='padding: 5px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px;'>";
            echo "<option value='ouvert' " . ($row['statut'] == 'ouvert' ? 'selected' : '') . ">Ouvert</option>";
            echo "<option value='en_cours' " . ($row['statut'] == 'en_cours' ? 'selected' : '') . ">En cours</option>";
            echo "<option value='resolu' " . ($row['statut'] == 'resolu' ? 'selected' : '') . ">Résolu</option>";
            echo "</select>";
            echo "<button type='submit' name='change_statut' style='padding: 5px 15px; background: #667eea; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px;'>OK</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "<div class='alert-success'>Aucun incident enregistré pour le moment.</div>";
    }
}

// TAB: Statistiques
if ($tab == 'stats') {
    echo "<div class='incident-header'>";
    echo "<h2>Statistiques et Analyses</h2>";
    echo "<p style='margin: 10px 0 0 0; opacity: 0.9;'>Analyse détaillée des incidents par salle, type et période</p>";
    echo "</div>";
    
    $query = "SELECT salle, COUNT(*) as nb FROM glpi_incidentsalles GROUP BY salle ORDER BY nb DESC LIMIT 10";
    $result = $DB->query($query);
    
    echo "<div class='stat-box'><h3>Top 10 des salles les plus touchées</h3></div>";
    echo "<table class='tab_cadre_fixehov' style='width: 100%;'>";
    echo "<tr class='tab_bg_2'><th>Salle</th><th style='width: 150px;'>Nombre d'incidents</th></tr>";
    while ($row = $DB->fetchAssoc($result)) {
        echo "<tr class='tab_bg_1'><td>" . htmlspecialchars($row['salle']) . "</td><td><b>" . $row['nb'] . "</b></td></tr>";
    }
    echo "</table>";
    
    $query = "SELECT type_incident, COUNT(*) as nb FROM glpi_incidentsalles GROUP BY type_incident ORDER BY nb DESC";
    $result = $DB->query($query);
    
    echo "<div class='stat-box' style='margin-top: 30px;'><h3>Types d'incidents les plus fréquents</h3></div>";
    echo "<table class='tab_cadre_fixehov' style='width: 100%;'>";
    echo "<tr class='tab_bg_2'><th>Type d'incident</th><th style='width: 150px;'>Nombre</th></tr>";
    while ($row = $DB->fetchAssoc($result)) {
        echo "<tr class='tab_bg_1'><td>" . htmlspecialchars($row['type_incident']) . "</td><td><b>" . $row['nb'] . "</b></td></tr>";
    }
    echo "</table>";
    
    $query = "SELECT DATE_FORMAT(date_incident, '%Y-%m') as mois, COUNT(*) as nb 
              FROM glpi_incidentsalles 
              GROUP BY mois 
              ORDER BY mois DESC 
              LIMIT 12";
    $result = $DB->query($query);
    
    echo "<div class='stat-box' style='margin-top: 30px;'><h3>Évolution des incidents (12 derniers mois)</h3></div>";
    echo "<table class='tab_cadre_fixehov' style='width: 100%;'>";
    echo "<tr class='tab_bg_2'><th>Mois</th><th style='width: 150px;'>Nombre d'incidents</th></tr>";
    while ($row = $DB->fetchAssoc($result)) {
        echo "<tr class='tab_bg_1'><td>" . $row['mois'] . "</td><td><b>" . $row['nb'] . "</b></td></tr>";
    }
    echo "</table>";
}

// TAB: Alertes
if ($tab == 'alerts') {
    echo "<div class='incident-header'>";
    echo "<h2>Alertes et Incidents Critiques</h2>";
    echo "<p style='margin: 10px 0 0 0; opacity: 0.9;'>Incidents nécessitant une attention immédiate</p>";
    echo "</div>";
    
    $duree_max = 7;
    $date_limite = date('Y-m-d H:i:s', strtotime("-$duree_max days"));
    
    $query = "SELECT i.*, u.name as user_name, u.realname, u.firstname,
              DATEDIFF(NOW(), i.date_incident) as jours_ouverts
              FROM glpi_incidentsalles i 
              LEFT JOIN glpi_users u ON i.user_id = u.id 
              WHERE i.statut != 'resolu' AND i.date_incident < ?
              ORDER BY i.date_incident ASC";
    
    $stmt = $DB->prepare($query);
    $stmt->bind_param('s', $date_limite);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<div class='alert-danger'><strong>" . $result->num_rows . " incident(s)</strong> ouvert(s) depuis plus de <strong>$duree_max jours</strong> nécessitent une intervention urgente !</div>";
        
        echo "<table class='tab_cadre_fixehov'>";
        echo "<tr class='tab_bg_2'>";
        echo "<th>ID</th><th>Salle</th><th>Type</th><th>Équipement</th><th>Date</th><th>Jours ouverts</th><th>Statut</th>";
        echo "</tr>";
        
        while ($row = $result->fetch_assoc()) {
            $alert_level = $row['jours_ouverts'] > 14 ? 'darkred' : 'red';
            
            echo "<tr class='tab_bg_1' style='background-color: #ffe6e6;'>";
            echo "<td><b>" . $row['id'] . "</b></td>";
            echo "<td><b>" . htmlspecialchars($row['salle']) . "</b></td>";
            echo "<td>" . htmlspecialchars($row['type_incident']) . "</td>";
            echo "<td>" . htmlspecialchars($row['equipement'] ?? '-') . "</td>";
            echo "<td>" . date('d/m/Y', strtotime($row['date_incident'])) . "</td>";
            echo "<td style='color: $alert_level; font-weight: bold; font-size: 16px;'>" . $row['jours_ouverts'] . " jours</td>";
            echo "<td style='color: orange; font-weight: bold;'>" . strtoupper($row['statut']) . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "<div class='alert-success'><strong>Excellent !</strong> Aucun incident en retard. Tous les incidents sont traités dans les délais.</div>";
    }
    
    $stmt->close();
}

echo "</div>";

Html::footer();
