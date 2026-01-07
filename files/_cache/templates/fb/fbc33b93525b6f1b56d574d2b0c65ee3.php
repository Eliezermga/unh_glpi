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

/* components/form/fields_macros.html.twig */
class __TwigTemplate_a2433cfdd640cd9da15faef7902a1272 extends Template
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
        $macros["_self"] = $this->macros["_self"] = $this;
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 33
        echo "
";
        // line 53
        echo "
";
        // line 70
        echo "
";
        // line 86
        echo "

";
        // line 107
        echo "

";
        // line 129
        echo "

";
        // line 158
        echo "

";
        // line 183
        echo "

";
        // line 198
        echo "

";
        // line 280
        echo "
";
        // line 314
        echo "
";
        // line 348
        echo "
";
        // line 383
        echo "
";
        // line 411
        echo "
";
        // line 450
        echo "
";
        // line 455
        echo "
";
        // line 477
        echo "
";
        // line 502
        echo "
";
        // line 530
        echo "
";
        // line 547
        echo "
";
        // line 570
        echo "
";
        // line 594
        echo "
";
        // line 617
        echo "
";
        // line 639
        echo "
";
        // line 664
        echo "
";
        // line 675
        echo "
";
        // line 697
        echo "
";
        // line 720
        echo "
";
        // line 754
        echo "
";
        // line 765
        echo "
";
        // line 800
        echo "
";
        // line 811
        echo "
";
        // line 821
        echo "

";
        // line 839
        echo "

";
        // line 898
        echo "

";
        // line 929
        echo "

