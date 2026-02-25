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

/* components/dropdown/limit.html.twig */
class __TwigTemplate_04088d189a88907860881ba7f93e1ba8 extends Template
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
        if ( !array_key_exists("additional_params", $context)) {
            // line 35
            echo "   ";
            $context["additional_params"] = "";
        } else {
            // line 37
            echo "   ";
            if (((twig_length_filter($this->env, ($context["additional_params"] ?? null)) > 0) &&  !(is_string($__internal_compile_0 = ($context["additional_params"] ?? null)) && is_string($__internal_compile_1 = "&") && ('' === $__internal_compile_1 || 0 === strpos($__internal_compile_0, $__internal_compile_1))))) {
                // line 38
                echo "      ";
                $context["additional_params"] = ("&" . ($context["additional_params"] ?? null));
                // line 39
                echo "   ";
            }
        }
        // line 41
        echo "
";
        // line 42
        if ( !($context["no_onchange"] ?? null)) {
            // line 43
            echo "   ";
            $context["href"] = (((("location.href='" . ($context["href"] ?? null)) . "glpilist_limit='+this.value+'") . ($context["additional_params"] ?? null)) . "'");
            // line 44
            echo "   ";
            if ((array_key_exists("is_tab", $context) && (($context["is_tab"] ?? null) == true))) {
                // line 45
                echo "      ";
                $context["href"] = (("javascript:reloadTab('glpilist_limit='+this.value+'" . ($context["additional_params"] ?? null)) . "');");
                // line 46
                echo "   ";
            }
        }
        // line 48
        echo "
";
        // line 49
        $context["options"] = [];
        // line 50
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(5, 19, 5));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 51
            echo "   ";
            $context["options"] = twig_array_merge(($context["options"] ?? null), [0 => $context["i"]]);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 53
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(20, 49, 10));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 54
            echo "   ";
            $context["options"] = twig_array_merge(($context["options"] ?? null), [0 => $context["i"]]);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(50, 249, 50));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 57
            echo "   ";
            $context["options"] = twig_array_merge(($context["options"] ?? null), [0 => $context["i"]]);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(250, 999, 250));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 60
            echo "   ";
            $context["options"] = twig_array_merge(($context["options"] ?? null), [0 => $context["i"]]);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 62
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(1000, 4999, 1000));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 63
            echo "   ";
            $context["options"] = twig_array_merge(($context["options"] ?? null), [0 => $context["i"]]);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 65
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(5000, 10000, 5000));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 66
            echo "   ";
            $context["options"] = twig_array_merge(($context["options"] ?? null), [0 => $context["i"]]);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 68
        $context["options"] = twig_array_merge(($context["options"] ?? null), [0 => 9999999]);
        // line 69
        $context["max"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->phpConfig("max_input_vars");
        // line 70
        if ((($context["max"] ?? null) > 10)) {
            // line 71
            echo "   ";
            $context["options"] = twig_array_merge(($context["options"] ?? null), [0 => (($context["max"] ?? null) - 10)]);
        }
        // line 73
        echo "<select class=\"form-select form-select-sm mx-1 d-inline-block w-auto ";
        echo twig_escape_filter($this->env, ((array_key_exists("select_class", $context)) ? (_twig_default_filter(($context["select_class"] ?? null), "")) : ("")), "html", null, true);
        echo "\"
        ";
        // line 74
        if ( !($context["no_onchange"] ?? null)) {
            echo "onChange=\"";
            echo twig_escape_filter($this->env, ($context["href"] ?? null), "html", null, true);
            echo "\"";
        }
        echo ">
   ";
        // line 75
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_sort_filter($this->env, ($context["options"] ?? null)));
        foreach ($context['_seq'] as $context["_key"] => $context["value"]) {
            // line 76
            echo "      <option value=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\" ";
            echo ((($context["value"] == $this->extensions['Glpi\Application\View\Extension\SessionExtension']->userPref("list_limit"))) ? ("selected") : (""));
            echo ">
         ";
            // line 77
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "
      </option>
   ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 80
        echo "</select>
";
    }

    public function getTemplateName()
    {
        return "components/dropdown/limit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  188 => 80,  179 => 77,  172 => 76,  168 => 75,  160 => 74,  155 => 73,  151 => 71,  149 => 70,  147 => 69,  145 => 68,  138 => 66,  134 => 65,  127 => 63,  123 => 62,  116 => 60,  112 => 59,  105 => 57,  101 => 56,  94 => 54,  90 => 53,  83 => 51,  79 => 50,  77 => 49,  74 => 48,  70 => 46,  67 => 45,  64 => 44,  61 => 43,  59 => 42,  56 => 41,  52 => 39,  49 => 38,  46 => 37,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/dropdown/limit.html.twig", "C:\\xampp1\\htdocs\\unh_glpi\\templates\\components\\dropdown\\limit.html.twig");
    }
}
