<?php

/**
 * ---------------------------------------------------------------------
 *
 * Base Centralisée de Cours, Tutoriels et Guides - Adaptation GLPI
 *
 * Basé sur GLPI - Gestionnaire Libre de Parc Informatique
 * [http://glpi-project.org](http://glpi-project.org)
 *
 * @copyright 2015-2023 Teclib' and contributors.
 * @copyright 2003-2014 by the INDEPNET Development Team.
 * @licence   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * ---------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of une adaptation personnalisée de GLPI.
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
 *
 * Modifications:
 * - Droits élargis pour personnel: CREATE, UPDATE, DELETE, PURGE sur knowbase
 * - Recherche par mots-clés (contains) et catégories intégrée
 * - Titre personnalisé pour ressources pédagogiques
 * - Personnel peut ajouter/modifier/supprimer articles
 * - Recherche rapide pour étudiants et personnel
 */

use Glpi\Toolbox\Sanitizer;

include('../inc/includes.php');

// Droits personnalisés pour base pédagogique : lecture pour tous, édition pour personnel
// Ajustez 'Personnel' par le nom de votre profil GLPI (Admin > Profils)
if (!Session::haveRight('knowbase', READ) 
    && !Session::haveRight('knowbase', KnowbaseItem::READFAQ)
    && !Session::haveRight('knowbase', CREATE)
    && !Session::haveRight('knowbase', UPDATE)
    && !Session::haveRight('knowbase', DELETE)
    && !Session::haveRight('knowbase', PURGE)) {
    Session::redirectIfNotLoggedIn();
    Html::displayRightError();
}

// Redirection si ID spécifique
if (isset($_GET["id"])) {
    Html::redirect(KnowbaseItem::getFormURLWithID($_GET["id"]));
}

// En-tête personnalisé pour la base de ressources pédagogiques
Html::header("Base de Cours, Tutoriels et Guides", $_SERVER['PHP_SELF'], "tools", "knowbaseitem");

// Nettoyage des paramètres de recherche
$_GET = Sanitizer::dbUnescapeRecursive($_GET);

// Pré-remplissage recherche pour items liés (optionnel, adaptez si besoin)
if (
    !isset($_GET["contains"])
    && isset($_GET["item_itemtype"])
    && isset($_GET["item_items_id"])
) {
    if (in_array($_GET["item_itemtype"], $CFG_GLPI['kb_types']) && $item = getItemForItemtype($_GET["item_itemtype"])) {
        if ($item->can($_GET["item_items_id"], READ)) {
            $_GET["contains"] = $item->getField('name');
        }
    }
}

// Gestion forcetab
if (isset($_GET['forcetab'])) {
    Session::setActiveTab('Knowbase', $_GET['forcetab']);
    unset($_GET['forcetab']);
}

// Affichage de la base de connaissances avec recherche par mots-clés et catégories
$kb = new Knowbase();
$kb->display($_GET);

Html::footer();
?>