";
    }

    // line 34
    public function macro_largeTitle($__label__ = null, $__icon__ = "", $__first__ = false, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "label" => $__label__,
            "icon" => $__icon__,
            "first" => $__first__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 35
            echo "   ";
            $context["margins"] = "mt-3";
            // line 36
            echo "   ";
            if (($context["first"] ?? null)) {
                // line 37
                echo "      ";
                $context["margins"] = "mt-n2";
                // line 38
                echo "   ";
            }
            // line 39
            echo "
   <div class=\"card border-0 shadow-none p-0 m-0 ";
            // line 40
            echo twig_escape_filter($this->env, ($context["margins"] ?? null), "html", null, true);
            echo "\">
      <div class=\"card-header mb-3\">
         <h4 class=\"card-title ";
            // line 42
            echo ((twig_length_filter($this->env, ($context["icon"] ?? null))) ? ("ms-4") : (""));
            echo "\">
            ";
            // line 43
            if (twig_length_filter($this->env, ($context["icon"] ?? null))) {
                // line 44
                echo "               <div class=\"ribbon ribbon-bookmark ribbon-top ribbon-start bg-blue s-1\">
                  <i class=\"fa-2x ";
                // line 45
                echo twig_escape_filter($this->env, ($context["icon"] ?? null), "html", null, true);
                echo "\"></i>
               </div>
            ";
            }
            // line 48
            echo "            ";
            echo twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
            echo "
         </h4>
      </div>
   </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 54
    public function macro_smallTitle($__label__ = null, $__icon__ = "", ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "label" => $__label__,
            "icon" => $__icon__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 55
            echo "   ";
            $context["margins"] = "mt-2 mb-2";
            // line 56
            echo "
   <div class=\"card border-0 shadow-none p-0 m-0 ";
            // line 57
            echo twig_escape_filter($this->env, ($context["margins"] ?? null), "html", null, true);
            echo "\">
      <div class=\"card-header mb-1 p-0 ps-3\">
         <h4 class=\"card-subtitle ";
            // line 59
            echo ((twig_length_filter($this->env, ($context["icon"] ?? null))) ? ("ms-4") : (""));
            echo "\">
            ";
            // line 60
            if (twig_length_filter($this->env, ($context["icon"] ?? null))) {
                // line 61
                echo "               <div class=\"ribbon ribbon-bookmark ribbon-top ribbon-start bg-blue s-1\">
                  <i class=\"fa-2x ";
                // line 62
                echo twig_escape_filter($this->env, ($context["icon"] ?? null), "html", null, true);
                echo "\"></i>
               </div>
            ";
            }
            // line 65
            echo "            ";
            echo twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
            echo "
         </h4>
      </div>
   </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 71
    public function macro_autoNameField($__name__ = null, $__item__ = null, $__label__ = "", $__withtemplate__ = null, $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "item" => $__item__,
            "label" => $__label__,
            "withtemplate" => $__withtemplate__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 72
            echo "   ";
            $context["tpl_value"] = (((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["option"] ?? null), "value", [], "any", false, false, false, 72)) > 0)) ? (twig_get_attribute($this->env, $this->source, ($context["option"] ?? null), "value", [], "any", false, false, false, 72)) : ($this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue((($__internal_compile_0 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 72)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[($context["name"] ?? null)] ?? null) : null))));
            // line 73
            echo "   ";
            $context["tplmark"] = "";
            // line 74
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isTemplate", [], "method", false, false, false, 74)) {
                echo " ";
                // line 75
                echo "      ";
                $context["tplmark"] = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getAutofillMark", [0 => ($context["name"] ?? null), 1 => ["withtemplate" => ($context["withtemplate"] ?? null)], 2 => ($context["tpl_value"] ?? null)], "method", false, false, false, 75);
                // line 76
                echo "   ";
            }
            // line 77
            echo "   ";
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, true, false, 77), ($context["name"] ?? null), [], "array", true, true, false, 77) &&  !(null === (($__internal_compile_1 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 77)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[($context["name"] ?? null)] ?? null) : null)))) {
                // line 78
                echo "      ";
                $context["value"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("autoName", [0 => $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue((($__internal_compile_2 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 78)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[($context["name"] ?? null)] ?? null) : null)), 1 => ($context["name"] ?? null), 2 => (($context["withtemplate"] ?? null) == 2), 3 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 78), 4 => (($__internal_compile_3 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 78)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["entities_id"] ?? null) : null)]);
                // line 79
                echo "   ";
            } else {
                // line 80
                echo "      ";
                $context["value"] = null;
                // line 81
                echo "   ";
            }
            // line 82
            echo "   ";
            $context["label"] = twig_sprintf(__("%1\$s%2\$s"), ($context["label"] ?? null), ($context["tplmark"] ?? null));
            // line 83
            echo "
   ";
            // line 84
            echo twig_call_macro($macros["_self"], "macro_textField", [($context["name"] ?? null), ($context["value"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 84, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 88
    public function macro_textField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 89
            echo "   ";
            $context["options"] = twig_array_merge(["type" => "text"], ($context["options"] ?? null));
            // line 90
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 90), "isMandatoryField", [0 => ($context["name"] ?? null)], "method", false, false, false, 90)) {
                // line 91
                echo "      ";
                $context["options"] = twig_array_merge(["required" => true], ($context["options"] ?? null));
                // line 92
                echo "   ";
            }
            // line 93
            echo "
   ";
            // line 94
            ob_start(function () { return ''; });
            // line 95
            echo "      <input type=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "type", [], "any", false, false, false, 95), "html", null, true);
            echo "\" id=\"%id%\"
             class=\"form-control ";
            // line 96
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "input_addclass", [], "any", false, false, false, 96), "html", null, true);
            echo "\"
             name=\"";
            // line 97
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue(($context["value"] ?? null)), "html", null, true);
            echo "\"
             ";
            // line 98
            ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "maxlength", [], "any", false, false, false, 98)) ? (print (twig_escape_filter($this->env, ("maxlength=" . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "maxlength", [], "any", false, false, false, 98)), "html", null, true))) : (print ("")));
            echo "
             ";
            // line 99
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 99)) ? ("readonly") : (""));
            echo "
             ";
            // line 100
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 100)) ? ("disabled") : (""));
            echo "
             ";
            // line 101
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "multiple", [], "any", false, false, false, 101)) ? ("multiple") : (""));
            echo " ";
            // line 102
            echo "             ";
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "required", [], "any", false, false, false, 102)) ? ("required") : (""));
            echo " />
   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 104
            echo "
   ";
            // line 105
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 105, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 109
    public function macro_checkboxField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 110
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 110), "isMandatoryField", [0 => ($context["name"] ?? null)], "method", false, false, false, 110)) {
                // line 111
                echo "      ";
                $context["options"] = twig_array_merge(["required" => true], ($context["options"] ?? null));
                // line 112
                echo "   ";
            }
            // line 113
            echo "
   ";
            // line 114
            $context["options"] = twig_array_merge(["center" => true],             // line 116
($context["options"] ?? null));
            // line 117
            echo "
   ";
            // line 118
            ob_start(function () { return ''; });
            // line 119
            echo "      <input type=\"hidden\"   name=\"";
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" value=\"0\" />
      <input type=\"checkbox\" name=\"";
            // line 120
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" value=\"1\" class=\"form-check-input\" id=\"%id%\"
             ";
            // line 121
            echo (((($context["value"] ?? null) == 1)) ? ("checked") : (""));
            echo "
             ";
            // line 122
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 122)) ? ("readonly") : (""));
            echo "
             ";
            // line 123
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "required", [], "any", false, false, false, 123)) ? ("required") : (""));
            echo "
             ";
            // line 124
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 124)) ? ("disabled") : (""));
            echo " />
   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 126
            echo "
   ";
            // line 127
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 127, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 131
    public function macro_sliderField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 132
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 132), "isMandatoryField", [0 => ($context["name"] ?? null)], "method", false, false, false, 132)) {
                // line 133
                echo "      ";
                $context["options"] = twig_array_merge(["required" => true],                 // line 135
($context["options"] ?? null));
                // line 136
                echo "   ";
            }
            // line 137
            echo "   ";
            $context["options"] = twig_array_merge(["no_value" => 0, "yes_value" => 1],             // line 140
($context["options"] ?? null));
            // line 141
            echo "
   ";
            // line 142
            ob_start(function () { return ''; });
            // line 143
            echo "      <label class=\"form-check form-switch pt-2\">
         <input type=\"hidden\"   name=\"";
            // line 144
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "no_value", [], "any", false, false, false, 144), "html", null, true);
            echo "\" />
         <input type=\"checkbox\" name=\"";
            // line 145
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "yes_value", [], "any", false, false, false, 145), "html", null, true);
            echo "\" class=\"form-check-input\" id=\"%id%\"
                ";
            // line 146
            echo (((($context["value"] ?? null) == 1)) ? ("checked") : (""));
            echo "
                ";
            // line 147
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 147)) ? ("readonly") : (""));
            echo "
                ";
            // line 148
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "required", [], "any", false, false, false, 148)) ? ("required") : (""));
            echo "
                ";
            // line 149
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 149)) ? ("disabled") : (""));
            echo " />
         ";
            // line 150
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "label2", [], "any", false, false, false, 150)) {
                // line 151
                echo "            <span class=\"form-check-label\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "label2", [], "any", false, false, false, 151), "html", null, true);
                echo "</span>
         ";
            }
            // line 153
            echo "      </label>
   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 155
            echo "
   ";
            // line 156
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 156, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 160
    public function macro_numberField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 161
            echo "   ";
            if (((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "step", [], "any", false, false, false, 161) != "any") && (twig_round(twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "step", [], "any", false, false, false, 161), 0, "floor") != twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "step", [], "any", false, false, false, 161)))) {
                // line 162
                echo "      ";
                // line 163
                echo "      ";
                $context["value"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::formatNumber", [0 => ($context["value"] ?? null), 1 => true]);
                // line 164
                echo "   ";
            }
            // line 165
            echo "
   ";
            // line 166
            if ((($context["value"] ?? null) == "")) {
                // line 167
                echo "      ";
                $context["value"] = ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "min", [], "any", true, true, false, 167)) ? (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "min", [], "any", false, false, false, 167)) : (0));
                // line 168
                echo "   ";
            }
            // line 169
            echo "
   ";
            // line 170
            ob_start(function () { return ''; });
            // line 171
            echo "      <input type=\"number\" id=\"%id%\"
             class=\"form-control ";
            // line 172
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "input_addclass", [], "any", false, false, false, 172), "html", null, true);
            echo "\"
             name=\"";
            // line 173
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, ($context["value"] ?? null), "html", null, true);
            echo "\"
         ";
            // line 174
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 174)) ? ("readonly") : (""));
            echo "
         ";
            // line 175
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 175)) ? ("disabled") : (""));
            echo "
         ";
            // line 176
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "required", [], "any", false, false, false, 176)) ? ("required") : (""));
            echo "
         ";
            // line 177
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "min", [], "any", true, true, false, 177)) {
                echo "min=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "min", [], "any", false, false, false, 177), "html", null, true);
                echo "\"";
            }
            // line 178
            echo "         ";
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "max", [], "any", true, true, false, 178)) {
                echo "max=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "max", [], "any", false, false, false, 178), "html", null, true);
                echo "\"";
            }
            // line 179
            echo "         ";
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "step", [], "any", true, true, false, 179)) {
                echo "step=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "step", [], "any", false, false, false, 179), "html", null, true);
                echo "\"";
            }
            echo " />
   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 181
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 181, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 185
    public function macro_readOnlyField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 186
            echo "   ";
            $context["options"] = twig_array_merge(($context["options"] ?? null), ["readonly" => true]);
            // line 187
            echo "   ";
            ob_start(function () { return ''; });
            // line 188
            echo "      <span class=\"form-control ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "input_addclass", [], "any", false, false, false, 188), "html", null, true);
            echo "\" readonly>
         ";
            // line 189
            if ((twig_length_filter($this->env, ($context["value"] ?? null)) == 0)) {
                // line 190
                echo "            &nbsp;
         ";
            } else {
                // line 192
                echo "            ";
                echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue(($context["value"] ?? null)), "html", null, true);
                echo "
         ";
            }
            // line 194
            echo "      </span>
   ";
            $context["value"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 196
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["value"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 196, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 200
    public function macro_textareaField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 201
            echo "   ";
            $context["options"] = twig_array_merge(["rand" => twig_random($this->env), "enable_richtext" => false, "enable_images" => true, "enable_fileupload" => false, "enable_mentions" => false, "entities_id" => $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactive_entity"), "uploads" => []],             // line 209
($context["options"] ?? null));
            // line 210
            echo "
   ";
            // line 211
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 211), "isMandatoryField", [0 => ($context["name"] ?? null)], "method", false, false, false, 211)) {
                // line 212
                echo "      ";
                $context["options"] = twig_array_merge(["required" => true], ($context["options"] ?? null));
                // line 213
                echo "   ";
            }
            // line 214
            echo "   ";
            $context["id"] = (((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 214)) > 0)) ? (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 214)) : (((($context["name"] ?? null) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 214))));
            // line 215
            echo "
   ";
            // line 216
            ob_start(function () { return ''; });
            // line 217
            echo "      ";
            // line 218
            echo "      <textarea class=\"form-control ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "input_addclass", [], "any", false, false, false, 218), "html", null, true);
            echo "\" id=\"";
            echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
            echo "\" name=\"";
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" rows=\"3\"
                style=\"width: 100%;\"
                ";
            // line 220
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 220)) ? ("disabled") : (""));
            echo "
                ";
            // line 221
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 221)) ? ("readonly") : (""));
            echo "
                ";
            // line 222
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "required", [], "any", false, false, false, 222)) ? ("required") : (""));
            echo ">";
            ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "enable_richtext", [], "any", false, false, false, 222)) ? (print (twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getSafeHtml(($context["value"] ?? null))))) : (print (twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue(($context["value"] ?? null)), "html", null, true))));
            echo "</textarea>
   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 224
            echo "
   ";
            // line 225
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "enable_richtext", [], "any", false, false, false, 225)) {
                // line 226
                echo "      ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::initEditorSystem", [0 =>                 // line 227
($context["id"] ?? null), 1 => twig_get_attribute($this->env, $this->source,                 // line 228
($context["options"] ?? null), "rand", [], "any", false, false, false, 228), 2 => true, 3 => ((twig_get_attribute($this->env, $this->source,                 // line 230
($context["options"] ?? null), "disabled", [], "any", true, true, false, 230)) ? (_twig_default_filter(twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 230), false)) : (false)), 4 => twig_get_attribute($this->env, $this->source,                 // line 231
($context["options"] ?? null), "enable_images", [], "any", false, false, false, 231)]);
                // line 233
                echo "   ";
            }
            // line 234
            echo "
   ";
            // line 235
            $context["add_html"] = "";
            // line 236
            echo "   ";
            if (( !twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 236) && twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "enable_fileupload", [], "any", false, false, false, 236))) {
                // line 237
                echo "      ";
                ob_start(function () { return ''; });
                // line 238
                echo "         ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::file", [0 => ["editor_id" =>                 // line 239
($context["id"] ?? null), "multiple" => true, "uploads" => twig_get_attribute($this->env, $this->source,                 // line 241
($context["options"] ?? null), "uploads", [], "any", false, false, false, 241), "required" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,                 // line 242
($context["options"] ?? null), "fields_template", [], "any", false, false, false, 242), "isMandatoryField", [0 => "_documents_id"], "method", false, false, false, 242)]]);
                // line 244
                echo "      ";
                $context["add_html"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 245
                echo "   ";
            } elseif (((( !twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 245) &&  !twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "enable_fileupload", [], "any", false, false, false, 245)) && twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "enable_richtext", [], "any", false, false, false, 245)) && twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "enable_images", [], "any", false, false, false, 245))) {
                // line 246
                echo "      ";
                ob_start(function () { return ''; });
                // line 247
                echo "         ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::file", [0 => ["editor_id" =>                 // line 248
($context["id"] ?? null), "name" =>                 // line 249
($context["name"] ?? null), "only_uploaded_files" => true, "uploads" => twig_get_attribute($this->env, $this->source,                 // line 251
($context["options"] ?? null), "uploads", [], "any", false, false, false, 251), "required" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,                 // line 252
($context["options"] ?? null), "fields_template", [], "any", false, false, false, 252), "isMandatoryField", [0 => "_documents_id"], "method", false, false, false, 252)]]);
                // line 254
                echo "      ";
                $context["add_html"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 255
                echo "   ";
            }
            // line 256
            echo "
   ";
            // line 257
            if ((($context["add_html"] ?? null) != "")) {
                // line 258
                echo "      ";
                if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "add_field_html", [], "any", true, true, false, 258)) {
                    // line 259
                    echo "         ";
                    $context["add_html"] = (($context["add_html"] ?? null) . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "add_field_html", [], "any", false, false, false, 259));
                    // line 260
                    echo "      ";
                }
                // line 261
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["add_field_html" => ($context["add_html"] ?? null)]);
                // line 262
                echo "   ";
            }
            // line 263
            echo "
   ";
            // line 264
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 264, $context, $this->getSourceContext());
            echo "
   ";
            // line 265
            if ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "enable_mentions", [], "any", false, false, false, 265) && $this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("use_notifications"))) {
                // line 266
                echo "      <script>
         \$(
            function() {
               const user_mention = new GLPI.RichText.UserMention(
                  tinymce.get('";
                // line 270
                echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
                echo "'),
                  ";
                // line 271
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "entities_id", [], "any", false, false, false, 271), "html", null, true);
                echo ",
                  '";
                // line 272
                echo twig_escape_filter($this->env, Session::getNewIDORToken("User", ["right" => "all", "entity_restrict" => twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "entities_id", [], "any", false, false, false, 272)]), "html", null, true);
                echo "'
               );
               user_mention.register();
            }
         )
      </script>
   ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 281
    public function macro_flatpickrHtmlInput($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 282
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 282), "isMandatoryField", [0 => ($context["name"] ?? null)], "method", false, false, false, 282)) {
                // line 283
                echo "      ";
                $context["options"] = twig_array_merge(["required" => true], ($context["options"] ?? null));
                // line 284
                echo "   ";
            }
            // line 285
            echo "
   ";
            // line 286
            if ((($context["value"] ?? null) == "NULL")) {
                // line 287
                echo "      ";
                $context["value"] = null;
                // line 288
                echo "   ";
            }
            // line 289
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "checkIsExpired", [], "any", false, false, false, 289)) {
                // line 290
                echo "      ";
                if ((twig_date_format_filter($this->env, ($context["value"] ?? null), "Y-m-d H:i:s") < twig_date_format_filter($this->env, "now", "Y-m-d H:i:s"))) {
                    // line 291
                    echo "         ";
                    $context["class"] = "warn";
                    // line 292
                    echo "      ";
                }
                // line 293
                echo "   ";
            } else {
                // line 294
                echo "      ";
                if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "expiration_class", [], "any", true, true, false, 294)) {
                    // line 295
                    echo "         ";
                    $context["class"] = twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "expiration_class", [], "any", false, false, false, 295);
                    // line 296
                    echo "      ";
                } else {
                    // line 297
                    echo "         ";
                    $context["class"] = "";
                    // line 298
                    echo "      ";
                }
                // line 299
                echo "   ";
            }
            // line 300
            echo "
   <div class=\"input-group flex-grow-1 flatpickr\" id=\"";
            // line 301
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 301), "html", null, true);
            echo "\">
      ";
            // line 303
            echo "      ";
            // line 304
            echo "      <input type=\"text\" class=\"form-control rounded-start ps-2 ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "input_addclass", [], "any", false, false, false, 304), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
            echo "\" data-input
             name=\"";
            // line 305
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue(($context["value"] ?? null)), "html", null, true);
            echo "\"
             ";
            // line 306
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "required", [], "any", false, false, false, 306)) ? ("required") : (""));
            echo "
             ";
            // line 307
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 307)) ? ("readonly") : (""));
            echo "
             ";
            // line 308
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 308)) ? ("disabled") : (""));
            echo " />
      ";
            // line 309
            if ( !twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 309)) {
                // line 310
                echo "         <i class=\"input-group-text far fa-calendar-alt\" data-toggle role=\"button\"></i>
      ";
            }
            // line 312
            echo "   </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 315
    public function macro_dateField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 316
            echo "   ";
            $context["options"] = twig_array_merge(["rand" => twig_random($this->env)], ($context["options"] ?? null));
            // line 317
            echo "   ";
            $context["options"] = twig_array_merge(["id" => (($this->extensions['Twig\Extra\String\StringExtension']->createSlug(($context["name"] ?? null)) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 317))], ($context["options"] ?? null));
            // line 318
            echo "   ";
            $context["locale"] = $this->extensions['Glpi\Application\View\Extension\I18nExtension']->getCurrentLocale();
            // line 319
            echo "
   ";
            // line 320
            ob_start(function () { return ''; });
            // line 321
            echo "      ";
            echo twig_call_macro($macros["_self"], "macro_flatpickrHtmlInput", [($context["name"] ?? null), ($context["value"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 321, $context, $this->getSourceContext());
            echo "
      <script>
      \$(function() {
         \$(\"#";
            // line 324
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 324), "html", null, true);
            echo "\").flatpickr({
            wrap: true,
            altInput: true,
            altFormat: '";
            // line 327
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Toolbox::getDateFormat", [0 => "js"]), "html", null, true);
            echo "',
            dateFormat: 'Y-m-d',
            enableTime: false,
            weekNumbers: true,
            time_24hr: true,
            allowInput: ";
            // line 332
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 332)) ? ("false") : ("true"));
            echo ",
            clickOpens: ";
            // line 333
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 333)) ? ("false") : ("true"));
            echo ",
            locale: getFlatPickerLocale(\"";
            // line 334
            echo twig_escape_filter($this->env, (($__internal_compile_4 = ($context["locale"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["language"] ?? null) : null), "html", null, true);
            echo "\", \"";
            echo twig_escape_filter($this->env, (($__internal_compile_5 = ($context["locale"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["region"] ?? null) : null), "html", null, true);
            echo "\"),
            onClose(dates, currentdatestring, picker) {
               picker.setDate(picker.altInput.value, true, picker.config.altFormat)
            },
            plugins: [
               CustomFlatpickrButtons()
            ]
         });
      });
      </script>
   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 345
            echo "
   ";
            // line 346
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 346, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 349
    public function macro_datetimeField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 350
            echo "   ";
            $context["options"] = twig_array_merge(["rand" => twig_random($this->env)], ($context["options"] ?? null));
            // line 351
            echo "   ";
            $context["options"] = twig_array_merge(["id" => (($this->extensions['Twig\Extra\String\StringExtension']->createSlug(($context["name"] ?? null)) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 351))], ($context["options"] ?? null));
            // line 352
            echo "   ";
            $context["locale"] = $this->extensions['Glpi\Application\View\Extension\I18nExtension']->getCurrentLocale();
            // line 353
            echo "
   ";
            // line 354
            ob_start(function () { return ''; });
            // line 355
            echo "      ";
            echo twig_call_macro($macros["_self"], "macro_flatpickrHtmlInput", [($context["name"] ?? null), ($context["value"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 355, $context, $this->getSourceContext());
            echo "
      <script>
      \$(function() {
         \$('#";
            // line 358
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 358), "html", null, true);
            echo "').flatpickr({
            altInput: true,
            dateFormat: 'Y-m-d H:i:S',
            altFormat: '";
            // line 361
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Toolbox::getDateFormat", [0 => "js"]), "html", null, true);
            echo " H:i:S',
            enableTime: true,
            wrap: true,
            enableSeconds: true,
            weekNumbers: true,
            time_24hr: true,
            allowInput: ";
            // line 367
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 367)) ? ("false") : ("true"));
            echo ",
            clickOpens: ";
            // line 368
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 368)) ? ("false") : ("true"));
            echo ",
            locale: getFlatPickerLocale('";
            // line 369
            echo twig_escape_filter($this->env, (($__internal_compile_6 = ($context["locale"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["language"] ?? null) : null), "html", null, true);
            echo "', '";
            echo twig_escape_filter($this->env, (($__internal_compile_7 = ($context["locale"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["region"] ?? null) : null), "html", null, true);
            echo "'),
            onClose(dates, currentdatestring, picker) {
               picker.setDate(picker.altInput.value, true, picker.config.altFormat)
            },
            plugins: [
               CustomFlatpickrButtons()
            ]
         });
      });
      </script>
   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 380
            echo "
   ";
            // line 381
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 381, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 384
    public function macro_colorField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 385
            echo "   ";
            ob_start(function () { return ''; });
            // line 386
            echo "      <input id=\"%id%\"
             class=\"form-control ";
            // line 387
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "input_addclass", [], "any", false, false, false, 387), "html", null, true);
            echo "\"
             name=\"";
            // line 388
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue(($context["value"] ?? null)), "html", null, true);
            echo "\"
         ";
            // line 389
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 389)) ? ("readonly") : (""));
            echo "
         ";
            // line 390
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 390)) ? ("disabled") : (""));
            echo "
         ";
            // line 391
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "required", [], "any", false, false, false, 391)) ? ("required") : (""));
            echo " />
      <script>
      \$(function() {
        \$(\"#%id%\").spectrum({
            showInput: true,
            preferredFormat: \"hex\",
            type: \"text\",
            change: function(color) {
                if (color !== null && color.getAlpha() !== 1) {
                    let hex = color.toHexString();
                    hex += (\"0\" + Math.round(parseFloat(color.getAlpha()) * 255).toString(16)).slice(-2);
                    this.value = hex;
                }
            }
        });
      });
      </script>
   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 409
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 409, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 412
    public function macro_passwordField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 413
            echo "   ";
            $context["options"] = twig_array_merge(["autocomplete" => "new-password", "is_disclosable" => false, "rand" => (((twig_get_attribute($this->env, $this->source,             // line 416
($context["options"] ?? null), "rand", [], "any", true, true, false, 416) &&  !(null === twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 416)))) ? (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 416)) : (twig_random($this->env)))],             // line 417
($context["options"] ?? null));
            // line 418
            echo "   ";
            $context["options"] = twig_array_merge(["id" => ((twig_get_attribute($this->env, $this->source,             // line 419
($context["options"] ?? null), "id", [], "any", true, true, false, 419)) ? (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 419)) : ((($context["name"] ?? null) . twig_random($this->env)))), "clearable" => ((twig_get_attribute($this->env, $this->source,             // line 420
($context["options"] ?? null), "clearable", [], "any", true, true, false, 420)) ? (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "clearable", [], "any", false, false, false, 420)) : ( !twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "is_disclosable", [], "any", false, false, false, 420)))],             // line 421
($context["options"] ?? null));
            // line 422
            echo "
   ";
            // line 423
            ob_start(function () { return ''; });
            // line 424
            echo "      <input type=\"password\" id=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 424), "html", null, true);
            echo "\"
             class=\"form-control ";
            // line 425
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "input_addclass", [], "any", false, false, false, 425), "html", null, true);
            echo "\"
             name=\"";
            // line 426
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\"
             value=\"";
            // line 427
            ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "is_disclosable", [], "any", false, false, false, 427)) ? (print (twig_escape_filter($this->env, ($context["value"] ?? null), "html", null, true))) : (print ("")));
            echo "\"
         ";
            // line 428
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 428)) ? ("readonly") : (""));
            echo "
         ";
            // line 429
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 429)) ? ("disabled") : (""));
            echo "
         ";
            // line 430
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "required", [], "any", false, false, false, 430)) ? ("required") : (""));
            echo " />
   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 432
            echo "   ";
            ob_start(function () { return ''; });
            // line 433
            echo "      &nbsp;<i class=\"far fa-eye pointer disclose\" onmousedown=\"showDisclosablePasswordField('";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 433), "html", null, true);
            echo "')\"
               onmouseup=\"hideDisclosablePasswordField('";
            // line 434
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 434), "html", null, true);
            echo "')\"
               onmouseout=\"hideDisclosablePasswordField('";
            // line 435
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 435), "html", null, true);
            echo "')\"></i>
      &nbsp;<i class=\"fa fa-paste pointer disclose\" onclick=\"copyDisclosablePasswordFieldToClipboard('";
            // line 436
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 436), "html", null, true);
            echo "')\"></i>
   ";
            $context["btn_group"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 438
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "is_disclosable", [], "any", false, false, false, 438)) {
                // line 439
                echo "      ";
                $context["label"] = (($context["label"] ?? null) . ($context["btn_group"] ?? null));
                // line 440
                echo "   ";
            }
            // line 441
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "clearable", [], "any", false, false, false, 441)) {
                // line 442
                echo "      ";
                ob_start(function () { return ''; });
                // line 443
                echo "         <input type=\"checkbox\" name=\"_blank_";
                echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
                echo "\" id=\"_blank_";
                echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
                echo "\">&nbsp;<label for=\"_blank_";
                echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, __("Clear"), "html", null, true);
                echo "</label>
      ";
                $context["clear_chk"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 445
                echo "      ";
                $context["field"] = (($context["field"] ?? null) . ($context["clear_chk"] ?? null));
                // line 446
                echo "   ";
            }
            // line 447
            echo "
   ";
            // line 448
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 448, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 451
    public function macro_emailField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 452
            echo "   ";
            $context["options"] = twig_array_merge(["type" => "email"], ($context["options"] ?? null));
            // line 453
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_textField", [($context["name"] ?? null), ($context["value"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 453, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 456
    public function macro_fileField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 457
            echo "   ";
            $context["options"] = twig_array_merge(["rand" => twig_random($this->env), "name" =>             // line 459
($context["name"] ?? null), "simple" => false],             // line 461
($context["options"] ?? null));
            // line 462
            echo "   ";
            ob_start(function () { return ''; });
            // line 463
            echo "      ";
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "simple", [], "any", false, false, false, 463)) {
                // line 464
                echo "        <input type=\"file\" id=\"%id%\"
               class=\"form-control ";
                // line 465
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "input_addclass", [], "any", false, false, false, 465), "html", null, true);
                echo "\"
               name=\"";
                // line 466
                echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
                echo "\"
               ";
                // line 467
                echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "multiple", [], "any", false, false, false, 467)) ? ("multiple") : (""));
                echo "
               ";
                // line 468
                echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 468)) ? ("readonly") : (""));
                echo "
               ";
                // line 469
                echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 469)) ? ("disabled") : (""));
                echo "
               ";
                // line 470
                echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "required", [], "any", false, false, false, 470)) ? ("required") : (""));
                echo " />
      ";
            } else {
                // line 472
                echo "        ";
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::file", [0 => ($context["options"] ?? null)]);
                // line 473
                echo "      ";
            }
            // line 474
            echo "   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 475
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 475, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 478
    public function macro_imageField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], $__link_options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "link_options" => $__link_options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 479
            echo "   ";
            ob_start(function () { return ''; });
            // line 480
            echo "      <div class=\"img-overlay-wrapper position-relative\">
         ";
            // line 481
            $context["clearable"] = (($__internal_compile_8 = ($context["options"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["clearable"] ?? null) : null);
            // line 482
            echo "         ";
            $context["url"] = (((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "url", [], "array", true, true, false, 482) &&  !(null === (($__internal_compile_9 = ($context["options"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["url"] ?? null) : null)))) ? ((($__internal_compile_10 = ($context["options"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["url"] ?? null) : null)) : (null));
            // line 483
            echo "         ";
            $context["options"] = twig_array_filter($this->env, ($context["options"] ?? null), function ($__v__, $__k__) use ($context, $macros) { $context["v"] = $__v__; $context["k"] = $__k__; return ((($context["k"] ?? null) != "url") && (($context["k"] ?? null) != "clearable")); });
            // line 484
            echo "         ";
            if ( !twig_test_empty(($context["url"] ?? null))) {
                // line 485
                echo "            <a href=\"";
                echo twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
                echo "\" ";
                echo $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::parseAttributes", [0 => ($context["link_options"] ?? null)]);
                echo ">
         ";
            }
            // line 487
            echo "               <img src=\"";
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue(($context["value"] ?? null)), "html", null, true);
            echo "\" ";
            echo $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::parseAttributes", [0 => ($context["options"] ?? null)]);
            echo " />
         ";
            // line 488
            if ( !twig_test_empty(($context["url"] ?? null))) {
                // line 489
                echo "            </a>
         ";
            }
            // line 491
            echo "         ";
            if (($context["clearable"] ?? null)) {
                // line 492
                echo "            <input type=\"hidden\" name=\"_blank_";
                echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
                echo "\" />
            <button type=\"button\" class=\"btn p-2 position-absolute top-0 start-0\" title=\"";
                // line 493
                echo twig_escape_filter($this->env, __("Delete"), "html", null, true);
                echo "\"
                    onclick=\"const blank_input = \$('input[name=\\'_blank_";
                // line 494
                echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
                echo "\\']'); blank_input.val(blank_input.val() ? '' : true); \$(this).toggleClass('btn-danger')\">
               <i class=\"ti ti-x\"></i>
            </button>
         ";
            }
            // line 498
            echo "      </div>
   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 500
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 500, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 503
    public function macro_imageGalleryField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 504
            echo "   ";
            ob_start(function () { return ''; });
            // line 505
            echo "      <div class=\"picture_gallery d-flex flex-wrap overflow-auto p-3\">
         ";
            // line 506
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["value"] ?? null));
            foreach ($context['_seq'] as $context["i"] => $context["picture"]) {
                // line 507
                echo "            <div style=\"position: relative; width: fit-content\">
               ";
                // line 508
                echo twig_call_macro($macros["_self"], "macro_imageField", [((($context["name"] ?? null) . "_") . $context["i"]), $context["picture"], "", ["style" => "max-width: 300px; max-height: 150px", "class" => "picture_square", "clearable" => (($__internal_compile_11 =                 // line 511
($context["options"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["clearable"] ?? null) : null), "no_label" => true]], 508, $context, $this->getSourceContext());
                // line 513
                echo "
            </div>
         ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['i'], $context['picture'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 516
            echo "      </div>
      ";
            // line 517
            echo twig_call_macro($macros["_self"], "macro_fileField", [($context["name"] ?? null), null, "", ["onlyimages" => true, "multiple" => true]], 517, $context, $this->getSourceContext());
            // line 520
            echo "
   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 522
            echo "
   ";
            // line 523
            $context["id"] = (((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 523)) > 0)) ? (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 523)) : (((($context["name"] ?? null) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 523))));
            // line 524
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_label", [($context["label"] ?? null), ($context["id"] ?? null), ($context["options"] ?? null)], 524, $context, $this->getSourceContext());
            echo "
   ";
            // line 525
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), twig_array_merge(($context["options"] ?? null), ["full_width" => true, "no_label" => true])], 525, $context, $this->getSourceContext());
            // line 528
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 531
    public function macro_hiddenField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 532
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "no_label", [], "any", false, false, false, 532)) {
                // line 533
                echo "      ";
                $context["options"] = twig_array_merge(["mb" => "mb-0"],                 // line 535
($context["options"] ?? null));
                // line 536
                echo "   ";
            }
            // line 537
            echo "   ";
            ob_start(function () { return ''; });
            // line 538
            echo "      <input type=\"hidden\" id=\"%id%\"
             class=\"form-control ";
            // line 539
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "input_addclass", [], "any", false, false, false, 539), "html", null, true);
            echo "\"
             name=\"";
            // line 540
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue(($context["value"] ?? null)), "html", null, true);
            echo "\"
         ";
            // line 541
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "readonly", [], "any", false, false, false, 541)) ? ("readonly") : (""));
            echo "
         ";
            // line 542
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 542)) ? ("disabled") : (""));
            echo "
         ";
            // line 543
            echo ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "required", [], "any", false, false, false, 543)) ? ("required") : (""));
            echo " />
   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 545
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 545, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 548
    public function macro_dropdownNumberField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 549
            echo "    ";
            $context["options"] = twig_array_merge(["rand" => twig_random($this->env), "width" => "100%"],             // line 552
($context["options"] ?? null));
            // line 553
            echo "
   ";
            // line 554
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 554)) {
                // line 555
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 556
                echo "   ";
            }
            // line 557
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 557), "isMandatoryField", [0 => ($context["name"] ?? null)], "method", false, false, false, 557)) {
                // line 558
                echo "      ";
                $context["options"] = twig_array_merge(["specific_tags" => ["required" => true]], ($context["options"] ?? null));
                // line 559
                echo "   ";
            }
            // line 560
            echo "
   ";
            // line 561
            ob_start(function () { return ''; });
            // line 562
            echo "      ";
            $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Dropdown::showNumber", [0 => ($context["name"] ?? null), 1 => twig_array_merge(["value" =>             // line 563
