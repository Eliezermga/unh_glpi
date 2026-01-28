<?php

if (!defined('GLPI_ROOT')) {
    die("Sorry. You can't access this file directly");
}

/**
 * Gestion des ressources des cours
 */
class PluginUniversiteRessource extends CommonDBTM {
    
    static $rightname = 'plugin_universite_ressource';
    
    // Types de ressources disponibles
    const TYPE_DOCUMENT = 1;
    const TYPE_LIEN = 2;
    const TYPE_VIDEO = 3;
    
    static function getTypeName($nb = 0) {
        return _n('Ressource', 'Ressources', $nb, 'universite');
    }
    
    /**
     * Obtenir les types de ressources disponibles
     */
    static function getTypes() {
        return [
            self::TYPE_DOCUMENT => __('Document', 'universite'),
            self::TYPE_LIEN     => __('Lien', 'universite'),
            self::TYPE_VIDEO    => __('Vidéo', 'universite')
        ];
    }
    
    function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {
        if (!$withtemplate) {
            $nb = 0;
            if ($_SESSION['glpishow_count_on_tabs']) {
                $nb = countElementsInTable(
                    self::getTable(),
                    [
                        'is_deleted' => 0,
                        'cours_id'   => $item->fields['id'] ?? 0
                    ]
                );
            }
            return self::createTabEntry(self::getTypeName($nb), $nb);
        }
        return '';
    }
    
    static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {
        if ($item->getType() == 'PluginUniversiteCours' && method_exists('PluginUniversiteRessource', 'showForCours')) {
            self::showForCours($item);
        }
        return true;
    }
    
    static function showForCours(CommonGLPI $cours) {
        global $DB, $CFG_GLPI;
        
        $ID = $cours->fields['id'] ?? 0;
        
        if (!$cours->can($ID, READ)) {
            return false;
        }
        
        $canedit = $cours->can($ID, UPDATE);
        
        echo "<div class='spaced'>";
        
        if ($canedit) {
            echo "<div class='center'>";
            echo "<a class='btn btn-primary' href='ressource.form.php?cours_id=" . $ID . "' title='" . __s('Ajouter une ressource', 'universite') . "'>";
            echo "<i class='fas fa-plus' aria-hidden='true'></i> " . __('Ajouter une ressource', 'universite');
            echo "</a>";
            echo "</div><br>";
        }
        
        $ressources = $DB->request([
            'FROM'  => self::getTable(),
            'WHERE' => [
                'cours_id'    => $ID,
                'is_deleted'  => 0
            ],
            'ORDER' => 'name ASC'
        ]);
        
        if (count($ressources)) {
            echo "<table class='tab_cadre_fixehov' role='grid'>";
            echo "<thead>";
            echo "<tr class='tab_bg_2'>";
            echo "<th>" . __('Type', 'universite') . "</th>";
            echo "<th>" . __('Titre', 'universite') . "</th>";
            echo "<th>" . __('Description', 'universite') . "</th>";
            echo "<th>" . __('Date de création', 'universite') . "</th>";
            if ($canedit) {
                echo "<th>" . __('Actions', 'universite') . "</th>";
            }
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            $types = self::getTypes();
            
            foreach ($ressources as $data) {
                echo "<tr class='tab_bg_1'>";
                echo "<td>" . ($types[$data['type']] ?? '') . "</td>";
                echo "<td>" . $data['name'] . "</td>";
                echo "<td>" . nl2br(Html::clean($data['description'])) . "</td>";
                echo "<td>" . Html::convDate($data['date_creation']) . "</td>";
                
                if ($canedit) {
                    echo "<td class='center'>";
                    echo "<a href='ressource.form.php?id=" . $data['id'] . "' title='" . __s('Modifier cette ressource', 'universite') . "'>";
                    echo "<i class='fas fa-edit' aria-hidden='true'></i>";
                    echo "<span class='sr-only'>" . __('Modifier', 'universite') . "</span>";
                    echo "</a>";
                    
                    echo " | ";
                    
                    echo "<a href='ressource.form.php?delete=1&id=" . $data['id'] . "' title='" . __s('Supprimer cette ressource', 'universite') . "'";
                    echo " onclick=\"return confirm('" . addslashes(__s('Confirmer la suppression ?')) . "')\">";
                    echo "<i class='fas fa-trash' aria-hidden='true'></i>";
                    echo "<span class='sr-only'>" . __('Supprimer', 'universite') . "</span>";
                    echo "</a>";
                    
                    echo "</td>";
                }
                
                echo "</tr>";
            }
            
            echo "</tbody>";
                        echo "</table>";
        } else {
            echo "<p class='center b'>" . __('Aucune ressource trouvée', 'universite') . "</p>";
        }
        
        echo "</div>";
        
        return true;
    }
    
