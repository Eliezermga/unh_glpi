<?php

include ('../../../inc/includes.php');

Session::checkRight("config", UPDATE);

Html::header(
    __('Configuration UNH Assets', 'unhassets'),
    $_SERVER['PHP_SELF'],
    "config",
    "plugins"
);

echo "<div class='center'>";
echo "<table class='tab_cadre_fixe'>";
echo "<tr><th colspan='2'>" . __('Configuration du plugin UNH Assets', 'unhassets') . "</th></tr>";

echo "<tr class='tab_bg_1'>";
echo "<td colspan='2'>";
echo "<h3>" . __('Fonctionnalités actives', 'unhassets') . "</h3>";
echo "<ul>";
echo "<li>✅ " . __('Gestion centralisée du parc informatique', 'unhassets') . "</li>";
echo "<li>✅ " . __('Module de réservation de matériel', 'unhassets') . "</li>";
echo "<li>✅ " . __('Gestion des licences et alertes', 'unhassets') . "</li>";
echo "<li>✅ " . __('Tableau de bord et rapports', 'unhassets') . "</li>";
echo "</ul>";
echo "</td>";
echo "</tr>";

echo "<tr class='tab_bg_1'>";
echo "<td colspan='2'>";
echo "<h3>" . __('Actions automatiques', 'unhassets') . "</h3>";
echo "<p>" . __('Pour activer les alertes automatiques des licences :', 'unhassets') . "</p>";
echo "<ol>";
echo "<li>" . __('Aller dans Configuration > Actions automatiques', 'unhassets') . "</li>";
echo "<li>" . __('Rechercher "checkExpiration"', 'unhassets') . "</li>";
echo "<li>" . __('Activer la tâche et configurer la fréquence', 'unhassets') . "</li>";
echo "</ol>";
echo "</td>";
echo "</tr>";

echo "<tr class='tab_bg_1'>";
echo "<td colspan='2'>";
echo "<h3>" . __('Statistiques', 'unhassets') . "</h3>";

global $DB;

$total_assets = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_assets',
    'WHERE' => ['is_deleted' => 0]
])->current()['cpt'];

$total_reservations = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_reservations'
])->current()['cpt'];

$total_licenses = $DB->request([
    'COUNT' => 'cpt',
    'FROM'  => 'glpi_plugin_unhassets_licenses',
    'WHERE' => ['is_deleted' => 0]
])->current()['cpt'];

echo "<ul>";
echo "<li>" . sprintf(__('Total équipements : %d', 'unhassets'), $total_assets) . "</li>";
echo "<li>" . sprintf(__('Total réservations : %d', 'unhassets'), $total_reservations) . "</li>";
echo "<li>" . sprintf(__('Total licences : %d', 'unhassets'), $total_licenses) . "</li>";
echo "</ul>";
echo "</td>";
echo "</tr>";

echo "<tr class='tab_bg_1'>";
echo "<td colspan='2'>";
echo "<h3>" . __('Support', 'unhassets') . "</h3>";
echo "<p>" . __('Pour toute question, consulter le fichier README.md du plugin.', 'unhassets') . "</p>";
echo "<p><strong>" . __('Version', 'unhassets') . " :</strong> " . PLUGIN_UNHASSETS_VERSION . "</p>";
echo "</td>";
echo "</tr>";

echo "</table>";
echo "</div>";

Html::footer();