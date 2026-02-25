<?php

class PluginIncidentsallesMenu extends CommonGLPI {

   static function getMenuName() {
      return __('Incidents en Salles', 'incidentsalles');
   }

   static function getMenuContent() {
      $menu = [];
      $menu['title'] = self::getMenuName();
      $menu['page']  = '/plugins/incidentsalles/front/signalement.php';
      $menu['icon']  = 'fas fa-door-open';
      
      $menu['options'] = [
         'signalement' => [
            'title' => 'Signaler un incident',
            'page'  => '/plugins/incidentsalles/front/signalement.php',
            'icon'  => 'fas fa-plus-circle'
         ],
         'incident' => [
            'title' => 'Liste des incidents',
            'page'  => '/plugins/incidentsalles/front/incident.php',
            'icon'  => 'fas fa-list'
         ],
         'stats' => [
            'title' => 'Statistiques',
            'page'  => '/plugins/incidentsalles/front/stats.php',
            'icon'  => 'fas fa-chart-bar'
         ],
         'historique' => [
            'title' => 'Historique Matériel',
            'page'  => '/plugins/incidentsalles/front/historique.php',
            'icon'  => 'fas fa-history'
         ]
      ];

      return $menu;
   }
}
