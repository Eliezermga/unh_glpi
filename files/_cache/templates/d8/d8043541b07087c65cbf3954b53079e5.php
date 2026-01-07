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

/* components/itilobject/fields/priority_matrix.html.twig */
class __TwigTemplate_8eef133c458616bcd6c3f742f705939e extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/itilobject/fields/priority_matrix.html.twig", 34)->unwrap();
        // line 35
        $context["rand"] = twig_random($this->env);
        // line 36
        echo "
";
        // line 37
        $context["urgency_options"] = twig_array_merge(($context["field_options"] ?? null), ["disabled" =>  !(        // line 38
($context["canupdate"] ?? null) || ($context["can_requester"] ?? null))]);
        // line 40
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["field_options"] ?? null), "fields_template", [], "any", false, false, false, 40), "isMandatoryField", [0 => "urgency"], "method", false, false, false, 40)) {
            // line 41
            echo "   ";
            $context["urgency_options"] = twig_array_merge(($context["urgency_options"] ?? null), ["required" => true]);
        }
        // line 45
        echo "
";
        // line 46
        echo twig_call_macro($macros["fields"], "macro_field", ["urgency", twig_get_attribute($this->env, $this->source,         // line 48
($context["item"] ?? null), "dropdownUrgency", [0 => twig_array_merge(["value" => (($__internal_compile_0 = twig_get_attribute($this->env, $this->source,         // line 49
($context["item"] ?? null), "fields", [], "any", false, false, false, 49)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["urgency"] ?? null) : null), "width" => "100%", "display" => false, "rand" =>         // line 52
($context["rand"] ?? null)],         // line 53
($context["urgency_options"] ?? null))], "method", false, false, false, 48), __("Urgency"),         // line 55
($context["field_options"] ?? null)], 46, $context, $this->getSourceContext());
        // line 56
        echo "

";
        // line 58
        $context["impact_options"] = ($context["field_options"] ?? null);
        // line 59
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["field_options"] ?? null), "fields_template", [], "any", false, false, false, 59), "isMandatoryField", [0 => "impact"], "method", false, false, false, 59)) {
            // line 60
            echo "   ";
            $context["impact_options"] = twig_array_merge(($context["impact_options"] ?? null), ["required" => true]);
        }
        // line 64
        echo "
";
        // line 65
        echo twig_call_macro($macros["fields"], "macro_field", ["impact", twig_get_attribute($this->env, $this->source,         // line 67
($context["item"] ?? null), "dropdownImpact", [0 => twig_array_merge(["value" => (($__internal_compile_1 = twig_get_attribute($this->env, $this->source,         // line 68
($context["item"] ?? null), "fields", [], "any", false, false, false, 68)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["impact"] ?? null) : null), "width" => "100%", "display" => false, "rand" =>         // line 71
($context["rand"] ?? null)],         // line 72
($context["impact_options"] ?? null))], "method", false, false, false, 67), __("Impact"),         // line 74
($context["field_options"] ?? null)], 65, $context, $this->getSourceContext());
        // line 75
        echo "

";
        // line 77
        $context["priority_options"] = twig_array_merge(($context["field_options"] ?? null), ["disabled" =>  !        // line 78
($context["canpriority"] ?? null), "withmajor" => true]);
        // line 81
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["field_options"] ?? null), "fields_template", [], "any", false, false, false, 81), "isMandatoryField", [0 => "priority"], "method", false, false, false, 81)) {
            // line 82
            echo "   ";
            $context["priority_options"] = twig_array_merge(($context["priority_options"] ?? null), ["required" => true]);
        }
        // line 86
        echo "
";
        // line 87
        echo twig_call_macro($macros["fields"], "macro_field", ["priority", twig_get_attribute($this->env, $this->source,         // line 89
($context["item"] ?? null), "dropdownPriority", [0 => twig_array_merge(["value" => (($__internal_compile_2 = twig_get_attribute($this->env, $this->source,         // line 90
($context["item"] ?? null), "fields", [], "any", false, false, false, 90)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["priority"] ?? null) : null), "width" => "100%", "display" => false, "rand" =>         // line 93
($context["rand"] ?? null)], twig_array_merge(        // line 94
($context["field_options"] ?? null), ($context["priority_options"] ?? null)))], "method", false, false, false, 89), __("Priority"),         // line 96
($context["field_options"] ?? null)], 87, $context, $this->getSourceContext());
        // line 97
        echo "

<script type=\"text/javascript\">
\$(function() {
   \$('#dropdown_urgency";
        // line 101
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo ", #dropdown_impact";
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "').on('change.select2', function (e) {
      \$.ajax({
         url: \"";
        // line 103
        echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("/ajax/priority.php"), "html", null, true);
        echo "\",
         datatype: 'json',
         data: {
            'urgency': \$('#dropdown_urgency";
        // line 106
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "').select2('data')[0].id ?? 0,
            'impact':  \$('#dropdown_impact";
        // line 107
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "').select2('data')[0].id ?? 0,
            'getJson': true,
         }
      }).done(function(data) {
         \$('#dropdown_priority";
        // line 111
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "').val(data.priority);
         \$('#dropdown_priority";
        // line 112
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "').trigger('change');
      });
   })
});
</script>
";
    }

    public function getTemplateName()
    {
        return "components/itilobject/fields/priority_matrix.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  145 => 112,  141 => 111,  134 => 107,  130 => 106,  124 => 103,  117 => 101,  111 => 97,  109 => 96,  108 => 94,  107 => 93,  106 => 90,  105 => 89,  104 => 87,  101 => 86,  97 => 82,  95 => 81,  93 => 78,  92 => 77,  88 => 75,  86 => 74,  85 => 72,  84 => 71,  83 => 68,  82 => 67,  81 => 65,  78 => 64,  74 => 60,  72 => 59,  70 => 58,  66 => 56,  64 => 55,  63 => 53,  62 => 52,  61 => 49,  60 => 48,  59 => 46,  56 => 45,  52 => 41,  50 => 40,  48 => 38,  47 => 37,  44 => 36,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/fields/priority_matrix.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\components\\itilobject\\fields\\priority_matrix.html.twig");
    }
}