($context["value"] ?? null), "rand" =>             // line 564
($context["rand"] ?? null)],             // line 565
($context["options"] ?? null))]);
            // line 566
            echo "   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 567
            echo "
   ";
            // line 568
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), twig_array_merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 568))])], 568, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 571
    public function macro_dropdownArrayField($__name__ = null, $__value__ = null, $__elements__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "elements" => $__elements__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 572
            echo "    ";
            $context["options"] = twig_array_merge(["rand" => twig_random($this->env), "width" => "100%"],             // line 575
($context["options"] ?? null));
            // line 576
            echo "
   ";
            // line 577
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 577)) {
                // line 578
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 579
                echo "   ";
            }
            // line 580
            echo "
   ";
            // line 581
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 581), "isMandatoryField", [0 => ($context["name"] ?? null)], "method", false, false, false, 581)) {
                // line 582
                echo "      ";
                $context["options"] = twig_array_merge(["required" => true], ($context["options"] ?? null));
                // line 583
                echo "   ";
            }
            // line 584
            echo "
   ";
            // line 585
            ob_start(function () { return ''; });
            // line 586
            echo "      ";
            $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Dropdown::showFromArray", [0 => ($context["name"] ?? null), 1 => ($context["elements"] ?? null), 2 => twig_array_merge(["value" => $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue(            // line 587
