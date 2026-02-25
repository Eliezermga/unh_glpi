<?php

use Glpi\Event;

include ('../../../inc/includes.php');

Session::checkLoginUser();

if (!isset($_GET["id"])) {
    $_GET["id"] = 0;
}

$projet = new PluginProjetProjet();

if (isset($_POST["add"])) {
    if (!$projet->canCreate()) {
        Session::addMessageAfterRedirect(__('Vous n\'avez pas les droits pour créer un projet.', 'projet'), false, ERROR);
        Html::redirect('projet.php');
    }
    $newID = $projet->add($_POST);
    Event::log($newID, "plugin_projet_projets", 4, "tools",
        sprintf(__('%1$s adds the item %2$s'), $_SESSION["glpiname"], $_POST["name"]));
    Session::addMessageAfterRedirect(__('Projet créé avec succès !', 'projet'), false, INFO);
    Html::redirect('projet.php');
    
} else if (isset($_POST["purge"])) {
    if (!$projet->canDelete()) {
        Session::addMessageAfterRedirect(__('Vous n\'avez pas les droits pour supprimer un projet.', 'projet'), false, ERROR);
        Html::redirect('projet.php');
    }
    $projet->delete($_POST, 1);
    Event::log($_POST["id"], "plugin_projet_projets", 4, "tools",
        sprintf(__('%s purges an item'), $_SESSION["glpiname"]));
    Session::addMessageAfterRedirect(__('Projet supprimé avec succès !', 'projet'), false, INFO);
    Html::redirect('projet.php');
    
} else if (isset($_POST["update"])) {
    if (!$projet->canUpdate()) {
        Session::addMessageAfterRedirect(__('Vous n\'avez pas les droits pour modifier un projet.', 'projet'), false, ERROR);
        Html::redirect('projet.php');
    }
    $projet->update($_POST);
    Event::log($_POST["id"], "plugin_projet_projets", 4, "tools",
        sprintf(__('%s updates an item'), $_SESSION["glpiname"]));
    Session::addMessageAfterRedirect(__('Projet modifié avec succès !', 'projet'), false, INFO);
    Html::redirect('projet.php');
    
} else {
    Html::header(__('Gestion des Projets', 'projet'), $_SERVER['PHP_SELF'], 'tools', 'PluginProjetProjet');
    
    if ($_GET["id"] > 0) {
        $projet->getFromDB($_GET["id"]);
    }
    
    echo "<div class='center' style='padding: 20px; max-width: 1000px; margin: 0 auto;'>";
    echo "<div style='background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>";
    
    if ($_GET["id"] > 0) {
        echo "<h2 style='margin-bottom: 25px; color: #333;'><i class='fas fa-edit'></i> " . __('Modifier le projet', 'projet') . "</h2>";
    } else {
        echo "<h2 style='margin-bottom: 25px; color: #333;'><i class='fas fa-plus'></i> " . __('Créer un nouveau projet', 'projet') . "</h2>";
    }
    
    echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
    
    if ($_GET["id"] > 0) {
        echo "<input type='hidden' name='id' value='" . $_GET["id"] . "'>";
    }
    
    echo "<table class='tab_cadre_fixe' style='width: 100%;'>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td style='padding: 15px; width: 30%; font-weight: bold;'><i class='fas fa-tag'></i> " . __('Nom du projet', 'projet') . " *</td>";
    echo "<td style='padding: 15px;'>";
    echo "<input type='text' name='name' value='" . htmlspecialchars($projet->fields['name'] ?? '') . "' required style='width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px;'>";
    echo "</td>";
    echo "</tr>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td style='padding: 15px; font-weight: bold;'><i class='fas fa-folder'></i> " . __('Type de projet', 'projet') . " *</td>";
    echo "<td style='padding: 15px;'>";
    echo "<select name='type' required style='width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px;'>";
    echo "<option value='etudiant' " . (($projet->fields['type'] ?? '') == 'etudiant' ? 'selected' : '') . ">" . __('Projet Étudiant', 'projet') . "</option>";
    echo "<option value='recherche' " . (($projet->fields['type'] ?? '') == 'recherche' ? 'selected' : '') . ">" . __('Projet de Recherche', 'projet') . "</option>";
    echo "</select>";
    echo "</td>";
    echo "</tr>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td style='padding: 15px; font-weight: bold;'><i class='fas fa-user-tie'></i> " . __('Responsable du projet', 'projet') . " *</td>";
    echo "<td style='padding: 15px;'>";
    echo "<input type='text' name='responsable' value='" . htmlspecialchars($projet->fields['responsable'] ?? '') . "' required style='width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px;'>";
    echo "</td>";
    echo "</tr>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td style='padding: 15px; font-weight: bold;'><i class='fas fa-users'></i> " . __('Étudiants impliqués', 'projet') . "</td>";
    echo "<td style='padding: 15px;'>";
    echo "<textarea name='etudiants' rows='3' placeholder='Ex: Marie Dupont, Jean Martin, Sophie Bernard' style='width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px;'>" . htmlspecialchars($projet->fields['etudiants'] ?? '') . "</textarea>";
    echo "<small style='color: #666;'>" . __('Séparez les noms par des virgules', 'projet') . "</small>";
    echo "</td>";
    echo "</tr>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td style='padding: 15px; font-weight: bold;'><i class='fas fa-calendar-alt'></i> " . __('Date de début', 'projet') . " *</td>";
    echo "<td style='padding: 15px;'>";
    echo "<input type='date' name='date_debut' value='" . ($projet->fields['date_debut'] ?? '') . "' required style='width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px;'>";
    echo "</td>";
    echo "</tr>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td style='padding: 15px; font-weight: bold;'><i class='fas fa-calendar-check'></i> " . __('Date de fin prévue', 'projet') . "</td>";
    echo "<td style='padding: 15px;'>";
    echo "<input type='date' name='date_fin' value='" . ($projet->fields['date_fin'] ?? '') . "' style='width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px;'>";
    echo "</td>";
    echo "</tr>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td style='padding: 15px; font-weight: bold;'><i class='fas fa-flag'></i> " . __('Statut du projet', 'projet') . " *</td>";
    echo "<td style='padding: 15px;'>";
    echo "<select name='statut' required style='width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px;'>";
    echo "<option value='planifie' " . (($projet->fields['statut'] ?? 'planifie') == 'planifie' ? 'selected' : '') . ">📅 " . __('Planifié', 'projet') . "</option>";
    echo "<option value='en_cours' " . (($projet->fields['statut'] ?? '') == 'en_cours' ? 'selected' : '') . ">⏳ " . __('En cours', 'projet') . "</option>";
    echo "<option value='termine' " . (($projet->fields['statut'] ?? '') == 'termine' ? 'selected' : '') . ">✅ " . __('Terminé', 'projet') . "</option>";
    echo "<option value='suspendu' " . (($projet->fields['statut'] ?? '') == 'suspendu' ? 'selected' : '') . ">⏸️ " . __('Suspendu', 'projet') . "</option>";
    echo "</select>";
    echo "</td>";
    echo "</tr>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td style='padding: 15px; font-weight: bold; vertical-align: top;'><i class='fas fa-align-left'></i> " . __('Description du projet', 'projet') . "</td>";
    echo "<td style='padding: 15px;'>";
    echo "<textarea name='description' rows='5' placeholder='" . __('Décrivez les objectifs et le contexte du projet...', 'projet') . "' style='width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px;'>" . htmlspecialchars($projet->fields['description'] ?? '') . "</textarea>";
    echo "</td>";
    echo "</tr>";
    
    echo "<tr class='tab_bg_1'>";
    echo "<td style='padding: 15px; font-weight: bold; vertical-align: top;'><i class='fas fa-comment'></i> " . __('Commentaires', 'projet') . "</td>";
    echo "<td style='padding: 15px;'>";
    echo "<textarea name='comment' rows='4' placeholder='" . __('Notes additionnelles, remarques...', 'projet') . "' style='width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px;'>" . htmlspecialchars($projet->fields['comment'] ?? '') . "</textarea>";
    echo "</td>";
    echo "</tr>";
    
    echo "</table>";
    
    echo "<div style='margin-top: 30px; text-align: center;'>";
    
    if ($_GET["id"] > 0) {
        echo "<button type='submit' name='update' class='btn btn-primary' style='padding: 12px 40px; font-size: 16px; margin-right: 10px;'>";
        echo "<i class='fas fa-save'></i> " . __('Enregistrer les modifications', 'projet') . "</button>";
        
        echo "<button type='submit' name='purge' class='btn btn-danger' style='padding: 12px 40px; font-size: 16px; margin-right: 10px;' onclick='return confirm(\"" . __('Voulez-vous vraiment supprimer ce projet ?', 'projet') . "\");'>";
        echo "<i class='fas fa-trash'></i> " . __('Supprimer le projet', 'projet') . "</button>";
    } else {
        echo "<button type='submit' name='add' class='btn btn-primary' style='padding: 12px 40px; font-size: 16px; margin-right: 10px;'>";
        echo "<i class='fas fa-plus'></i> " . __('Créer le projet', 'projet') . "</button>";
    }
    
    echo "<a href='projet.php' class='btn btn-secondary' style='padding: 12px 40px; font-size: 16px;'>";
    echo "<i class='fas fa-arrow-left'></i> " . __('Retour à la liste', 'projet') . "</a>";
    
    echo "</div>";
    
    echo Html::closeForm(false);
    echo "</div>";
    echo "</div>";
    
    Html::footer();
}
