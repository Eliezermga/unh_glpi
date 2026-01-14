<?php

include('../../../inc/includes.php');

Session::checkRight('user', READ);

Html::header('Accès et sécurité des utilisateurs', $_SERVER['PHP_SELF'], 'tools', 'PluginAccesssecuriteMenu');

global $DB;

$tab = $_GET['tab'] ?? 'users';

echo "<div class='center'>";
echo "<ul class='nav nav-tabs' style='margin-bottom: 20px;'>";
echo "<li class='nav-item'><a class='nav-link " . ($tab == 'users' ? 'active' : '') . "' href='?tab=users'>Utilisateurs actifs</a></li>";
echo "<li class='nav-item'><a class='nav-link " . ($tab == 'profiles' ? 'active' : '') . "' href='?tab=profiles'>Profils et droits</a></li>";
echo "<li class='nav-item'><a class='nav-link " . ($tab == 'sessions' ? 'active' : '') . "' href='?tab=sessions'>Sessions actives</a></li>";
echo "<li class='nav-item'><a class='nav-link " . ($tab == 'logs' ? 'active' : '') . "' href='?tab=logs'>Logs de connexion</a></li>";
echo "</ul>";
echo "</div>";

// TAB: Utilisateurs actifs
if ($tab == 'users') {
    echo "<div class='center'>";
    echo "<h2>Liste des utilisateurs actifs</h2>";
    
    $query = "SELECT u.id, u.name, u.realname, u.firstname, u.is_active, u.last_login, 
              p.name as profile_name, u.authtype
              FROM glpi_users u
              LEFT JOIN glpi_profiles_users pu ON u.id = pu.users_id
              LEFT JOIN glpi_profiles p ON pu.profiles_id = p.id
              WHERE u.is_deleted = 0
              ORDER BY u.is_active DESC, u.last_login DESC";
    
    $result = $DB->query($query);
    
    echo "<table class='tab_cadre_fixehov'>";
    echo "<tr class='tab_bg_2'>";
    echo "<th>ID</th><th>Login</th><th>Nom complet</th><th>Profil</th>";
    echo "<th>Type auth</th><th>Dernière connexion</th><th>Statut</th>";
    echo "</tr>";
    
    while ($row = $DB->fetchAssoc($result)) {
        $fullname = trim(($row['firstname'] ?? '') . ' ' . ($row['realname'] ?? ''));
        if (empty($fullname)) $fullname = '-';
        
        $status = $row['is_active'] ? "<span style='color: green;'>✓ Actif</span>" : "<span style='color: red;'>✗ Inactif</span>";
        $last_login = $row['last_login'] ? date('d/m/Y H:i', strtotime($row['last_login'])) : 'Jamais';
        
        $authtype_labels = [
            1 => 'Local',
            2 => 'LDAP',
            3 => 'Mail',
            4 => 'External',
            5 => 'CAS',
            6 => 'X509'
        ];
        $authtype = $authtype_labels[$row['authtype']] ?? 'Inconnu';
        
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td><b>" . htmlspecialchars($row['name']) . "</b></td>";
        echo "<td>" . htmlspecialchars($fullname) . "</td>";
        echo "<td>" . htmlspecialchars($row['profile_name'] ?? '-') . "</td>";
        echo "<td>" . $authtype . "</td>";
        echo "<td>" . $last_login . "</td>";
        echo "<td>" . $status . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "</div>";
}

// TAB: Profils et droits
if ($tab == 'profiles') {
    echo "<div class='center'>";
    echo "<h2>Profils et leurs droits</h2>";
    
    $query = "SELECT p.id, p.name, p.interface, COUNT(pu.users_id) as nb_users
              FROM glpi_profiles p
              LEFT JOIN glpi_profiles_users pu ON p.id = pu.profiles_id
              GROUP BY p.id
              ORDER BY p.name";
    
    $result = $DB->query($query);
    
    echo "<table class='tab_cadre_fixehov'>";
    echo "<tr class='tab_bg_2'>";
    echo "<th>ID</th><th>Nom du profil</th><th>Interface</th><th>Nombre d'utilisateurs</th><th>Actions</th>";
    echo "</tr>";
    
    while ($row = $DB->fetchAssoc($result)) {
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td><b>" . htmlspecialchars($row['name']) . "</b></td>";
        echo "<td>" . htmlspecialchars($row['interface']) . "</td>";
        echo "<td><b>" . $row['nb_users'] . "</b></td>";
        echo "<td><a href='../../../front/profile.form.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary'>Voir détails</a></td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "</div>";
}

// TAB: Sessions actives
if ($tab == 'sessions') {
    echo "<div class='center'>";
    echo "<h2>Sessions utilisateurs actives</h2>";
    
    $query = "SELECT u.id, u.name, u.realname, u.firstname, u.last_login
              FROM glpi_users u
              WHERE u.is_deleted = 0 
              AND u.is_active = 1
              AND u.last_login >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
              ORDER BY u.last_login DESC";
    
    $result = $DB->query($query);
    $nb = $DB->numrows($result);
    
    echo "<p><b>$nb utilisateur(s) connecté(s) dans les dernières 24 heures</b></p>";
    
    echo "<table class='tab_cadre_fixehov'>";
    echo "<tr class='tab_bg_2'>";
    echo "<th>ID</th><th>Login</th><th>Nom complet</th><th>Dernière activité</th><th>Durée</th>";
    echo "</tr>";
    
    while ($row = $DB->fetchAssoc($result)) {
        $fullname = trim(($row['firstname'] ?? '') . ' ' . ($row['realname'] ?? ''));
        if (empty($fullname)) $fullname = '-';
        
        $last_login = strtotime($row['last_login']);
        $duration = time() - $last_login;
        $hours = floor($duration / 3600);
        $minutes = floor(($duration % 3600) / 60);
        $duration_str = $hours . "h " . $minutes . "min";
        
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td><b>" . htmlspecialchars($row['name']) . "</b></td>";
        echo "<td>" . htmlspecialchars($fullname) . "</td>";
        echo "<td>" . date('d/m/Y H:i:s', $last_login) . "</td>";
        echo "<td>Il y a " . $duration_str . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "</div>";
}

// TAB: Logs de connexion
if ($tab == 'logs') {
    echo "<div class='center'>";
    echo "<h2>Historique des connexions (30 derniers jours)</h2>";
    
    $query = "SELECT l.id, l.date_mod, l.user_name, l.itemtype, l.items_id, l.old_value, l.new_value
              FROM glpi_logs l
              WHERE l.itemtype = 'User'
              AND l.date_mod >= DATE_SUB(NOW(), INTERVAL 30 DAY)
              AND (l.old_value LIKE '%login%' OR l.new_value LIKE '%login%' OR l.linked_action = 1)
              ORDER BY l.date_mod DESC
              LIMIT 100";
    
    $result = $DB->query($query);
    
    // Afficher les tentatives de connexion récentes
    $query2 = "SELECT u.name, u.last_login, COUNT(*) as nb_connexions
               FROM glpi_users u
               WHERE u.last_login >= DATE_SUB(NOW(), INTERVAL 7 DAY)
               GROUP BY u.id
               ORDER BY nb_connexions DESC
               LIMIT 20";
    
    $result2 = $DB->query($query2);
    
    echo "<h3>Top 20 des utilisateurs les plus actifs (7 derniers jours)</h3>";
    echo "<table class='tab_cadre_fixehov' style='width: 60%; margin: auto;'>";
    echo "<tr class='tab_bg_2'><th>Utilisateur</th><th>Dernière connexion</th></tr>";
    
    while ($row = $DB->fetchAssoc($result2)) {
        echo "<tr class='tab_bg_1'>";
        echo "<td><b>" . htmlspecialchars($row['name']) . "</b></td>";
        echo "<td>" . date('d/m/Y H:i', strtotime($row['last_login'])) . "</td>";
        echo "</tr>";
    }
    
    echo "</table><br><br>";
    
    // Statistiques globales
    $stats_query = "SELECT 
                    COUNT(DISTINCT id) as total_users,
                    COUNT(DISTINCT CASE WHEN is_active = 1 THEN id END) as active_users,
                    COUNT(DISTINCT CASE WHEN last_login >= DATE_SUB(NOW(), INTERVAL 7 DAY) THEN id END) as users_7days,
                    COUNT(DISTINCT CASE WHEN last_login >= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN id END) as users_30days
                    FROM glpi_users
                    WHERE is_deleted = 0";
    
    $stats = $DB->query($stats_query);
    $stat_row = $DB->fetchAssoc($stats);
    
    echo "<h3>Statistiques globales</h3>";
    echo "<table class='tab_cadre_fixehov' style='width: 60%; margin: auto;'>";
    echo "<tr class='tab_bg_1'><td>Total utilisateurs</td><td><b>" . $stat_row['total_users'] . "</b></td></tr>";
    echo "<tr class='tab_bg_1'><td>Utilisateurs actifs</td><td><b>" . $stat_row['active_users'] . "</b></td></tr>";
    echo "<tr class='tab_bg_1'><td>Connectés (7 jours)</td><td><b>" . $stat_row['users_7days'] . "</b></td></tr>";
    echo "<tr class='tab_bg_1'><td>Connectés (30 jours)</td><td><b>" . $stat_row['users_30days'] . "</b></td></tr>";
    echo "</table>";
    
    echo "</div>";
}

Html::footer();
