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

/* components/itilobject/service_levels.html.twig */
class __TwigTemplate_85927decdc0061e8d2c2ca885e19ec3e extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/itilobject/service_levels.html.twig", 34)->unwrap();
        // line 35
        $macros["modals"] = $this->macros["modals"] = $this->loadTemplate("components/form/modals_macros.html.twig", "components/itilobject/service_levels.html.twig", 35)->unwrap();
        // line 36
        echo "
";
        // line 37
        $context["la_fields"] = [];
        // line 38
        echo "
";
        // line 39
        $context["la_fields"] = twig_array_merge(($context["la_fields"] ?? null), [0 => ["la" =>         // line 41
($context["sla"] ?? null), "type_str" => "sla", "type" => twig_constant("SLM::TTO"), "datefieldname" => "time_to_own", "lafieldname" => "slas_id_tto", "label" => __("TTO"), "helper" => __("Time to own")], 1 => ["la" =>         // line 49
($context["sla"] ?? null), "type_str" => "sla", "type" => twig_constant("SLM::TTR"), "datefieldname" => "time_to_resolve", "lafieldname" => "slas_id_ttr", "label" => __("TTR"), "helper" => __("Time to resolve")]]);
        // line 58
        echo "
";
        // line 59
        $context["la_fields"] = twig_array_merge(($context["la_fields"] ?? null), [0 => ["la" =>         // line 61
($context["ola"] ?? null), "type_str" => "ola", "type" => twig_constant("SLM::TTO"), "datefieldname" => "internal_time_to_own", "lafieldname" => "olas_id_tto", "label" => __("Internal TTO"), "helper" => __("Internal Time to own")], 1 => ["la" =>         // line 69
($context["ola"] ?? null), "type_str" => "ola", "type" => twig_constant("SLM::TTR"), "datefieldname" => "internal_time_to_resolve", "lafieldname" => "olas_id_ttr", "label" => __("Internal TTR"), "helper" => __("Internal Time to resolve")]]);
        // line 78
        echo "