    function showForm($ID, array $options = []) {
        global $CFG_GLPI;
        
        $this->initForm($ID, $options);
        $this->showFormHeader($options);
        
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Type', 'universite') . " <span class='red'>*</span></td>";
        echo "<td>";
        Dropdown::showFromArray('type', self::getTypes(), [
            'value'     => $this->fields['type'] ?? self::TYPE_DOCUMENT,
            'required'  => true
        ]);
        echo "</td>";
        echo "<td colspan='2'></td>";
        echo "</tr>";
        
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Titre', 'universite') . " <span class='red'>*</span></td>";
        echo "<td>";
        echo Html::input('name', [
            'value'    => $this->fields['name'] ?? '',
            'size'     => 50,
            'required' => true
        ]);
        echo "</td>";
        
        echo "<td>" . __('Cours associé', 'universite') . " <span class='red'>*</span></td>";
        echo "<td>";
        $cours_id = $_GET['cours_id'] ?? ($this->fields['cours_id'] ?? 0);
        Dropdown::show('PluginUniversiteCours', [
            'name'     => 'cours_id',
            'value'    => $cours_id,
            'required' => true
        ]);
        echo "</td>";
        echo "</tr>";
        
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Description', 'universite') . "</td>";
        echo "<td colspan='3'>";
        echo Html::textarea([
            'name'  => 'description',
            'value' => $this->fields['description'] ?? '',
            'cols'  => 100,
            'rows'  => 4
        ]);
        echo "</td>";
        echo "</tr>";
        
        // Champs spécifiques au type de ressource
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Fichier/URL', 'universite') . " <span class='red'>*</span></td>";
        echo "<td colspan='3'>";
        
        $type = $this->fields['type'] ?? self::TYPE_DOCUMENT;
        
        if ($type == self::TYPE_DOCUMENT) {
            echo "<input type='file' name='fichier' ";
            if (empty($ID)) {
                echo " required";
            }
            echo ">";
            
            if (!empty($this->fields['chemin'])) {
                echo "<br><small>" . __('Fichier actuel :', 'universite') . " ";
                echo basename($this->fields['chemin']);
                echo "</small>";
            }
        } else {
            echo Html::input('url', [
                'value'    => $this->fields['url'] ?? 'http://',
                'size'     => 100,
                'required' => true
            ]);
            
            if ($type == self::TYPE_VIDEO) {
                echo "<br><small>" . __('URL de la vidéo (YouTube, Vimeo, etc.)', 'universite') . "</small>";
            } else {
                echo "<br><small>" . __('URL complète commençant par http:// ou https://', 'universite') . "</small>";
            }
        }
        
        echo "</td>";
        echo "</tr>";
        
        $this->showFormButtons($options);
        
        return true;
    }
    
    function prepareInputForAdd($input) {
        return $this->prepareInput($input);
    }
    
    function prepareInputForUpdate($input) {
        return $this->prepareInput($input, true);
    }
    
