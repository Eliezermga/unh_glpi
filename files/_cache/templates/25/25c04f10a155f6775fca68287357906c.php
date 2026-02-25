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

/* components/form/dates.html.twig */
class __TwigTemplate_e159526d373cd112105a6fd3a8e3a12c extends Template
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
        $context["withtemplate"] = (((twig_get_attribute($this->env, $this->source, ($context["params"] ?? null), "withtemplate", [], "array", true, true, false, 34) &&  !(null === (($__internal_compile_0 = ($context["params"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["withtemplate"] ?? null) : null)))) ? ((($__internal_compile_1 = ($context["params"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["withtemplate"] ?? null) : null)) : (""));
        // line 35
        echo "
";
        // line 36
        if ( !twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 36)) {
            // line 37
            echo "<div class=\"row\">
   ";
            // line 38
            if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "date_creation"], "method", false, false, false, 38)) {
                // line 39
                echo "   <div class=\"col-sm-6 col-12\">
      ";
                // line 40
                echo twig_escape_filter($this->env, twig_sprintf(__("Created on %s"), $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedDatetime((($__internal_compile_2 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 40)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["date_creation"] ?? null) : null))), "html", null, true);
                echo "
   </div>
   ";
            }
            // line 43
            echo "
   ";
            // line 44
            if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "date_mod"], "method", false, false, false, 44)) {
                // line 45
                echo "   <div class=\"col-sm-6 col-12\">
      ";
                // line 46
                echo twig_escape_filter($this->env, twig_sprintf(__("Last update on %s"), $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedDatetime((($__internal_compile_3 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 46)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["date_mod"] ?? null) : null))), "html", null, true);
                echo "
   </div>
   ";
            }
            // line 49
            echo "</div>
";
        }
        // line 51
        echo "
";
        // line 52
        if (((array_key_exists("withtemplate", $context) && (($context["withtemplate"] ?? null) > 0)) && (twig_length_filter($this->env, (($__internal_compile_4 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 52)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["template_name"] ?? null) : null)) > 0))) {
            // line 53
            echo "<div class=\"row\">
   <div class=\"col-12\">
      ";
            // line 55
            echo twig_escape_filter($this->env, twig_sprintf(__("Created from the template %s"), $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue((($__internal_compile_5 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 55)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["template_name"] ?? null) : null))), "html", null, true);
            echo "
   </div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "components/form/dates.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 55,  84 => 53,  82 => 52,  79 => 51,  75 => 49,  69 => 46,  66 => 45,  64 => 44,  61 => 43,  55 => 40,  52 => 39,  50 => 38,  47 => 37,  45 => 36,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/form/dates.html.twig", "C:\\xampp1\\htdocs\\unh_glpi\\templates\\components\\form\\dates.html.twig");
    }
}
