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

use Glpi\Event;
use Glpi\RichText\RichText;

/**
 * KnowbaseItemTranslation Class
 *
 * @since 0.85
 **/
class KnowbaseItemTranslation extends CommonDBChild
{
    public static $itemtype = 'KnowbaseItem';
    public static $items_id = 'knowbaseitems_id';
    public $dohistory       = true;
    public static $logs_for_parent = false;

    public static $rightname       = 'knowbase';
    private static $translation_cache = [];



    public static function getTypeName($nb = 0)
    {
        return _n('Translation', 'Translations', $nb);
    }


    public function defineTabs($options = [])
    {

        $ong = [];
        $this->addStandardTab(__CLASS__, $ong, $options);
        $this->addStandardTab('Log', $ong, $options);
        $this->addStandardTab('KnowbaseItem_Revision', $ong, $options);
        $this->addStandardTab('KnowbaseItem_Comment', $ong, $options);

        return $ong;
    }

    public function getForbiddenStandardMassiveAction()
    {

        $forbidden   = parent::getForbiddenStandardMassiveAction();
        $forbidden[] = 'update';
        return $forbidden;
    }


    public function getTabNameForItem(CommonGLPI $item, $withtemplate = 0)
    {

        if (!$withtemplate) {
            $nb = 0;
            switch ($item->getType()) {
                case __CLASS__:
                    $ong[1] = $this->getTypeName(1);
                    if ($item->canUpdateItem()) {
                        $ong[3] = __('Edit');
                    }
                    return $ong;
            }
        }

        if (self::canBeTranslated($item)) {
            $nb = 0;
            if ($_SESSION['glpishow_count_on_tabs']) {
                $nb = self::getNumberOfTranslationsForItem($item);
            }
            return self::createTabEntry(self::getTypeName(Session::getPluralNumber()), $nb);
        }

        return '';
    }