($context["value"] ?? null)), "rand" =>             // line 588
($context["rand"] ?? null)],             // line 589
($context["options"] ?? null))]);
            // line 590
            echo "   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 591
            echo "
   ";
            // line 592
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), twig_array_merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 592))])], 592, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 595
    public function macro_dropdownTimestampField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 596
            echo "    ";
            $context["options"] = twig_array_merge(["rand" => twig_random($this->env), "width" => "100%"],             // line 599
($context["options"] ?? null));
            // line 600
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 600), "isMandatoryField", [0 => ($context["name"] ?? null)], "method", false, false, false, 600)) {
                // line 601
                echo "      ";
                $context["options"] = twig_array_merge(["required" => true], ($context["options"] ?? null));
                // line 602
                echo "   ";
            }
            // line 603
            echo "
   ";
            // line 604
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 604)) {
                // line 605
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 606
                echo "   ";
            }
            // line 607
            echo "
   ";
            // line 608
            ob_start(function () { return ''; });
            // line 609
            echo "      ";
            $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Dropdown::showTimestamp", [0 => ($context["name"] ?? null), 1 => twig_array_merge(["value" =>             // line 610
($context["value"] ?? null), "rand" =>             // line 611
($context["rand"] ?? null)],             // line 612
($context["options"] ?? null))]);
            // line 613
            echo "   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 614
            echo "
   ";
            // line 615
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), twig_array_merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 615))])], 615, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 618
    public function macro_dropdownYesNo($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 619
            echo "    ";
            $context["options"] = twig_array_merge(["rand" => twig_random($this->env), "width" => "100%"],             // line 622
($context["options"] ?? null));
            // line 623
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 623), "isMandatoryField", [0 => ($context["name"] ?? null)], "method", false, false, false, 623)) {
                // line 624
                echo "      ";
                $context["options"] = twig_array_merge(["required" => true], ($context["options"] ?? null));
                // line 625
                echo "   ";
            }
            // line 626
            echo "
   ";
            // line 627
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 627)) {
                // line 628
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 629
                echo "   ";
            }
            // line 630
            echo "
   ";
            // line 631
            ob_start(function () { return ''; });
            // line 632
            echo "      ";
            $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Dropdown::showYesNo", [0 => ($context["name"] ?? null), 1 => ($context["value"] ?? null), 2 =>  -1, 3 => twig_array_merge(["rand" =>             // line 633
