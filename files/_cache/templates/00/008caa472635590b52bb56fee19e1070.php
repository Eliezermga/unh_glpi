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

/* install/blocks/requirements_table.html.twig */
class __TwigTemplate_2df307b3ad863d6ce466c4c68db711aa extends Template
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
<table class=\"table tab_check\">
   <thead>
      <tr>
         <th>";
        // line 37
        echo twig_escape_filter($this->env, __("Test done"), "html", null, true);
        echo "</th>
         <th>";
        // line 38
        echo twig_escape_filter($this->env, __("Results"), "html", null, true);
        echo "</th>
      </tr>
   </thead>
   <tbody>
      ";
        // line 42
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["requirements"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["requirement"]) {
            // line 43
            echo "         ";
            if ( !twig_get_attribute($this->env, $this->source, $context["requirement"], "isOutOfContext", [], "method", false, false, false, 43)) {
                // line 44
                echo "            <tr class=\"tab_bg_1\">
               <td class=\"text-start\">
                  ";
                // line 46
                if (twig_get_attribute($this->env, $this->source, $context["requirement"], "isOptional", [], "method", false, false, false, 46)) {
                    // line 47
                    echo "                     <span class=\"badge bg-secondary\">";
                    echo twig_escape_filter($this->env, __("Suggested"), "html", null, true);
                    echo "</span>
                  ";
                } else {
                    // line 49
                    echo "                     <span class=\"badge bg-warning\">";
                    echo twig_escape_filter($this->env, __("Required"), "html", null, true);
                    echo "</span>
                  ";
                }
                // line 51
                echo "                  <strong>";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["requirement"], "getTitle", [], "method", false, false, false, 51), "html", null, true);
                echo "</strong>
                  ";
                // line 52
                $context["description"] = twig_get_attribute($this->env, $this->source, $context["requirement"], "getDescription", [], "method", false, false, false, 52);
                // line 53
                echo "                  ";
                if ( !twig_test_empty(($context["description"] ?? null))) {
                    // line 54
                    echo "                      <br />
                      <em>";
                    // line 55
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["requirement"], "getDescription", [], "method", false, false, false, 55), "html", null, true);
                    echo "</em>
                  ";
                }
                // line 57
                echo "                  ";
                if ( !twig_get_attribute($this->env, $this->source, $context["requirement"], "isValidated", [], "method", false, false, false, 57)) {
                    // line 58
                    echo "                      ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["requirement"], "getValidationMessages", [], "method", false, false, false, 58));
                    foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                        // line 59
                        echo "                          <br />
                          <strong><em class=\"";
                        // line 60
                        echo (( !twig_get_attribute($this->env, $this->source, $context["requirement"], "isOptional", [], "method", false, false, false, 60)) ? ("red") : ("missing"));
                        echo "\">";
                        echo twig_escape_filter($this->env, $context["message"], "html", null, true);
                        echo "</em></strong>
                      ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 62
                    echo "                  ";
                }
                // line 63
                echo "               </td>
               <td class=\"";
                // line 64
                echo (((twig_get_attribute($this->env, $this->source, $context["requirement"], "isMissing", [], "method", false, false, false, 64) &&  !twig_get_attribute($this->env, $this->source, $context["requirement"], "isOptional", [], "method", false, false, false, 64))) ? ("red") : (""));
                echo "\">
                  <span data-bs-toggle=\"popover\"
                        data-bs-placement=\"right\"
                        data-bs-html=\"true\"
                        data-bs-custom-class=\"validation-messages\"
                        data-bs-content=\"";
                // line 69
                echo twig_escape_filter($this->env, twig_join_filter(twig_get_attribute($this->env, $this->source, $context["requirement"], "getValidationMessages", [], "method", false, false, false, 69), "<br />"), "html", null, true);
                echo "\">
                     <i class=\"";
                // line 70
                echo ((twig_get_attribute($this->env, $this->source, $context["requirement"], "isValidated", [], "method", false, false, false, 70)) ? ("fas fa-check") : (((twig_get_attribute($this->env, $this->source, $context["requirement"], "isOptional", [], "method", false, false, false, 70)) ? ("fas fa-exclamation-triangle") : ("ti ti-x"))));
                echo "\"></i>
                  </span>
               </td>
            </tr>
         ";
            }
            // line 75
            echo "      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['requirement'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "   </tbody>
</table>
";
    }

    public function getTemplateName()
    {
        return "install/blocks/requirements_table.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  150 => 76,  144 => 75,  136 => 70,  132 => 69,  124 => 64,  121 => 63,  118 => 62,  108 => 60,  105 => 59,  100 => 58,  97 => 57,  92 => 55,  89 => 54,  86 => 53,  84 => 52,  79 => 51,  73 => 49,  67 => 47,  65 => 46,  61 => 44,  58 => 43,  54 => 42,  47 => 38,  43 => 37,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "install/blocks/requirements_table.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\install\\blocks\\requirements_table.html.twig");
    }
}
