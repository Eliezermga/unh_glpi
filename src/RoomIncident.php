<?php

class RoomIncident extends CommonDBTM {
    static $rightname = 'roomincident';
    
    public static function getTypeName($nb = 0) {
        return _n('Room incident', 'Room incidents', $nb);
    }
    
    public static function getTable($classname = null) {
        if ($classname === null) {
            $classname = __CLASS__;
        }
        return parent::getTable($classname);
    }
    
    public static function install(Migration $migration) {
        global $DB;
        
        $table = self::getTable();
        
        if (!$DB->tableExists($table)) {
            $query = "CREATE TABLE `$table` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(255) NOT NULL,
                `room_id` int(11) NOT NULL,
                `incident_type` varchar(50) NOT NULL,
                `description` text,
                `date` date NOT NULL,
                `time` time NOT NULL,
                `users_id` int(11) NOT NULL,
                `status` enum('new','in_progress','resolved') NOT NULL DEFAULT 'new',
                `date_creation` datetime NOT NULL,
                `date_mod` datetime DEFAULT NULL,
                `date_resolution` datetime DEFAULT NULL,
                PRIMARY KEY (`id`),
                KEY `room_id` (`room_id`),
                KEY `users_id` (`users_id`),
                KEY `status` (`status`),
                KEY `date_creation` (`date_creation`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
            
            $DB->queryOrDie($query, $DB->error());
        }
        
        return true;
    }
    
    public static function uninstall() {
        global $DB;
        
        $table = self::getTable();
        if ($DB->tableExists($table)) {
            $DB->queryOrDie("DROP TABLE `$table`", $DB->error());
        }
        
        return true;
    }
    
    public function showForm($ID, $options = []) {
        global $DB;
        
        $this->initForm($ID, $options);
        
        // Récupérer les données pour le formulaire
        $rooms = $this->getRooms();
        $users = $this->getUsers();
        $incident_types = self::getIncidentTypes();
        $statuses = self::getStatuses();
        
        echo '<div class="container-fluid">';
        echo '<div class="row">';
        echo '<div class="col-12">';
        echo '<div class="card">';
        echo '<div class="card-header">';
        echo '<h3>' . ($ID > 0 ? __('Edit incident') : __('Report an incident')) . '</h3>';
        echo '</div>';
        echo '<div class="card-body">';
        
        echo '<form method="post" action="' . $this->getFormURL() . '" data-track-changes="true">';
        echo '<input type="hidden" name="id" value="' . $ID . '">';
        
        // Ligne 1: Nom et Salle
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<div class="form-group">';
        echo '<label class="form-label">' . __('Incident title') . ' <span class="required">*</span></label>';
        echo '<input type="text" class="form-control" name="name" value="' . htmlspecialchars($this->fields['name'] ?? '') . '" required>';
        echo '</div>';
        echo '</div>';
        echo '<div class="col-md-6">';
        echo '<div class="form-group">';
        echo '<label class="form-label">' . __('Room/Laboratory') . ' <span class="required">*</span></label>';
        echo '<select class="form-control" name="room_id" required>';
        echo '<option value="">' . __('Select a room') . '</option>';
        foreach ($rooms as $room) {
            $selected = isset($this->fields['room_id']) && $this->fields['room_id'] == $room['id'] ? 'selected' : '';
            echo '<option value="' . $room['id'] . '" ' . $selected . '>' . htmlspecialchars($room['name']) . '</option>';
        }
        echo '</select>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Ligne 2: Type d'incident et Statut
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<div class="form-group">';
        echo '<label class="form-label">' . __('Incident type') . ' <span class="required">*</span></label>';
        echo '<select class="form-control" name="incident_type" required>';
        echo '<option value="">' . __('Select type') . '</option>';
        foreach ($incident_types as $type) {
            $selected = isset($this->fields['incident_type']) && $this->fields['incident_type'] == $type ? 'selected' : '';
            echo '<option value="' . $type . '" ' . $selected . '>' . __($type) . '</option>';
        }
        echo '</select>';
        echo '</div>';
        echo '</div>';
        echo '<div class="col-md-6">';
        echo '<div class="form-group">';
        echo '<label class="form-label">' . __('Status') . '</label>';
        echo '<select class="form-control" name="status">';
        foreach ($statuses as $status) {
            $selected = isset($this->fields['status']) && $this->fields['status'] == $status ? 'selected' : '';
            echo '<option value="' . $status . '" ' . $selected . '>' . self::getStatusName($status) . '</option>';
        }
        echo '</select>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Ligne 3: Date et Heure
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<div class="form-group">';
        echo '<label class="form-label">' . __('Date') . ' <span class="required">*</span></label>';
        $date_value = $this->fields['date'] ?? date('Y-m-d');
        echo '<input type="date" class="form-control" name="date" value="' . $date_value . '" required>';
        echo '</div>';
        echo '</div>';
        echo '<div class="col-md-6">';
        echo '<div class="form-group">';
        echo '<label class="form-label">' . __('Time') . ' <span class="required">*</span></label>';
        $time_value = $this->fields['time'] ?? date('H:i');
        echo '<input type="time" class="form-control" name="time" value="' . $time_value . '" required>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Ligne 4: Description
        echo '<div class="row">';
        echo '<div class="col-12">';
        echo '<div class="form-group">';
        echo '<label class="form-label">' . __('Description') . '</label>';
        echo '<textarea class="form-control" name="description" rows="4">' . htmlspecialchars($this->fields['description'] ?? '') . '</textarea>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Boutons
        echo '<div class="row">';
        echo '<div class="col-12">';
        echo '<div class="form-group">';
        if ($ID > 0) {
            echo '<button type="submit" name="update" class="btn btn-primary">' . __('Save') . '</button>';
            echo '<button type="submit" name="delete" class="btn btn-danger ml-2" onclick="return confirm(\'' . __('Are you sure?') . '\')">' . __('Delete') . '</button>';
        } else {
            echo '<button type="submit" name="add" class="btn btn-primary">' . __('Report incident') . '</button>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        return true;
    }
    
    public function getRooms() {
        global $DB;
        
        $rooms = [];
        
        // Récupérer les salles depuis la table des locations
        $query = "SELECT id, name FROM glpi_locations WHERE is_deleted = 0 ORDER BY name";
        $result = $DB->request($query);
        
        foreach ($result as $row) {
            $rooms[] = $row;
        }
        
        return $rooms;
    }
    
    public function getUsers() {
        global $DB;
        
        $users = [];
        
        $query = "SELECT id, name, realname, firstname FROM glpi_users WHERE is_deleted = 0 AND is_active = 1 ORDER BY name";
        $result = $DB->request($query);
        
        foreach ($result as $row) {
            $users[] = $row;
        }
        
        return $users;
    }
    
    public static function getIncidentTypes() {
        return [
            'hardware' => __('Hardware'),
            'software' => __('Software'),
            'network' => __('Network'),
            'power' => __('Power'),
            'other' => __('Other')
        ];
    }
    
    public static function getStatuses() {
        return ['new', 'in_progress', 'resolved'];
    }
    
    public static function getStatusName($status) {
        $names = [
            'new' => __('New'),
            'in_progress' => __('In progress'),
            'resolved' => __('Resolved')
        ];
        
        return $names[$status] ?? $status;
    }
    
    public function prepareInputForAdd($input) {
        if (isset($input['date']) && isset($input['time'])) {
            $input['date_creation'] = $input['date'] . ' ' . $input['time'] . ':00';
        }
        
        if (!isset($input['users_id'])) {
            $input['users_id'] = $_SESSION['glpiID'];
        }
        
        return $input;
    }
    
    public function prepareInputForUpdate($input) {
        if (isset($input['date']) && isset($input['time'])) {
            $input['date_mod'] = $input['date'] . ' ' . $input['time'] . ':00';
        }
        
        if (isset($input['status']) && $input['status'] == 'resolved') {
            $input['date_resolution'] = date('Y-m-d H:i:s');
        }
        
        return $input;
    }
    
    public static function getIncidentStatistics() {
        global $DB;
        
        $table = self::getTable();
        
        // Statistiques générales
        $stats = [];
        
        // Total des incidents
        $result = $DB->request([
            'SELECT' => ['COUNT' as 'total'],
            'FROM' => $table
        ]);
        
        $stats['total'] = $result->current()['total'] ?? 0;
        
        // Incidents par type
        $result = $DB->request([
            'SELECT' => ['incident_type', 'COUNT' as 'count'],
            'FROM' => $table,
            'GROUP' => 'incident_type',
            'ORDER' => 'count DESC'
        ]);
        
        $stats['by_type'] = [];
        foreach ($result as $row) {
            $stats['by_type'][$row['incident_type']] = $row['count'];
        }
        
        // Incidents par salle
        $result = $DB->request([
            'SELECT' => ['l.name as room_name', 'COUNT' as 'count'],
            'FROM' => $table,
            'LEFT JOIN' => [
                'glpi_locations' => [
                    'FKEY' => [
                        $table => 'room_id',
                        'glpi_locations' => 'id'
                    ]
                ]
            ],
            'GROUP' => 'room_id, room_name',
            'ORDER' => 'count DESC',
            'LIMIT' => 10
        ]);
        
        $stats['by_room'] = [];
        foreach ($result as $row) {
            $stats['by_room'][$row['room_name']] = $row['count'];
        }
        
        // Incidents par statut
        $result = $DB->request([
            'SELECT' => ['status', 'COUNT' as 'count'],
            'FROM' => $table,
            'GROUP' => 'status'
        ]);
        
        $stats['by_status'] = [];
        foreach ($result as $row) {
            $stats['by_status'][$row['status']] = $row['count'];
        }
        
        // Évolution mensuelle (6 derniers mois)
        $result = $DB->request([
            'SELECT' => ['DATE_FORMAT(date_creation, "%Y-%m") as month', 'COUNT' as 'count'],
            'FROM' => $table,
            'WHERE' => ['date_creation >= DATE_SUB(NOW(), INTERVAL 6 MONTH)'],
            'GROUP' => 'month',
            'ORDER' => 'month'
        ]);
        
        $stats['monthly_evolution'] = [];
        foreach ($result as $row) {
            $stats['monthly_evolution'][$row['month']] = $row['count'];
        }
        
        return $stats;
    }
    
    public static function showStatistics() {
        $stats = self::getIncidentStatistics();
        
        echo '<div class="row">';
        
        // Cartes de statistiques
        echo '<div class="col-md-3">';
        echo '<div class="card bg-primary text-white">';
        echo '<div class="card-body">';
        echo '<h4>' . $stats['total'] . '</h4>';
        echo '<p>' . __('Total incidents') . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '<div class="col-md-3">';
        echo '<div class="card bg-success text-white">';
        echo '<div class="card-body">';
        echo '<h4>' . ($stats['by_status']['resolved'] ?? 0) . '</h4>';
        echo '<p>' . __('Resolved') . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '<div class="col-md-3">';
        echo '<div class="card bg-warning text-white">';
        echo '<div class="card-body">';
        echo '<h4>' . ($stats['by_status']['in_progress'] ?? 0) . '</h4>';
        echo '<p>' . __('In progress') . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '<div class="col-md-3">';
        echo '<div class="card bg-danger text-white">';
        echo '<div class="card-body">';
        echo '<h4>' . ($stats['by_status']['new'] ?? 0) . '</h4>';
        echo '<p>' . __('New') . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '</div>';
        
        // Graphiques
        echo '<div class="row mt-4">';
        
        // Graphique par type
        echo '<div class="col-md-4">';
        echo '<div class="card">';
        echo '<div class="card-header">';
        echo '<h5>' . __('Incidents by type') . '</h5>';
        echo '</div>';
        echo '<div class="card-body">';
        echo '<canvas id="typeChart" width="400" height="300"></canvas>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Graphique par salle
        echo '<div class="col-md-4">';
        echo '<div class="card">';
        echo '<div class="card-header">';
        echo '<h5>' . __('Top 10 rooms') . '</h5>';
        echo '</div>';
        echo '<div class="card-body">';
        echo '<canvas id="roomChart" width="400" height="300"></canvas>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Évolution mensuelle
        echo '<div class="col-md-4">';
        echo '<div class="card">';
        echo '<div class="card-header">';
        echo '<h5>' . __('Monthly evolution') . '</h5>';
        echo '</div>';
        echo '<div class="card-body">';
        echo '<canvas id="evolutionChart" width="400" height="300"></canvas>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '</div>';
        
        // JavaScript pour les graphiques
        echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
        echo '<script>';
        
        // Graphique par type
        echo 'var typeCtx = document.getElementById("typeChart").getContext("2d");';
        echo 'var typeChart = new Chart(typeCtx, {';
        echo '    type: "doughnut",';
        echo '    data: {';
        echo '        labels: ' . json_encode(array_keys($stats['by_type'])) . ',';
        echo '        datasets: [{';
        echo '            data: ' . json_encode(array_values($stats['by_type'])) . ',';
        echo '            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#9966FF"]';
        echo '        }]';
        echo '    },';
        echo '    options: {';
        echo '        responsive: true,';
        echo '        maintainAspectRatio: false';
        echo '    }';
        echo '});';
        
        // Graphique par salle
        echo 'var roomCtx = document.getElementById("roomChart").getContext("2d");';
        echo 'var roomChart = new Chart(roomCtx, {';
        echo '    type: "bar",';
        echo '    data: {';
        echo '        labels: ' . json_encode(array_keys($stats['by_room'])) . ',';
        echo '        datasets: [{';
        echo '            label: "' . __('Incidents') . '",';
        echo '            data: ' . json_encode(array_values($stats['by_room'])) . ',';
        echo '            backgroundColor: "#36A2EB"';
        echo '        }]';
        echo '    },';
        echo '    options: {';
        echo '        responsive: true,';
        echo '        maintainAspectRatio: false,';
        echo '        scales: {';
        echo '            y: {';
        echo '                beginAtZero: true';
        echo '            }';
        echo '        }';
        echo '    }';
        echo '});';
        
        // Évolution mensuelle
        echo 'var evolutionCtx = document.getElementById("evolutionChart").getContext("2d");';
        echo 'var evolutionChart = new Chart(evolutionCtx, {';
        echo '    type: "line",';
        echo '    data: {';
        echo '        labels: ' . json_encode(array_keys($stats['monthly_evolution'])) . ',';
        echo '        datasets: [{';
        echo '            label: "' . __('Incidents') . '",';
        echo '            data: ' . json_encode(array_values($stats['monthly_evolution'])) . ',';
        echo '            borderColor: "#FF6384",';
        echo '            backgroundColor: "rgba(255, 99, 132, 0.2)",';
        echo '            fill: true';
        echo '        }]';
        echo '    },';
        echo '    options: {';
        echo '        responsive: true,';
        echo '        maintainAspectRatio: false,';
        echo '        scales: {';
        echo '            y: {';
        echo '                beginAtZero: true';
        echo '            }';
        echo '        }';
        echo '    }';
        echo '});';
        
        echo '</script>';
    }
    
    public static function getEquipmentHistory($room_id = null) {
        global $DB;
        
        $table = self::getTable();
        
        $where = [];
        if ($room_id) {
            $where['room_id'] = $room_id;
        }
        
        $result = $DB->request([
            'SELECT' => [
                'i.name',
                'i.incident_type',
                'i.date',
                'i.status',
                'l.name as room_name',
                'u.name as user_name'
            ],
            'FROM' => $table . ' as i',
            'LEFT JOIN' => [
                'glpi_locations' => [
                    'FKEY' => [
                        'i' => 'room_id',
                        'glpi_locations' => 'id'
                    ]
                ],
                'glpi_users' => [
                    'FKEY' => [
                        'i' => 'users_id',
                        'glpi_users' => 'id'
                    ]
                ]
            ],
            'WHERE' => $where,
            'ORDER' => 'i.date_creation DESC',
            'LIMIT' => 50
        ]);
        
        $history = [];
        foreach ($result as $row) {
            $history[] = $row;
        }
        
        return $history;
    }
    
    public static function showEquipmentHistory($room_id = null) {
        $history = self::getEquipmentHistory($room_id);
        
        echo '<div class="card">';
        echo '<div class="card-header">';
        echo '<h5>' . __('Equipment incident history') . '</h5>';
        echo '</div>';
        echo '<div class="card-body">';
        
        if (empty($history)) {
            echo '<p>' . __('No incidents found') . '</p>';
        } else {
            echo '<div class="table-responsive">';
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>' . __('Date') . '</th>';
            echo '<th>' . __('Room') . '</th>';
            echo '<th>' . __('Incident') . '</th>';
            echo '<th>' . __('Type') . '</th>';
            echo '<th>' . __('Status') . '</th>';
            echo '<th>' . __('Reporter') . '</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            foreach ($history as $item) {
                echo '<tr>';
                echo '<td>' . $item['date'] . '</td>';
                echo '<td>' . htmlspecialchars($item['room_name']) . '</td>';
                echo '<td>' . htmlspecialchars($item['name']) . '</td>';
                echo '<td>' . __($item['incident_type']) . '</td>';
                echo '<td>';
                $status_class = $item['status'] == 'resolved' ? 'success' : ($item['status'] == 'in_progress' ? 'warning' : 'danger');
                echo '<span class="badge badge-' . $status_class . '">' . self::getStatusName($item['status']) . '</span>';
                echo '</td>';
                echo '<td>' . htmlspecialchars($item['user_name']) . '</td>';
                echo '</tr>';
            }
            
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</div>';
    }
    
    public static function getOverdueIncidents($days = 7) {
        global $DB;
        
        $table = self::getTable();
        
        $result = $DB->request([
            'SELECT' => [
                'i.id',
                'i.name',
                'i.incident_type',
                'i.date_creation',
                'l.name as room_name',
                'u.name as user_name'
            ],
            'FROM' => $table . ' as i',
            'LEFT JOIN' => [
                'glpi_locations' => [
                    'FKEY' => [
                        'i' => 'room_id',
                        'glpi_locations' => 'id'
                    ]
                ],
                'glpi_users' => [
                    'FKEY' => [
                        'i' => 'users_id',
                        'glpi_users' => 'id'
                    ]
                ]
            ],
            'WHERE' => [
                'i.status' => ['!=', 'resolved'],
                'i.date_creation < DATE_SUB(NOW(), INTERVAL ' . $days . ' DAY)'
            ],
            'ORDER' => 'i.date_creation ASC'
        ]);
        
        $overdue = [];
        foreach ($result as $row) {
            $overdue[] = $row;
        }
        
        return $overdue;
    }
    
    public static function showOverdueAlerts($days = 7) {
        $overdue = self::getOverdueIncidents($days);
        
        if (empty($overdue)) {
            return;
        }
        
        echo '<div class="alert alert-danger">';
        echo '<h4 class="alert-heading">' . __('Overdue incidents!') . '</h4>';
        echo '<p>' . sprintf(__('The following incidents have been open for more than %d days:'), $days) . '</p>';
        
        echo '<div class="table-responsive">';
        echo '<table class="table table-sm">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>' . __('Incident') . '</th>';
        echo '<th>' . __('Room') . '</th>';
        echo '<th>' . __('Type') . '</th>';
        echo '<th>' . __('Days overdue') . '</th>';
        echo '<th>' . __('Action') . '</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        foreach ($overdue as $incident) {
            $days_overdue = floor((time() - strtotime($incident['date_creation'])) / (24 * 60 * 60));
            
            echo '<tr>';
            echo '<td>' . htmlspecialchars($incident['name']) . '</td>';
            echo '<td>' . htmlspecialchars($incident['room_name']) . '</td>';
            echo '<td>' . __($incident['incident_type']) . '</td>';
            echo '<td><span class="badge badge-danger">' . $days_overdue . '</span></td>';
            echo '<td>';
            echo '<a href="' . self::getFormURL() . '?id=' . $incident['id'] . '" class="btn btn-sm btn-primary">' . __('View') . '</a>';
            echo '<a href="' . self::getFormURL() . '?id=' . $incident['id'] . '&resolve=1" class="btn btn-sm btn-success ml-1">' . __('Resolve') . '</a>';
            echo '</td>';
            echo '</tr>';
        }
        
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
    }
    
    public static function createTable() {
        global $DB;
        
        $table = self::getTable();
        
        if (!$DB->tableExists($table)) {
            $query = "CREATE TABLE `$table` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(255) NOT NULL,
                `room_id` int(11) NOT NULL,
                `incident_type` varchar(50) NOT NULL,
                `description` text,
                `date` date NOT NULL,
                `time` time NOT NULL,
                `users_id` int(11) NOT NULL,
                `status` enum('new','in_progress','resolved') NOT NULL DEFAULT 'new',
                `date_creation` datetime NOT NULL,
                `date_mod` datetime DEFAULT NULL,
                `date_resolution` datetime DEFAULT NULL,
                PRIMARY KEY (`id`),
                KEY `room_id` (`room_id`),
                KEY `users_id` (`users_id`),
                KEY `status` (`status`),
                KEY `date_creation` (`date_creation`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
            
            $DB->queryOrDie($query, $DB->error());
        }
    }
}
?>
