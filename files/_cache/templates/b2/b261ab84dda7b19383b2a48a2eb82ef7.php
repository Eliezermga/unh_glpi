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

/* dropdown_form.html.twig */
class __TwigTemplate_773dc01307b62f6c834e7a4b373b20b3 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 33
        echo "
";
        // line 34
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "dropdown_form.html.twig", 34)->unwrap();
        // line 35
        echo "
<div class=\"asset\">
    ";
        // line 37
        echo twig_include($this->env, $context, "components/form/header.html.twig");
        echo "
    ";
        // line 38
        $context["rand"] = twig_random($this->env);
        // line 39
        echo "    ";
        $context["base_fields_params"] = (($context["fields_params"]) ?? ([]));
        // line 40
        echo "    ";
        $context["params"] = (($context["params"]) ?? ([]));
        // line 41
        echo "    ";
        $context["target"] = (((twig_get_attribute($this->env, $this->source, ($context["params"] ?? null), "target", [], "array", true, true, false, 41) &&  !(null === (($__internal_compile_0 = ($context["params"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["target"] ?? null) : null)))) ? ((($__internal_compile_1 = ($context["params"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["target"] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getFormURL", [], "method", false, false, false, 41)));
        // line 42
        echo "    ";
        $context["withtemplate"] = (((twig_get_attribute($this->env, $this->source, ($context["params"] ?? null), "withtemplate", [], "array", true, true, false, 42) &&  !(null === (($__internal_compile_2 = ($context["params"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["withtemplate"] ?? null) : null)))) ? ((($__internal_compile_3 = ($context["params"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["withtemplate"] ?? null) : null)) : (""));
        // line 43
        echo "
    <div class=\"card-body row\">
        ";
        // line 45
        $context["picture_fields"] = [0 => "picture_front", 1 => "picture_rear", 2 => "pictures"];
        // line 46
        echo "        ";
        $context["has_picture_field"] = false;
        // line 47
        echo "
        ";
        // line 49
        echo "        ";
        echo twig_call_macro($macros["fields"], "macro_autoNameField", [((twig_get_attribute($this->env, $this->source,         // line 50
($context["item"] ?? null), "isField", [0 => "designation"], "method", false, false, false, 50)) ? ("designation") : ("name")),         // line 51
($context["item"] ?? null), __("Name"),         // line 53
($context["withtemplate"] ?? null)], 49, $context, $this->getSourceContext());
        // line 54
        echo "

        ";
        // line 56
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "comment"], "method", false, false, false, 56)) {
            // line 57
            echo "            ";
            echo twig_call_macro($macros["fields"], "macro_textareaField", ["comment", (($__internal_compile_4 = twig_get_attribute($this->env, $this->source,             // line 59
($context["item"] ?? null), "fields", [], "any", false, false, false, 59)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["comment"] ?? null) : null), _n("Comment", "Comments", Session::getPluralNumber())], 57, $context, $this->getSourceContext());
            // line 61
            echo "
        ";
        }
        // line 63
        echo "
        ";
        // line 65
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["additional_fields"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            // line 66
            echo "            ";
            $context["fields_params"] = ($context["base_fields_params"] ?? null);
            // line 67
            echo "            ";
            $context["type"] = ((twig_get_attribute($this->env, $this->source, $context["field"], "type", [], "array", true, true, false, 67)) ? (_twig_default_filter((($__internal_compile_5 = $context["field"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["type"] ?? null) : null), "")) : (""));
            // line 68
            echo "            ";
            $context["show_field"] = true;
            // line 69
            echo "            ";
            if ((((($__internal_compile_6 = $context["field"]) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["name"] ?? null) : null) == "entities_id") && ((($context["type"] ?? null) != "parent") || ((($__internal_compile_7 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 69)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["id"] ?? null) : null) == 0)))) {
                // line 70
                echo "                ";
                // line 71
                echo "                ";
                $context["show_field"] = false;
                // line 72
                echo "            ";
            }
            // line 73
            echo "            ";
            if (twig_in_filter((($__internal_compile_8 = $context["field"]) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["name"] ?? null) : null), ($context["picture_fields"] ?? null))) {
                // line 74
                echo "                ";
                $context["show_field"] = false;
                // line 75
                echo "            ";
            }
            // line 76
            echo "            ";
            if (($context["show_field"] ?? null)) {
                // line 77
                echo "
                ";
                // line 78
                if (((($__internal_compile_9 = $context["field"]) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["name"] ?? null) : null) == "header")) {
                    // line 79
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_largeTitle", [(($__internal_compile_10 = $context["field"]) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["label"] ?? null) : null)], 79, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif (((($__internal_compile_11 =                 // line 80
$context["field"]) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["name"] ?? null) : null) == "content")) {
                    // line 81
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_textareaField", ["content", (($__internal_compile_12 = twig_get_attribute($this->env, $this->source,                     // line 83
($context["item"] ?? null), "fields", [], "any", false, false, false, 83)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["content"] ?? null) : null), (($__internal_compile_13 =                     // line 84
$context["field"]) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["label"] ?? null) : null), ["full_width" => true, "full_width_adapt_column" => false, "is_horizontal" => false, "enable_richtext" => ((twig_get_attribute($this->env, $this->source,                     // line 89
$context["field"], "enable_richtext", [], "array", true, true, false, 89)) ? ((($__internal_compile_14 = $context["field"]) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["enable_richtext"] ?? null) : null)) : (true)), "enable_images" => false]], 81, $context, $this->getSourceContext());
                    // line 92
                    echo "
                ";
                } elseif ((                // line 93
($context["type"] ?? null) == "UserDropdown")) {
                    // line 94
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_dropdownField", ["User", (($__internal_compile_15 =                     // line 96
$context["field"]) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["name"] ?? null) : null), (($__internal_compile_16 = twig_get_attribute($this->env, $this->source,                     // line 97
($context["item"] ?? null), "fields", [], "any", false, false, false, 97)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16[(($__internal_compile_17 = $context["field"]) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_18 =                     // line 98
$context["field"]) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["label"] ?? null) : null), ["entity" => (($__internal_compile_19 = twig_get_attribute($this->env, $this->source,                     // line 100
($context["item"] ?? null), "fields", [], "any", false, false, false, 100)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["entities_id"] ?? null) : null), "right" => ((twig_get_attribute($this->env, $this->source,                     // line 101
$context["field"], "right", [], "array", true, true, false, 101)) ? (_twig_default_filter((($__internal_compile_20 = $context["field"]) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["right"] ?? null) : null), "interface")) : ("interface")), "rand" =>                     // line 102
($context["rand"] ?? null)]], 94, $context, $this->getSourceContext());
                    // line 104
                    echo "
                ";
                } elseif ((                // line 105
($context["type"] ?? null) == "dropdownValue")) {
                    // line 106
                    echo "                    ";
                    $context["dropdown_params"] = ["entity" => (($__internal_compile_21 = twig_get_attribute($this->env, $this->source,                     // line 107
($context["item"] ?? null), "fields", [], "any", false, false, false, 107)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["entities_id"] ?? null) : null)];
                    // line 109
                    echo "                    ";
                    if (twig_get_attribute($this->env, $this->source, $context["field"], "condition", [], "array", true, true, false, 109)) {
                        // line 110
                        echo "                        ";
                        $context["dropdown_params"] = twig_array_merge(($context["dropdown_params"] ?? null), ["condition" => (($__internal_compile_22 = $context["field"]) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["condition"] ?? null) : null)]);
                        // line 111
                        echo "                    ";
                    }
                    // line 112
                    echo "                    ";
                    $context["dropdown_itemtype"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("getItemtypeForForeignKeyField", [0 => (($__internal_compile_23 = $context["field"]) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["name"] ?? null) : null)]);
                    // line 113
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_dropdownField", [($context["dropdown_itemtype"] ?? null), (($__internal_compile_24 = $context["field"]) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["name"] ?? null) : null), (($__internal_compile_25 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 113)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25[(($__internal_compile_26 = $context["field"]) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_27 = $context["field"]) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["label"] ?? null) : null), ($context["dropdown_params"] ?? null)], 113, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif ((                // line 114
($context["type"] ?? null) == "text")) {
                    // line 115
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_autoNameField", [(($__internal_compile_28 = $context["field"]) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["name"] ?? null) : null), ($context["item"] ?? null), (($__internal_compile_29 = $context["field"]) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29["label"] ?? null) : null), ($context["withtemplate"] ?? null), ($context["fields_params"] ?? null)], 115, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif ((                // line 116
($context["type"] ?? null) == "textarea")) {
                    // line 117
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_textareaField", [(($__internal_compile_30 = $context["field"]) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30["name"] ?? null) : null), (($__internal_compile_31 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 117)) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31[(($__internal_compile_32 = $context["field"]) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_33 = $context["field"]) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33["label"] ?? null) : null), ($context["fields_params"] ?? null)], 117, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif ((                // line 118
($context["type"] ?? null) == "integer")) {
                    // line 119
                    echo "                    ";
                    $context["fields_params"] = ["value" => (($__internal_compile_34 = twig_get_attribute($this->env, $this->source,                     // line 120
($context["item"] ?? null), "fields", [], "any", false, false, false, 120)) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34[(($__internal_compile_35 = $context["field"]) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35["name"] ?? null) : null)] ?? null) : null)];
                    // line 122
                    echo "                    ";
                    if (twig_get_attribute($this->env, $this->source, $context["field"], "min", [], "array", true, true, false, 122)) {
                        // line 123
                        echo "                        ";
                        $context["fields_params"] = twig_array_merge(($context["fields_params"] ?? null), ["min" => (($__internal_compile_36 = $context["field"]) && is_array($__internal_compile_36) || $__internal_compile_36 instanceof ArrayAccess ? ($__internal_compile_36["min"] ?? null) : null)]);
                        // line 124
                        echo "                    ";
                    }
                    // line 125
                    echo "                    ";
                    if (twig_get_attribute($this->env, $this->source, $context["field"], "step", [], "array", true, true, false, 125)) {
                        // line 126
                        echo "                        ";
                        $context["fields_params"] = twig_array_merge(($context["fields_params"] ?? null), ["step" => (($__internal_compile_37 = $context["field"]) && is_array($__internal_compile_37) || $__internal_compile_37 instanceof ArrayAccess ? ($__internal_compile_37["step"] ?? null) : null)]);
                        // line 127
                        echo "                    ";
                    }
                    // line 128
                    echo "                    ";
                    if (twig_get_attribute($this->env, $this->source, $context["field"], "max", [], "array", true, true, false, 128)) {
                        // line 129
                        echo "                        ";
                        $context["fields_params"] = twig_array_merge(($context["fields_params"] ?? null), ["max" => (($__internal_compile_38 = $context["field"]) && is_array($__internal_compile_38) || $__internal_compile_38 instanceof ArrayAccess ? ($__internal_compile_38["max"] ?? null) : null)]);
                        // line 130
                        echo "                    ";
                    }
                    // line 131
                    echo "
                    ";
                    // line 132
                    $context["fields_params"] = twig_array_merge(($context["fields_params"] ?? null), ["type" => "number"]);
                    // line 133
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_numberField", [(($__internal_compile_39 = $context["field"]) && is_array($__internal_compile_39) || $__internal_compile_39 instanceof ArrayAccess ? ($__internal_compile_39["name"] ?? null) : null), (($__internal_compile_40 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 133)) && is_array($__internal_compile_40) || $__internal_compile_40 instanceof ArrayAccess ? ($__internal_compile_40[(($__internal_compile_41 = $context["field"]) && is_array($__internal_compile_41) || $__internal_compile_41 instanceof ArrayAccess ? ($__internal_compile_41["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_42 = $context["field"]) && is_array($__internal_compile_42) || $__internal_compile_42 instanceof ArrayAccess ? ($__internal_compile_42["label"] ?? null) : null), ($context["fields_params"] ?? null)], 133, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif ((                // line 134
($context["type"] ?? null) == "timestamp")) {
                    // line 135
                    echo "                    ";
                    $context["fields_params"] = ["value" => (($__internal_compile_43 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 135)) && is_array($__internal_compile_43) || $__internal_compile_43 instanceof ArrayAccess ? ($__internal_compile_43[(($__internal_compile_44 = $context["field"]) && is_array($__internal_compile_44) || $__internal_compile_44 instanceof ArrayAccess ? ($__internal_compile_44["name"] ?? null) : null)] ?? null) : null)];
                    // line 136
                    echo "                    ";
                    if (twig_get_attribute($this->env, $this->source, $context["field"], "min", [], "array", true, true, false, 136)) {
                        // line 137
                        echo "                        ";
                        $context["fields_params"] = twig_array_merge(($context["fields_params"] ?? null), ["min" => (($__internal_compile_45 = $context["field"]) && is_array($__internal_compile_45) || $__internal_compile_45 instanceof ArrayAccess ? ($__internal_compile_45["min"] ?? null) : null)]);
                        // line 138
                        echo "                    ";
                    }
                    // line 139
                    echo "                    ";
                    if (twig_get_attribute($this->env, $this->source, $context["field"], "step", [], "array", true, true, false, 139)) {
                        // line 140
                        echo "                        ";
                        $context["fields_params"] = twig_array_merge(($context["fields_params"] ?? null), ["step" => (($__internal_compile_46 = $context["field"]) && is_array($__internal_compile_46) || $__internal_compile_46 instanceof ArrayAccess ? ($__internal_compile_46["step"] ?? null) : null)]);
                        // line 141
                        echo "                    ";
                    }
                    // line 142
                    echo "                    ";
                    if (twig_get_attribute($this->env, $this->source, $context["field"], "max", [], "array", true, true, false, 142)) {
                        // line 143
                        echo "                        ";
                        $context["fields_params"] = twig_array_merge(($context["fields_params"] ?? null), ["max" => (($__internal_compile_47 = $context["field"]) && is_array($__internal_compile_47) || $__internal_compile_47 instanceof ArrayAccess ? ($__internal_compile_47["max"] ?? null) : null)]);
                        // line 144
                        echo "                    ";
                    }
                    // line 145
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_dropdownTimestampField", [(($__internal_compile_48 = $context["field"]) && is_array($__internal_compile_48) || $__internal_compile_48 instanceof ArrayAccess ? ($__internal_compile_48["name"] ?? null) : null), (($__internal_compile_49 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 145)) && is_array($__internal_compile_49) || $__internal_compile_49 instanceof ArrayAccess ? ($__internal_compile_49[(($__internal_compile_50 = $context["field"]) && is_array($__internal_compile_50) || $__internal_compile_50 instanceof ArrayAccess ? ($__internal_compile_50["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_51 = $context["field"]) && is_array($__internal_compile_51) || $__internal_compile_51 instanceof ArrayAccess ? ($__internal_compile_51["label"] ?? null) : null), ($context["fields_params"] ?? null)], 145, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif ((                // line 146
($context["type"] ?? null) == "parent")) {
                    // line 147
                    echo "                    ";
                    $context["restrict"] = ((((($__internal_compile_52 = $context["field"]) && is_array($__internal_compile_52) || $__internal_compile_52 instanceof ArrayAccess ? ($__internal_compile_52["name"] ?? null) : null) == "entities_id")) ? ( -1) : (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getEntityID", [], "method", false, false, false, 147)));
                    // line 148
                    echo "                    ";
                    $context["fields_params"] = twig_array_merge(($context["fields_params"] ?? null), ["entity" => ($context["restrict"] ?? null)]);
                    // line 149
                    echo "                    ";
                    $context["fields_params"] = twig_array_merge(($context["fields_params"] ?? null), ["used" => ((((($__internal_compile_53 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 149)) && is_array($__internal_compile_53) || $__internal_compile_53 instanceof ArrayAccess ? ($__internal_compile_53["id"] ?? null) : null) > 0)) ? ($this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("getSonsOf", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getTable", [], "method", false, false, false, 149), 1 => (($__internal_compile_54 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 149)) && is_array($__internal_compile_54) || $__internal_compile_54 instanceof ArrayAccess ? ($__internal_compile_54["id"] ?? null) : null)])) : ([]))]);
                    // line 150
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_dropdownField", [($context["item"] ?? null), (($__internal_compile_55 = $context["field"]) && is_array($__internal_compile_55) || $__internal_compile_55 instanceof ArrayAccess ? ($__internal_compile_55["name"] ?? null) : null), (($__internal_compile_56 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 150)) && is_array($__internal_compile_56) || $__internal_compile_56 instanceof ArrayAccess ? ($__internal_compile_56[(($__internal_compile_57 = $context["field"]) && is_array($__internal_compile_57) || $__internal_compile_57 instanceof ArrayAccess ? ($__internal_compile_57["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_58 = $context["field"]) && is_array($__internal_compile_58) || $__internal_compile_58 instanceof ArrayAccess ? ($__internal_compile_58["label"] ?? null) : null), ($context["fields_params"] ?? null)], 150, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif ((                // line 151
($context["type"] ?? null) == "icon")) {
                    // line 152
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_dropdownIcons", [(($__internal_compile_59 = $context["field"]) && is_array($__internal_compile_59) || $__internal_compile_59 instanceof ArrayAccess ? ($__internal_compile_59["name"] ?? null) : null), (($__internal_compile_60 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 152)) && is_array($__internal_compile_60) || $__internal_compile_60 instanceof ArrayAccess ? ($__internal_compile_60[(($__internal_compile_61 = $context["field"]) && is_array($__internal_compile_61) || $__internal_compile_61 instanceof ArrayAccess ? ($__internal_compile_61["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_62 = $context["field"]) && is_array($__internal_compile_62) || $__internal_compile_62 instanceof ArrayAccess ? ($__internal_compile_62["label"] ?? null) : null), ($context["fields_params"] ?? null)], 152, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif ((                // line 153
($context["type"] ?? null) == "bool")) {
                    // line 154
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_dropdownYesNo", [(($__internal_compile_63 = $context["field"]) && is_array($__internal_compile_63) || $__internal_compile_63 instanceof ArrayAccess ? ($__internal_compile_63["name"] ?? null) : null), (($__internal_compile_64 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 154)) && is_array($__internal_compile_64) || $__internal_compile_64 instanceof ArrayAccess ? ($__internal_compile_64[(($__internal_compile_65 = $context["field"]) && is_array($__internal_compile_65) || $__internal_compile_65 instanceof ArrayAccess ? ($__internal_compile_65["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_66 = $context["field"]) && is_array($__internal_compile_66) || $__internal_compile_66 instanceof ArrayAccess ? ($__internal_compile_66["label"] ?? null) : null), ($context["fields_params"] ?? null)], 154, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif ((                // line 155
($context["type"] ?? null) == "color")) {
                    // line 156
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_colorField", [(($__internal_compile_67 = $context["field"]) && is_array($__internal_compile_67) || $__internal_compile_67 instanceof ArrayAccess ? ($__internal_compile_67["name"] ?? null) : null), (($__internal_compile_68 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 156)) && is_array($__internal_compile_68) || $__internal_compile_68 instanceof ArrayAccess ? ($__internal_compile_68[(($__internal_compile_69 = $context["field"]) && is_array($__internal_compile_69) || $__internal_compile_69 instanceof ArrayAccess ? ($__internal_compile_69["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_70 = $context["field"]) && is_array($__internal_compile_70) || $__internal_compile_70 instanceof ArrayAccess ? ($__internal_compile_70["label"] ?? null) : null), ($context["fields_params"] ?? null)], 156, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif ((                // line 157
($context["type"] ?? null) == "date")) {
                    // line 158
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_dateField", [(($__internal_compile_71 = $context["field"]) && is_array($__internal_compile_71) || $__internal_compile_71 instanceof ArrayAccess ? ($__internal_compile_71["name"] ?? null) : null), (($__internal_compile_72 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 158)) && is_array($__internal_compile_72) || $__internal_compile_72 instanceof ArrayAccess ? ($__internal_compile_72[(($__internal_compile_73 = $context["field"]) && is_array($__internal_compile_73) || $__internal_compile_73 instanceof ArrayAccess ? ($__internal_compile_73["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_74 = $context["field"]) && is_array($__internal_compile_74) || $__internal_compile_74 instanceof ArrayAccess ? ($__internal_compile_74["label"] ?? null) : null), ($context["fields_params"] ?? null)], 158, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif ((                // line 159
($context["type"] ?? null) == "datetime")) {
                    // line 160
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_datetimeField", [(($__internal_compile_75 = $context["field"]) && is_array($__internal_compile_75) || $__internal_compile_75 instanceof ArrayAccess ? ($__internal_compile_75["name"] ?? null) : null), (($__internal_compile_76 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 160)) && is_array($__internal_compile_76) || $__internal_compile_76 instanceof ArrayAccess ? ($__internal_compile_76[(($__internal_compile_77 = $context["field"]) && is_array($__internal_compile_77) || $__internal_compile_77 instanceof ArrayAccess ? ($__internal_compile_77["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_78 = $context["field"]) && is_array($__internal_compile_78) || $__internal_compile_78 instanceof ArrayAccess ? ($__internal_compile_78["label"] ?? null) : null), ($context["fields_params"] ?? null)], 160, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif ((                // line 161
($context["type"] ?? null) == "picture")) {
                    // line 162
                    echo "                    ";
                    if ( !twig_test_empty((($__internal_compile_79 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 162)) && is_array($__internal_compile_79) || $__internal_compile_79 instanceof ArrayAccess ? ($__internal_compile_79[(($__internal_compile_80 = $context["field"]) && is_array($__internal_compile_80) || $__internal_compile_80 instanceof ArrayAccess ? ($__internal_compile_80["name"] ?? null) : null)] ?? null) : null))) {
                        // line 163
                        echo "                        ";
                        echo twig_call_macro($macros["fields"], "macro_imageField", [(($__internal_compile_81 = $context["field"]) && is_array($__internal_compile_81) || $__internal_compile_81 instanceof ArrayAccess ? ($__internal_compile_81["name"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getPictureUrl((($__internal_compile_82 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 163)) && is_array($__internal_compile_82) || $__internal_compile_82 instanceof ArrayAccess ? ($__internal_compile_82[(($__internal_compile_83 = $context["field"]) && is_array($__internal_compile_83) || $__internal_compile_83 instanceof ArrayAccess ? ($__internal_compile_83["name"] ?? null) : null)] ?? null) : null)), (($__internal_compile_84 = $context["field"]) && is_array($__internal_compile_84) || $__internal_compile_84 instanceof ArrayAccess ? ($__internal_compile_84["label"] ?? null) : null), twig_array_merge(($context["fields_params"] ?? null), ["clearable" => ( !twig_get_attribute($this->env, $this->source,                         // line 164
($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 164) && twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "canUpdateItem", [], "method", false, false, false, 164))])], 163, $context, $this->getSourceContext());
                        // line 165
                        echo "
                    ";
                    } else {
                        // line 167
                        echo "                        ";
                        echo twig_call_macro($macros["fields"], "macro_fileField", [(($__internal_compile_85 = $context["field"]) && is_array($__internal_compile_85) || $__internal_compile_85 instanceof ArrayAccess ? ($__internal_compile_85["name"] ?? null) : null), null, (($__internal_compile_86 = $context["field"]) && is_array($__internal_compile_86) || $__internal_compile_86 instanceof ArrayAccess ? ($__internal_compile_86["label"] ?? null) : null), ["onlyimages" => true]], 167, $context, $this->getSourceContext());
                        // line 169
                        echo "
                    ";
                    }
                    // line 171
                    echo "                ";
                } elseif ((($context["type"] ?? null) == "picture_gallery")) {
                    // line 172
                    echo "                    ";
                    $context["pictures"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("importArrayFromDB", [0 => (($__internal_compile_87 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 172)) && is_array($__internal_compile_87) || $__internal_compile_87 instanceof ArrayAccess ? ($__internal_compile_87[(($__internal_compile_88 = $context["field"]) && is_array($__internal_compile_88) || $__internal_compile_88 instanceof ArrayAccess ? ($__internal_compile_88["name"] ?? null) : null)] ?? null) : null)]);
                    // line 173
                    echo "                    ";
                    $context["picture_urls"] = [];
                    // line 174
                    echo "                    ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["pictures"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["picture"]) {
                        // line 175
                        echo "                        ";
                        $context["picture_urls"] = twig_array_merge(($context["picture_urls"] ?? null), [0 => $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getPictureUrl($context["picture"])]);
                        // line 176
                        echo "                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['picture'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 177
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_imageGalleryField", [(($__internal_compile_89 = $context["field"]) && is_array($__internal_compile_89) || $__internal_compile_89 instanceof ArrayAccess ? ($__internal_compile_89["name"] ?? null) : null), ($context["picture_urls"] ?? null), (($__internal_compile_90 = $context["field"]) && is_array($__internal_compile_90) || $__internal_compile_90 instanceof ArrayAccess ? ($__internal_compile_90["label"] ?? null) : null), twig_array_merge(($context["fields_params"] ?? null), ["clearable" => ( !twig_get_attribute($this->env, $this->source,                     // line 178
($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 178) && twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "canUpdateItem", [], "method", false, false, false, 178))])], 177, $context, $this->getSourceContext());
                    // line 179
                    echo "
                ";
                } elseif ((                // line 180
($context["type"] ?? null) == "password")) {
                    // line 181
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_passwordField", [(($__internal_compile_91 = $context["field"]) && is_array($__internal_compile_91) || $__internal_compile_91 instanceof ArrayAccess ? ($__internal_compile_91["name"] ?? null) : null), (($__internal_compile_92 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 181)) && is_array($__internal_compile_92) || $__internal_compile_92 instanceof ArrayAccess ? ($__internal_compile_92[(($__internal_compile_93 = $context["field"]) && is_array($__internal_compile_93) || $__internal_compile_93 instanceof ArrayAccess ? ($__internal_compile_93["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_94 = $context["field"]) && is_array($__internal_compile_94) || $__internal_compile_94 instanceof ArrayAccess ? ($__internal_compile_94["label"] ?? null) : null), ($context["fields_params"] ?? null)], 181, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif ((                // line 182
($context["type"] ?? null) == "tinymce")) {
                    // line 183
                    echo "                    ";
                    $context["fields_params"] = twig_array_merge(($context["fields_params"] ?? null), ["enable_richtext" => true]);
                    // line 184
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_textareaField", [(($__internal_compile_95 = $context["field"]) && is_array($__internal_compile_95) || $__internal_compile_95 instanceof ArrayAccess ? ($__internal_compile_95["name"] ?? null) : null), (($__internal_compile_96 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 184)) && is_array($__internal_compile_96) || $__internal_compile_96 instanceof ArrayAccess ? ($__internal_compile_96[(($__internal_compile_97 = $context["field"]) && is_array($__internal_compile_97) || $__internal_compile_97 instanceof ArrayAccess ? ($__internal_compile_97["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_98 = $context["field"]) && is_array($__internal_compile_98) || $__internal_compile_98 instanceof ArrayAccess ? ($__internal_compile_98["label"] ?? null) : null), ($context["fields_params"] ?? null)], 184, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif ((                // line 185
($context["type"] ?? null) == "duration")) {
                    // line 186
                    echo "                    ";
                    $context["toadd"] = [];
                    // line 187
                    echo "                    ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(range(9, 100));
                    foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                        // line 188
                        echo "                        ";
                        $context["toadd"] = twig_array_merge(($context["toadd"] ?? null), [0 => ($context["i"] * twig_constant("HOUR_TIMESTAMP"))]);
                        // line 189
                        echo "                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 190
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_dropdownTimestampField", [(($__internal_compile_99 = $context["field"]) && is_array($__internal_compile_99) || $__internal_compile_99 instanceof ArrayAccess ? ($__internal_compile_99["name"] ?? null) : null), (($__internal_compile_100 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 190)) && is_array($__internal_compile_100) || $__internal_compile_100 instanceof ArrayAccess ? ($__internal_compile_100[(($__internal_compile_101 = $context["field"]) && is_array($__internal_compile_101) || $__internal_compile_101 instanceof ArrayAccess ? ($__internal_compile_101["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_102 = $context["field"]) && is_array($__internal_compile_102) || $__internal_compile_102 instanceof ArrayAccess ? ($__internal_compile_102["label"] ?? null) : null), ($context["fields_params"] ?? null)], 190, $context, $this->getSourceContext());
                    echo "
                ";
                } elseif ((                // line 191
($context["type"] ?? null) == "itemtypename")) {
                    // line 192
                    echo "                    ";
                    if (twig_get_attribute($this->env, $this->source, $context["field"], "itemtype_list", [], "array", true, true, false, 192)) {
                        // line 193
                        echo "                        ";
                        $context["fields_params"] = twig_array_merge(($context["fields_params"] ?? null), ["types" => $this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config((($__internal_compile_103 = $context["field"]) && is_array($__internal_compile_103) || $__internal_compile_103 instanceof ArrayAccess ? ($__internal_compile_103["itemtype_list"] ?? null) : null))]);
                        // line 194
                        echo "                    ";
                    }
                    // line 195
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_dropdownItemTypes", [(($__internal_compile_104 = $context["field"]) && is_array($__internal_compile_104) || $__internal_compile_104 instanceof ArrayAccess ? ($__internal_compile_104["name"] ?? null) : null), (($__internal_compile_105 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 195)) && is_array($__internal_compile_105) || $__internal_compile_105 instanceof ArrayAccess ? ($__internal_compile_105[(($__internal_compile_106 = $context["field"]) && is_array($__internal_compile_106) || $__internal_compile_106 instanceof ArrayAccess ? ($__internal_compile_106["name"] ?? null) : null)] ?? null) : null), (($__internal_compile_107 = $context["field"]) && is_array($__internal_compile_107) || $__internal_compile_107 instanceof ArrayAccess ? ($__internal_compile_107["label"] ?? null) : null), ($context["fields_params"] ?? null)], 195, $context, $this->getSourceContext());
                    echo "
                ";
                } else {
                    // line 197
                    echo "                    ";
                    ob_start(function () { return ''; });
                    // line 198
                    echo "                        ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "displaySpecificTypeField", [0 => (($__internal_compile_108 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 198)) && is_array($__internal_compile_108) || $__internal_compile_108 instanceof ArrayAccess ? ($__internal_compile_108["id"] ?? null) : null), 1 => $context["field"], 2 => ($context["fields_params"] ?? null)], "method", false, false, false, 198), "html", null, true);
                    echo "
                    ";
                    $context["field_value"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                    // line 200
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_field", [(($__internal_compile_109 = $context["field"]) && is_array($__internal_compile_109) || $__internal_compile_109 instanceof ArrayAccess ? ($__internal_compile_109["name"] ?? null) : null), ($context["field_value"] ?? null), (($__internal_compile_110 = $context["field"]) && is_array($__internal_compile_110) || $__internal_compile_110 instanceof ArrayAccess ? ($__internal_compile_110["label"] ?? null) : null)], 200, $context, $this->getSourceContext());
                    echo "
                ";
                }
                // line 202
                echo "            ";
            } elseif (twig_in_filter((($__internal_compile_111 = $context["field"]) && is_array($__internal_compile_111) || $__internal_compile_111 instanceof ArrayAccess ? ($__internal_compile_111["name"] ?? null) : null), ($context["picture_fields"] ?? null))) {
                // line 203
                echo "                ";
                $context["has_picture_field"] = true;
                // line 204
                echo "            ";
            }
            // line 205
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 206
        echo "
        ";
        // line 207
        if (($context["has_picture_field"] ?? null)) {
            // line 208
            echo "            ";
            echo twig_call_macro($macros["fields"], "macro_largeTitle", [_n("Picture", "Pictures", Session::getPluralNumber()), "fas fa-image"], 208, $context, $this->getSourceContext());
            echo "
        ";
        }
        // line 210
        echo "        ";
        // line 211
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["additional_fields"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            // line 212
            echo "            ";
            $context["type"] = ((twig_get_attribute($this->env, $this->source, $context["field"], "type", [], "array", true, true, false, 212)) ? (_twig_default_filter((($__internal_compile_112 = $context["field"]) && is_array($__internal_compile_112) || $__internal_compile_112 instanceof ArrayAccess ? ($__internal_compile_112["type"] ?? null) : null), "")) : (""));
            // line 213
            echo "            ";
            if (twig_in_filter((($__internal_compile_113 = $context["field"]) && is_array($__internal_compile_113) || $__internal_compile_113 instanceof ArrayAccess ? ($__internal_compile_113["name"] ?? null) : null), ($context["picture_fields"] ?? null))) {
                // line 214
                echo "                ";
                if ((($context["type"] ?? null) == "picture")) {
                    // line 215
                    echo "                    ";
                    if (((($__internal_compile_114 = $context["field"]) && is_array($__internal_compile_114) || $__internal_compile_114 instanceof ArrayAccess ? ($__internal_compile_114["name"] ?? null) : null) == "picture_front")) {
                        // line 216
                        echo "                        ";
                        echo twig_call_macro($macros["fields"], "macro_smallTitle", [__("Rack pictures"), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeIcon("Rack")], 216, $context, $this->getSourceContext());
                        echo "
                    ";
                    }
                    // line 218
                    echo "                    ";
                    if ( !twig_test_empty((($__internal_compile_115 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 218)) && is_array($__internal_compile_115) || $__internal_compile_115 instanceof ArrayAccess ? ($__internal_compile_115[(($__internal_compile_116 = $context["field"]) && is_array($__internal_compile_116) || $__internal_compile_116 instanceof ArrayAccess ? ($__internal_compile_116["name"] ?? null) : null)] ?? null) : null))) {
                        // line 219
                        echo "                        ";
                        echo twig_call_macro($macros["fields"], "macro_imageField", [(($__internal_compile_117 = $context["field"]) && is_array($__internal_compile_117) || $__internal_compile_117 instanceof ArrayAccess ? ($__internal_compile_117["name"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getPictureUrl((($__internal_compile_118 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 219)) && is_array($__internal_compile_118) || $__internal_compile_118 instanceof ArrayAccess ? ($__internal_compile_118[(($__internal_compile_119 = $context["field"]) && is_array($__internal_compile_119) || $__internal_compile_119 instanceof ArrayAccess ? ($__internal_compile_119["name"] ?? null) : null)] ?? null) : null)), (($__internal_compile_120 = $context["field"]) && is_array($__internal_compile_120) || $__internal_compile_120 instanceof ArrayAccess ? ($__internal_compile_120["label"] ?? null) : null), twig_array_merge(($context["base_fields_params"] ?? null), ["clearable" => twig_get_attribute($this->env, $this->source,                         // line 220
($context["item"] ?? null), "canUpdateItem", [], "method", false, false, false, 220)])], 219, $context, $this->getSourceContext());
                        // line 221
                        echo "
                    ";
                    } else {
                        // line 223
                        echo "                        ";
                        echo twig_call_macro($macros["fields"], "macro_fileField", [(($__internal_compile_121 = $context["field"]) && is_array($__internal_compile_121) || $__internal_compile_121 instanceof ArrayAccess ? ($__internal_compile_121["name"] ?? null) : null), null, (($__internal_compile_122 = $context["field"]) && is_array($__internal_compile_122) || $__internal_compile_122 instanceof ArrayAccess ? ($__internal_compile_122["label"] ?? null) : null), ["onlyimages" => true]], 223, $context, $this->getSourceContext());
                        // line 225
                        echo "
                    ";
                    }
                    // line 227
                    echo "                ";
                } elseif ((($context["type"] ?? null) == "picture_gallery")) {
                    // line 228
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_smallTitle", [__("Other pictures"), "fas fa-images"], 228, $context, $this->getSourceContext());
                    echo "
                    ";
                    // line 229
                    $context["pictures"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("importArrayFromDB", [0 => (($__internal_compile_123 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 229)) && is_array($__internal_compile_123) || $__internal_compile_123 instanceof ArrayAccess ? ($__internal_compile_123[(($__internal_compile_124 = $context["field"]) && is_array($__internal_compile_124) || $__internal_compile_124 instanceof ArrayAccess ? ($__internal_compile_124["name"] ?? null) : null)] ?? null) : null)]);
                    // line 230
                    echo "                    ";
                    $context["picture_urls"] = [];
                    // line 231
                    echo "                    ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["pictures"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["picture"]) {
                        // line 232
                        echo "                        ";
                        $context["picture_urls"] = twig_array_merge(($context["picture_urls"] ?? null), [0 => $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getPictureUrl($context["picture"])]);
                        // line 233
                        echo "                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['picture'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 234
                    echo "                    ";
                    echo twig_call_macro($macros["fields"], "macro_imageGalleryField", [(($__internal_compile_125 = $context["field"]) && is_array($__internal_compile_125) || $__internal_compile_125 instanceof ArrayAccess ? ($__internal_compile_125["name"] ?? null) : null), ($context["picture_urls"] ?? null), "", twig_array_merge(($context["base_fields_params"] ?? null), ["clearable" => twig_get_attribute($this->env, $this->source,                     // line 235
($context["item"] ?? null), "canUpdateItem", [], "method", false, false, false, 235), "no_label" => true])], 234, $context, $this->getSourceContext());
                    // line 237
                    echo "
                ";
                }
                // line 239
                echo "            ";
            }
            // line 240
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 241
        echo "    </div>
    ";
        // line 242
        echo twig_include($this->env, $context, "components/form/buttons.html.twig");
        echo "
</div>
";
    }

    public function getTemplateName()
    {
        return "dropdown_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  578 => 242,  575 => 241,  569 => 240,  566 => 239,  562 => 237,  560 => 235,  558 => 234,  552 => 233,  549 => 232,  544 => 231,  541 => 230,  539 => 229,  534 => 228,  531 => 227,  527 => 225,  524 => 223,  520 => 221,  518 => 220,  516 => 219,  513 => 218,  507 => 216,  504 => 215,  501 => 214,  498 => 213,  495 => 212,  490 => 211,  488 => 210,  482 => 208,  480 => 207,  477 => 206,  471 => 205,  468 => 204,  465 => 203,  462 => 202,  456 => 200,  450 => 198,  447 => 197,  441 => 195,  438 => 194,  435 => 193,  432 => 192,  430 => 191,  425 => 190,  419 => 189,  416 => 188,  411 => 187,  408 => 186,  406 => 185,  401 => 184,  398 => 183,  396 => 182,  391 => 181,  389 => 180,  386 => 179,  384 => 178,  382 => 177,  376 => 176,  373 => 175,  368 => 174,  365 => 173,  362 => 172,  359 => 171,  355 => 169,  352 => 167,  348 => 165,  346 => 164,  344 => 163,  341 => 162,  339 => 161,  334 => 160,  332 => 159,  327 => 158,  325 => 157,  320 => 156,  318 => 155,  313 => 154,  311 => 153,  306 => 152,  304 => 151,  299 => 150,  296 => 149,  293 => 148,  290 => 147,  288 => 146,  283 => 145,  280 => 144,  277 => 143,  274 => 142,  271 => 141,  268 => 140,  265 => 139,  262 => 138,  259 => 137,  256 => 136,  253 => 135,  251 => 134,  246 => 133,  244 => 132,  241 => 131,  238 => 130,  235 => 129,  232 => 128,  229 => 127,  226 => 126,  223 => 125,  220 => 124,  217 => 123,  214 => 122,  212 => 120,  210 => 119,  208 => 118,  203 => 117,  201 => 116,  196 => 115,  194 => 114,  189 => 113,  186 => 112,  183 => 111,  180 => 110,  177 => 109,  175 => 107,  173 => 106,  171 => 105,  168 => 104,  166 => 102,  165 => 101,  164 => 100,  163 => 98,  162 => 97,  161 => 96,  159 => 94,  157 => 93,  154 => 92,  152 => 89,  151 => 84,  150 => 83,  148 => 81,  146 => 80,  141 => 79,  139 => 78,  136 => 77,  133 => 76,  130 => 75,  127 => 74,  124 => 73,  121 => 72,  118 => 71,  116 => 70,  113 => 69,  110 => 68,  107 => 67,  104 => 66,  99 => 65,  96 => 63,  92 => 61,  90 => 59,  88 => 57,  86 => 56,  82 => 54,  80 => 53,  79 => 51,  78 => 50,  76 => 49,  73 => 47,  70 => 46,  68 => 45,  64 => 43,  61 => 42,  58 => 41,  55 => 40,  52 => 39,  50 => 38,  46 => 37,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "dropdown_form.html.twig", "C:\\xampp1\\htdocs\\unh_glpi\\templates\\dropdown_form.html.twig");
    }
}
