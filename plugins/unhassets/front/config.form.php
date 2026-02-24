<?php

include ('../../../inc/includes.php');

Session::checkRight("config", UPDATE);

Html::header(
    __('UNH Assets Configuration', 'unhassets'),
    $_SERVER['PHP_SELF'],
    "config",
    "plugins"
);

echo "<div class='center'>";
echo "<table class='tab_cadre_fixe'>";
echo "<tr><th colspan='2'>" . __('UNH Assets Plugin Configuration', 'unhassets') . "</th></tr>";

echo "<tr class='tab_bg_1'>";
echo "<td colspan='2'>";
echo "<h3>" . __('Active Features', 'unhassets') . "</h3>";
echo "<ul>";
echo "<li>✅ " . __('Centralised IT asset management', 'unhassets') . "</li>";
echo "<li>✅ " . __('Equipment reservation module', 'unhassets') . "</li>";
echo "<li>✅ " . __('License management and alerts', 'unhassets') . "</li>";
echo "<li>✅ " . __('Dashboard and reports', 'unhassets') . "</li>";
echo "</ul>";
echo "</td>";
echo "</tr>";

echo "<tr class='tab_bg_1'>";
echo "<td colspan='2'>";
echo "<h3>" . __('Automated Actions', 'unhassets') . "</h3>";
echo "<p>" . __('To enable automatic license expiry alerts:', 'unhassets') . "</p>";
echo "<ol>";
echo "<li>" . __('Go to Setup > Automatic Actions', 'unhassets') . "</li>";
echo "<li>" . __('Search for "checkExpiration"', 'unhassets') . "</li>";
echo "<li>" . __('Enable the task and configure its frequency', 'unhassets') . "</li>";
echo "</ol>";
echo "</td>";
echo "</tr>";

echo "<tr class='tab_bg_1'>";
echo "<td colspan='2'>";
echo "<h3>" . __('Statistics', 'unhassets') . "</h3>";

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
echo "<li>" . sprintf(__('Total assets: %d', 'unhassets'), $total_assets) . "</li>";
echo "<li>" . sprintf(__('Total reservations: %d', 'unhassets'), $total_reservations) . "</li>";
echo "<li>" . sprintf(__('Total licenses: %d', 'unhassets'), $total_licenses) . "</li>";
echo "</ul>";
echo "</td>";
echo "</tr>";

echo "<tr class='tab_bg_1'>";
echo "<td colspan='2'>";
echo "<h3>" . __('Support', 'unhassets') . "</h3>";
echo "<p>" . __('For any questions, refer to the plugin README.md file.', 'unhassets') . "</p>";
echo "<p><strong>" . __('Version', 'unhassets') . " :</strong> " . PLUGIN_UNHASSETS_VERSION . "</p>";
echo "</td>";
echo "</tr>";

echo "</table>";
echo "</div>";

Html::footer();