    /**
     * @param $item            CommonGLPI object
     * @param $tabnum          (default 1)
     * @param $withtemplate    (default 0)
     **/
    public static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0)
    {

        if ($item->getType() == __CLASS__) {
            switch ($tabnum) {
                case 1:
                    $item->showFull();
                    break;

                case 2:
                    $item->showVisibility();
                    break;

                case 3:
                    $item->showForm($item->getID());
                    break;
            }
        } else if (self::canBeTranslated($item)) {
            self::showTranslations($item);
        }
        return true;
    }

    /**
     * Print out (html) show item : question and answer
     *
     * @param $options      array of options
     *
     * @return void
     **/
    public function showFull($options = [])
    {
        global $CFG_GLPI;

        if (!$this->can($this->fields['id'], READ)) {
            return false;
        }

        $linkusers_id = true;
       // show item : question and answer
        if (
            ((Session::getLoginUserID() === false) && $CFG_GLPI["use_public_faq"])
            || (Session::getCurrentInterface() == "helpdesk")
            || !User::canView()
        ) {
            $linkusers_id = false;
        }

        echo "<table class='tab_cadre_fixe'>";

        echo "<tr><td class='left' colspan='4'><h2>" . __('Subject') . "</h2>";
        echo $this->fields["name"];

        echo "</td></tr>";
        echo "<tr><td class='left' colspan='4'><h2>" . __('Content') . "</h2>\n";

        echo "<div class='rich_text_container' id='kbanswer'>";
        echo RichText::getEnhancedHtml($this->fields['answer']);
        echo "</div>";
        echo "</td></tr>";
        echo "</table>";

        return true;
    }

    /**
     * Display all translated field for an KnowbaseItem
     *
     * @param $item a KnowbaseItem item
     *
     * @return true;
     **/
    public static function showTranslations(KnowbaseItem $item)
    {
        global $CFG_GLPI;

        $canedit = $item->can($item->getID(), UPDATE);
        $rand    = mt_rand();
        if ($canedit) {
            echo "<div id='viewtranslation" . $item->getID() . "$rand'></div>\n";
            echo "<script type='text/javascript' >\n";
            echo "function addTranslation" . $item->getID() . "$rand() {\n";
            $params = ['type'             => __CLASS__,
                'parenttype'       => get_class($item),
                'knowbaseitems_id' => $item->fields['id'],
                'id'               => -1
            ];
            Ajax::updateItemJsCode(
                "viewtranslation" . $item->getID() . "$rand",
                $CFG_GLPI["root_doc"] . "/ajax/viewsubitem.php",
                $params
            );
            echo "};";
            echo "</script>\n";

            echo "<div class='center'>" .
              "<a class='btn btn-primary' href='javascript:addTranslation" . $item->getID() . "$rand();'>" .
              __('Add a new translation') . "</a></div><br>";
        }

        $obj   = new self();
        $found = $obj->find(['knowbaseitems_id' => $item->getID()], "language ASC");

        if (count($found) > 0) {
            if ($canedit) {
                Html::openMassiveActionsForm('mass' . __CLASS__ . $rand);
                $massiveactionparams = ['container' => 'mass' . __CLASS__ . $rand];
                Html::showMassiveActions($massiveactionparams);
            }

            Session::initNavigateListItems('KnowbaseItemTranslation', __('Entry translations list'));

            echo "<div class='center'>";
            echo "<table class='tab_cadre_fixehov'><tr class='tab_bg_2'>";
            echo "<th colspan='4'>" . __("List of translations") . "</th></tr>";
            if ($canedit) {
                echo "<th width='10'>";
                echo Html::getCheckAllAsCheckbox('mass' . __CLASS__ . $rand);
                echo "</th>";
            }
            echo "<th>" . __("Language") . "</th>";
            echo "<th>" . __("Subject") . "</th>";
            foreach ($found as $data) {
                echo "<tr class='tab_bg_1'>";
                if ($canedit) {
                    echo "<td class='center'>";
                    Html::showMassiveActionCheckBox(__CLASS__, $data["id"]);
                    echo "</td>";
                }
                echo "<td>";
                echo Dropdown::getLanguageName($data['language']);
                echo "</td><td>";
                if ($canedit) {
                    echo "<a href=\"" . KnowbaseItemTranslation::getFormURLWithID($data["id"]) . "\">{$data['name']}</a>";
                } else {
                    echo  $data["name"];
                }
                if (isset($data['answer']) && !empty($data['answer'])) {
                    echo "&nbsp;";
                    Html::showToolTip(RichText::getEnhancedHtml($data['answer']));
                }
                echo "</td></tr>";
            }
            echo "</table>";
            if ($canedit) {
                $massiveactionparams['ontop'] = false;
                Html::showMassiveActions($massiveactionparams);
                Html::closeForm();
            }
        } else {
            echo "<table class='tab_cadre_fixe'><tr class='tab_bg_2'>";
            echo "<th class='b'>" . __("No translation found") . "</th></tr></table>";
        }

        return true;
    }


    /**
     * Display translation form
     *
     * @param integer $ID
     * @param array   $options
     */
    public function showForm($ID = -1, array $options = [])
    {
        if (isset($options['parent']) && !empty($options['parent'])) {
            $item = $options['parent'];
        }
        if ($ID > 0) {
            $this->check($ID, READ);
        } else {
           // Create item
            $options['itemtype']         = get_class($item);
            $options['knowbaseitems_id'] = $item->getID();
            $this->check(-1, CREATE, $options);
        }
        $this->showFormHeader($options);
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Language') . "&nbsp;:</td>";
        echo "<td>";
        echo "<input type='hidden' name='users_id' value=\"" . Session::getLoginUserID() . "\">";
        echo "<input type='hidden' name='knowbaseitems_id' value='" . $this->fields['knowbaseitems_id'] . "'>";
        if ($ID > 0) {
            echo Dropdown::getLanguageName($this->fields['language']);
        } else {
            Dropdown::showLanguages(
                "language",
                ['display_none' => false,
                    'value'        => $_SESSION['glpilanguage'],
                    'used'         => self::getAlreadyTranslatedForItem($item)
                ]
            );
        }
        echo "</td><td colspan='2'>&nbsp;</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Subject') . "</td>";
        echo "<td colspan='3'>";
        echo "<textarea class='form-control' name='name'>" . $this->fields["name"] . "</textarea>";
        echo "</td></tr>\n";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Content') . "</td>";
        echo "<td colspan='3'>";
        Html::textarea(
            [
                'name'              => 'answer',
                'value'             => RichText::getSafeHtml($this->fields['answer'], true),
                'editor_id'         => 'answer',
                'enable_fileupload' => false,
                'enable_richtext'   => true,
                'cols'              => 100,
                'rows'              => 30
            ]
        );
        echo "</td></tr>\n";

        $this->showFormButtons($options);
        return true;
    }


    /**
     * Get a translation for a value
     *
     * @param KnowbaseItem $item   item to translate
     * @param string       $field  field to return (default 'name')
     *
     * @return string  the field translated if a translation is available, or the original field if not
     **/
    public static function getTranslatedValue(KnowbaseItem $item, $field = "name")
    {
        global $DB;

        if (!in_array($field, ['name', 'answer'])) {
            return $item->fields[$field] ?? "";
        }

        $language = $_SESSION['glpilanguage'] ?? '';
        $cache_key = $item->getID() . '|' . $field . '|' . $language;
        if (array_key_exists($cache_key, self::$translation_cache)) {
            return self::$translation_cache[$cache_key];
        }

        $languages = self::getPreferredLanguages($language);

        $obj   = new self();
        foreach ($languages as $current_language) {
            $found = $obj->find([
                'knowbaseitems_id'   => $item->getID(),
                'language'           => $current_language
            ]);

            if (count($found) > 0) {
                $first = array_shift($found);
                if (!empty($first[$field])) {
                    self::$translation_cache[$cache_key] = $first[$field];
                    return $first[$field];
                }
            }
        }

        if (
            !empty($language)
            && preg_match('/^([a-z]{2})[_-]/i', $language, $matches)
        ) {
            $base_language = strtolower($matches[1]);
            $iterator = $DB->request([
                'SELECT' => [$field],
                'FROM'   => self::getTable(),
                'WHERE'  => [
                    'knowbaseitems_id' => $item->getID(),
                    'language'         => ['LIKE', $base_language . '\_%']
                ],
                'ORDER'  => ['language ASC'],
                'LIMIT'  => 1
            ]);

            if (count($iterator)) {
                $current = $iterator->current();
                if (!empty($current[$field])) {
                    self::$translation_cache[$cache_key] = $current[$field];
                    return $current[$field];
                }
            }
        }

        if (is_string($item->fields[$field]) && $item->fields[$field] !== '') {
            $gettext_fallback = __($item->fields[$field]);
            if ($gettext_fallback !== $item->fields[$field]) {
                self::$translation_cache[$cache_key] = $gettext_fallback;
                return $gettext_fallback;
            }
        }

        if ($field === 'answer') {
            $faq_answer_key = self::getFaqAnswerTranslationKey($item);
            if ($faq_answer_key !== null) {
                $faq_answer_keys = [$faq_answer_key];
                $legacy_answer_key = str_replace('faq.static.answer.', 'faq.answer.', $faq_answer_key);
                if ($legacy_answer_key !== $faq_answer_key) {
                    $faq_answer_keys[] = $legacy_answer_key;
                }

                foreach ($faq_answer_keys as $answer_key) {
                    $faq_answer_translation = __($answer_key);
                    if ($faq_answer_translation !== $answer_key) {
                        self::$translation_cache[$cache_key] = $faq_answer_translation;
                        return $faq_answer_translation;
                    }
                }
            }
        }

        self::$translation_cache[$cache_key] = $item->fields[$field];
        return $item->fields[$field];
    }

    /**
     * Return gettext key for FAQ answer by canonical FAQ title.
     */
    private static function getFaqAnswerTranslationKey(KnowbaseItem $item): ?string
    {
        if ((int) ($item->fields['is_faq'] ?? 0) !== 1) {
            return null;
        }

        $faq_map = self::getFaqQuestionToAnswerMap();
        foreach (self::getFaqQuestionCandidates($item) as $candidate) {
            $normalized_candidate = self::normalizeFaqQuestionForLookup($candidate);
            if ($normalized_candidate !== '' && isset($faq_map[$normalized_candidate])) {
                return $faq_map[$normalized_candidate];
            }
        }

        if (!isset($item->fields['name'])) {
            return null;
        }

        $name = trim((string)$item->fields['name']);
        if ($name === '') {
            return null;
        }

        $canonical_name = function_exists('mb_strtolower')
            ? mb_strtolower($name, 'UTF-8')
            : strtolower($name);
        $canonical_name = preg_replace('/\s+/u', ' ', $canonical_name);

        $faq_answer_keys = [
            'comment créer un ticket de support ?'        => 'faq.answer.create_support_ticket',
            'comment réinitialiser mon mot de passe ?'    => 'faq.answer.reset_password',
            'comment se connecter au wifi du campus ?'    => 'faq.answer.connect_campus_wifi',
            'mon ordinateur ne démarre plus, que faire ?' => 'faq.answer.computer_not_booting',
            'comment installer un logiciel ?'             => 'faq.answer.install_software',
            "l'imprimante ne fonctionne pas"              => 'faq.answer.printer_not_working',
            'comment accéder à mes fichiers à distance ?' => 'faq.answer.remote_file_access',
            'mon écran reste noir ou figé'                => 'faq.answer.black_or_frozen_screen',
            "comment suivre l'état de mon ticket ?"       => 'faq.answer.track_ticket_status',
            'les raccourcis clavier utiles'               => 'faq.answer.useful_keyboard_shortcuts',
        ];

        return $faq_answer_keys[$canonical_name] ?? null;
    }

    /**
     * Return all known question candidates for an FAQ item (base + translations).
     *
     * @param KnowbaseItem $item
     *
     * @return string[]
     */
    private static function getFaqQuestionCandidates(KnowbaseItem $item): array
    {
        $candidates = [];

        $base_name = trim((string) ($item->fields['name'] ?? ''));
        if ($base_name !== '') {
            $candidates[] = $base_name;
        }

        $translations = new self();
        foreach ($translations->find(['knowbaseitems_id' => $item->getID()]) as $translation) {
            $translated_name = trim((string) ($translation['name'] ?? ''));
            if ($translated_name !== '') {
                $candidates[] = $translated_name;
            }
        }

        return array_values(array_unique($candidates));
    }

    /**
     * Build lookup map from normalized FAQ question aliases to static answer keys.
     *
     * @return array<string,string>
     */
    private static function getFaqQuestionToAnswerMap(): array
    {
        static $faq_map = null;

        if (is_array($faq_map)) {
            return $faq_map;
        }

        $faq_pairs = [
            [
                'answer_key' => 'faq.static.answer.create_support_ticket',
                'aliases' => [
                    'faq.static.question.create_support_ticket',
                    'comment creer un ticket de support ?',
                    'how to create a support ticket?',
                    'how do i create a support ticket?',
                ],
            ],
            [
                'answer_key' => 'faq.static.answer.reset_password',
                'aliases' => [
                    'faq.static.question.reset_password',
                    'comment reinitialiser mon mot de passe ?',
                    'how to reset my password?',
                    'how do i reset my password?',
                ],
            ],
            [
                'answer_key' => 'faq.static.answer.connect_campus_wifi',
                'aliases' => [
                    'faq.static.question.connect_campus_wifi',
                    'comment se connecter au wifi du campus ?',
                    'how to connect to campus wifi?',
                ],
            ],
            [
                'answer_key' => 'faq.static.answer.computer_not_booting',
                'aliases' => [
                    'faq.static.question.computer_not_booting',
                    'mon ordinateur ne demarre plus, que faire ?',
                    'my computer does not start, what should i do?',
                    'my computer is not booting, what should i do?',
                ],
            ],
            [
                'answer_key' => 'faq.static.answer.install_software',
                'aliases' => [
                    'faq.static.question.install_software',
                    'comment installer un logiciel ?',
                    'how to install software?',
                ],
            ],
            [
                'answer_key' => 'faq.static.answer.printer_not_working',
                'aliases' => [
                    'faq.static.question.printer_not_working',
                    "l'imprimante ne fonctionne pas",
                    'printer is not working',
                ],
            ],
            [
                'answer_key' => 'faq.static.answer.remote_file_access',
                'aliases' => [
                    'faq.static.question.remote_file_access',
                    'comment acceder a mes fichiers a distance ?',
                    'how to access my files remotely?',
                ],
            ],
            [
                'answer_key' => 'faq.static.answer.black_or_frozen_screen',
                'aliases' => [
                    'faq.static.question.black_or_frozen_screen',
                    'mon ecran reste noir ou fige',
                    'my screen is black or frozen',
                ],
            ],
            [
                'answer_key' => 'faq.static.answer.track_ticket_status',
                'aliases' => [
                    'faq.static.question.track_ticket_status',
                    "comment suivre l'etat de mon ticket ?",
                    'how to track my ticket status?',
                ],
            ],
            [
                'answer_key' => 'faq.static.answer.useful_keyboard_shortcuts',
                'aliases' => [
                    'faq.static.question.useful_keyboard_shortcuts',
                    'les raccourcis clavier utiles',
                    'useful keyboard shortcuts',
                ],
            ],
        ];

        $faq_map = [];
        foreach ($faq_pairs as $pair) {
            $answer_key = $pair['answer_key'];

            foreach ($pair['aliases'] as $alias) {
                $normalized_alias = self::normalizeFaqQuestionForLookup((string) $alias);
                if ($normalized_alias !== '') {
                    $faq_map[$normalized_alias] = $answer_key;
                }
            }
        }

        return $faq_map;
    }

    /**
     * Normalize FAQ question text for stable matching across locale variants.
     */
    private static function normalizeFaqQuestionForLookup(string $value): string
    {
        $value = trim($value);
        if ($value === '') {
            return '';
        }

        $value = str_replace(['’', '‘', '`', '´'], "'", $value);
        $value = function_exists('mb_strtolower')
            ? mb_strtolower($value, 'UTF-8')
            : strtolower($value);

        if (class_exists(\Normalizer::class)) {
            $normalized = \Normalizer::normalize($value, \Normalizer::FORM_D);
            if (is_string($normalized)) {
                $value = $normalized;
            }
        }

        $value = preg_replace('/\p{Mn}+/u', '', $value) ?? $value;

        if (function_exists('iconv')) {
            $ascii_value = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
            if (is_string($ascii_value) && $ascii_value !== '') {
                $value = $ascii_value;
            }
        }

        $value = preg_replace('/[^a-z0-9\s\?\']+/i', ' ', $value) ?? $value;
        $value = preg_replace('/\s+/u', ' ', $value) ?? $value;

        return trim($value);
    }

    /**
     * Build ordered fallback languages for KB translations.
     *
     * @param string $language
     *
     * @return array
     **/
    private static function getPreferredLanguages(string $language): array
    {
        $preferred = [];

        if (!empty($language)) {
            $preferred[] = $language;
        }

        if (preg_match('/^([a-z]{2})[_-]([a-z]{2})$/i', $language, $matches)) {
            $base = strtolower($matches[1]);
            if ($base === 'en') {
                $preferred[] = 'en_US';
                $preferred[] = 'en_GB';
            } elseif ($base === 'fr') {
                $preferred[] = 'fr_FR';
                $preferred[] = 'fr_CA';
                $preferred[] = 'fr_BE';
            }
        }

        return array_values(array_unique(array_filter($preferred)));
    }


    /**
     * Is kb item translation functionality active
     *
     * @return true if active, false if not
     **/
    public static function isKbTranslationActive()
    {
        global $CFG_GLPI;

        return $CFG_GLPI['translate_kb'];
    }


    /**
     * Check if an item can be translated
     * It be translated if translation if globally on and item is an instance of CommonDropdown
     * or CommonTreeDropdown and if translation is enabled for this class
     *
     * @param item the item to check
     *
     * @return true if item can be translated, false otherwise
     **/
    public static function canBeTranslated(CommonGLPI $item)
    {

        return (self::isKbTranslationActive()
              && $item instanceof KnowbaseItem);
    }


    /**
     * Return the number of translations for an item
     *
     * @param KnowbaseItem $item
     *
     * @return integer  the number of translations for this item
     **/
    public static function getNumberOfTranslationsForItem($item)
    {

        return countElementsInTable(
            getTableForItemType(__CLASS__),
            ['knowbaseitems_id' => $item->getID()]
        );
    }


    /**
     * Get already translated languages for item
     *
     * @param item
     *
     * @return array of already translated languages
     **/
    public static function getAlreadyTranslatedForItem($item)
    {
        global $DB;

        $tab = [];

        $iterator = $DB->request([
            'FROM'   => getTableForItemType(__CLASS__),
            'WHERE'  => ['knowbaseitems_id' => $item->getID()]
        ]);

        foreach ($iterator as $data) {
            $tab[$data['language']] = $data['language'];
        }
        return $tab;
    }

    public function pre_updateInDB()
    {
        $revision = new KnowbaseItem_Revision();
        $translation = new KnowbaseItemTranslation();
        $translation->getFromDB($this->getID());
        $revision->createNewTranslated($translation);
    }

    /**
     * Reverts item translation contents to specified revision
     *
     * @param integer $revid Revision ID
     *
     * @return boolean
     */
    public function revertTo($revid)
    {
        $revision = new KnowbaseItem_Revision();
        $revision->getFromDB($revid);

        $values = [
            'id'     => $this->getID(),
            'name'   => $revision->fields['name'],
            'answer' => $revision->fields['answer']
        ];

        if ($this->update($values)) {
            Event::log(
                $this->getID(),
                "knowbaseitemtranslation",
                5,
                "tools",
                //TRANS: %1$s is the user login, %2$s the revision number
                sprintf(__('%1$s reverts item translation to revision %2$s'), $_SESSION["glpiname"], $revision)
            );
            return true;
        } else {
            return false;
        }
    }
}
