<?php

include('../../../inc/includes.php');

global $DB;

$table = 'glpi_incidentsalles';

// Vérifier les incidents critiques
$critiques = $DB->query("SELECT COUNT(*) as c FROM $table WHERE statut != 'resolu' AND priorite = 'critique'")->fetch_assoc()['c'];

// Vérifier les incidents > 7 jours
$retard = $DB->query("SELECT COUNT(*) as c FROM $table WHERE statut != 'resolu' AND DATEDIFF(NOW(), date_incident) > 7")->fetch_assoc()['c'];

// Vérifier les incidents > 14 jours (urgence maximale)
$urgence = $DB->query("SELECT COUNT(*) as c FROM $table WHERE statut != 'resolu' AND DATEDIFF(NOW(), date_incident) > 14")->fetch_assoc()['c'];

$alertes = [];

if ($critiques > 0) {
    $alertes[] = [
        'type' => 'critique',
        'count' => $critiques,
        'message' => "$critiques incident(s) critique(s) nécessite(nt) une intervention immédiate",
        'color' => '#dc3545'
    ];
}

if ($urgence > 0) {
    $alertes[] = [
        'type' => 'urgence',
        'count' => $urgence,
        'message' => "$urgence incident(s) non résolu(s) depuis plus de 14 jours",
        'color' => '#fd7e14'
    ];
} elseif ($retard > 0) {
    $alertes[] = [
        'type' => 'retard',
        'count' => $retard,
        'message' => "$retard incident(s) en retard (> 7 jours)",
        'color' => '#ffc107'
    ];
}

// Retourner les alertes en JSON pour AJAX
if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    echo json_encode($alertes);
    exit;
}

// Affichage HTML
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alertes Incidents</title>
    <style>
        .alert-popup { 
            position: fixed; 
            top: 20px; 
            right: 20px; 
            z-index: 9999; 
            max-width: 400px;
            animation: slideIn 0.5s ease-out;
        }
        .alert-item { 
            background: white; 
            border-left: 5px solid; 
            padding: 15px; 
            margin-bottom: 10px; 
            border-radius: 4px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .close-btn { 
            float: right; 
            cursor: pointer; 
            font-weight: bold; 
            color: #999;
        }
    </style>
</head>
<body>
    <?php if (!empty($alertes)): ?>
        <div class="alert-popup" id="alertPopup">
            <?php foreach ($alertes as $alerte): ?>
                <div class="alert-item" style="border-left-color: <?= $alerte['color'] ?>">
                    <span class="close-btn" onclick="closeAlert()">&times;</span>
                    <strong>🚨 Alerte <?= ucfirst($alerte['type']) ?></strong><br>
                    <?= $alerte['message'] ?>
                    <br><br>
                    <a href="incident.php?tab=alerts" style="color: <?= $alerte['color'] ?>; text-decoration: none;">
                        ➡️ Voir les détails
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        
        <script>
        function closeAlert() {
            document.getElementById('alertPopup').style.display = 'none';
        }
        
        // Auto-fermeture après 10 secondes pour les alertes non critiques
        <?php if (!in_array('critique', array_column($alertes, 'type'))): ?>
        setTimeout(closeAlert, 10000);
        <?php endif; ?>
        </script>
    <?php endif; ?>
    
    <div style="padding: 20px;">
        <h2>🚨 Système d'Alertes</h2>
        
        <?php if (empty($alertes)): ?>
            <p style="color: green;">✅ Aucune alerte active</p>
        <?php else: ?>
            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px;">
                <h3>Alertes actives :</h3>
                <?php foreach ($alertes as $alerte): ?>
                    <div style="background: <?= $alerte['color'] ?>; color: white; padding: 10px; margin: 10px 0; border-radius: 4px;">
                        <strong><?= $alerte['message'] ?></strong>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <hr>
        <p><a href="incident.php">← Retour aux incidents</a></p>
    </div>
</body>
</html>