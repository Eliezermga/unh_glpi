<?php

/**
 * ---------------------------------------------------------------------
 *
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * http://glpi-project.org
 *
 * @copyright 2015-2023 Teclib' and contributors.
 * @copyright 2003-2014 by the INDEPNET Development Team.
 * @licence   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of GLPI.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * ---------------------------------------------------------------------
 */

include('../inc/includes.php');

Session::checkLoginUser();

if (Session::getCurrentInterface() == "helpdesk") {
    Html::helpHeader(Ticket::getTypeName(Session::getPluralNumber()), 'tickets', 'ticket');
} else {
    Html::header(Ticket::getTypeName(Session::getPluralNumber()), '', "helpdesk", "ticket");
}

$refresh_callback = <<<JS
const container = $('div.ajax-container.search-display-data');
if (container.length > 0 && container.data('js_class') !== undefined) {
    container.data('js_class').getView().refreshResults();
} else {
    // Fallback when fluid search isn't initialized
    window.location.reload();
}
JS;

echo Html::manageRefreshPage(false, $refresh_callback);

// UNH - Lien vers réponses rapides
if (Session::haveRight('ticket', READ)) {
// Affichage du bloc d'astuce avec lien vers les réponses rapides
echo '<div class="alert alert-info" style="margin: 10px 0;">';
echo '<i class="fas fa-lightbulb"></i> ';
echo '<strong>' . __('Astuce :') . '</strong> ';
$link = '<a href="' . $CFG_GLPI['root_doc'] . '/front/unh_reponses_rapides.php" class="btn btn-sm btn-primary" target="_blank">' .
        '<i class="fas fa-comments"></i> ' . __('Réponses Rapides UNH') .
        '</a>';
echo sprintf(__('Utilisez les %s pour répondre plus rapidement aux tickets courants.'), $link);
echo '</div>';

    echo '<div class="alert alert-info" style="margin: 10px 0;">';
    echo '<i class="fas fa-lightbulb"></i> ';
    echo '<strong>Astuce :</strong> Utilisez les ';
    echo '<a href="' . $CFG_GLPI['root_doc'] . '/front/unh_reponses_rapides.php" class="btn btn-sm btn-primary" target="_blank">';
    echo '<i class="fas fa-comments"></i> Réponses Rapides UNH';
    echo '</a>';
    echo ' pour répondre plus rapidement aux tickets courants.';
    echo '</div>';
}

Search::show('Ticket');

if (Session::getCurrentInterface() == "helpdesk") {
    Html::helpFooter();
} else {
    Html::footer();
}
