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

/**
 * Budget class
 */
class Budget extends CommonDropdown
{
    use Glpi\Features\Clonable;

    public $dohistory = true;
    public static $rightname = 'budget';
    protected $usenotepad = true;
    public $can_be_translated = false;

    public function getCloneRelations(): array
    {
        return [Document_Item::class];
    }

    public static function getTypeName($nb = 0)
    {
        return _n('Budget', 'Budgets', $nb);
    }

    public function defineTabs($options = [])
    {
        $ong = [];
        $this->addDefaultFormTab($ong);
        $this->addStandardTab(__CLASS__, $ong, $options);
        $this->addStandardTab('Document_Item', $ong, $options);
        $this->addStandardTab('KnowbaseItem_Item', $ong, $options);
        $this->addStandardTab('ManualLink', $ong, $options);
        $this->addStandardTab('Notepad', $ong, $options);
        $this->addStandardTab('Log', $ong, $options);
        return $ong;
    }

    public function getTabNameForItem(CommonGLPI $item, $withtemplate = 0)
    {
        if (!$withtemplate) {
            switch ($item->getType()) {
                case __CLASS__:
                    return [
                        1 => __('Main'),
                        2 => _n('Item', 'Items', Session::getPluralNumber())
                    ];
            }
        }
        return '';
    }

    public static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0)
    {
        if ($item->getType() == __CLASS__) {
            switch ($tabnum) {
                case 1:
                    $item->showValuesByEntity();
                    break;
                case 2:
                    $item->showItems();
                    break;
            }
        }
        return true;
    }

    public function showForm($ID, array $options = [])
    {
        $rowspan = 2;
        if ($ID > 0) {
            $rowspan++;
        }

        $this->initForm($ID, $options);
        $this->showFormHeader($options);

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Name') . "</td>";
        echo "<td>";
        echo Html::input('name', ['value' => $this->fields['name']]);
        echo "</td>";
        echo "<td>" . __('Référence Annuelle UNH') . "</td>";
        echo "<td>";
        echo Html::input('unh_budget_code', ['value' => $this->fields['unh_budget_code'] ?? '']);
        echo "</td>";
        echo "<td>" . _n('Type', 'Types', 1) . "</td>";
        echo "<td>";
        Dropdown::show('BudgetType', ['value' => $this->fields['budgettypes_id']]);
        echo "</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . _x('price', 'Value') . "</td>";
        echo "<td>";
        echo "<input type='text' name='value' size='14' value='" . Html::formatNumber($this->fields["value"], true) . "' class='form-control'>";
        echo "</td>";
        echo "<td rowspan='$rowspan' class='middle right'></td>";
        echo "<td class='center middle' rowspan='$rowspan'></td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Start date') . "</td>";
        echo "<td>";
        Html::showDateField("begin_date", [
            'value' => $this->fields["begin_date"],
            'id'    => 'begin_date_field'
        ]);
        echo "</td>";
        echo "<td></td><td></td>";
        echo "</tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('End date') . "</td>";
        echo "<td>";
        Html::showDateField("end_date", [
            'value' => $this->fields["end_date"],
            'id'    => 'end_date_field'
        ]);
        echo "</td>";
        echo "<td></td><td></td>";
        echo "</tr>";

        // Script de validation des dates
        echo "<script type='text/javascript'>
            $(document).ready(function() {
                function validateDates() {
                    var startField = $('#begin_date_field');
                    var endField = $('#end_date_field');
                    
                    var startValue = startField.val();
                    var endValue = endField.val();
                    
                    if (!startValue) {
                        startValue = startField.closest('td').find('input[type=hidden]').val();
                    }
                    if (!endValue) {
                        endValue = endField.closest('td').find('input[type=hidden]').val();
                    }
                    
                    if (startValue && endValue) {
                        if (endValue < startValue) {
                            alert('Erreur : La date de fin ne peut pas être antérieure à la date de début');
                            endField.val('');
                            endField.closest('td').find('input[type=hidden]').val('');
                            endField.closest('td').find('.datepicker').val('');
                        }
                    }
                }
                
                $('#end_date_field').on('change blur', function() {
                    validateDates();
                });
                
                $('#begin_date_field').on('change', function() {
                    var endValue = $('#end_date_field').val();
                    if (!endValue) {
                        endValue = $('#end_date_field').closest('td').find('input[type=hidden]').val();
                    }
                    if (endValue) {
                        validateDates();
                    }
                });
            });
        </script>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Location') . "</td>";
        echo "<td>";
        Location::dropdown([
            'value'  => $this->fields["locations_id"],
            'entity' => $this->fields["entities_id"]
        ]);
        echo "</td>";
        echo "<td colspan='4'></td>";
        echo "</tr>";

        $this->showFormButtons($options);
        return true;
    }

    public function prepareInputForAdd($input)
    {
        if (!isset($input['is_recursive'])) {
            $input['is_recursive'] = 1;
        }

        if (!empty($input['begin_date']) && !empty($input['end_date'])) {
            if ($input['end_date'] < $input['begin_date']) {
                Session::addMessageAfterRedirect(
                    __('La date de fin ne peut pas être antérieure à la date de début'),
                    false,
                    ERROR
                );
                return false;
            }
        }

        if (isset($input["id"]) && ($input["id"] > 0)) {
            $input["_oldID"] = $input["id"];
        }
        unset($input['id']);
        unset($input['withtemplate']);

        return $input;
    }

    public function prepareInputForUpdate($input)
    {
        if (!empty($input['begin_date']) && !empty($input['end_date'])) {
            if ($input['end_date'] < $input['begin_date']) {
                Session::addMessageAfterRedirect(
                    __('La date de fin ne peut pas être antérieure à la date de début'),
                    false,
                    ERROR
                );
                return false;
            }
        }
        return $input;
    }

    public function rawSearchOptions()
    {
        $tab = [];

        $tab[] = [
            'id' => 'common',
            'name' => __('Characteristics')
        ];

        $tab[] = [
            'id' => '1',
            'table' => $this->getTable(),
            'field' => 'name',
            'name' => __('Name'),
            'datatype' => 'itemlink'
        ];

        $tab[] = [
            'id' => '2',
            'table' => $this->getTable(),
            'field' => 'id',
            'name' => __('ID'),
            'datatype' => 'number'
        ];

        $tab[] = [
            'id' => '5',
            'table' => $this->getTable(),
            'field' => 'begin_date',
            'name' => __('Start date'),
            'datatype' => 'date'
        ];

        $tab[] = [
            'id' => '6',
            'table' => $this->getTable(),
            'field' => 'end_date',
            'name' => __('End date'),
            'datatype' => 'date'
        ];

        $tab[] = [
            'id' => '7',
            'table' => $this->getTable(),
            'field' => 'value',
            'name' => _x('price', 'Value'),
            'datatype' => 'decimal'
        ];

        $tab[] = [
            'id' => '8',
            'table' => $this->getTable(),
            'field' => 'unh_budget_code',
            'name' => __('Référence Annuelle UNH'),
            'datatype' => 'string'
        ];

        $tab = array_merge($tab, Location::rawSearchOptionsToAdd());
        $tab = array_merge($tab, Notepad::rawSearchOptionsToAdd());

        return $tab;
    }

    public function showItems()
    {
        // Votre code original ici
        parent::showItems();
    }

    public function showValuesByEntity()
    {
        // Votre code original ici
        parent::showValuesByEntity();
    }

    public static function getIcon()
    {
        return "ti ti-calculator";
    }
}