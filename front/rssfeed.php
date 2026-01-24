<?php

include('../inc/includes.php');

Session::checkLoginUser();

Html::header('Accès au module Outils', $_SERVER['PHP_SELF'], 'tools', 'tools_custom');

// CSS personnalisé pour la maquette moderne
echo "<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

body { font-family: 'Roboto', sans-serif; background-color: #F5F7FA; }
.modern-container { max-width: 1200px; margin: 0 auto; padding: 20px; }
.card { background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 20px; overflow: hidden; }
.card-header { background: #1e3a8a; color: white; padding: 15px; font-weight: 500; }
.card-body { padding: 20px; }
.timeline { position: relative; padding-left: 30px; }
.timeline-item { margin-bottom: 20px; position: relative; }
.timeline-item::before { content: ''; position: absolute; left: -25px; top: 5px; width: 10px; height: 10px; border-radius: 50%; background: #1e3a8a; }
.timeline-item.success::before { background: #27AE60; }
.timeline-item.warning::before { background: #f39c12; }
.timeline-item.error::before { background: #e74c3c; }
.timeline-content { background: white; padding: 10px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
.btn-primary-custom { background: #1e3a8a; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: 500; }
.btn-primary-custom:hover { background: #1e293b; }
.alert-warning-custom { background: #fff3cd; border: 1px solid #ffeaa7; color: #856404; padding: 15px; border-radius: 6px; }
.dark-mode { background-color: #1C1C1C; color: white; }
.dark-mode .card { background: #2c2c2c; color: white; }
.dark-mode .timeline-content { background: #3c3c3c; }
@media (max-width: 768px) { .modern-container { padding: 10px; } .card { margin-bottom: 15px; } }
</style>";



// Conteneur principal
echo "<div class='modern-container'>";

// Carte Utilisateurs
echo "<div class='card'>
    <div class='card-header'>
        <i class='fas fa-users'></i> Utilisateurs ayant accès au module Outils
    </div>
    <div class='card-body'>";

$query = "SELECT DISTINCT u.name, u.realname, u.firstname, u.date_creation
          FROM glpi_users u
          JOIN glpi_profiles_users pu ON pu.users_id = u.id
          JOIN glpi_profilerights pr ON pr.profiles_id = pu.profiles_id
          WHERE pr.name = 'rssfeed' AND (pr.rights & " . READ . ") > 0
          ORDER BY u.date_creation DESC, u.realname, u.firstname";

$result = $DB->query($query);
$user_count = $DB->numrows($result);

if ($user_count > 0) {
    echo "<p><strong>Total : $user_count utilisateur(s)</strong></p>";
    echo "<button onclick='location.reload()' class='btn-primary-custom' style='margin-bottom: 15px; margin-right: 10px;'><i class='fas fa-refresh'></i> Actualiser</button>";
    echo "<a href='" . $CFG_GLPI['root_doc'] . "/front/user.form.php' class='btn-primary-custom' style='margin-bottom: 15px; text-decoration: none; display: inline-block;'><i class='fas fa-plus'></i> Ajouter un utilisateur</a>";
    echo "<p style='font-size: 14px; color: #666; margin-bottom: 15px;'>Note : Seuls les utilisateurs ayant le droit 'rssfeed' dans leur profil apparaissent dans cette liste.</p>";
    echo "<ul style='list-style: none; padding: 0;'>";
    while ($data = $DB->fetch_assoc($result)) {
        $name = trim($data['realname'] . ' ' . $data['firstname']);
        if (empty($name)) {
            $name = $data['name'];
        }
        $badge = '';
        if (!empty($data['date_creation']) && strtotime($data['date_creation']) > strtotime('-1 day')) {
            $badge = "<span class='new-user-badge'>Nouveau</span>";
        }
        echo "<li style='padding: 8px 0; border-bottom: 1px solid #eee;'><i class='fas fa-user' style='color: #2F80ED; margin-right: 10px;'></i>" . htmlspecialchars($name) . $badge . "</li>";
    }
    echo "</ul>";
} else {
    echo "<div class='alert-warning-custom'>
        <i class='fas fa-exclamation-triangle'></i> Aucun utilisateur trouvé avec accès au module Outils.
        <br><a href='" . $CFG_GLPI['root_doc'] . "/front/user.form.php' class='btn-primary-custom' style='margin-top: 10px; text-decoration: none; display: inline-block;'><i class='fas fa-plus'></i> Ajouter un utilisateur</a>
    </div>";
}

echo "</div></div>";

// Carte Historique des actions
echo "<div class='card'>
    <div class='card-header'>
        <i class='fas fa-history'></i> Historique des actions
    </div>
    <div class='card-body'>
        <button onclick='location.reload()' class='btn-primary-custom' style='margin-bottom: 15px;'><i class='fas fa-refresh'></i> Actualiser</button>
        <div class='timeline'>";

// Récupérer les logs récents de la base de données avec plus de détails
$log_query = "SELECT * FROM glpi_logs ORDER BY date_mod DESC LIMIT 10";
$log_result = $DB->query($log_query);

if ($log_result && $DB->numrows($log_result) > 0) {
    while ($log_data = $DB->fetch_assoc($log_result)) {
        $date = date('Y-m-d H:i', strtotime($log_data['date_mod']));
        $user = htmlspecialchars($log_data['user_name'] ?: 'Système');
        $itemtype = htmlspecialchars($log_data['itemtype']);
        $old_value = htmlspecialchars($log_data['old_value']);
        $new_value = htmlspecialchars($log_data['new_value']);
        $message = "Utilisateur: $user | Type: $itemtype | Ancien: $old_value | Nouveau: $new_value";
        $class = 'success'; // Par défaut
        if (strpos($message, 'refusée') !== false || strpos($message, 'error') !== false) {
            $class = 'error';
        } elseif (strpos($message, 'autorisation') !== false || strpos($message, 'warning') !== false) {
            $class = 'warning';
        }
        echo "<div class='timeline-item $class'>
            <div class='timeline-content'>
                <strong>🕒 $date</strong><br>
                $message
            </div>
        </div>";
    }
} else {
    echo "<div class='timeline-item'>
        <div class='timeline-content'>
            Aucun historique récent.
        </div>
    </div>";
}

echo "</div></div></div>";



echo "</div>"; // Fin modern-container

// JavaScript pour les notifications
echo "<script>
function toggleNotifications() {
    var dropdown = document.getElementById('notificationsDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}
</script>";

Html::footer();
