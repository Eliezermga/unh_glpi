<?php

/**
 * ---------------------------------------------------------------------
 *
 * GLPI - Gestionnaire Libre de Parc Informatique
 *
 * ---------------------------------------------------------------------
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
        return [
            Document_Item::class
        ];
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

    public function showForm($ID, array $options = [])
    {
        $this->initForm($ID, $options);
        $this->showFormHeader($options);

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Name') . "</td>";
        echo "<td>" . Html::input('name', ['value' => $this->fields['name']]) . "</td>";

        echo "<td>" . _n('Type', 'Types', 1) . "</td>";
        echo "<td>";
        Dropdown::show('BudgetType', ['value' => $this->fields['budgettypes_id']]);
        echo "</td></tr>";

        // -------------------------------
        // MODIFICATION UNH : Ajout du champ Référence Annuelle UNH
        // -------------------------------
        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Référence Annuelle UNH') . "</td>";
        echo "<td>" . Html::input('unh_budget_code', [
            'value' => $this->fields['unh_budget_code'] ?? ''
        ]) . "</td>";
        echo "<td colspan='2'>Code interne UNH</td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . _x('price', 'Value') . "</td>";
        echo "<td><input type='text' name='value' size='14'
              value='" . Html::formatNumber($this->fields['value'], true) . "' class='form-control'></td>";
        echo "<td colspan='2'></td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('Start date') . "</td>";
        echo "<td>";
        Html::showDateField("begin_date", ['value' => $this->fields["begin_date"]]);
        echo "</td><td colspan='2'></td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . __('End date') . "</td>";
        echo "<td>";
        Html::showDateField("end_date", ['value' => $this->fields["end_date"]]);
        echo "</td><td colspan='2'></td></tr>";

        echo "<tr class='tab_bg_1'>";
        echo "<td>" . Location::getTypeName(1) . "</td>";
        echo "<td>";
        Location::dropdown([
            'value'  => $this->fields["locations_id"],
            'entity' => $this->fields["entities_id"]
        ]);
        echo "</td><td colspan='2'></td></tr>";

        $this->showFormButtons($options);
        return true;
    }

    public function prepareInputForAdd($input)
    {
        // -------------------------------
        // MODIFICATION UNH : Partage automatique avec facultés/UFR
        // -------------------------------
        $input['is_recursive'] = 1;

        // -------------------------------
        // MODIFICATION UNH : Validation des dates (serveur)
        // -------------------------------
        if (!empty($input['begin_date']) && !empty($input['end_date'])) {
            if (strtotime($input['end_date']) < strtotime($input['begin_date'])) {
                Session::addMessageAfterRedirect(
                    __('La date de fin ne peut pas être antérieure à la date de début'),
                    false,
                    ERROR
                );
                return false;
            }
        }

        // -------------------------------
        // MODIFICATION UNH : Suppression du champ commentaire
        // -------------------------------
        unset($input['comment']);

        // Nettoyage GLPI standard
        unset($input['id'], $input['withtemplate']);

        return $input;
    }

    public function prepareInputForUpdate($input)
    {
        return $this->prepareInputForAdd($input);
    }

    public function rawSearchOptions()
    {
        $tab = [];

        $tab[] = [
            'id'   => '1',
            'table'=> $this->getTable(),
            'field'=> 'name',
            'name' => __('Name'),
            'datatype' => 'itemlink'
        ];

        // -------------------------------
        // MODIFICATION UNH : Recherche du champ Référence Annuelle UNH
        // -------------------------------
        $tab[] = [
            'id'   => '2',
            'table'=> $this->getTable(),
            'field'=> 'unh_budget_code',
            'name' => __('Référence Annuelle UNH'),
            'datatype' => 'string'
        ];

        $tab[] = [
            'id'   => '3',
            'table'=> $this->getTable(),
            'field'=> 'begin_date',
            'name' => __('Start date'),
            'datatype' => 'date'
        ];

        $tab[] = [
            'id'   => '4',
            'table'=> $this->getTable(),
            'field'=> 'end_date',
            'name' => __('End date'),
            'datatype' => 'date'
        ];

        return $tab;
    }

    public static function getIcon()
    {
        return "ti ti-calculator";
    }
}