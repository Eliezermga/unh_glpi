<?php

include ('../../../inc/includes.php');

Session::checkLoginUser();

Html::header(
    __('Gestion des Projets', 'projet'),
    $_SERVER['PHP_SELF'],
    'tools',
    'PluginProjetProjet'
);

global $DB;

$projets = $DB->request([
    'FROM' => 'glpi_plugin_projet_projets',
    'ORDER' => 'date_mod DESC'
]);

echo "<div class='center' style='padding: 20px;'>";
echo "<div style='margin-bottom: 30px;'>";
echo "<a href='projet.form.php' class='btn btn-primary' style='font-size: 16px; padding: 12px 30px;'>";
echo "<i class='fas fa-plus'></i> " . __('Créer un nouveau projet', 'projet') . "</a>";
echo "</div>";

echo "<table class='tab_cadre_fixehov' style='width: 100%;'>";
echo "<thead>";
echo "<tr class='tab_bg_1'>";
echo "<th style='padding: 15px; font-size: 14px; width: 25%;'>" . __('Nom du projet', 'projet') . "</th>";
echo "<th style='padding: 15px; font-size: 14px; width: 15%;'>" . __('Type', 'projet') . "</th>";
echo "<th style='padding: 15px; font-size: 14px; width: 20%;'>" . __('Responsable', 'projet') . "</th>";
echo "<th style='padding: 15px; font-size: 14px; width: 12%;'>" . __('Statut', 'projet') . "</th>";
echo "<th style='padding: 15px; font-size: 14px; width: 13%;'>" . __('Date de début', 'projet') . "</th>";
echo "<th style='padding: 15px; font-size: 14px; width: 15%;'>" . __('Actions', 'projet') . "</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

if (count($projets) == 0) {
    echo "<tr><td colspan='6' class='center' style='padding: 30px; font-size: 14px;'>";
    echo __('Aucun projet pour le moment. Cliquez sur \'Créer un nouveau projet\' pour commencer.', 'projet');
    echo "</td></tr>";
} else {
    foreach ($projets as $projet) {
        $statut_colors = [
            'planifie' => '#3498db',
            'en_cours' => '#f39c12',
            'termine' => '#27ae60',
            'suspendu' => '#e74c3c'
        ];
        $statut_labels = [
            'planifie' => __('Planifié', 'projet'),
            'en_cours' => __('En cours', 'projet'),
            'termine' => __('Terminé', 'projet'),
            'suspendu' => __('Suspendu', 'projet')
        ];
        
        $color = $statut_colors[$projet['statut']] ?? '#95a5a6';
        $label = $statut_labels[$projet['statut']] ?? $projet['statut'];
        
        echo "<tr class='tab_bg_2'>";
        echo "<td style='padding: 12px; font-size: 13px;'><strong>" . htmlspecialchars($projet['name']) . "</strong></td>";
        echo "<td style='padding: 12px; font-size: 13px;'>" . ($projet['type'] == 'etudiant' ? __('Projet Étudiant', 'projet') : __('Projet de Recherche', 'projet')) . "</td>";
        echo "<td style='padding: 12px; font-size: 13px;'>" . htmlspecialchars($projet['responsable']) . "</td>";
        echo "<td style='padding: 12px;'><span style='background: {$color}; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px;'>{$label}</span></td>";
        echo "<td style='padding: 12px; font-size: 13px;'>" . Html::convDate($projet['date_debut']) . "</td>";
        echo "<td style='padding: 12px;'>";
        echo "<a href='projet.form.php?id={$projet['id']}' class='btn btn-sm btn-info' style='margin-right: 5px;' title='" . __('Modifier', 'projet') . "'>";
        echo "<i class='fas fa-edit'></i> " . __('Modifier', 'projet') . "</a>";
        echo "</td>";
        echo "</tr>";
    }
}

echo "</tbody>";
echo "</table>";
echo "</div>";

Html::footer();
