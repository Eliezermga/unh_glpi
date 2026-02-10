<?php

/**
 * ---------------------------------------------------------------------
 *
 * Base de connaissances pédagogique (Cours, Tutoriels et Guides)
 * Adaptation GLPI
 *
 * Basé sur GLPI - Gestionnaire Libre de Parc Informatique
 * https://glpi-project.org
 *
 * @copyright 2015-2023 Teclib'
 * @licence   https://www.gnu.org/licenses/gpl-3.0.html
 *
 * ---------------------------------------------------------------------
 *
 * DESCRIPTION
 *
 * Base centralisée regroupant :
 *  - Cours universitaires
 *  - Tutoriels pédagogiques
 *  - Guides pratiques
 *
 * Accès :
 *  - Lecture : étudiants et personnel
 *  - Création / modification / suppression : personnel autorisé
 *
 * Fonctionnalités :
 *  - Recherche par mots-clés
 *  - Classement par catégories
 *  - FAQ pédagogique
 *  - Articles toujours à jour
 */

use Glpi\Toolbox\Sanitizer;

include('../inc/includes.php');

global $CFG_GLPI;

/**
 * ---------------------------------------------------------------------
 * Gestion des droits
 * Lecture obligatoire pour accéder à la base
 * Les droits d'édition sont gérés automatiquement par GLPI
 * ---------------------------------------------------------------------
 */
if (
    !Session::haveRight('knowbase', READ)
    && !Session::haveRight('knowbase', KnowbaseItem::READFAQ)
) {
    Session::redirectIfNotLoggedIn();
    Html::displayRightError();
}

/**
 * ---------------------------------------------------------------------
 * Redirection vers la fiche si un ID est fourni
 * ---------------------------------------------------------------------
 */
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    Html::redirect(
        KnowbaseItem::getFormURLWithID((int) $_GET['id'])
    );
}

/**
 * ---------------------------------------------------------------------
 * En-tête GLPI personnalisé
 * ---------------------------------------------------------------------
 */
Html::header(
    __('Base de connaissances pédagogique'),
    $_SERVER['PHP_SELF'],
    'tools',
    'knowbaseitem'
);

/**
 * ---------------------------------------------------------------------
 * Nettoyage sécurisé des paramètres GET
 * ---------------------------------------------------------------------
 */
$_GET = Sanitizer::dbUnescapeRecursive($_GET);

/**
 * ---------------------------------------------------------------------
 * Pré-remplissage de la recherche si lien avec un objet GLPI
 * ---------------------------------------------------------------------
 */
if (
    !isset($_GET['contains'])
    && isset($_GET['item_itemtype'], $_GET['item_items_id'])
) {
    if (
        in_array($_GET['item_itemtype'], $CFG_GLPI['kb_types'])
        && ($item = getItemForItemtype($_GET['item_itemtype']))
    ) {
        if ($item->can((int) $_GET['item_items_id'], READ)) {
            $_GET['contains'] = $item->getField('name');
        }
    }
}

/**
 * ---------------------------------------------------------------------
 * Gestion du forçage d'onglet
 * ---------------------------------------------------------------------
 */
if (isset($_GET['forcetab'])) {
    Session::setActiveTab('Knowbase', $_GET['forcetab']);
    unset($_GET['forcetab']);
}

/**
 * ---------------------------------------------------------------------
 * Affichage de la base de connaissances
 * ---------------------------------------------------------------------
 */
$knowbase = new Knowbase();
$knowbase->display($_GET);

/**
 * ---------------------------------------------------------------------
 * Pied de page GLPI
 * ---------------------------------------------------------------------
 */
Html::footer();
