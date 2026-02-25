<?php

define('PLUGIN_INCIDENTSALLES_VERSION', '1.0.0');

function plugin_version_incidentsalles() {
   return [
      'name'           => 'Incidents en Salles',
      'version'        => PLUGIN_INCIDENTSALLES_VERSION,
      'author'         => 'UNH',
      'license'        => 'GPLv3+',
      'homepage'       => '',
      'requirements'   => [
         'glpi' => [
            'min' => '10.0',
            'max' => '10.1'
         ]
      ]
   ];
}

function plugin_init_incidentsalles() {
   global $PLUGIN_HOOKS;

   $PLUGIN_HOOKS['csrf_compliant']['incidentsalles'] = true;
   
   Plugin::registerClass('PluginIncidentsallesIncident', [
      'addtabon'               => ['Ticket']
   ]);

   $PLUGIN_HOOKS['menu_toadd']['incidentsalles'] = ['tools' => 'PluginIncidentsallesMenu'];
   
   if (Session::getLoginUserID()) {
      $PLUGIN_HOOKS['config_page']['incidentsalles'] = 'front/incident.php';
   }
}

function plugin_incidentsalles_install() {
   global $DB;

   $table = 'glpi_plugin_incidentsalles_incidents';
   
   if (!$DB->tableExists($table)) {
      $query = "CREATE TABLE `$table` (
         `id` int unsigned NOT NULL AUTO_INCREMENT,
         `name` varchar(255) DEFAULT NULL,
         `salle` varchar(255) DEFAULT NULL,
         `type_incident` varchar(100) DEFAULT NULL,
         `description` text,
         `status` varchar(50) DEFAULT 'nouveau',
         `priority` int DEFAULT 3,
         `date_incident` date DEFAULT NULL,
         `heure_incident` time DEFAULT NULL,
         `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
         `date_resolution` timestamp NULL DEFAULT NULL,
         `equipement` varchar(255) DEFAULT NULL,
         `users_id` int unsigned DEFAULT 0,
         `entities_id` int unsigned DEFAULT 0,
         PRIMARY KEY (`id`),
         KEY `salle` (`salle`),
         KEY `type_incident` (`type_incident`),
         KEY `status` (`status`),
         KEY `date_creation` (`date_creation`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
      
      $DB->query($query) or die($DB->error());
   }

   return true;
}

function plugin_incidentsalles_uninstall() {
   global $DB;
   
   $table = 'glpi_plugin_incidentsalles_incidents';
   if ($DB->tableExists($table)) {
      $DB->query("DROP TABLE `$table`");
   }
   
   return true;
}
