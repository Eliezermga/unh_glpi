<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* generic_show_form.html.twig */
class __TwigTemplate_07adc13afbaafbb7fb73c03fa570d767 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'form_fields' => [$this, 'block_form_fields'],
            'more_fields' => [$this, 'block_more_fields'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 33
        echo "
";
        // line 34
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "generic_show_form.html.twig", 34)->unwrap();
        // line 35
        echo "
";
        // line 36
        $context["no_header"] = ((array_key_exists("no_header", $context)) ? (_twig_default_filter(($context["no_header"] ?? null), ( !twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 36) &&  !((twig_get_attribute($this->env, $this->source, ($context["_get"] ?? null), "_in_modal", [], "any", true, true, false, 36)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, ($context["_get"] ?? null), "_in_modal", [], "any", false, false, false, 36), false)) : (false))))) : (( !twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 36) &&  !((twig_get_attribute($this->env, $this->source, ($context["_get"] ?? null), "_in_modal", [], "any", true, true, false, 36)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, ($context["_get"] ?? null), "_in_modal", [], "any", false, false, false, 36), false)) : (false)))));
        // line 37
        $context["bg"] = "";
        // line 38
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isDeleted", [], "method", false, false, false, 38)) {
            // line 39
            echo "   ";
            $context["bg"] = "asset-deleted";
        }
        // line 41
        echo "
