<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

/**
 * Gestion des cours universitaires
 */
class PluginUniversiteCours extends CommonDBTM {
    
    static $rightname = 'plugin_universite_cours';
    
    static function getTypeName($nb = 0) {
        return _n('Cours', 'Cours', $nb, 'universite');
    }
    
    function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {
        if (!$withtemplate) {
            $nb = 0;
            if ($_SESSION['glpishow_count_on_tabs']) {
                $nb = countElementsInTable(
                    self::getTable(),
                    ['is_deleted' => 0]
                );
            }
            return self::createTabEntry(self::getTypeName($nb), $nb);
        }
        return '';
    }
    
    static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {
        if ($item instanceof PluginUniversiteCours) {
            self::showForCours($item);
        }
        return true;
    }
    
    static function showForCours(PluginUniversiteCours $cours) {
        global $DB, $CFG_GLPI;
        
        if (!isset($cours->fields['id'])) {
            echo "<div class='alert alert-danger'>";
            echo __('Données du cours invalides', 'universite');
            echo "</div>";
            return false;
        }
        
        $ID = $cours->fields['id'];
        
        if (!$cours->can($ID, READ)) {
            return false;
        }
        
        // Vérifier les droits
        $canedit = $cours->can($ID, UPDATE);
        
        // Afficher les informations du cours
        echo "<div class='spaced'>";
        
        // En-tête
        echo "<table class='tab_cadre_fixe'>";
        echo "<tr class='tab_bg_1'>";
        echo "<th colspan='4'>".__('Détails du cours', 'universite')."</th>";
        echo "</tr>";
        
        // Informations de base
        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Titre', 'universite')."</td>";
        echo "<td>".htmlspecialchars($cours->fields['name'] ?? '')."</td>";
        echo "<td>".__('Code', 'universite')."</td>";
        echo "<td>".htmlspecialchars($cours->fields['code'] ?? '')."</td>";
        echo "</tr>";
        
        // Description
        if (!empty($cours->fields['description'])) {
            echo "<tr class='tab_bg_1'>";
            echo "<td colspan='4'>".__('Description', 'universite')."</td>";
            echo "</tr>";
            echo "<tr class='tab_bg_1'>";
            echo "<td colspan='4'>".nl2br(Html::clean($cours->fields['description']))."</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
        // Section des ressources
        echo "<table class='tab_cadre_fixe'>";
        echo "<tr class='tab_bg_1'>";
        echo "<th colspan='4'>".__('Ressources associées', 'universite')."</th>";
        echo "</tr>";
        
        // Ici, on pourrait ajouter la liste des ressources liées à ce cours
        
        echo "</table>";
        
        echo "</div>";
        
        return true;
    }
    
    function showForm($ID, array $options = []) {
        $this->initForm($ID, $options);
        $this->showFormHeader($options);
        
        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Titre', 'universite')." <span class='red'>*</span></td>";
        echo "<td>";
        echo Html::input('name', [
            'value' => $this->fields['name'], 
            'size' => 50,
            'required' => true
        ]);
        echo "</td>";
        echo "<td>".__('Code', 'universite')." <span class='red'>*</span></td>";
        echo "<td>";
        echo Html::input('code', [
            'value' => $this->fields['code'],
            'size' => 20,
            'required' => true
        ]);
        echo "</td>";
        echo "</tr>";
        
        echo "<tr class='tab_bg_1'>";
        echo "<td>".__('Description', 'universite')."</td>";
        echo "<td colspan='3'>";
        echo Html::textarea([
            'name' => 'description',
            'value' => $this->fields['description'],
            'cols' => 100,
            'rows' => 6
        ]);
        echo "</td>";
        echo "</tr>";
        
        $this->showFormButtons($options);
        
        return true;
    }
    
    function prepareInputForAdd($input) {
        return $this->prepareInput($input);
    }
    
    function prepareInputForUpdate($input) {
        return $this->prepareInput($input);
    }
    
    private function prepareInput($input) {
        // Nettoyage des entrées
        if (isset($input['name'])) {
            $input['name'] = trim($input['name']);
            if (empty($input['name'])) {
                Session::addMessageAfterRedirect(
                    __('Le titre ne peut pas être vide', 'universite'),
                    false,
                    ERROR
                );
                return false;
            }
        }
        
        if (isset($input['code'])) {
            $input['code'] = trim($input['code']);
            if (empty($input['code'])) {
                Session::addMessageAfterRedirect(
                    __('Le code ne peut pas être vide', 'universite'),
                    false,
                    ERROR
                );
                return false;
            }
        }
        
        return $input;
    }
    
    static function install(Migration $migration) {
        global $DB;
        
        $table = self::getTable();
        
        if (!$DB->tableExists($table)) {
            $migration->displayMessage("Création de la table ".$table);
            
            $query = "CREATE TABLE IF NOT EXISTS `$table` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
                `description` text COLLATE utf8_unicode_ci,
                `faculte_id` int(11) DEFAULT NULL,
                `departement_id` int(11) DEFAULT NULL,
                `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                `date_mod` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
                PRIMARY KEY (`id`),
                UNIQUE KEY `code` (`code`),
                KEY `faculte_id` (`faculte_id`),
                KEY `departement_id` (`departement_id`),
                KEY `is_deleted` (`is_deleted`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
            
            if (!$DB->query($query)) {
                Toolbox::logError("Erreur lors de la création de la table $table : " . $DB->error());
                return false;
            }
        }
        
        // Ajout des droits
        $rights = [
            READ    => __('Lire'),
            CREATE  => __('Créer'),
            UPDATE  => __('Mettre à jour'),
            DELETE  => __('Supprimer'),
            PURGE   => __('Purger')
        ];
        
        foreach ($rights as $right => $label) {
            if (!countElementsInTable('glpi_profilerights', [
                'name' => 'plugin_universite_cours',
                'rights' => ['&', $right]
            ])) {
                ProfileRight::addProfileRights(['plugin_universite_cours']);
                break;
            }
        }
        
        return true;
    }
    
    static function uninstall() {
        global $DB;
        
        $table = self::getTable();
        
        // Suppression de la table
        if ($DB->tableExists($table)) {
            $query = "DROP TABLE IF EXISTS `$table`";
            if (!$DB->query($query)) {
                Toolbox::logError("Erreur lors de la suppression de la table $table : " . $DB->error());
                return false;
            }
        }
        
        // Suppression des droits
        $rights = new ProfileRight();
        $rights->deleteByCriteria(['name' => 'plugin_universite_cours']);
        
        // Nettoyage de la configuration
        $config = new Config();
        $config->deleteByCriteria(['context' => 'plugin:universite']);
        
        return true;
    }
}