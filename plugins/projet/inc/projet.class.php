<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

class PluginProjetProjet extends CommonDBTM {
    
    static $rightname = 'plugin_projet';
    public $dohistory = true;
    
    static function getTypeName($nb = 0) {
        return _n('Projet', 'Projets', $nb, 'projet');
    }
    
    static function getMenuName() {
        return __('Projets Étudiants', 'projet');
    }
    
    static function getIcon() {
        return 'ti ti-briefcase';
    }
    
    static function canCreate() {
        return true;
    }
    
    static function canView() {
        return true;
    }
    
    static function canUpdate() {
        return true;
    }
    
    static function canDelete() {
        return true;
    }
    
    static function canPurge() {
        return true;
    }
    
    function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {
        return self::getTypeName(Session::getPluralNumber());
    }
    
    function defineTabs($options = []) {
        $ong = [];
        $this->addDefaultFormTab($ong);
        $this->addStandardTab('Log', $ong, $options);
        return $ong;
    }
    
    function showForm($ID, array $options = []) {
        $this->initForm($ID, $options);
        $this->showFormHeader($options);
        
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Nom', 'projet') . "</td>";
        echo "<td>";
        echo Html::input('name', ['value' => $this->fields['name'] ?? '', 'size' => 50]);
        echo "</td>";
        
        echo "<td>" . __('Type', 'projet') . "</td>";
        echo "<td>";
        Dropdown::showFromArray('type', [
            'etudiant' => __('Projet Étudiant', 'projet'),
            'recherche' => __('Projet de Recherche', 'projet')
        ], ['value' => $this->fields['type'] ?? 'etudiant']);
        echo "</td>";
        echo "</tr>";
        
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Responsable', 'projet') . "</td>";
        echo "<td>";
        echo Html::input('responsable', ['value' => $this->fields['responsable'] ?? '', 'size' => 50]);
        echo "</td>";
        
        echo "<td>" . __('Statut', 'projet') . "</td>";
        echo "<td>";
        Dropdown::showFromArray('statut', [
            'planifie' => __('Planifié', 'projet'),
            'en_cours' => __('En cours', 'projet'),
            'termine' => __('Terminé', 'projet'),
            'suspendu' => __('Suspendu', 'projet')
        ], ['value' => $this->fields['statut'] ?? 'planifie']);
        echo "</td>";
        echo "</tr>";
        
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Date de début', 'projet') . "</td>";
        echo "<td>";
        Html::showDateField('date_debut', ['value' => $this->fields['date_debut'] ?? '']);
        echo "</td>";
        
        echo "<td>" . __('Date de fin', 'projet') . "</td>";
        echo "<td>";
        Html::showDateField('date_fin', ['value' => $this->fields['date_fin'] ?? '']);
        echo "</td>";
        echo "</tr>";
        
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Étudiants impliqués', 'projet') . "</td>";
        echo "<td colspan='3'>";
        echo "<textarea name='etudiants' rows='3' style='width:98%;'>" . ($this->fields['etudiants'] ?? '') . "</textarea>";
        echo "</td>";
        echo "</tr>";
        
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Description', 'projet') . "</td>";
        echo "<td colspan='3'>";
        echo "<textarea name='description' rows='5' style='width:98%;'>" . ($this->fields['description'] ?? '') . "</textarea>";
        echo "</td>";
        echo "</tr>";
        
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Commentaires', 'projet') . "</td>";
        echo "<td colspan='3'>";
        echo "<textarea name='comment' rows='5' style='width:98%;'>" . ($this->fields['comment'] ?? '') . "</textarea>";
        echo "</td>";
        echo "</tr>";
        
        $this->showFormButtons($options);
        
        return true;
    }
    
    function rawSearchOptions() {
        $tab = [];
        
        $tab[] = [
            'id' => 'common',
            'name' => self::getTypeName(1)
        ];
        
        $tab[] = [
            'id' => '1',
            'table' => $this->getTable(),
            'field' => 'name',
            'name' => __('Nom', 'projet'),
            'datatype' => 'itemlink',
            'massiveaction' => false
        ];
        
        $tab[] = [
            'id' => '2',
            'table' => $this->getTable(),
            'field' => 'type',
            'name' => __('Type', 'projet'),
            'datatype' => 'string'
        ];
        
        $tab[] = [
            'id' => '3',
            'table' => $this->getTable(),
            'field' => 'responsable',
            'name' => __('Responsable', 'projet'),
            'datatype' => 'string'
        ];
        
        $tab[] = [
            'id' => '4',
            'table' => $this->getTable(),
            'field' => 'statut',
            'name' => __('Statut', 'projet'),
            'datatype' => 'string'
        ];
        
        $tab[] = [
            'id' => '5',
            'table' => $this->getTable(),
            'field' => 'date_debut',
            'name' => __('Date de début', 'projet'),
            'datatype' => 'date'
        ];
        
        $tab[] = [
            'id' => '6',
            'table' => $this->getTable(),
            'field' => 'date_fin',
            'name' => __('Date de fin', 'projet'),
            'datatype' => 'date'
        ];
        
        return $tab;
    }
}