<div class=\"asset ";
        // line 42
        echo twig_escape_filter($this->env, ($context["bg"] ?? null), "html", null, true);
        echo "\">
   ";
        // line 43
        echo twig_include($this->env, $context, "components/form/header.html.twig", ["in_twig" => true]);
        echo "

   ";
        // line 45
        $context["rand"] = twig_random($this->env);
        // line 46
        echo "   ";
        $context["params"] = (($context["params"]) ?? ([]));
        // line 47
        echo "   ";
        $context["target"] = (((twig_get_attribute($this->env, $this->source, ($context["params"] ?? null), "target", [], "array", true, true, false, 47) &&  !(null === (($__internal_compile_0 = ($context["params"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["target"] ?? null) : null)))) ? ((($__internal_compile_1 = ($context["params"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["target"] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getFormURL", [], "method", false, false, false, 47)));
        // line 48
        echo "   ";
        $context["withtemplate"] = (((twig_get_attribute($this->env, $this->source, ($context["params"] ?? null), "withtemplate", [], "array", true, true, false, 48) &&  !(null === (($__internal_compile_2 = ($context["params"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["withtemplate"] ?? null) : null)))) ? ((($__internal_compile_3 = ($context["params"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["withtemplate"] ?? null) : null)) : (""));
        // line 49
        echo "   ";
        $context["item_type"] = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 49);
        // line 50
        echo "   ";
        $context["item_has_pictures"] = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "hasItemtypeOrModelPictures", [], "method", false, false, false, 50);
        // line 51
        echo "   ";
        $context["field_options"] = ["locked_fields" => twig_get_attribute($this->env, $this->source,         // line 52
($context["item"] ?? null), "getLockedFields", [], "method", false, false, false, 52)];
        // line 54
        echo "
   <div class=\"card-body d-flex flex-wrap\">
      <div class=\"col-12 col-xxl-";
        // line 56
        echo ((($context["item_has_pictures"] ?? null)) ? ("9") : ("12"));
        echo " flex-column\">
         <div class=\"d-flex flex-row flex-wrap flex-xl-nowrap\">
            <div class=\"row flex-row align-items-start flex-grow-1\">
               <div class=\"row flex-row\">
                  ";
        // line 60
        $this->displayBlock('form_fields', $context, $blocks);
        // line 666
        echo "               </div> ";
        // line 667
        echo "            </div> ";
        // line 668
        echo "         </div> ";
        // line 669
        echo "      </div>
      ";
        // line 670
        if (($context["item_has_pictures"] ?? null)) {
            // line 671
            echo "         <div class=\"col-12 col-xxl-3 flex-column\">
            <div class=\"flex-row asset-pictures\">
               ";
            // line 673
            echo twig_include($this->env, $context, "components/form/pictures.html.twig", ["gallery_type" => ""]);
            echo "
            </div>
         </div>
      ";
        }
        // line 677
        echo "   </div> ";
        // line 678
        echo "
   ";
        // line 679
        if ((($context["item_type"] ?? null) == "Contract")) {
            // line 680
            echo "      ";
            echo twig_include($this->env, $context, "components/form/support_hours.html.twig");
            echo "
   ";
        }
        // line 682
        echo "   ";
        echo twig_include($this->env, $context, "components/form/buttons.html.twig");
        echo "
   ";
        // line 683
        if (( !array_key_exists("no_inventory_footer", $context) || (($context["no_inventory_footer"] ?? null) == false))) {
            // line 684
            echo "      ";
            echo twig_include($this->env, $context, "components/form/inventory_info.html.twig");
            echo "
   ";
        }
        // line 686
        echo "
   ";
        // line 687
        if (((null === (($__internal_compile_4 = ($context["params"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["formfooter"] ?? null) : null)) || ((($__internal_compile_5 = ($context["params"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["formfooter"] ?? null) : null) == true))) {
            // line 688
            echo "      <div class=\"card-footer mx-n2 mb-n2 mt-4\">
         ";
            // line 689
            echo twig_include($this->env, $context, "components/form/dates.html.twig");
            echo "
      </div>
   ";
        }
        // line 692
        echo "</div>
";
    }

    // line 60
    public function block_form_fields($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 61
        echo "                     ";
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "name"], "method", false, false, false, 61)) {
            // line 62
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["name",             // line 64
($context["item"] ?? null), (((            // line 65
($context["item_type"] ?? null) == "Contact")) ? (__("Surname")) : (__("Name"))),             // line 66
($context["withtemplate"] ?? null),             // line 67
($context["field_options"] ?? null)], 62, $context, $this->getSourceContext());
            // line 68
            echo "
                     ";
        }
        // line 70
        echo "
                     ";
        // line 71
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "firstname"], "method", false, false, false, 71)) {
            // line 72
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["firstname",             // line 74
($context["item"] ?? null), __("First name"),             // line 76
($context["withtemplate"] ?? null),             // line 77
($context["field_options"] ?? null)], 72, $context, $this->getSourceContext());
            // line 78
            echo "
                     ";
        }
        // line 80
        echo "
                     ";
        // line 81
        if (((twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "template_name"], "method", false, false, false, 81) && (($context["withtemplate"] ?? null) == 1)) && ($context["no_header"] ?? null))) {
            // line 82
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["template_name",             // line 84
($context["item"] ?? null), __("Template name"), 0,             // line 87
($context["field_options"] ?? null)], 82, $context, $this->getSourceContext());
            // line 88
            echo "
                     ";
        }
        // line 90
        echo "
                     ";
        // line 91
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "is_active"], "method", false, false, false, 91)) {
            // line 92
            echo "                        ";
            if (( !twig_test_empty(($context["withtemplate"] ?? null)) || (($context["withtemplate"] ?? null) == 1))) {
                // line 93
                echo "                           ";
                echo twig_call_macro($macros["fields"], "macro_hiddenField", ["is_active", (($__internal_compile_6 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 93)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["is_active"] ?? null) : null), __("Is active"), ["add_field_html" => __("No")]], 93, $context, $this->getSourceContext());
                // line 95
                echo "
                        ";
            } else {
                // line 97
                echo "                        ";
            }
            // line 98
            echo "                     ";
        }
        // line 99
        echo "
                     ";
        // line 100
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "states_id"], "method", false, false, false, 100)) {
            // line 101
            echo "                        ";
            $context["condition"] = ((twig_in_filter(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 101), $this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("state_types"))) ? ([("is_visible_" . twig_lower_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 101))) => 1]) : ([]));
            // line 102
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownField", ["State", "states_id", (($__internal_compile_7 = twig_get_attribute($this->env, $this->source,             // line 105
($context["item"] ?? null), "fields", [], "any", false, false, false, 105)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["states_id"] ?? null) : null), __("Status"), twig_array_merge(            // line 107
($context["field_options"] ?? null), ["entity" => (($__internal_compile_8 = twig_get_attribute($this->env, $this->source,             // line 108
($context["item"] ?? null), "fields", [], "any", false, false, false, 108)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["entities_id"] ?? null) : null), "condition" =>             // line 109
($context["condition"] ?? null)])], 102, $context, $this->getSourceContext());
            // line 111
            echo "
                     ";
        }
        // line 113
        echo "
                     ";
        // line 114
        $context["fk"] = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getForeignKeyField", [], "method", false, false, false, 114);
        // line 115
        echo "                     ";
        if ((twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => ($context["fk"] ?? null)], "method", false, false, false, 115) && (($context["item_type"] ?? null) != "Software"))) {
            // line 116
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownField", [            // line 117
($context["item_type"] ?? null),             // line 118
($context["fk"] ?? null), (($__internal_compile_9 = twig_get_attribute($this->env, $this->source,             // line 119
($context["item"] ?? null), "fields", [], "any", false, false, false, 119)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9[($context["fk"] ?? null)] ?? null) : null), __("As child of"), twig_array_merge(            // line 121
($context["field_options"] ?? null), ["entity" => (($__internal_compile_10 = twig_get_attribute($this->env, $this->source,             // line 122
($context["item"] ?? null), "fields", [], "any", false, false, false, 122)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["entities_id"] ?? null) : null)])], 116, $context, $this->getSourceContext());
            // line 124
            echo "
                     ";
        }
        // line 126
        echo "
                     ";
        // line 127
        if (((($context["item_type"] ?? null) != "SoftwareLicense") && twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "is_helpdesk_visible"], "method", false, false, false, 127))) {
            // line 128
            echo "                        ";
            // line 129
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_checkboxField", ["is_helpdesk_visible", (($__internal_compile_11 = twig_get_attribute($this->env, $this->source,             // line 131
($context["item"] ?? null), "fields", [], "any", false, false, false, 131)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["is_helpdesk_visible"] ?? null) : null), __("Associable to a ticket"),             // line 133
($context["field_options"] ?? null)], 129, $context, $this->getSourceContext());
            // line 134
            echo "
                     ";
        }
        // line 136
        echo "
                     ";
        // line 137
        $context["dc_breadcrumbs"] = (($this->extensions['Glpi\Application\View\Extension\PhpExtension']->isUsingTrait(($context["item"] ?? null), "Glpi\\Features\\DCBreadcrumb")) ? (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getDcBreadcrumb", [], "method", false, false, false, 137)) : ([]));
        // line 138
        echo "                     ";
        if ((twig_length_filter($this->env, ($context["dc_breadcrumbs"] ?? null)) > 0)) {
            // line 139
            echo "                        ";
            ob_start(function () { return ''; });
            // line 140
            echo "                           <ol class=\"breadcrumb breadcrumb-arrows\" aria-label=\"breadcrumbs\">
                              ";
            // line 141
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_reverse_filter($this->env, ($context["dc_breadcrumbs"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["dc_item"]) {
                // line 142
                echo "                                 <li class=\"breadcrumb-item text-nowrap\">";
                echo $context["dc_item"];
                echo "</li>
                              ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dc_item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 144
            echo "                           </ol>
                        ";
            $context["dc_breadcrumbs"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 146
            echo "
                        ";
            // line 147
            echo twig_call_macro($macros["fields"], "macro_htmlField", ["",             // line 149
($context["dc_breadcrumbs"] ?? null), __("Data center position")], 147, $context, $this->getSourceContext());
            // line 151
            echo "

                        ";
            // line 153
            echo twig_call_macro($macros["fields"], "macro_nullField", [], 153, $context, $this->getSourceContext());
            echo " ";
            // line 154
            echo "                     ";
        }
        // line 155
        echo "
                     ";
        // line 156
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "locations_id"], "method", false, false, false, 156)) {
            // line 157
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownField", ["Location", "locations_id", (($__internal_compile_12 = twig_get_attribute($this->env, $this->source,             // line 160
($context["item"] ?? null), "fields", [], "any", false, false, false, 160)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["locations_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Location"), twig_array_merge(            // line 162
($context["field_options"] ?? null), ["entity" => (($__internal_compile_13 = twig_get_attribute($this->env, $this->source,             // line 163
($context["item"] ?? null), "fields", [], "any", false, false, false, 163)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["entities_id"] ?? null) : null)])], 157, $context, $this->getSourceContext());
            // line 165
            echo "
                     ";
        }
        // line 167
        echo "
                     ";
        // line 168
        if (((($context["item_type"] ?? null) == "Unmanaged") && twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "item_type"], "method", false, false, false, 168))) {
            // line 169
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownArrayField", ["item_type", (($__internal_compile_14 = twig_get_attribute($this->env, $this->source,             // line 171
($context["item"] ?? null), "fields", [], "any", false, false, false, 171)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["itemtype"] ?? null) : null), _n("Type", "Types", 1), [0 => "Computer", 1 => "NetworkEquipment", 2 => "Printer", 3 => "Peripheral", 4 => "Phone"],             // line 176
($context["field_options"] ?? null)], 169, $context, $this->getSourceContext());
            // line 177
            echo "
                     ";
        }
        // line 179
        echo "
                     ";
        // line 180
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "date_domaincreation"], "method", false, false, false, 180)) {
            // line 181
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_datetimeField", ["date_domaincreation", (($__internal_compile_15 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 181)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["date_domaincreation"] ?? null) : null), __("Registration date")], 181, $context, $this->getSourceContext());
            echo "
                     ";
        }
        // line 183
        echo "
                     ";
        // line 184
        $context["type_itemtype"] = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getTypeClass", [], "method", false, false, false, 184);
        // line 185
        echo "                     ";
        $context["type_fk"] = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getTypeForeignKeyField", [], "method", false, false, false, 185);
        // line 186
        echo "                     ";
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => ($context["type_fk"] ?? null)], "method", false, false, false, 186)) {
            // line 187
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownField", [            // line 188
($context["type_itemtype"] ?? null),             // line 189
($context["type_fk"] ?? null), (($__internal_compile_16 = twig_get_attribute($this->env, $this->source,             // line 190
($context["item"] ?? null), "fields", [], "any", false, false, false, 190)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16[($context["type_fk"] ?? null)] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName(            // line 191
($context["type_itemtype"] ?? null)),             // line 192
($context["field_options"] ?? null)], 187, $context, $this->getSourceContext());
            // line 193
            echo "
                     ";
        }
        // line 195
        echo "
                     ";
        // line 196
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "usertitles_id"], "method", false, false, false, 196)) {
            // line 197
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownField", ["UserTitle", "usertitles_id", (($__internal_compile_17 = twig_get_attribute($this->env, $this->source,             // line 200
($context["item"] ?? null), "fields", [], "any", false, false, false, 200)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["usertitles_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("UserTitle"), twig_array_merge(            // line 202
($context["field_options"] ?? null), ["entity" => (($__internal_compile_18 = twig_get_attribute($this->env, $this->source,             // line 203
($context["item"] ?? null), "fields", [], "any", false, false, false, 203)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["entities_id"] ?? null) : null)])], 197, $context, $this->getSourceContext());
            // line 205
            echo "
                     ";
        }
        // line 207
        echo "
                     ";
        // line 208
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "registration_number"], "method", false, false, false, 208)) {
            // line 209
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["registration_number",             // line 211
($context["item"] ?? null), (((is_string($__internal_compile_19 =             // line 212
($context["item_type"] ?? null)) && is_string($__internal_compile_20 = "User") && ('' === $__internal_compile_20 || 0 === strpos($__internal_compile_19, $__internal_compile_20)))) ? (_x("user", "Administrative number")) : (_x("infocom", "Administrative number"))),             // line 213
($context["withtemplate"] ?? null),             // line 214
($context["field_options"] ?? null)], 209, $context, $this->getSourceContext());
            // line 215
            echo "
                     ";
        }
        // line 217
        echo "
                     ";
        // line 218
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "phone"], "method", false, false, false, 218)) {
            // line 219
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["phone",             // line 221
($context["item"] ?? null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Phone"),             // line 223
($context["withtemplate"] ?? null),             // line 224
($context["field_options"] ?? null)], 219, $context, $this->getSourceContext());
            // line 225
            echo "
                     ";
        }
        // line 227
        echo "
                     ";
        // line 228
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "phone2"], "method", false, false, false, 228)) {
            // line 229
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["phone2",             // line 231
($context["item"] ?? null), __("Phone 2"),             // line 233
($context["withtemplate"] ?? null),             // line 234
($context["field_options"] ?? null)], 229, $context, $this->getSourceContext());
            // line 235
            echo "
                     ";
        }
        // line 237
        echo "
                     ";
        // line 238
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "phonenumber"], "method", false, false, false, 238)) {
            // line 239
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["phonenumber",             // line 241
($context["item"] ?? null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Phone"),             // line 243
($context["withtemplate"] ?? null),             // line 244
($context["field_options"] ?? null)], 239, $context, $this->getSourceContext());
            // line 245
            echo "
                     ";
        }
        // line 247
        echo "
                     ";
        // line 248
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "mobile"], "method", false, false, false, 248)) {
            // line 249
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["mobile",             // line 251
($context["item"] ?? null), __("Mobile phone"),             // line 253
($context["withtemplate"] ?? null),             // line 254
($context["field_options"] ?? null)], 249, $context, $this->getSourceContext());
            // line 255
            echo "
                     ";
        }
        // line 257
        echo "
                     ";
        // line 258
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "fax"], "method", false, false, false, 258)) {
            // line 259
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["fax",             // line 261
($context["item"] ?? null), __("Fax"),             // line 263
($context["withtemplate"] ?? null),             // line 264
($context["field_options"] ?? null)], 259, $context, $this->getSourceContext());
            // line 265
            echo "
                     ";
        }
        // line 267
        echo "
                     ";
        // line 268
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "website"], "method", false, false, false, 268)) {
            // line 269
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["website",             // line 271
($context["item"] ?? null), __("Website"),             // line 273
($context["withtemplate"] ?? null),             // line 274
($context["field_options"] ?? null)], 269, $context, $this->getSourceContext());
            // line 275
            echo "
                     ";
        }
        // line 277
        echo "
                     ";
        // line 278
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "email"], "method", false, false, false, 278)) {
            // line 279
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["email",             // line 281
($context["item"] ?? null), _n("Email", "Emails", 1),             // line 283
($context["withtemplate"] ?? null),             // line 284
($context["field_options"] ?? null)], 279, $context, $this->getSourceContext());
            // line 285
            echo "
                     ";
        }
        // line 287
        echo "
                     ";
        // line 288
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "address"], "method", false, false, false, 288)) {
            // line 289
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_textareaField", ["address", (($__internal_compile_21 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 289)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["address"] ?? null) : null), __("Address")], 289, $context, $this->getSourceContext());
            echo "
                     ";
        }
        // line 291
        echo "
                     ";
        // line 292
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "postalcode"], "method", false, false, false, 292)) {
            // line 293
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["postalcode",             // line 295
($context["item"] ?? null), __("Postal code"),             // line 297
($context["withtemplate"] ?? null),             // line 298
($context["field_options"] ?? null)], 293, $context, $this->getSourceContext());
            // line 299
            echo "
                     ";
        }
        // line 301
        echo "
                     ";
        // line 302
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "town"], "method", false, false, false, 302)) {
            // line 303
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["town",             // line 305
($context["item"] ?? null), __("City"),             // line 307
($context["withtemplate"] ?? null),             // line 308
($context["field_options"] ?? null)], 303, $context, $this->getSourceContext());
            // line 309
            echo "
                     ";
        }
        // line 311
        echo "
                     ";
        // line 313
        echo "                     ";
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "postcode"], "method", false, false, false, 313)) {
            // line 314
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["postcode",             // line 316
($context["item"] ?? null), __("Postal code"),             // line 318
($context["withtemplate"] ?? null),             // line 319
($context["field_options"] ?? null)], 314, $context, $this->getSourceContext());
            // line 320
            echo "
                     ";
        }
        // line 322
        echo "
                     ";
        // line 323
        if (((($context["item_type"] ?? null) == "Supplier") || (($context["item_type"] ?? null) == "Contact"))) {
            // line 324
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["state",             // line 326
($context["item"] ?? null), _x("location", "State"),             // line 328
($context["withtemplate"] ?? null),             // line 329
($context["field_options"] ?? null)], 324, $context, $this->getSourceContext());
            // line 330
            echo "
                     ";
        }
        // line 332
        echo "
                     ";
        // line 333
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "country"], "method", false, false, false, 333)) {
            // line 334
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["country",             // line 336
($context["item"] ?? null), __("Country"),             // line 338
($context["withtemplate"] ?? null),             // line 339
($context["field_options"] ?? null)], 334, $context, $this->getSourceContext());
            // line 340
            echo "
                     ";
        }
        // line 342
        echo "
                     ";
        // line 343
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "date_expiration"], "method", false, false, false, 343)) {
            // line 344
            echo "                        ";
            if ((($context["item_type"] ?? null) == "Certificate")) {
                // line 345
                echo "                           ";
                echo twig_call_macro($macros["fields"], "macro_dateField", ["date_expiration", (($__internal_compile_22 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 345)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["date_expiration"] ?? null) : null), __("Expiration date"), twig_array_merge(["helper" => __("Empty for infinite"), "checkIsExpired" => false, "expiration_class" => twig_get_attribute($this->env, $this->source,                 // line 348
($context["params"] ?? null), "expiration_class", [], "any", false, false, false, 348)],                 // line 349
($context["field_options"] ?? null))], 345, $context, $this->getSourceContext());
                echo "
                        ";
            } elseif ((            // line 350
($context["item_type"] ?? null) == "ComputerAntivirus")) {
                // line 351
                echo "                           ";
                echo twig_call_macro($macros["fields"], "macro_dateField", ["date_expiration", (($__internal_compile_23 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 351)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["date_expiration"] ?? null) : null), __("Expiration date"), twig_array_merge(["helper" => __("Empty for infinite"), "checkIsExpired" => true],                 // line 354
($context["field_options"] ?? null))], 351, $context, $this->getSourceContext());
                echo "
                        ";
            } else {
                // line 356
                echo "                           ";
                echo twig_call_macro($macros["fields"], "macro_datetimeField", ["date_expiration", (($__internal_compile_24 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 356)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["date_expiration"] ?? null) : null), __("Expiration date"), twig_array_merge(["helper" => __("Empty for infinite"), "checkIsExpired" => true],                 // line 359
($context["field_options"] ?? null))], 356, $context, $this->getSourceContext());
                echo "
                        ";
            }
            // line 361
            echo "                     ";
        }
        // line 362
        echo "
                     ";
        // line 363
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "ref"], "method", false, false, false, 363)) {
            // line 364
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_textField", ["ref", (($__internal_compile_25 = twig_get_attribute($this->env, $this->source,             // line 366
($context["item"] ?? null), "fields", [], "any", false, false, false, 366)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["ref"] ?? null) : null), __("Reference"),             // line 368
($context["field_options"] ?? null)], 364, $context, $this->getSourceContext());
            // line 369
            echo "
                     ";
        }
        // line 371
        echo "
                     ";
        // line 372
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "users_id_tech"], "method", false, false, false, 372)) {
            // line 373
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownField", ["User", "users_id_tech", (($__internal_compile_26 = twig_get_attribute($this->env, $this->source,             // line 376
($context["item"] ?? null), "fields", [], "any", false, false, false, 376)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["users_id_tech"] ?? null) : null), __("Technician in charge of the hardware"), twig_array_merge(            // line 378
($context["field_options"] ?? null), ["entity" => (($__internal_compile_27 = twig_get_attribute($this->env, $this->source,             // line 379
($context["item"] ?? null), "fields", [], "any", false, false, false, 379)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["entities_id"] ?? null) : null), "right" => "own_ticket"])], 373, $context, $this->getSourceContext());
            // line 382
            echo "
                     ";
        }
        // line 384
        echo "
                     ";
        // line 385
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "manufacturers_id"], "method", false, false, false, 385)) {
            // line 386
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownField", ["Manufacturer", "manufacturers_id", (($__internal_compile_28 = twig_get_attribute($this->env, $this->source,             // line 389
($context["item"] ?? null), "fields", [], "any", false, false, false, 389)) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["manufacturers_id"] ?? null) : null), (((is_string($__internal_compile_29 =             // line 390
($context["item_type"] ?? null)) && is_string($__internal_compile_30 = "Software") && ('' === $__internal_compile_30 || 0 === strpos($__internal_compile_29, $__internal_compile_30)))) ? (__("Publisher")) : ($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Manufacturer"))),             // line 391
($context["field_options"] ?? null)], 386, $context, $this->getSourceContext());
            // line 392
            echo "
                     ";
        }
        // line 394
        echo "
                     ";
        // line 395
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "groups_id_tech"], "method", false, false, false, 395)) {
            // line 396
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownField", ["Group", "groups_id_tech", (($__internal_compile_31 = twig_get_attribute($this->env, $this->source,             // line 399
($context["item"] ?? null), "fields", [], "any", false, false, false, 399)) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31["groups_id_tech"] ?? null) : null), __("Group in charge of the hardware"), twig_array_merge(            // line 401
($context["field_options"] ?? null), ["entity" => (($__internal_compile_32 = twig_get_attribute($this->env, $this->source,             // line 402
($context["item"] ?? null), "fields", [], "any", false, false, false, 402)) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32["entities_id"] ?? null) : null), "condition" => ["is_assign" => 1]])], 396, $context, $this->getSourceContext());
            // line 405
            echo "
                     ";
        }
        // line 407
        echo "
                     ";
        // line 408
        $context["model_itemtype"] = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getModelClass", [], "method", false, false, false, 408);
        // line 409
        echo "                     ";
        $context["model_fk"] = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getModelForeignKeyField", [], "method", false, false, false, 409);
        // line 410
        echo "                     ";
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => ($context["model_fk"] ?? null)], "method", false, false, false, 410)) {
            // line 411
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownField", [            // line 412
($context["model_itemtype"] ?? null),             // line 413
($context["model_fk"] ?? null), (($__internal_compile_33 = twig_get_attribute($this->env, $this->source,             // line 414
($context["item"] ?? null), "fields", [], "any", false, false, false, 414)) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33[($context["model_fk"] ?? null)] ?? null) : null), _n("Model", "Models", 1),             // line 416
($context["field_options"] ?? null)], 411, $context, $this->getSourceContext());
            // line 417
            echo "
                     ";
        }
        // line 419
        echo "
                     ";
        // line 420
        if (((($context["item_type"] ?? null) != "SoftwareLicense") && twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "contact_num"], "method", false, false, false, 420))) {
            // line 421
            echo "                        ";
            // line 422
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_textField", ["contact_num", (($__internal_compile_34 = twig_get_attribute($this->env, $this->source,             // line 424
($context["item"] ?? null), "fields", [], "any", false, false, false, 424)) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34["contact_num"] ?? null) : null), __("Alternate username number"),             // line 426
($context["field_options"] ?? null)], 422, $context, $this->getSourceContext());
            // line 427
            echo "
                     ";
        }
        // line 429
        echo "
                     ";
        // line 430
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "serial"], "method", false, false, false, 430)) {
            // line 431
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_textField", ["serial", (($__internal_compile_35 = twig_get_attribute($this->env, $this->source,             // line 433
($context["item"] ?? null), "fields", [], "any", false, false, false, 433)) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35["serial"] ?? null) : null), __("Serial number"),             // line 435
($context["field_options"] ?? null)], 431, $context, $this->getSourceContext());
            // line 436
            echo "
                     ";
        }
        // line 438
        echo "
                     ";
        // line 439
        if (((($context["item_type"] ?? null) != "SoftwareLicense") && twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "contact"], "method", false, false, false, 439))) {
            // line 440
            echo "                        ";
            // line 441
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_textField", ["contact", (($__internal_compile_36 = twig_get_attribute($this->env, $this->source,             // line 443
($context["item"] ?? null), "fields", [], "any", false, false, false, 443)) && is_array($__internal_compile_36) || $__internal_compile_36 instanceof ArrayAccess ? ($__internal_compile_36["contact"] ?? null) : null), __("Alternate username"),             // line 445
($context["field_options"] ?? null)], 441, $context, $this->getSourceContext());
            // line 446
            echo "
                     ";
        }
        // line 448
        echo "
                     ";
        // line 449
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "otherserial"], "method", false, false, false, 449)) {
            // line 450
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["otherserial",             // line 452
($context["item"] ?? null), __("Inventory number"),             // line 454
($context["withtemplate"] ?? null),             // line 455
($context["field_options"] ?? null)], 450, $context, $this->getSourceContext());
            // line 456
            echo "
                     ";
        }
        // line 458
        echo "
                     ";
        // line 459
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "sysdescr"], "method", false, false, false, 459)) {
            // line 460
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_textareaField", ["sysdescr", (($__internal_compile_37 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 460)) && is_array($__internal_compile_37) || $__internal_compile_37 instanceof ArrayAccess ? ($__internal_compile_37["sysdescr"] ?? null) : null), __("Sysdescr")], 460, $context, $this->getSourceContext());
            echo "
                     ";
        }
        // line 462
        echo "
                     ";
        // line 463
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "snmpcredentials_id"], "method", false, false, false, 463)) {
            // line 464
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownField", ["SNMPCredential", "snmpcredentials_id", (($__internal_compile_38 = twig_get_attribute($this->env, $this->source,             // line 467
($context["item"] ?? null), "fields", [], "any", false, false, false, 467)) && is_array($__internal_compile_38) || $__internal_compile_38 instanceof ArrayAccess ? ($__internal_compile_38["snmpcredentials_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("SNMPCredential"),             // line 469
($context["field_options"] ?? null)], 464, $context, $this->getSourceContext());
            // line 470
            echo "
                     ";
        }
        // line 472
        echo "
                     ";
        // line 473
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "users_id"], "method", false, false, false, 473)) {
            // line 474
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownField", ["User", "users_id", (($__internal_compile_39 = twig_get_attribute($this->env, $this->source,             // line 477
($context["item"] ?? null), "fields", [], "any", false, false, false, 477)) && is_array($__internal_compile_39) || $__internal_compile_39 instanceof ArrayAccess ? ($__internal_compile_39["users_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("User"), twig_array_merge(            // line 479
($context["field_options"] ?? null), ["entity" => (($__internal_compile_40 = twig_get_attribute($this->env, $this->source,             // line 480
($context["item"] ?? null), "fields", [], "any", false, false, false, 480)) && is_array($__internal_compile_40) || $__internal_compile_40 instanceof ArrayAccess ? ($__internal_compile_40["entities_id"] ?? null) : null), "right" => "all"])], 474, $context, $this->getSourceContext());
            // line 483
            echo "
                     ";
        }
        // line 485
        echo "
                     ";
        // line 486
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "is_global"], "method", false, false, false, 486)) {
            // line 487
            echo "                        ";
            $context["management_restrict"] = 0;
            // line 488
            echo "                        ";
            if ((($context["item_type"] ?? null) == "Monitor")) {
                // line 489
                echo "                           ";
                $context["management_restrict"] = $this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("monitors_management_restrict");
                // line 490
                echo "                        ";
            } elseif ((($context["item_type"] ?? null) == "Peripheral")) {
                // line 491
                echo "                           ";
                $context["management_restrict"] = $this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("peripherals_management_restrict");
                // line 492
                echo "                        ";
            } elseif ((($context["item_type"] ?? null) == "Phone")) {
                // line 493
                echo "                           ";
                $context["management_restrict"] = $this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("phones_management_restrict");
                // line 494
                echo "                        ";
            } elseif ((($context["item_type"] ?? null) == "Printer")) {
                // line 495
                echo "                           ";
                $context["management_restrict"] = $this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("printers_management_restrict");
                // line 496
                echo "                        ";
            } else {
                // line 497
                echo "                           ";
                $context["management_restrict"] = 0;
                // line 498
                echo "                        ";
            }
            // line 499
            echo "                        ";
            ob_start(function () { return ''; });
            // line 500
            echo "                           ";
            $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Dropdown::showGlobalSwitch", [0 => (($__internal_compile_41 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 500)) && is_array($__internal_compile_41) || $__internal_compile_41 instanceof ArrayAccess ? ($__internal_compile_41["id"] ?? null) : null), 1 => ["withtemplate" =>             // line 501
($context["withtemplate"] ?? null), "value" => (($__internal_compile_42 = twig_get_attribute($this->env, $this->source,             // line 502
($context["item"] ?? null), "fields", [], "any", false, false, false, 502)) && is_array($__internal_compile_42) || $__internal_compile_42 instanceof ArrayAccess ? ($__internal_compile_42["is_global"] ?? null) : null), "management_restrict" =>             // line 503
($context["management_restrict"] ?? null), "target" =>             // line 504
($context["target"] ?? null), "width" => "100%"]]);
            // line 507
            echo "                        ";
            $context["dd_globalswitch"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 508
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_htmlField", ["is_global",             // line 510
($context["dd_globalswitch"] ?? null), __("Management type")], 508, $context, $this->getSourceContext());
            // line 512
            echo "
                     ";
        }
        // line 514
        echo "
                     ";
        // line 515
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "size"], "method", false, false, false, 515)) {
            // line 516
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_numberField", ["size", (($__internal_compile_43 = twig_get_attribute($this->env, $this->source,             // line 518
($context["item"] ?? null), "fields", [], "any", false, false, false, 518)) && is_array($__internal_compile_43) || $__internal_compile_43 instanceof ArrayAccess ? ($__internal_compile_43["size"] ?? null) : null), __("Size"), twig_array_merge(            // line 520
($context["field_options"] ?? null), ["min" => 0, "step" => 0.01])], 516, $context, $this->getSourceContext());
            // line 524
            echo "
                     ";
        }
        // line 526
        echo "
                     ";
        // line 527
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "networks_id"], "method", false, false, false, 527)) {
            // line 528
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownField", ["Network", "networks_id", (($__internal_compile_44 = twig_get_attribute($this->env, $this->source,             // line 531
($context["item"] ?? null), "fields", [], "any", false, false, false, 531)) && is_array($__internal_compile_44) || $__internal_compile_44 instanceof ArrayAccess ? ($__internal_compile_44["networks_id"] ?? null) : null), _n("Network", "Networks", 1),             // line 533
($context["field_options"] ?? null)], 528, $context, $this->getSourceContext());
            // line 534
            echo "
                     ";
        }
        // line 536
        echo "
                     ";
        // line 537
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "groups_id"], "method", false, false, false, 537)) {
            // line 538
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownField", ["Group", "groups_id", (($__internal_compile_45 = twig_get_attribute($this->env, $this->source,             // line 541
($context["item"] ?? null), "fields", [], "any", false, false, false, 541)) && is_array($__internal_compile_45) || $__internal_compile_45 instanceof ArrayAccess ? ($__internal_compile_45["groups_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Group"), twig_array_merge(            // line 543
($context["field_options"] ?? null), ["entity" => (($__internal_compile_46 = twig_get_attribute($this->env, $this->source,             // line 544
($context["item"] ?? null), "fields", [], "any", false, false, false, 544)) && is_array($__internal_compile_46) || $__internal_compile_46 instanceof ArrayAccess ? ($__internal_compile_46["entities_id"] ?? null) : null), "condition" => ["is_itemgroup" => 1]])], 538, $context, $this->getSourceContext());
            // line 547
            echo "
                     ";
        }
        // line 549
        echo "
                     ";
        // line 550
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "uuid"], "method", false, false, false, 550)) {
            // line 551
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_textField", ["uuid", (($__internal_compile_47 = twig_get_attribute($this->env, $this->source,             // line 553
($context["item"] ?? null), "fields", [], "any", false, false, false, 553)) && is_array($__internal_compile_47) || $__internal_compile_47 instanceof ArrayAccess ? ($__internal_compile_47["uuid"] ?? null) : null), __("UUID"),             // line 555
($context["field_options"] ?? null)], 551, $context, $this->getSourceContext());
            // line 556
            echo "
                     ";
        }
        // line 558
        echo "
                     ";
        // line 559
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "version"], "method", false, false, false, 559)) {
            // line 560
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_autoNameField", ["version",             // line 562
($context["item"] ?? null), _n("Version", "Versions", 1),             // line 564
($context["withtemplate"] ?? null),             // line 565
($context["field_options"] ?? null)], 560, $context, $this->getSourceContext());
            // line 566
            echo "
                     ";
        }
        // line 568
        echo "
                     ";
        // line 569
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "comment"], "method", false, false, false, 569)) {
            // line 570
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_textareaField", ["comment", (($__internal_compile_48 = twig_get_attribute($this->env, $this->source,             // line 572
($context["item"] ?? null), "fields", [], "any", false, false, false, 572)) && is_array($__internal_compile_48) || $__internal_compile_48 instanceof ArrayAccess ? ($__internal_compile_48["comment"] ?? null) : null), _n("Comment", "Comments", Session::getPluralNumber()),             // line 574
($context["field_options"] ?? null)], 570, $context, $this->getSourceContext());
            // line 575
            echo "
                     ";
        }
        // line 577
        echo "
                     ";
        // line 578
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "ram"], "method", false, false, false, 578)) {
            // line 579
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_numberField", ["ram", (($__internal_compile_49 = twig_get_attribute($this->env, $this->source,             // line 581
($context["item"] ?? null), "fields", [], "any", false, false, false, 581)) && is_array($__internal_compile_49) || $__internal_compile_49 instanceof ArrayAccess ? ($__internal_compile_49["ram"] ?? null) : null), twig_sprintf(__("%1\$s (%2\$s)"), _n("Memory", "Memories", 1), __("Mio")),             // line 583
($context["field_options"] ?? null)], 579, $context, $this->getSourceContext());
            // line 584
            echo "
                     ";
        }
        // line 586
        echo "
                     ";
        // line 587
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "alarm_threshold"], "method", false, false, false, 587)) {
            // line 588
            echo "                        ";
            ob_start(function () { return ''; });
            // line 589
            echo "                           ";
            $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Dropdown::showNumber", [0 => "alarm_threshold", 1 => twig_array_merge(["value" => (($__internal_compile_50 = twig_get_attribute($this->env, $this->source,             // line 590
($context["item"] ?? null), "fields", [], "any", false, false, false, 590)) && is_array($__internal_compile_50) || $__internal_compile_50 instanceof ArrayAccess ? ($__internal_compile_50["alarm_threshold"] ?? null) : null), "rand" =>             // line 591
($context["rand"] ?? null), "width" => "100%", "min" => 0, "max" => 100, "step" => 1, "toadd" => ["-1" => __("Never")]],             // line 597
($context["params"] ?? null))]);
            // line 598
            echo "                        ";
            $context["dd_alarm_treshold"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 599
            echo "                        ";
            ob_start(function () { return ''; });
            // line 600
            echo "                           <span class=\"text-muted\">
                              ";
            // line 601
            $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Alert::displayLastAlert", [0 => ($context["item_type"] ?? null), 1 => (($__internal_compile_51 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 601)) && is_array($__internal_compile_51) || $__internal_compile_51 instanceof ArrayAccess ? ($__internal_compile_51["id"] ?? null) : null)]);
            // line 602
            echo "                           </span>
                        ";
            $context["last_alert_html"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 604
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_htmlField", ["alarm_threshold",             // line 606
($context["dd_alarm_treshold"] ?? null), __("Alert threshold"), twig_array_merge(            // line 608
($context["field_options"] ?? null), ["add_field_html" =>             // line 609
($context["last_alert_html"] ?? null)])], 604, $context, $this->getSourceContext());
            // line 611
            echo "
                     ";
        }
        // line 613
        echo "
                     ";
        // line 614
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "brand"], "method", false, false, false, 614)) {
            // line 615
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_textField", ["brand", (($__internal_compile_52 = twig_get_attribute($this->env, $this->source,             // line 617
($context["item"] ?? null), "fields", [], "any", false, false, false, 617)) && is_array($__internal_compile_52) || $__internal_compile_52 instanceof ArrayAccess ? ($__internal_compile_52["brand"] ?? null) : null), __("Brand"),             // line 619
($context["field_options"] ?? null)], 615, $context, $this->getSourceContext());
            // line 620
            echo "
                     ";
        }
        // line 622
        echo "
                     ";
        // line 623
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "begin_date"], "method", false, false, false, 623)) {
            // line 624
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dateField", ["begin_date", (($__internal_compile_53 = twig_get_attribute($this->env, $this->source,             // line 626
($context["item"] ?? null), "fields", [], "any", false, false, false, 626)) && is_array($__internal_compile_53) || $__internal_compile_53 instanceof ArrayAccess ? ($__internal_compile_53["begin_date"] ?? null) : null), __("Start date"),             // line 628
($context["field_options"] ?? null)], 624, $context, $this->getSourceContext());
            // line 629
            echo "
                     ";
        }
        // line 631
        echo "
                     ";
        // line 632
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "autoupdatesystems_id"], "method", false, false, false, 632)) {
            // line 633
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownField", ["AutoUpdateSystem", "autoupdatesystems_id", (($__internal_compile_54 = twig_get_attribute($this->env, $this->source,             // line 636
($context["item"] ?? null), "fields", [], "any", false, false, false, 636)) && is_array($__internal_compile_54) || $__internal_compile_54 instanceof ArrayAccess ? ($__internal_compile_54["autoupdatesystems_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("AutoUpdateSystem"),             // line 638
($context["field_options"] ?? null)], 633, $context, $this->getSourceContext());
            // line 639
            echo "
                     ";
        }
        // line 641
        echo "
                     ";
        // line 642
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "pictures"], "method", false, false, false, 642)) {
            // line 643
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_fileField", ["pictures", null, _n("Picture", "Pictures", Session::getPluralNumber()), ["onlyimages" => true, "multiple" => true]], 643, $context, $this->getSourceContext());
            // line 646
            echo "
                     ";
        }
        // line 648
        echo "
                     ";
        // line 649
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "is_active"], "method", false, false, false, 649)) {
            // line 650
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_dropdownYesNo", ["is_active", (($__internal_compile_55 = twig_get_attribute($this->env, $this->source,             // line 652
($context["item"] ?? null), "fields", [], "any", false, false, false, 652)) && is_array($__internal_compile_55) || $__internal_compile_55 instanceof ArrayAccess ? ($__internal_compile_55["is_active"] ?? null) : null), __("Active"),             // line 654
($context["field_options"] ?? null)], 650, $context, $this->getSourceContext());
            // line 655
            echo "
                     ";
        }
        // line 657
        echo "
                     ";
        // line 659
        echo "                     ";
        if (((twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "last_boot"], "method", false, false, false, 659) && twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "is_dynamic"], "method", false, false, false, 659)) && (($__internal_compile_56 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 659)) && is_array($__internal_compile_56) || $__internal_compile_56 instanceof ArrayAccess ? ($__internal_compile_56["is_dynamic"] ?? null) : null))) {
            // line 660
            echo "                        ";
            echo twig_call_macro($macros["fields"], "macro_htmlField", ["last_boot", $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedDatetime((($__internal_compile_57 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 660)) && is_array($__internal_compile_57) || $__internal_compile_57 instanceof ArrayAccess ? ($__internal_compile_57["last_boot"] ?? null) : null), true), __("Last boot date")], 660, $context, $this->getSourceContext());
            echo "
                     ";
        }
        // line 662
        echo "
                     ";
        // line 663
        $this->displayBlock('more_fields', $context, $blocks);
        // line 665
        echo "                  ";
    }

    // line 663
    public function block_more_fields($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 664
        echo "                     ";
    }

    public function getTemplateName()
    {
        return "generic_show_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1136 => 664,  1132 => 663,  1128 => 665,  1126 => 663,  1123 => 662,  1117 => 660,  1114 => 659,  1111 => 657,  1107 => 655,  1105 => 654,  1104 => 652,  1102 => 650,  1100 => 649,  1097 => 648,  1093 => 646,  1090 => 643,  1088 => 642,  1085 => 641,  1081 => 639,  1079 => 638,  1078 => 636,  1076 => 633,  1074 => 632,  1071 => 631,  1067 => 629,  1065 => 628,  1064 => 626,  1062 => 624,  1060 => 623,  1057 => 622,  1053 => 620,  1051 => 619,  1050 => 617,  1048 => 615,  1046 => 614,  1043 => 613,  1039 => 611,  1037 => 609,  1036 => 608,  1035 => 606,  1033 => 604,  1029 => 602,  1027 => 601,  1024 => 600,  1021 => 599,  1018 => 598,  1016 => 597,  1015 => 591,  1014 => 590,  1012 => 589,  1009 => 588,  1007 => 587,  1004 => 586,  1000 => 584,  998 => 583,  997 => 581,  995 => 579,  993 => 578,  990 => 577,  986 => 575,  984 => 574,  983 => 572,  981 => 570,  979 => 569,  976 => 568,  972 => 566,  970 => 565,  969 => 564,  968 => 562,  966 => 560,  964 => 559,  961 => 558,  957 => 556,  955 => 555,  954 => 553,  952 => 551,  950 => 550,  947 => 549,  943 => 547,  941 => 544,  940 => 543,  939 => 541,  937 => 538,  935 => 537,  932 => 536,  928 => 534,  926 => 533,  925 => 531,  923 => 528,  921 => 527,  918 => 526,  914 => 524,  912 => 520,  911 => 518,  909 => 516,  907 => 515,  904 => 514,  900 => 512,  898 => 510,  896 => 508,  893 => 507,  891 => 504,  890 => 503,  889 => 502,  888 => 501,  886 => 500,  883 => 499,  880 => 498,  877 => 497,  874 => 496,  871 => 495,  868 => 494,  865 => 493,  862 => 492,  859 => 491,  856 => 490,  853 => 489,  850 => 488,  847 => 487,  845 => 486,  842 => 485,  838 => 483,  836 => 480,  835 => 479,  834 => 477,  832 => 474,  830 => 473,  827 => 472,  823 => 470,  821 => 469,  820 => 467,  818 => 464,  816 => 463,  813 => 462,  807 => 460,  805 => 459,  802 => 458,  798 => 456,  796 => 455,  795 => 454,  794 => 452,  792 => 450,  790 => 449,  787 => 448,  783 => 446,  781 => 445,  780 => 443,  778 => 441,  776 => 440,  774 => 439,  771 => 438,  767 => 436,  765 => 435,  764 => 433,  762 => 431,  760 => 430,  757 => 429,  753 => 427,  751 => 426,  750 => 424,  748 => 422,  746 => 421,  744 => 420,  741 => 419,  737 => 417,  735 => 416,  734 => 414,  733 => 413,  732 => 412,  730 => 411,  727 => 410,  724 => 409,  722 => 408,  719 => 407,  715 => 405,  713 => 402,  712 => 401,  711 => 399,  709 => 396,  707 => 395,  704 => 394,  700 => 392,  698 => 391,  697 => 390,  696 => 389,  694 => 386,  692 => 385,  689 => 384,  685 => 382,  683 => 379,  682 => 378,  681 => 376,  679 => 373,  677 => 372,  674 => 371,  670 => 369,  668 => 368,  667 => 366,  665 => 364,  663 => 363,  660 => 362,  657 => 361,  652 => 359,  650 => 356,  645 => 354,  643 => 351,  641 => 350,  637 => 349,  636 => 348,  634 => 345,  631 => 344,  629 => 343,  626 => 342,  622 => 340,  620 => 339,  619 => 338,  618 => 336,  616 => 334,  614 => 333,  611 => 332,  607 => 330,  605 => 329,  604 => 328,  603 => 326,  601 => 324,  599 => 323,  596 => 322,  592 => 320,  590 => 319,  589 => 318,  588 => 316,  586 => 314,  583 => 313,  580 => 311,  576 => 309,  574 => 308,  573 => 307,  572 => 305,  570 => 303,  568 => 302,  565 => 301,  561 => 299,  559 => 298,  558 => 297,  557 => 295,  555 => 293,  553 => 292,  550 => 291,  544 => 289,  542 => 288,  539 => 287,  535 => 285,  533 => 284,  532 => 283,  531 => 281,  529 => 279,  527 => 278,  524 => 277,  520 => 275,  518 => 274,  517 => 273,  516 => 271,  514 => 269,  512 => 268,  509 => 267,  505 => 265,  503 => 264,  502 => 263,  501 => 261,  499 => 259,  497 => 258,  494 => 257,  490 => 255,  488 => 254,  487 => 253,  486 => 251,  484 => 249,  482 => 248,  479 => 247,  475 => 245,  473 => 244,  472 => 243,  471 => 241,  469 => 239,  467 => 238,  464 => 237,  460 => 235,  458 => 234,  457 => 233,  456 => 231,  454 => 229,  452 => 228,  449 => 227,  445 => 225,  443 => 224,  442 => 223,  441 => 221,  439 => 219,  437 => 218,  434 => 217,  430 => 215,  428 => 214,  427 => 213,  426 => 212,  425 => 211,  423 => 209,  421 => 208,  418 => 207,  414 => 205,  412 => 203,  411 => 202,  410 => 200,  408 => 197,  406 => 196,  403 => 195,  399 => 193,  397 => 192,  396 => 191,  395 => 190,  394 => 189,  393 => 188,  391 => 187,  388 => 186,  385 => 185,  383 => 184,  380 => 183,  374 => 181,  372 => 180,  369 => 179,  365 => 177,  363 => 176,  362 => 171,  360 => 169,  358 => 168,  355 => 167,  351 => 165,  349 => 163,  348 => 162,  347 => 160,  345 => 157,  343 => 156,  340 => 155,  337 => 154,  334 => 153,  330 => 151,  328 => 149,  327 => 147,  324 => 146,  320 => 144,  311 => 142,  307 => 141,  304 => 140,  301 => 139,  298 => 138,  296 => 137,  293 => 136,  289 => 134,  287 => 133,  286 => 131,  284 => 129,  282 => 128,  280 => 127,  277 => 126,  273 => 124,  271 => 122,  270 => 121,  269 => 119,  268 => 118,  267 => 117,  265 => 116,  262 => 115,  260 => 114,  257 => 113,  253 => 111,  251 => 109,  250 => 108,  249 => 107,  248 => 105,  246 => 102,  243 => 101,  241 => 100,  238 => 99,  235 => 98,  232 => 97,  228 => 95,  225 => 93,  222 => 92,  220 => 91,  217 => 90,  213 => 88,  211 => 87,  210 => 84,  208 => 82,  206 => 81,  203 => 80,  199 => 78,  197 => 77,  196 => 76,  195 => 74,  193 => 72,  191 => 71,  188 => 70,  184 => 68,  182 => 67,  181 => 66,  180 => 65,  179 => 64,  177 => 62,  174 => 61,  170 => 60,  165 => 692,  159 => 689,  156 => 688,  154 => 687,  151 => 686,  145 => 684,  143 => 683,  138 => 682,  132 => 680,  130 => 679,  127 => 678,  125 => 677,  118 => 673,  114 => 671,  112 => 670,  109 => 669,  107 => 668,  105 => 667,  103 => 666,  101 => 60,  94 => 56,  90 => 54,  88 => 52,  86 => 51,  83 => 50,  80 => 49,  77 => 48,  74 => 47,  71 => 46,  69 => 45,  64 => 43,  60 => 42,  57 => 41,  53 => 39,  51 => 38,  49 => 37,  47 => 36,  44 => 35,  42 => 34,  39 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "generic_show_form.html.twig", "C:\\xampp1\\htdocs\\unh_glpi\\templates\\generic_show_form.html.twig");
    }
}