";
        // line 80
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["la_fields"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["la_field"]) {
            // line 81
            echo "   ";
            $context["rand"] = twig_random($this->env);
            // line 82
            echo "   ";
            $context["date_displayed"] = ( !twig_get_attribute($this->env, $this->source, ($context["field_options"] ?? null), "fields_template", [], "any", true, true, false, 82) ||  !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["field_options"] ?? null), "fields_template", [], "any", false, false, false, 82), "isHiddenField", [0 => twig_get_attribute($this->env, $this->source, $context["la_field"], "datefieldname", [], "any", false, false, false, 82)], "method", false, false, false, 82));
            // line 83
            echo "   ";
            $context["la_displayed"] = ( !twig_get_attribute($this->env, $this->source, ($context["field_options"] ?? null), "fields_template", [], "any", true, true, false, 83) ||  !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["field_options"] ?? null), "fields_template", [], "any", false, false, false, 83), "isHiddenField", [0 => twig_get_attribute($this->env, $this->source, $context["la_field"], "lafieldname", [], "any", false, false, false, 83)], "method", false, false, false, 83));
            // line 84
            echo "
   ";
            // line 85
            if ((($context["date_displayed"] ?? null) || ($context["la_displayed"] ?? null))) {
                // line 86
                echo "      ";
                ob_start(function () { return ''; });
                // line 87
                echo "         ";
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["la_field"], "la", [], "any", false, false, false, 87), "getDataForTicket", [0 => (($__internal_compile_0 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 87)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["id"] ?? null) : null), 1 => twig_get_attribute($this->env, $this->source, $context["la_field"], "type", [], "any", false, false, false, 87)], "method", false, false, false, 87)) {
                    // line 88
                    echo "            ";
                    if (($context["date_displayed"] ?? null)) {
                        // line 89
                        echo "               <span class=\"text-muted\">
                  ";
                        // line 90
                        echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedDatetime((($__internal_compile_1 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 90)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["la_field"], "datefieldname", [], "any", false, false, false, 90)] ?? null) : null)), "html", null, true);
                        echo "
               </span>
            ";
                    }
                    // line 93
                    echo "
            ";
                    // line 94
                    if (($context["la_displayed"] ?? null)) {
                        // line 95
                        echo "               <span class=\"level_name badge itil-badge bg-secondary ms-1 flex-column flex-sm-row\">
                  <span class=\"d-flex align-items-center\">
                     <i class=\"fas fa-stopwatch slt me-1\"></i>
                     <span class=\"text-truncate\"
                           title=\"";
                        // line 99
                        echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemComment(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["la_field"], "la", [], "any", false, false, false, 99), "getType", [], "method", false, false, false, 99), (($__internal_compile_2 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 99)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["la_field"], "lafieldname", [], "any", false, false, false, 99)] ?? null) : null)), "html", null, true);
                        echo "\"
                           data-bs-toggle=\"tooltip\" data-bs-placement=\"top\">
                        ";
                        // line 101
                        echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemName(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["la_field"], "la", [], "any", false, false, false, 101), "getType", [], "method", false, false, false, 101), (($__internal_compile_3 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 101)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["la_field"], "lafieldname", [], "any", false, false, false, 101)] ?? null) : null)), "html", null, true);
                        echo "
                     </span>

                     ";
                        // line 104
                        if (($context["canupdate"] ?? null)) {
                            // line 105
                            echo "                        <i class=\"ti ti-x ms-1\" role=\"button\"
                           onclick=\"delete_date_";
                            // line 106
                            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
                            echo "(event)\"
                           title=\"";
                            // line 107
                            echo twig_escape_filter($this->env, _x("button", "Delete permanently"), "html", null, true);
                            echo "\"
                           data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"></i>
                     ";
                        }
                        // line 110
                        echo "                  </span>

                  ";
                        // line 112
                        $context["nextaction"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["la_field"], "la", [], "any", false, false, false, 112), "getNextActionForTicket", [0 => ($context["item"] ?? null), 1 => twig_get_attribute($this->env, $this->source, $context["la_field"], "type", [], "any", false, false, false, 112)], "method", false, false, false, 112);
                        // line 113
                        echo "                  ";
                        $context["level"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["la_field"], "la", [], "any", false, false, false, 113), "getLevelFromAction", [0 => ($context["nextaction"] ?? null)], "method", false, false, false, 113);
                        // line 114
                        echo "                  ";
                        if ((($context["level"] ?? null) != false)) {
                            // line 115
                            echo "                     <span class=\"badge bg-info ms-0 ms-sm-1\">
                        <i class=\"fas fa-clock me-1\"
                           title=\"";
                            // line 117
                            echo twig_escape_filter($this->env, twig_sprintf(__("Next escalation: %s"), $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedDatetime((($__internal_compile_4 = twig_get_attribute($this->env, $this->source, ($context["nextaction"] ?? null), "fields", [], "any", false, false, false, 117)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["date"] ?? null) : null))), "html", null, true);
                            echo "\"
                           data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"></i>
                        <span title=\"";
                            // line 119
                            echo twig_escape_filter($this->env, twig_sprintf(__("%1\$s: %2\$s"), _n("Escalation level", "Escalation levels", 1), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemName(($context["level"] ?? null))), "html", null, true);
                            echo "\"
                              data-bs-toggle=\"tooltip\" data-bs-placement=\"top\">
                           ";
                            // line 121
                            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemName(($context["level"] ?? null)), "html", null, true);
                            echo "
                        </span>
                     </span>
                  ";
                        }
                        // line 125
                        echo "               </span>
               <script type=\"text/javascript\">
                  function delete_date_";
                        // line 127
                        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
                        echo "(e) {
                     e.preventDefault();

                     var delete_date = 0;
                     if (confirm('";
                        // line 131
                        echo twig_escape_filter($this->env, __("Also delete date?"), "html", null, true);
                        echo "')) {
                        delete_date = 1;
                     }

                     submitGetLink('";
                        // line 135
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getFormURL", [], "method", false, false, false, 135), "html", null, true);
                        echo "', {
                        '";
                        // line 136
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["la_field"], "type_str", [], "any", false, false, false, 136), "html", null, true);
                        echo "_delete': 1,
                        'id': ";
                        // line 137
                        echo twig_escape_filter($this->env, (($__internal_compile_5 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 137)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["id"] ?? null) : null), "html", null, true);
                        echo ",
                        'type': ";
                        // line 138
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["la_field"], "type", [], "any", false, false, false, 138), "html", null, true);
                        echo ",
                        '_glpi_csrf_token': '";
                        // line 139
                        echo twig_escape_filter($this->env, Session::getNewCSRFToken(), "html", null, true);
                        echo "',
                        '_glpi_simple_form': 1,
                        'delete_date': delete_date
                     });
                  }
               </script>
            ";
                    }
                    // line 146
                    echo "         ";
                } else {
                    // line 147
                    echo "            <div class=\"d-flex align-items-center flex-wrap\">
               ";
                    // line 148
                    $context["assign_la_id"] = ("assign_la_" . ($context["rand"] ?? null));
                    // line 149
                    echo "
               ";
                    // line 150
                    if (($context["date_displayed"] ?? null)) {
                        // line 151
                        echo "                  <div class=\"la_datefield\">
                     ";
                        // line 152
                        echo twig_call_macro($macros["fields"], "macro_datetimeField", [twig_get_attribute($this->env, $this->source,                         // line 153
$context["la_field"], "datefieldname", [], "any", false, false, false, 153), (($__internal_compile_6 = twig_get_attribute($this->env, $this->source,                         // line 154
($context["item"] ?? null), "fields", [], "any", false, false, false, 154)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[twig_get_attribute($this->env, $this->source, $context["la_field"], "datefieldname", [], "any", false, false, false, 154)] ?? null) : null), "", ["include_field" => false, "id" => ("date_" .                         // line 158
($context["assign_la_id"] ?? null)), "disabled" =>  !                        // line 159
($context["canupdate"] ?? null)]], 152, $context, $this->getSourceContext());
                        // line 161
                        echo "
                  </div>
               ";
                    }
                    // line 164
                    echo "
               ";
                    // line 165
                    if (($context["la_displayed"] ?? null)) {
                        // line 166
                        echo "                  <div class=\"";
                        echo ((twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "any", false, false, false, 166)) ? ("") : ("collapsed"));
                        echo " w-100 mt-1 d-none\" id=\"dropdown_";
                        echo twig_escape_filter($this->env, ($context["assign_la_id"] ?? null), "html", null, true);
                        echo "\">
                     ";
                        // line 167
                        echo twig_call_macro($macros["fields"], "macro_dropdownField", [twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,                         // line 168
$context["la_field"], "la", [], "any", false, false, false, 168), "getType", [], "method", false, false, false, 168), twig_get_attribute($this->env, $this->source,                         // line 169
$context["la_field"], "lafieldname", [], "any", false, false, false, 169), (($__internal_compile_7 = twig_get_attribute($this->env, $this->source,                         // line 170
($context["item"] ?? null), "fields", [], "any", false, false, false, 170)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[twig_get_attribute($this->env, $this->source, $context["la_field"], "lafieldname", [], "any", false, false, false, 170)] ?? null) : null), "", ["include_field" => false, "entity" => (($__internal_compile_8 = twig_get_attribute($this->env, $this->source,                         // line 174
($context["item"] ?? null), "fields", [], "any", false, false, false, 174)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["entities_id"] ?? null) : null), "condition" => ["type" => twig_get_attribute($this->env, $this->source,                         // line 175
$context["la_field"], "type", [], "any", false, false, false, 175)], "disabled" =>  !                        // line 176
($context["canupdate"] ?? null), "add_field_class" => ((                        // line 177
($context["is_expanded"] ?? null)) ? ("col-sm-6") : (""))]], 167, $context, $this->getSourceContext());
                        // line 179
                        echo "
                  </div>

                  ";
                        // line 182
                        if (($context["canupdate"] ?? null)) {
                            // line 183
                            echo "                     <button class=\"btn btn-sm btn-ghost-secondary ms-1\" type=\"button\"
                           id=\"button_";
                            // line 184
                            echo twig_escape_filter($this->env, ($context["assign_la_id"] ?? null), "html", null, true);
                            echo "\"
                           data-bs-toggle=\"modal\" data-bs-target=\"#";
                            // line 185
                            echo twig_escape_filter($this->env, ($context["assign_la_id"] ?? null), "html", null, true);
                            echo "\"
                           aria-expanded=\"false\" aria-controls=\"";
                            // line 186
                            echo twig_escape_filter($this->env, ($context["assign_la_id"] ?? null), "html", null, true);
                            echo "\">
                        <i class=\"fas fa-stopwatch slt pointer\"
                           title=\"";
                            // line 188
                            echo twig_escape_filter($this->env, __("Assign a SLA"), "html", null, true);
                            echo "\"
                           data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"></i>
                     </button>

                     ";
                            // line 192
                            echo twig_call_macro($macros["modals"], "macro_confirm", [__("Warning"), twig_join_filter(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,                             // line 194
$context["la_field"], "la", [], "any", false, false, false, 194), "getAddConfirmation", [], "method", false, false, false, 194), "<br />"), ["id" =>                             // line 196
($context["assign_la_id"] ?? null), "confirm_label" => ("<i class=\"fas fa-stopwatch me-1\"></i>" . __("Assign")), "confirm_event" => (("toggleAssignLA_" .                             // line 198
($context["rand"] ?? null)) . "()")]], 192, $context, $this->getSourceContext());
                            // line 200
                            echo "

                     <script type=\"text/javascript\">
                        function toggleAssignLA_";
                            // line 203
                            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
                            echo "() {
                           // hide button clicked
                           \$(\"#button_";
                            // line 205
                            echo twig_escape_filter($this->env, ($context["assign_la_id"] ?? null), "html", null, true);
                            echo "\").hide();

                           // hide date field
                           \$(\"#date_";
                            // line 208
                            echo twig_escape_filter($this->env, ($context["assign_la_id"] ?? null), "html", null, true);
                            echo "\").closest('.la_datefield').hide();

                           // show dropdown field
                           \$('#dropdown_assign_la_";
                            // line 211
                            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
                            echo "').removeClass('d-none');

                           // show level agreement dropdown
                           var myCollapse = new bootstrap.Collapse(document.getElementById('dropdown_";
                            // line 214
                            echo twig_escape_filter($this->env, ($context["assign_la_id"] ?? null), "html", null, true);
                            echo "'));
                           myCollapse.show();
                        }
                     </script>
                  ";
                        }
                        // line 219
                        echo "               ";
                    }
                    // line 220
                    echo "            </div>
         ";
                }
                // line 222
                echo "      ";
                $context["la_html"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 223
                echo "      ";
                echo twig_call_macro($macros["fields"], "macro_field", [twig_get_attribute($this->env, $this->source,                 // line 224
$context["la_field"], "lafieldname", [], "any", false, false, false, 224),                 // line 225
($context["la_html"] ?? null), twig_get_attribute($this->env, $this->source,                 // line 226
$context["la_field"], "label", [], "any", false, false, false, 226), ["helper" => twig_get_attribute($this->env, $this->source,                 // line 228
$context["la_field"], "helper", [], "any", false, false, false, 228), "mb" => "mb-2", "label_class" => "col-auto", "full_width" => true, "is_horizontal" => false, "add_field_class" => ((                // line 233
($context["is_expanded"] ?? null)) ? ("col-sm-6") : (""))]], 223, $context, $this->getSourceContext());
                // line 235
                echo "
   ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['la_field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "components/itilobject/service_levels.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  354 => 235,  352 => 233,  351 => 228,  350 => 226,  349 => 225,  348 => 224,  346 => 223,  343 => 222,  339 => 220,  336 => 219,  328 => 214,  322 => 211,  316 => 208,  310 => 205,  305 => 203,  300 => 200,  298 => 198,  297 => 196,  296 => 194,  295 => 192,  288 => 188,  283 => 186,  279 => 185,  275 => 184,  272 => 183,  270 => 182,  265 => 179,  263 => 177,  262 => 176,  261 => 175,  260 => 174,  259 => 170,  258 => 169,  257 => 168,  256 => 167,  249 => 166,  247 => 165,  244 => 164,  239 => 161,  237 => 159,  236 => 158,  235 => 154,  234 => 153,  233 => 152,  230 => 151,  228 => 150,  225 => 149,  223 => 148,  220 => 147,  217 => 146,  207 => 139,  203 => 138,  199 => 137,  195 => 136,  191 => 135,  184 => 131,  177 => 127,  173 => 125,  166 => 121,  161 => 119,  156 => 117,  152 => 115,  149 => 114,  146 => 113,  144 => 112,  140 => 110,  134 => 107,  130 => 106,  127 => 105,  125 => 104,  119 => 101,  114 => 99,  108 => 95,  106 => 94,  103 => 93,  97 => 90,  94 => 89,  91 => 88,  88 => 87,  85 => 86,  83 => 85,  80 => 84,  77 => 83,  74 => 82,  71 => 81,  67 => 80,  63 => 78,  61 => 69,  60 => 61,  59 => 59,  56 => 58,  54 => 49,  53 => 41,  52 => 39,  49 => 38,  47 => 37,  44 => 36,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/service_levels.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\components\\itilobject\\service_levels.html.twig");
    }
}