    private function prepareInput($input, $update = false) {
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
        
        if (empty($input['cours_id'])) {
            Session::addMessageAfterRedirect(
                __('Vous devez sélectionner un cours', 'universite'),
                false,
                ERROR
            );
            return false;
        }
        
        // Gestion du téléchargement de fichier pour les documents
        if (($input['type'] ?? null) == self::TYPE_DOCUMENT) {
            if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] == 0) {
                $upload_dir = GLPI_ROOT . '/files/plugins' . '/universite/ressources/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                $filename = uniqid() . '_' . $_FILES['fichier']['name'];
                $filepath = $upload_dir . $filename;
                
                if (move_uploaded_file($_FILES['fichier']['tmp_name'], $filepath)) {
                    $input['chemin'] = 'ressources/' . $filename;
                    
                    // Supprimer l'ancien fichier si mise à jour
                    if ($update && !empty($this->fields['chemin'])) {
                        $old_file = GLPI_ROOT . '/files/plugins' . '/universite/' . $this->fields['chemin'];
                        if (file_exists($old_file)) {
                            unlink($old_file);
                        }
                    }
                } else {
                    Session::addMessageAfterRedirect(
                        __('Erreur lors du téléchargement du fichier', 'universite'),
                        false,
                        ERROR
                    );
                    return false;
                }
            } elseif (!$update) {
                Session::addMessageAfterRedirect(
                    __('Vous devez sélectionner un fichier', 'universite'),
                    false,
                    ERROR
                );
                return false;
            }
        } elseif (($input['type'] ?? null) == self::TYPE_LIEN || ($input['type'] ?? null) == self::TYPE_VIDEO) {
            if (empty($input['url']) || !filter_var($input['url'], FILTER_VALIDATE_URL)) {
                Session::addMessageAfterRedirect(
                    __('Veuillez entrer une URL valide', 'universite'),
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
                `description` text COLLATE utf8_unicode_ci,
                `type` tinyint(1) NOT NULL DEFAULT 1,
                `chemin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                `url` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
                `cours_id` int(11) NOT NULL,
                `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                `date_mod` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
                PRIMARY KEY (`id`),
                KEY `cours_id` (`cours_id`),
                KEY `type` (`type`),
                KEY `is_deleted` (`is_deleted`),
                CONSTRAINT `plugin_universite_ressources_ibfk_1` 
                    FOREIGN KEY (`cours_id`) 
                    REFERENCES `glpi_plugin_universite_cours` (`id`) 
                    ON DELETE CASCADE
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
                'name' => 'plugin_universite_ressource',
                'rights' => ['&', $right]
            ])) {
                ProfileRight::addProfileRights(['plugin_universite_ressource']);
                break;
            }
        }
        
        return true;
    }
    
    static function uninstall() {
        global $DB;
        
        $table = self::getTable();
        
        // Suppression des fichiers téléchargés
        $ressources = $DB->request([
            'SELECT' => ['chemin'],
            'FROM'   => $table,
            'WHERE'  => ['chemin' => ['!=', '']]
        ]);
        
        foreach ($ressources as $data) {
            $file = GLPI_ROOT . '/files/plugins' . '/universite/' . $data['chemin'];
            if (file_exists($file)) {
                @unlink($file);
            }
        }
        
        // Suppression du répertoire s'il est vide
        $upload_dir = GLPI_ROOT . '/files/plugins' . '/universite/ressources/';
        if (is_dir($upload_dir) && count(glob($upload_dir . '*')) === 0) {
            @rmdir($upload_dir);
        }
        
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
        $rights->deleteByCriteria(['name' => 'plugin_universite_ressource']);
        
        return true;
    }
    
    /**
     * Afficher la ressource dans l'interface
     */
    function display($options = []) {
        switch ($this->fields['type']) {
            case self::TYPE_DOCUMENT:
                $this->displayDocument();
                break;
                
            case self::TYPE_LIEN:
                $this->displayLien();
                break;
                
            case self::TYPE_VIDEO:
                $this->displayVideo();
                break;
        }
    }
    
    /**
     * Afficher un document
     */
    private function displayDocument() {
        $filepath = GLPI_ROOT . '/files/plugins' . '/universite/' . $this->fields['chemin'];
        $filename = basename($this->fields['chemin']);
        
        if (file_exists($filepath)) {
            $mime = mime_content_type($filepath);
            $size = filesize($filepath);
            
            header("Content-Type: $mime");
            header("Content-Length: $size");
            header("Content-Disposition: inline; filename=\"$filename\"");
            
            readfile($filepath);
        } else {
            echo "<div class='alert alert-important alert-danger'>";
            echo __('Fichier introuvable', 'universite');
            echo "</div>";
        }
    }
    
    /**
     * Afficher un lien
     */
    private function displayLien() {
        $url = $this->fields['url'];
        $name = $this->fields['name'];
        
        echo "<div class='alert alert-info'>";
        echo "<p>" . __('Vous allez être redirigé vers :', 'universite') . "</p>";
        echo "<p><a href='$url' target='_blank'>$name</a></p>";
        echo "<p><small>$url</small></p>";
        echo "</div>";
        
        echo "<script>window.open('$url', '_blank');</script>";
    }
    
    /**
     * Afficher une vidéo
     */
    private function displayVideo() {
        $url = $this->fields['url'];
        
        // Détecter le type de vidéo (YouTube, Vimeo, etc.)
        if (preg_match("#youtube\.com|youtu\.be#i", $url)) {
            // YouTube
            if (preg_match('#(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})#i', $url, $matches)) {
                $video_id = $matches[1];
                $embed_url = "https://www.youtube.com/embed/$video_id";
                
                echo "<div class='video-container'>";
                echo "<iframe width='100%' height='500' src='$embed_url' ";
                echo "frameborder='0' allowfullscreen></iframe>";
                echo "</div>";
            }
        } elseif (preg_match("#vimeo\.com#i", $url)) {
            // Vimeo
            if (preg_match('#vimeo\.com/(\d+)#i', $url, $matches)) {
                $video_id = $matches[1];
                $embed_url = "https://player.vimeo.com/video/$video_id";
                
                echo "<div class='video-container'>";
                echo "<iframe src='$embed_url' width='100%' height='500' ";
                echo "frameborder='0' allow='autoplay; fullscreen' allowfullscreen></iframe>";
                echo "</div>";
            }
        } else {
            // Autres types de vidéos (lien direct)
            echo "<div class='alert alert-info'>";
            echo "<p>" . __('Lecture de la vidéo...', 'universite') . "</p>";
            echo "<p><a href='$url' target='_blank'>" . __('Ouvrir la vidéo dans un nouvel onglet', 'universite') . "</a></p>";
            echo "</div>";
            
            echo "<video width='100%' controls autoplay>";
            echo "<source src='$url' type='video/mp4'>";
            echo "Votre navigateur ne supporte pas la lecture de vidéos.";
            echo "</video>";
        }
    }
}

