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

/* layout/parts/breadcrumbs.html.twig */
class __TwigTemplate_9fabdcdfa4cb83b3e9016aa49ce09955 extends Template
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
<ol class=\"breadcrumb breadcrumb-alternate pe-1 pe-sm-3\" aria-label=\"breadcrumbs\">
   <li class=\"breadcrumb-item text-truncate\">
      <a href=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->indexPath(), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, __("Home"), "html", null, true);
        echo "\">
         <i class=\"ti ti-home-2\"></i>
         ";
        // line 38
        echo twig_escape_filter($this->env, __("Home"), "html", null, true);
        echo "
      </a>
   </li>

   ";
        // line 42
        if (twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", true, true, false, 42)) {
            // line 43
            echo "   <li class=\"breadcrumb-item text-truncate\">
      <a href=\"";
            // line 44
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path((((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 44), "default", [], "array", true, true, false, 44) &&  !(null === (($__internal_compile_0 = twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 44)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["default"] ?? null) : null)))) ? ((($__internal_compile_1 = twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 44)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["default"] ?? null) : null)) : ("/front/central.php"))), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, (($__internal_compile_2 = (($__internal_compile_3 = ($context["menu"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[($context["sector"] ?? null)] ?? null) : null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["title"] ?? null) : null), "html", null, true);
            echo "\">
         <i class=\"";
            // line 45
            (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 45), "icon", [], "array", true, true, false, 45) &&  !(null === (($__internal_compile_4 = twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 45)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["icon"] ?? null) : null)))) ? (print (twig_escape_filter($this->env, (($__internal_compile_5 = twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 45)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["icon"] ?? null) : null), "html", null, true))) : (print ("")));
            echo "\"></i>
         ";
            // line 46
            echo twig_escape_filter($this->env, (($__internal_compile_6 = (($__internal_compile_7 = ($context["menu"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[($context["sector"] ?? null)] ?? null) : null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["title"] ?? null) : null), "html", null, true);
            echo "
      </a>
   </li>
   ";
        }
        // line 50
        echo "
   ";
        // line 51
        $context["with_option"] = false;
        // line 52
        echo "   ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 52), "content", [], "array", false, true, false, 52), ($context["item"] ?? null), [], "array", true, true, false, 52)) {
            // line 53
            echo "      ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 53), "content", [], "array", false, true, false, 53), ($context["item"] ?? null), [], "array", false, true, false, 53), "page", [], "array", true, true, false, 53)) {
                // line 54
                echo "      ";
                $context["with_option"] = (( !twig_test_empty(($context["option"] ?? null)) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 54), "content", [], "array", false, true, false, 54), ($context["item"] ?? null), [], "array", false, true, false, 54), "options", [], "array", false, true, false, 54), ($context["option"] ?? null), [], "array", false, true, false, 54), "title", [], "array", true, true, false, 54)) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 54), "content", [], "array", false, true, false, 54), ($context["item"] ?? null), [], "array", false, true, false, 54), "options", [], "array", false, true, false, 54), ($context["option"] ?? null), [], "array", false, true, false, 54), "page", [], "array", true, true, false, 54));
                // line 55
                echo "      <li class=\"breadcrumb-item text-truncate\">
         <a href=\"";
                // line 56
                echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path((($__internal_compile_8 = (($__internal_compile_9 = (($__internal_compile_10 = (($__internal_compile_11 = ($context["menu"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11[($context["sector"] ?? null)] ?? null) : null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["content"] ?? null) : null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9[($context["item"] ?? null)] ?? null) : null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["page"] ?? null) : null)), "html", null, true);
                echo "\"
            class=\"";
                // line 57
                echo ((($context["with_option"] ?? null)) ? ("") : ("here"));
                echo "\"
            title=\"";
                // line 58
                echo twig_escape_filter($this->env, (($__internal_compile_12 = (($__internal_compile_13 = (($__internal_compile_14 = (($__internal_compile_15 = ($context["menu"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15[($context["sector"] ?? null)] ?? null) : null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["content"] ?? null) : null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13[($context["item"] ?? null)] ?? null) : null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["title"] ?? null) : null), "html", null, true);
                echo "\" >
            <i class=\"";
                // line 59
                (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 59), "content", [], "array", false, true, false, 59), ($context["item"] ?? null), [], "array", false, true, false, 59), "icon", [], "array", true, true, false, 59) &&  !(null === (($__internal_compile_16 = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 59), "content", [], "array", false, true, false, 59), ($context["item"] ?? null), [], "array", false, true, false, 59)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["icon"] ?? null) : null)))) ? (print (twig_escape_filter($this->env, (($__internal_compile_17 = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 59), "content", [], "array", false, true, false, 59), ($context["item"] ?? null), [], "array", false, true, false, 59)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["icon"] ?? null) : null), "html", null, true))) : (print ("")));
                echo "\"></i>
            ";
                // line 60
                echo twig_escape_filter($this->env, (($__internal_compile_18 = (($__internal_compile_19 = (($__internal_compile_20 = (($__internal_compile_21 = ($context["menu"] ?? null)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21[($context["sector"] ?? null)] ?? null) : null)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["content"] ?? null) : null)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19[($context["item"] ?? null)] ?? null) : null)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["title"] ?? null) : null), "html", null, true);
                echo "
         </a>
      </li>
      ";
            }
            // line 64
            echo "
      ";
            // line 65
            if (($context["with_option"] ?? null)) {
                // line 66
                echo "      <li class=\"breadcrumb-item text-truncate\">
         <a href=\"";
                // line 67
                echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path((($__internal_compile_22 = (($__internal_compile_23 = (($__internal_compile_24 = (($__internal_compile_25 = (($__internal_compile_26 = (($__internal_compile_27 = ($context["menu"] ?? null)) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27[($context["sector"] ?? null)] ?? null) : null)) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["content"] ?? null) : null)) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25[($context["item"] ?? null)] ?? null) : null)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["options"] ?? null) : null)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23[($context["option"] ?? null)] ?? null) : null)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["page"] ?? null) : null)), "html", null, true);
                echo "\"
            class=\"here\"
            title=\"";
                // line 69
                echo twig_escape_filter($this->env, (($__internal_compile_28 = (($__internal_compile_29 = (($__internal_compile_30 = (($__internal_compile_31 = (($__internal_compile_32 = (($__internal_compile_33 = ($context["menu"] ?? null)) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33[($context["sector"] ?? null)] ?? null) : null)) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32["content"] ?? null) : null)) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31[($context["item"] ?? null)] ?? null) : null)) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30["options"] ?? null) : null)) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29[($context["option"] ?? null)] ?? null) : null)) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["title"] ?? null) : null), "html", null, true);
                echo "\" >
            <i class=\"";
                // line 70
                (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 70), "content", [], "array", false, true, false, 70), ($context["item"] ?? null), [], "array", false, true, false, 70), "options", [], "array", false, true, false, 70), ($context["option"] ?? null), [], "array", false, true, false, 70), "icon", [], "array", true, true, false, 70) &&  !(null === (($__internal_compile_34 = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 70), "content", [], "array", false, true, false, 70), ($context["item"] ?? null), [], "array", false, true, false, 70), "options", [], "array", false, true, false, 70), ($context["option"] ?? null), [], "array", false, true, false, 70)) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34["icon"] ?? null) : null)))) ? (print (twig_escape_filter($this->env, (($__internal_compile_35 = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 70), "content", [], "array", false, true, false, 70), ($context["item"] ?? null), [], "array", false, true, false, 70), "options", [], "array", false, true, false, 70), ($context["option"] ?? null), [], "array", false, true, false, 70)) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35["icon"] ?? null) : null), "html", null, true))) : (print ("")));
                echo "\"></i>
            ";
                // line 71
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $this->extensions['Twig\Extra\String\StringExtension']->createUnicodeString((($__internal_compile_36 = (($__internal_compile_37 = (($__internal_compile_38 = (($__internal_compile_39 = (($__internal_compile_40 = (($__internal_compile_41 = ($context["menu"] ?? null)) && is_array($__internal_compile_41) || $__internal_compile_41 instanceof ArrayAccess ? ($__internal_compile_41[($context["sector"] ?? null)] ?? null) : null)) && is_array($__internal_compile_40) || $__internal_compile_40 instanceof ArrayAccess ? ($__internal_compile_40["content"] ?? null) : null)) && is_array($__internal_compile_39) || $__internal_compile_39 instanceof ArrayAccess ? ($__internal_compile_39[($context["item"] ?? null)] ?? null) : null)) && is_array($__internal_compile_38) || $__internal_compile_38 instanceof ArrayAccess ? ($__internal_compile_38["options"] ?? null) : null)) && is_array($__internal_compile_37) || $__internal_compile_37 instanceof ArrayAccess ? ($__internal_compile_37[($context["option"] ?? null)] ?? null) : null)) && is_array($__internal_compile_36) || $__internal_compile_36 instanceof ArrayAccess ? ($__internal_compile_36["title"] ?? null) : null)), "truncate", [0 => 17, 1 => "..."], "method", false, false, false, 71), "html", null, true);
                echo "
         </a>
      </li>
      ";
            }
            // line 75
            echo "
   ";
        }
        // line 77
        echo "</ol>

";
        // line 79
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["menu"] ?? null), ($context["sector"] ?? null), [], "array", false, true, false, 79), "content", [], "array", false, true, false, 79), ($context["item"] ?? null), [], "array", true, true, false, 79)) {
            // line 80
            echo "    ";
            echo twig_include($this->env, $context, "layout/parts/context_links.html.twig");
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "layout/parts/breadcrumbs.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  156 => 80,  154 => 79,  150 => 77,  146 => 75,  139 => 71,  135 => 70,  131 => 69,  126 => 67,  123 => 66,  121 => 65,  118 => 64,  111 => 60,  107 => 59,  103 => 58,  99 => 57,  95 => 56,  92 => 55,  89 => 54,  86 => 53,  83 => 52,  81 => 51,  78 => 50,  71 => 46,  67 => 45,  61 => 44,  58 => 43,  56 => 42,  49 => 38,  42 => 36,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "layout/parts/breadcrumbs.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\layout\\parts\\breadcrumbs.html.twig");
    }
}