($context["rand"] ?? null)],             // line 634
($context["options"] ?? null))]);
            // line 635
            echo "   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 636
            echo "
   ";
            // line 637
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), twig_array_merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 637))])], 637, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 640
    public function macro_dropdownItemTypes($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 641
            echo "    ";
            $context["options"] = twig_array_merge(["rand" => twig_random($this->env), "width" => "100%"],             // line 644
($context["options"] ?? null));
            // line 645
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 645), "isMandatoryField", [0 => ($context["name"] ?? null)], "method", false, false, false, 645)) {
                // line 646
                echo "      ";
                $context["options"] = twig_array_merge(["required" => true], ($context["options"] ?? null));
                // line 647
                echo "   ";
            }
            // line 648
            echo "
   ";
            // line 649
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 649)) {
                // line 650
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 651
                echo "   ";
            }
            // line 652
            echo "
   ";
            // line 653
            $context["types"] = ((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "types", [], "array", true, true, false, 653)) ? (_twig_default_filter((($__internal_compile_12 = ($context["options"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["types"] ?? null) : null), [])) : ([]));
            // line 654
            echo "
   ";
            // line 655
            ob_start(function () { return ''; });
            // line 656
            echo "      ";
            $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Dropdown::showItemTypes", [0 => ($context["name"] ?? null), 1 => ($context["types"] ?? null), 2 => twig_array_merge(["rand" =>             // line 657
($context["rand"] ?? null), "value" =>             // line 658
($context["value"] ?? null)],             // line 659
($context["options"] ?? null))]);
            // line 660
            echo "   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 661
            echo "
   ";
            // line 662
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), twig_array_merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 662))])], 662, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 665
    public function macro_dropdownItemsFromItemtypes($__name__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 666
            echo "   ";
            $context["options"] = twig_array_merge(["rand" => twig_random($this->env)],             // line 668
($context["options"] ?? null));
            // line 669
            echo "
   ";
            // line 670
            ob_start(function () { return ''; });
            // line 671
            echo "      ";
            $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Dropdown::showSelectItemFromItemtypes", [0 => ($context["options"] ?? null)]);
            // line 672
            echo "   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 673
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), twig_array_merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 673))])], 673, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 676
    public function macro_dropdownIcons($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 677
            echo "    ";
            $context["options"] = twig_array_merge(["rand" => twig_random($this->env), "width" => "100%"],             // line 680
($context["options"] ?? null));
            // line 681
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 681), "isMandatoryField", [0 => ($context["name"] ?? null)], "method", false, false, false, 681)) {
                // line 682
                echo "      ";
                $context["options"] = twig_array_merge(["required" => true], ($context["options"] ?? null));
                // line 683
                echo "   ";
            }
            // line 684
            echo "
   ";
            // line 685
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 685)) {
                // line 686
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 687
                echo "   ";
            }
            // line 688
            echo "
   ";
            // line 689
            ob_start(function () { return ''; });
            // line 690
            echo "      ";
            $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Dropdown::dropdownIcons", [0 => ($context["name"] ?? null), 1 => ($context["value"] ?? null), 2 => (twig_constant("GLPI_ROOT") . "/pics/icones"), 3 => twig_array_merge(["rand" =>             // line 691
($context["rand"] ?? null)],             // line 692
($context["options"] ?? null))]);
            // line 693
            echo "   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 694
            echo "
   ";
            // line 695
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), twig_array_merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 695))])], 695, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 698
    public function macro_dropdownHoursField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 699
            echo "    ";
            $context["options"] = twig_array_merge(["rand" => twig_random($this->env), "width" => "100%"],             // line 702
($context["options"] ?? null));
            // line 703
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 703), "isMandatoryField", [0 => ($context["name"] ?? null)], "method", false, false, false, 703)) {
                // line 704
                echo "      ";
                $context["options"] = twig_array_merge(["required" => true], ($context["options"] ?? null));
                // line 705
                echo "   ";
            }
            // line 706
            echo "
   ";
            // line 707
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 707)) {
                // line 708
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 709
                echo "   ";
            }
            // line 710
            echo "
   ";
            // line 711
            ob_start(function () { return ''; });
            // line 712
            echo "      ";
            $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Dropdown::showHours", [0 => ($context["name"] ?? null), 1 => twig_array_merge(["rand" =>             // line 713
