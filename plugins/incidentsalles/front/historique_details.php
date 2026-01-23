<?php

include('../../../inc/includes.php');

global $DB;

$table = 'glpi_incidentsalles';
$equipement = $_GET['equipement'] ?? '';

if (empty($equipement)) {
    echo "Équipement non spécifié";
    exit;
}

$equipement_escaped = $DB->escape($equipement);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Historique - <?= htmlspecialchars($equipement) ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: bold; }
        .badge { padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: bold; }
        .badge-ouvert { background: #fee; color: #c00; }
        .badge-en_cours { background: #ffeaa7; color: #d63031; }
        .badge-resolu { background: #d4edda; color: #155724; }
        .badge-critique { background: #dc3545; color: white; }
        .badge-haute { background: #fd7e14; color: white; }
        .badge-normale { background: #17a2b8; color: white; }
        .badge-basse { background: #6c757d; color: white; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin: 20px 0; }
        .stat-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px; border-radius: 8px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2>📋 Historique détaillé : <?= htmlspecialchars($equipement) ?></h2>
        
        <?php
        // Statistiques de l'équipement
        $stats_query = "SELECT 
            COUNT(*) as total_incidents,
            COUNT(CASE WHEN statut = 'resolu' THEN 1 END) as resolus,
            COUNT(CASE WHEN statut = 'ouvert' THEN 1 END) as ouverts,
            COUNT(CASE WHEN statut = 'en_cours' THEN 1 END) as en_cours,
            AVG(CASE WHEN statut = 'resolu' AND date_resolution IS NOT NULL 
                THEN DATEDIFF(date_resolution, date_incident) ELSE NULL END) as temps_moyen,
            MIN(date_incident) as premier_incident,
            MAX(date_incident) as dernier_incident,
            GROUP_CONCAT(DISTINCT salle ORDER BY salle) as salles
            FROM $table 
            WHERE equipement = '$equipement_escaped'";
        
        $stats = $DB->query($stats_query)->fetch_assoc();
        $taux_resolution = $stats['total_incidents'] > 0 ? round(($stats['resolus'] / $stats['total_incidents']) * 100) : 0;
        ?>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3 style="margin: 0; font-size: 24px;"><?= $stats['total_incidents'] ?></h3>
                <p style="margin: 5px 0 0 0;">Total incidents</p>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <h3 style="margin: 0; font-size: 24px;"><?= $taux_resolution ?>%</h3>
                <p style="margin: 5px 0 0 0;">Taux résolution</p>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #fd7e14 0%, #e55a00 100%);">
                <h3 style="margin: 0; font-size: 24px;"><?= $stats['temps_moyen'] ? round($stats['temps_moyen'], 1) : 0 ?> j</h3>
                <p style="margin: 5px 0 0 0;">Temps moyen</p>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%);">
                <h3 style="margin: 0; font-size: 24px;"><?= $stats['ouverts'] + $stats['en_cours'] ?></h3>
                <p style="margin: 5px 0 0 0;">Non résolus</p>
            </div>
        </div>
        
        <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <strong>Informations générales :</strong><br>
            <strong>Salles concernées :</strong> <?= htmlspecialchars($stats['salles']) ?><br>
            <strong>Premier incident :</strong> <?= date('d/m/Y', strtotime($stats['premier_incident'])) ?><br>
            <strong>Dernier incident :</strong> <?= date('d/m/Y', strtotime($stats['dernier_incident'])) ?>
        </div>
        
        <h3>📜 Historique complet des incidents</h3>
        
        <?php
        $incidents_query = "SELECT i.*, u.name as user_name,
            CASE WHEN i.statut = 'resolu' AND i.date_resolution IS NOT NULL 
                 THEN DATEDIFF(i.date_resolution, i.date_incident) 
                 ELSE DATEDIFF(NOW(), i.date_incident) END as duree
            FROM $table i
            LEFT JOIN glpi_users u ON i.users_id = u.id
            WHERE i.equipement = '$equipement_escaped'
            ORDER BY i.date_incident DESC";
        
        $incidents = $DB->query($incidents_query);
        ?>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Salle</th>
                <th>Type</th>
                <th>Priorité</th>
                <th>Statut</th>
                <th>Durée</th>
                <th>Utilisateur</th>
                <th>Description</th>
            </tr>
            <?php while ($incident = $DB->fetchAssoc($incidents)): ?>
                <tr>
                    <td><?= $incident['id'] ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($incident['date_incident'])) ?></td>
                    <td><?= htmlspecialchars($incident['salle']) ?></td>
                    <td><?= htmlspecialchars($incident['type_incident']) ?></td>
                    <td><span class="badge badge-<?= $incident['priorite'] ?>"><?= strtoupper($incident['priorite']) ?></span></td>
                    <td><span class="badge badge-<?= $incident['statut'] ?>"><?= strtoupper($incident['statut']) ?></span></td>
                    <td><?= $incident['duree'] ?> j</td>
                    <td><?= htmlspecialchars($incident['user_name'] ?? 'N/A') ?></td>
                    <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;" title="<?= htmlspecialchars($incident['description']) ?>">
                        <?= htmlspecialchars(substr($incident['description'], 0, 50)) ?><?= strlen($incident['description']) > 50 ? '...' : '' ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        
        <div style="margin-top: 20px; text-align: center;">
            <button onclick="window.close()" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Fermer
            </button>
        </div>
    </div>
</body>
</html>