($context["rand"] ?? null), "value" =>             // line 714
($context["value"] ?? null)],             // line 715
($context["options"] ?? null))]);
            // line 716
            echo "   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 717
            echo "
   ";
            // line 718
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), twig_array_merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 718))])], 718, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 721
    public function macro_dropdownField($__itemtype__ = null, $__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "itemtype" => $__itemtype__,
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 722
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "multiple", [], "any", false, false, false, 722)) {
                // line 723
                echo "      ";
                // line 724
                echo "      ";
                $context["defined_input_name"] = (("_" . ($context["name"] ?? null)) . "_defined");
                // line 725
                echo "      <input type=\"hidden\" name=\"";
                echo twig_escape_filter($this->env, ($context["defined_input_name"] ?? null), "html", null, true);
                echo "\" value=\"1\"></input>

      ";
                // line 728
                echo "      ";
                $context["name"] = (($context["name"] ?? null) . "[]");
                // line 729
                echo "   ";
            }
            // line 730
            echo "    ";
            $context["options"] = twig_array_merge(["rand" => twig_random($this->env), "width" => "100%"],             // line 733
($context["options"] ?? null));
            // line 734
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 734), "isMandatoryField", [0 => ($context["name"] ?? null)], "method", false, false, false, 734)) {
                // line 735
                echo "      ";
                $context["options"] = twig_array_merge(["specific_tags" => ["required" => true]], ($context["options"] ?? null));
                // line 736
                echo "   ";
            }
            // line 737
            echo "
   ";
            // line 738
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "disabled", [], "any", false, false, false, 738)) {
                // line 739
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["specific_tags" => ["disabled" => "disabled"]]);
                // line 740
                echo "   ";
            }
            // line 741
            echo "
   ";
            // line 742
            ob_start(function () { return ''; });
            // line 743
            echo "      ";
            echo $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeDropdown(($context["itemtype"] ?? null), twig_array_merge(["name" =>             // line 744
($context["name"] ?? null), "value" =>             // line 745
($context["value"] ?? null), "rand" =>             // line 746
($context["rand"] ?? null)],             // line 747
($context["options"] ?? null)));
            echo "
   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 749
            echo "
   ";
            // line 750
            if ( !twig_test_empty(twig_trim_filter(($context["field"] ?? null)))) {
                // line 751
                echo "      ";
                echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), twig_array_merge(($context["options"] ?? null), ["id" => ((("dropdown_" . ($context["name"] ?? null)) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 751))])], 751, $context, $this->getSourceContext());
                echo "
   ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 755
    public function macro_htmlField($__name__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 756
            echo "   ";
            if ((twig_length_filter($this->env, ($context["value"] ?? null)) == 0)) {
                // line 757
                echo "      ";
                $context["value"] = "&nbsp;";
                // line 758
                echo "   ";
            }
            // line 759
            echo "
   ";
            // line 760
            ob_start(function () { return ''; });
            // line 761
            echo "      <span class=\"form-control-plaintext\">";
            echo ($context["value"] ?? null);
            echo "</span>
   ";
            $context["value"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 763
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_field", [($context["name"] ?? null), ($context["value"] ?? null), ($context["label"] ?? null), ($context["options"] ?? null)], 763, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 766
    public function macro_field($__name__ = null, $__field__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "name" => $__name__,
            "field" => $__field__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 767
            echo "   ";
            $context["options"] = twig_array_merge(["rand" => twig_random($this->env), "is_horizontal" => true, "include_field" => true, "add_field_html" => "", "locked" => false, "locked_fields" => []],             // line 774
($context["options"] ?? null));
            // line 775
            echo "
   ";
            // line 776
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "locked_fields", [], "any", false, true, false, 776), ($context["name"] ?? null), [], "array", true, true, false, 776)) {
                // line 777
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["locked" => true, "locked_value" => (($__internal_compile_13 = twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "locked_fields", [], "any", false, false, false, 777)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13[($context["name"] ?? null)] ?? null) : null)]);
                // line 778
                echo "   ";
            } elseif (twig_in_filter(($context["name"] ?? null), twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "locked_fields", [], "any", false, false, false, 778))) {
                // line 779
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["locked" => true]);
                // line 780
                echo "   ";
            }
            // line 781
            echo "
   ";
            // line 782
            if ( !twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "include_field", [], "any", false, false, false, 782)) {
                // line 783
                echo "      ";
                echo twig_escape_filter($this->env, ($context["field"] ?? null), "html", null, true);
                echo "
   ";
            } else {
                // line 785
                echo "      ";
                $context["id"] = (((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 785)) > 0)) ? (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "id", [], "any", false, false, false, 785)) : (((($context["name"] ?? null) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 785))));
                // line 786
                echo "      ";
                $context["field"] = twig_replace_filter(($context["field"] ?? null), ["%id%" => ($context["id"] ?? null)]);
                // line 787
                echo "      ";
                $context["add_field_html"] = (((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "add_field_html", [], "any", false, false, false, 787)) > 0)) ? (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "add_field_html", [], "any", false, false, false, 787)) : (""));
                // line 788
                echo "
      ";
                // line 789
                if (( !twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", true, true, false, 789) ||  !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 789), "isHiddenField", [0 => ($context["name"] ?? null)], "method", false, false, false, 789))) {
                    // line 790
                    echo "         ";
                    if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "no_label", [], "any", false, false, false, 790)) {
                        // line 791
                        echo "            ";
                        echo twig_call_macro($macros["_self"], "macro_noLabelField", [($context["field"] ?? null), ($context["id"] ?? null), ($context["add_field_html"] ?? null), ($context["options"] ?? null)], 791, $context, $this->getSourceContext());
                        echo "
         ";
                    } elseif (twig_get_attribute($this->env, $this->source,                     // line 792
($context["options"] ?? null), "is_horizontal", [], "any", false, false, false, 792)) {
                        // line 793
                        echo "            ";
                        echo twig_call_macro($macros["_self"], "macro_horizontalField", [($context["label"] ?? null), ($context["field"] ?? null), ($context["id"] ?? null), ($context["add_field_html"] ?? null), twig_array_merge(($context["options"] ?? null), ["name" => ($context["name"] ?? null)])], 793, $context, $this->getSourceContext());
                        echo "
         ";
                    } else {
                        // line 795
                        echo "            ";
                        echo twig_call_macro($macros["_self"], "macro_verticalField", [($context["label"] ?? null), ($context["field"] ?? null), ($context["id"] ?? null), ($context["add_field_html"] ?? null), twig_array_merge(($context["options"] ?? null), ["name" => ($context["name"] ?? null)])], 795, $context, $this->getSourceContext());
                        echo "
         ";
                    }
                    // line 797
                    echo "      ";
                }
                // line 798
                echo "   ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 801
    public function macro_ajaxField($__id__ = null, $__value__ = null, $__label__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "id" => $__id__,
            "value" => $__value__,
            "label" => $__label__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 802
            echo "   ";
            ob_start(function () { return ''; });
            // line 803
            echo "      <div id=\"";
            echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
            echo "\" class=\"form-field-ajax\">
         ";
            // line 804
            if ( !(null === ($context["value"] ?? null))) {
                // line 805
                echo "            ";
                echo ($context["value"] ?? null);
                echo "
         ";
            }
            // line 807
            echo "      </div>
   ";
            $context["field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 809
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_field", [($context["id"] ?? null), ($context["field"] ?? null), ($context["label"] ?? null), twig_array_merge(($context["options"] ?? null), ["id" => ((($context["id"] ?? null) . "_") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "rand", [], "any", false, false, false, 809))])], 809, $context, $this->getSourceContext());
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 812
    public function macro_nullField($__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 813
            echo "   ";
            $context["options"] = twig_array_merge(["is_horizontal" => true], ($context["options"] ?? null));
            // line 814
            echo "
   ";
            // line 815
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "is_horizontal", [], "any", false, false, false, 815)) {
                // line 816
                echo "      ";
                echo twig_call_macro($macros["_self"], "macro_horizontalField", [($context["label"] ?? null), ($context["field"] ?? null), ($context["id"] ?? null), ($context["add_field_html"] ?? null), ($context["options"] ?? null)], 816, $context, $this->getSourceContext());
                echo "
   ";
            } else {
                // line 818
                echo "      ";
                echo twig_call_macro($macros["_self"], "macro_verticalField", [($context["label"] ?? null), ($context["field"] ?? null), ($context["id"] ?? null), ($context["add_field_html"] ?? null), ($context["options"] ?? null)], 818, $context, $this->getSourceContext());
                echo "
   ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 823
    public function macro_noLabelField($__field__ = null, $__id__ = "", $__add_field_html__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "field" => $__field__,
            "id" => $__id__,
            "add_field_html" => $__add_field_html__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 824
            echo "   ";
            $context["options"] = twig_array_merge(["full_width" => false, "mb" => "mb-3"],             // line 827
($context["options"] ?? null));
            // line 828
            echo "
   ";
            // line 829
            $context["class"] = (((twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "field_class", [], "any", true, true, false, 829) &&  !(null === twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "field_class", [], "any", false, false, false, 829)))) ? (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "field_class", [], "any", false, false, false, 829)) : ("col-12 col-sm-6"));
            // line 830
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "full_width", [], "any", false, false, false, 830)) {
                // line 831
                echo "      ";
                $context["class"] = "col-12";
                // line 832
                echo "   ";
            }
            // line 833
            echo "
   <div class=\"";
            // line 834
            echo twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "mb", [], "any", false, false, false, 834), "html", null, true);
            echo "\">
      ";
            // line 835
            echo ($context["field"] ?? null);
            echo "
      ";
            // line 836
            echo ($context["add_field_html"] ?? null);
            echo "
   </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 841
    public function macro_horizontalField($__label__ = null, $__field__ = null, $__id__ = null, $__add_field_html__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "label" => $__label__,
            "field" => $__field__,
            "id" => $__id__,
            "add_field_html" => $__add_field_html__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 842
            echo "   ";
            $context["options"] = twig_array_merge(["full_width" => false, "full_width_adapt_column" => true, "align_label_right" => true, "mb" => "mb-2", "field_class" => "col-12 col-sm-6", "label_class" => "col-xxl-5", "input_class" => "col-xxl-7", "add_field_class" => "", "add_field_attribs" => [], "center" => false],             // line 853
($context["options"] ?? null));
            // line 854
            echo "
   ";
            // line 855
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "full_width", [], "any", false, false, false, 855)) {
                // line 856
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["field_class" => "col-12"]);
                // line 859
                echo "
      ";
                // line 860
                if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "full_width_adapt_column", [], "any", false, false, false, 860)) {
                    // line 861
                    echo "         ";
                    $context["options"] = twig_array_merge(($context["options"] ?? null), ["label_class" => "col-xxl-4", "input_class" => "col-xxl-8"]);
                    // line 865
                    echo "      ";
                }
                // line 866
                echo "   ";
            }
            // line 867
            echo "
   ";
            // line 868
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "icon_label", [], "any", false, false, false, 868)) {
                // line 869
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["label_class" => "col-2", "input_class" => "col-10"]);
                // line 873
                echo "   ";
            }
            // line 874
            echo "
   ";
            // line 875
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "align_label_right", [], "any", false, false, false, 875)) {
                // line 876
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["label_class" => (twig_get_attribute($this->env, $this->source,                 // line 877
($context["options"] ?? null), "label_class", [], "any", false, false, false, 877) . " text-xxl-end")]);
                // line 879
                echo "   ";
            }
            // line 880
            echo "
   ";
            // line 881
            if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "add_field_attribs", [], "any", false, false, false, 881))) {
                // line 882
                echo "      ";
                $context["extra_attribs"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::parseAttributes", ["options" => twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "add_field_attribs", [], "any", false, false, false, 882)]);
                // line 883
                echo "   ";
            } else {
                // line 884
                echo "      ";
                $context["extra_attribs"] = "";
                // line 885
                echo "   ";
            }
            // line 886
            echo "
   <div class=\"form-field row ";
            // line 887
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "field_class", [], "any", false, false, false, 887), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "add_field_class", [], "any", false, false, false, 887), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "mb", [], "any", false, false, false, 887), "html", null, true);
            echo "\" ";
            echo ($context["extra_attribs"] ?? null);
            echo ">
      ";
            // line 888
            echo twig_call_macro($macros["_self"], "macro_label", [($context["label"] ?? null), ($context["id"] ?? null), ($context["options"] ?? null), ("col-form-label " . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "label_class", [], "any", false, false, false, 888))], 888, $context, $this->getSourceContext());
            echo "
      ";
            // line 889
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "center", [], "any", false, false, false, 889)) {
                // line 890
                echo "         ";
                $context["flex_class"] = "d-flex align-items-center";
                // line 891
                echo "      ";
            }
            // line 892
            echo "      <div class=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "input_class", [], "any", false, false, false, 892), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, ($context["flex_class"] ?? null), "html", null, true);
            echo " field-container\">
         ";
            // line 893
            echo ($context["field"] ?? null);
            echo "
         ";
            // line 894
            echo ($context["add_field_html"] ?? null);
            echo "
      </div>
   </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 900
    public function macro_verticalField($__label__ = null, $__field__ = null, $__id__ = null, $__add_field_html__ = "", $__options__ = [], ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "label" => $__label__,
            "field" => $__field__,
            "id" => $__id__,
            "add_field_html" => $__add_field_html__,
            "options" => $__options__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 901
            echo "   ";
            $context["options"] = twig_array_merge(["full_width" => false, "mb" => "mb-2", "field_class" => "col-12 col-sm-6", "add_field_class" => "", "add_field_attribs" => []],             // line 907
($context["options"] ?? null));
            // line 908
            echo "
   ";
            // line 909
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "full_width", [], "any", false, false, false, 909)) {
                // line 910
                echo "      ";
                $context["options"] = twig_array_merge(($context["options"] ?? null), ["field_class" => "col-12"]);
                // line 913
                echo "   ";
            }
            // line 914
            echo "
   ";
            // line 915
            if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "add_field_attribs", [], "any", false, false, false, 915))) {
                // line 916
                echo "      ";
                $context["extra_attribs"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::parseAttributes", ["options" => twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "add_field_attribs", [], "any", false, false, false, 916)]);
                // line 917
                echo "   ";
            } else {
                // line 918
                echo "      ";
                $context["extra_attribs"] = "";
                // line 919
                echo "   ";
            }
            // line 920
            echo "
   <div class=\"form-field ";
            // line 921
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "field_class", [], "any", false, false, false, 921), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "add_field_class", [], "any", false, false, false, 921), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "mb", [], "any", false, false, false, 921), "html", null, true);
            echo "\" ";
            echo ($context["extra_attribs"] ?? null);
            echo ">
      ";
            // line 922
            echo twig_call_macro($macros["_self"], "macro_label", [($context["label"] ?? null), ($context["id"] ?? null), ($context["options"] ?? null), ("col-form-label " . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "label_class", [], "any", false, false, false, 922))], 922, $context, $this->getSourceContext());
            echo "
      <div class=\"";
            // line 923
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "input_class", [], "any", false, false, false, 923), "html", null, true);
            echo " field-container\">
         ";
            // line 924
            echo ($context["field"] ?? null);
            echo "
      </div>
      ";
            // line 926
            echo ($context["add_field_html"] ?? null);
            echo "
   </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 931
    public function macro_label($__label__ = null, $__id__ = null, $__options__ = [], $__class__ = "form-label", ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "label" => $__label__,
            "id" => $__id__,
            "options" => $__options__,
            "class" => $__class__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 932
            echo "    ";
            $context["options"] = twig_array_merge(["locked" => false, "locked_value" => null],             // line 935
($context["options"] ?? null));
            // line 936
            echo "
   ";
            // line 937
            $context["required_mark"] = "";
            // line 938
            echo "   ";
            if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "fields_template", [], "any", false, false, false, 938), "isMandatoryField", [0 => twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "name", [], "any", false, false, false, 938)], "method", false, false, false, 938) || twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "required", [], "any", false, false, false, 938))) {
                // line 939
                echo "      ";
                $context["required_mark"] = "<span class=\"required\">*</span>";
                // line 940
                echo "   ";
            }
            // line 941
            echo "
   ";
            // line 942
            $context["helper"] = "";
            // line 943
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "helper", [], "any", false, false, false, 943)) {
                // line 944
                echo "      ";
                ob_start(function () { return ''; });
                // line 945
                echo "         <span class=\"form-help\" data-bs-toggle=\"popover\" data-bs-placement=\"top\" data-bs-html=\"true\"
               data-bs-content=\"";
                // line 946
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "helper", [], "any", false, false, false, 946), "html", null, true);
                echo "\">
            ?
         </span>
      ";
                $context["helper"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 950
                echo "   ";
            }
            // line 951
            echo "
   ";
            // line 952
            $context["locked_mark"] = "";
            // line 953
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "locked", [], "any", false, false, false, 953)) {
                // line 954
                echo "      ";
                ob_start(function () { return ''; });
                // line 955
                echo "        ";
                ob_start(function () { return ''; });
                echo twig_escape_filter($this->env, __("Field will not be updated from inventory"), "html", null, true);
                $context["locked_title"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 956
                echo "        ";
                if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "locked_value", [], "any", false, false, false, 956))) {
                    // line 957
                    echo "            ";
                    ob_start(function () { return ''; });
                    echo twig_escape_filter($this->env, ($context["locked_title"] ?? null), "html", null, true);
                    echo " - ";
                    echo twig_escape_filter($this->env, ((__("Last inventory value was:") . " ") . twig_get_attribute($this->env, $this->source, ($context["options"] ?? null), "locked_value", [], "any", false, false, false, 957)), "html", null, true);
                    $context["locked_title"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                    // line 958
                    echo "        ";
                }
                // line 959
                echo "        <i class=\"ti ti-lock\"
           title=\"";
                // line 960
                echo twig_escape_filter($this->env, ($context["locked_title"] ?? null), "html", null, true);
                echo "\"
           data-bs-toggle=\"tooltip\"></i>
      ";
                $context["locked_mark"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 963
                echo "   ";
            }
            // line 964
            echo "
   <label class=\"";
            // line 965
            echo twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
            echo "\" for=\"";
            echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
            echo "\">
      ";
            // line 966
            echo ($context["label"] ?? null);
            echo "
      ";
            // line 967
            echo ($context["locked_mark"] ?? null);
            echo "
      ";
            // line 968
            echo ($context["required_mark"] ?? null);
            echo "
      ";
            // line 969
            echo ($context["helper"] ?? null);
            echo "
   </label>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "components/form/fields_macros.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  3017 => 969,  3013 => 968,  3009 => 967,  3005 => 966,  2999 => 965,  2996 => 964,  2993 => 963,  2987 => 960,  2984 => 959,  2981 => 958,  2974 => 957,  2971 => 956,  2966 => 955,  2963 => 954,  2960 => 953,  2958 => 952,  2955 => 951,  2952 => 950,  2945 => 946,  2942 => 945,  2939 => 944,  2936 => 943,  2934 => 942,  2931 => 941,  2928 => 940,  2925 => 939,  2922 => 938,  2920 => 937,  2917 => 936,  2915 => 935,  2913 => 932,  2897 => 931,  2885 => 926,  2880 => 924,  2876 => 923,  2872 => 922,  2862 => 921,  2859 => 920,  2856 => 919,  2853 => 918,  2850 => 917,  2847 => 916,  2845 => 915,  2842 => 914,  2839 => 913,  2836 => 910,  2834 => 909,  2831 => 908,  2829 => 907,  2827 => 901,  2810 => 900,  2797 => 894,  2793 => 893,  2786 => 892,  2783 => 891,  2780 => 890,  2778 => 889,  2774 => 888,  2764 => 887,  2761 => 886,  2758 => 885,  2755 => 884,  2752 => 883,  2749 => 882,  2747 => 881,  2744 => 880,  2741 => 879,  2739 => 877,  2737 => 876,  2735 => 875,  2732 => 874,  2729 => 873,  2726 => 869,  2724 => 868,  2721 => 867,  2718 => 866,  2715 => 865,  2712 => 861,  2710 => 860,  2707 => 859,  2704 => 856,  2702 => 855,  2699 => 854,  2697 => 853,  2695 => 842,  2678 => 841,  2666 => 836,  2662 => 835,  2656 => 834,  2653 => 833,  2650 => 832,  2647 => 831,  2644 => 830,  2642 => 829,  2639 => 828,  2637 => 827,  2635 => 824,  2619 => 823,  2606 => 818,  2600 => 816,  2598 => 815,  2595 => 814,  2592 => 813,  2579 => 812,  2567 => 809,  2563 => 807,  2557 => 805,  2555 => 804,  2550 => 803,  2547 => 802,  2531 => 801,  2521 => 798,  2518 => 797,  2512 => 795,  2506 => 793,  2504 => 792,  2499 => 791,  2496 => 790,  2494 => 789,  2491 => 788,  2488 => 787,  2485 => 786,  2482 => 785,  2476 => 783,  2474 => 782,  2471 => 781,  2468 => 780,  2465 => 779,  2462 => 778,  2459 => 777,  2457 => 776,  2454 => 775,  2452 => 774,  2450 => 767,  2434 => 766,  2422 => 763,  2416 => 761,  2414 => 760,  2411 => 759,  2408 => 758,  2405 => 757,  2402 => 756,  2386 => 755,  2373 => 751,  2371 => 750,  2368 => 749,  2363 => 747,  2362 => 746,  2361 => 745,  2360 => 744,  2358 => 743,  2356 => 742,  2353 => 741,  2350 => 740,  2347 => 739,  2345 => 738,  2342 => 737,  2339 => 736,  2336 => 735,  2333 => 734,  2331 => 733,  2329 => 730,  2326 => 729,  2323 => 728,  2317 => 725,  2314 => 724,  2312 => 723,  2309 => 722,  2292 => 721,  2281 => 718,  2278 => 717,  2275 => 716,  2273 => 715,  2272 => 714,  2271 => 713,  2269 => 712,  2267 => 711,  2264 => 710,  2261 => 709,  2258 => 708,  2256 => 707,  2253 => 706,  2250 => 705,  2247 => 704,  2244 => 703,  2242 => 702,  2240 => 699,  2224 => 698,  2213 => 695,  2210 => 694,  2207 => 693,  2205 => 692,  2204 => 691,  2202 => 690,  2200 => 689,  2197 => 688,  2194 => 687,  2191 => 686,  2189 => 685,  2186 => 684,  2183 => 683,  2180 => 682,  2177 => 681,  2175 => 680,  2173 => 677,  2157 => 676,  2145 => 673,  2142 => 672,  2139 => 671,  2137 => 670,  2134 => 669,  2132 => 668,  2130 => 666,  2115 => 665,  2104 => 662,  2101 => 661,  2098 => 660,  2096 => 659,  2095 => 658,  2094 => 657,  2092 => 656,  2090 => 655,  2087 => 654,  2085 => 653,  2082 => 652,  2079 => 651,  2076 => 650,  2074 => 649,  2071 => 648,  2068 => 647,  2065 => 646,  2062 => 645,  2060 => 644,  2058 => 641,  2042 => 640,  2031 => 637,  2028 => 636,  2025 => 635,  2023 => 634,  2022 => 633,  2020 => 632,  2018 => 631,  2015 => 630,  2012 => 629,  2009 => 628,  2007 => 627,  2004 => 626,  2001 => 625,  1998 => 624,  1995 => 623,  1993 => 622,  1991 => 619,  1975 => 618,  1964 => 615,  1961 => 614,  1958 => 613,  1956 => 612,  1955 => 611,  1954 => 610,  1952 => 609,  1950 => 608,  1947 => 607,  1944 => 606,  1941 => 605,  1939 => 604,  1936 => 603,  1933 => 602,  1930 => 601,  1927 => 600,  1925 => 599,  1923 => 596,  1907 => 595,  1896 => 592,  1893 => 591,  1890 => 590,  1888 => 589,  1887 => 588,  1886 => 587,  1884 => 586,  1882 => 585,  1879 => 584,  1876 => 583,  1873 => 582,  1871 => 581,  1868 => 580,  1865 => 579,  1862 => 578,  1860 => 577,  1857 => 576,  1855 => 575,  1853 => 572,  1836 => 571,  1825 => 568,  1822 => 567,  1819 => 566,  1817 => 565,  1816 => 564,  1815 => 563,  1813 => 562,  1811 => 561,  1808 => 560,  1805 => 559,  1802 => 558,  1799 => 557,  1796 => 556,  1793 => 555,  1791 => 554,  1788 => 553,  1786 => 552,  1784 => 549,  1768 => 548,  1756 => 545,  1751 => 543,  1747 => 542,  1743 => 541,  1737 => 540,  1733 => 539,  1730 => 538,  1727 => 537,  1724 => 536,  1722 => 535,  1720 => 533,  1717 => 532,  1701 => 531,  1691 => 528,  1689 => 525,  1684 => 524,  1682 => 523,  1679 => 522,  1675 => 520,  1673 => 517,  1670 => 516,  1662 => 513,  1660 => 511,  1659 => 508,  1656 => 507,  1652 => 506,  1649 => 505,  1646 => 504,  1630 => 503,  1618 => 500,  1614 => 498,  1607 => 494,  1603 => 493,  1598 => 492,  1595 => 491,  1591 => 489,  1589 => 488,  1582 => 487,  1574 => 485,  1571 => 484,  1568 => 483,  1565 => 482,  1563 => 481,  1560 => 480,  1557 => 479,  1540 => 478,  1528 => 475,  1525 => 474,  1522 => 473,  1519 => 472,  1514 => 470,  1510 => 469,  1506 => 468,  1502 => 467,  1498 => 466,  1494 => 465,  1491 => 464,  1488 => 463,  1485 => 462,  1483 => 461,  1482 => 459,  1480 => 457,  1464 => 456,  1452 => 453,  1449 => 452,  1433 => 451,  1422 => 448,  1419 => 447,  1416 => 446,  1413 => 445,  1401 => 443,  1398 => 442,  1395 => 441,  1392 => 440,  1389 => 439,  1386 => 438,  1381 => 436,  1377 => 435,  1373 => 434,  1368 => 433,  1365 => 432,  1360 => 430,  1356 => 429,  1352 => 428,  1348 => 427,  1344 => 426,  1340 => 425,  1335 => 424,  1333 => 423,  1330 => 422,  1328 => 421,  1327 => 420,  1326 => 419,  1324 => 418,  1322 => 417,  1321 => 416,  1319 => 413,  1303 => 412,  1291 => 409,  1270 => 391,  1266 => 390,  1262 => 389,  1256 => 388,  1252 => 387,  1249 => 386,  1246 => 385,  1230 => 384,  1219 => 381,  1216 => 380,  1200 => 369,  1196 => 368,  1192 => 367,  1183 => 361,  1177 => 358,  1170 => 355,  1168 => 354,  1165 => 353,  1162 => 352,  1159 => 351,  1156 => 350,  1140 => 349,  1129 => 346,  1126 => 345,  1110 => 334,  1106 => 333,  1102 => 332,  1094 => 327,  1088 => 324,  1081 => 321,  1079 => 320,  1076 => 319,  1073 => 318,  1070 => 317,  1067 => 316,  1051 => 315,  1041 => 312,  1037 => 310,  1035 => 309,  1031 => 308,  1027 => 307,  1023 => 306,  1017 => 305,  1010 => 304,  1008 => 303,  1004 => 301,  1001 => 300,  998 => 299,  995 => 298,  992 => 297,  989 => 296,  986 => 295,  983 => 294,  980 => 293,  977 => 292,  974 => 291,  971 => 290,  968 => 289,  965 => 288,  962 => 287,  960 => 286,  957 => 285,  954 => 284,  951 => 283,  948 => 282,  932 => 281,  915 => 272,  911 => 271,  907 => 270,  901 => 266,  899 => 265,  895 => 264,  892 => 263,  889 => 262,  886 => 261,  883 => 260,  880 => 259,  877 => 258,  875 => 257,  872 => 256,  869 => 255,  866 => 254,  864 => 252,  863 => 251,  862 => 249,  861 => 248,  859 => 247,  856 => 246,  853 => 245,  850 => 244,  848 => 242,  847 => 241,  846 => 239,  844 => 238,  841 => 237,  838 => 236,  836 => 235,  833 => 234,  830 => 233,  828 => 231,  827 => 230,  826 => 228,  825 => 227,  823 => 226,  821 => 225,  818 => 224,  811 => 222,  807 => 221,  803 => 220,  793 => 218,  791 => 217,  789 => 216,  786 => 215,  783 => 214,  780 => 213,  777 => 212,  775 => 211,  772 => 210,  770 => 209,  768 => 201,  752 => 200,  740 => 196,  736 => 194,  730 => 192,  726 => 190,  724 => 189,  719 => 188,  716 => 187,  713 => 186,  697 => 185,  685 => 181,  675 => 179,  668 => 178,  662 => 177,  658 => 176,  654 => 175,  650 => 174,  644 => 173,  640 => 172,  637 => 171,  635 => 170,  632 => 169,  629 => 168,  626 => 167,  624 => 166,  621 => 165,  618 => 164,  615 => 163,  613 => 162,  610 => 161,  594 => 160,  583 => 156,  580 => 155,  576 => 153,  570 => 151,  568 => 150,  564 => 149,  560 => 148,  556 => 147,  552 => 146,  546 => 145,  540 => 144,  537 => 143,  535 => 142,  532 => 141,  530 => 140,  528 => 137,  525 => 136,  523 => 135,  521 => 133,  518 => 132,  502 => 131,  491 => 127,  488 => 126,  483 => 124,  479 => 123,  475 => 122,  471 => 121,  467 => 120,  462 => 119,  460 => 118,  457 => 117,  455 => 116,  454 => 114,  451 => 113,  448 => 112,  445 => 111,  442 => 110,  426 => 109,  415 => 105,  412 => 104,  406 => 102,  403 => 101,  399 => 100,  395 => 99,  391 => 98,  385 => 97,  381 => 96,  376 => 95,  374 => 94,  371 => 93,  368 => 92,  365 => 91,  362 => 90,  359 => 89,  343 => 88,  332 => 84,  329 => 83,  326 => 82,  323 => 81,  320 => 80,  317 => 79,  314 => 78,  311 => 77,  308 => 76,  305 => 75,  301 => 74,  298 => 73,  295 => 72,  278 => 71,  263 => 65,  257 => 62,  254 => 61,  252 => 60,  248 => 59,  243 => 57,  240 => 56,  237 => 55,  223 => 54,  208 => 48,  202 => 45,  199 => 44,  197 => 43,  193 => 42,  188 => 40,  185 => 39,  182 => 38,  179 => 37,  176 => 36,  173 => 35,  158 => 34,  152 => 929,  148 => 898,  144 => 839,  140 => 821,  137 => 811,  134 => 800,  131 => 765,  128 => 754,  125 => 720,  122 => 697,  119 => 675,  116 => 664,  113 => 639,  110 => 617,  107 => 594,  104 => 570,  101 => 547,  98 => 530,  95 => 502,  92 => 477,  89 => 455,  86 => 450,  83 => 411,  80 => 383,  77 => 348,  74 => 314,  71 => 280,  67 => 198,  63 => 183,  59 => 158,  55 => 129,  51 => 107,  47 => 86,  44 => 70,  41 => 53,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/form/fields_macros.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\components\\form\\fields_macros.html.twig");
    }
}
