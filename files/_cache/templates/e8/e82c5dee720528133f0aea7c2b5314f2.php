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

/* install/step1.html.twig */
class __TwigTemplate_fdb90a73a7504f177fdd788899a92ec2 extends Template
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
<h3>";
        // line 34
        echo twig_escape_filter($this->env, __("Checking of the compatibility of your environment with the execution of GLPI"), "html", null, true);
        echo "</h3>

";
        // line 36
        echo twig_include($this->env, $context, "install/blocks/requirements_table.html.twig", ["requirements" => ($context["requirements"] ?? null)], false);
        echo "

";
        // line 38
        ob_start(function () { return ''; });
        // line 39
        echo "   <input type=\"hidden\" name=\"language\" value=\"";
        echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpilanguage"), "html", null, true);
        echo "\">
   <input type=\"hidden\" name=\"update\" value=\"";
        // line 40
        echo twig_escape_filter($this->env, ($context["update"] ?? null), "html", null, true);
        echo "\">
   <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
        // line 41
        echo twig_escape_filter($this->env, Session::getNewCSRFToken(), "html", null, true);
        echo "\">
";
        $context["common_hiddens"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 43
        echo "
";
        // line 44
        ob_start(function () { return ''; });
        // line 45
        echo "   <form action=\"install.php\" method=\"post\" class=\"d-inline\" data-submit-once>
      <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">
         ";
        // line 47
        echo twig_escape_filter($this->env, __("Continue"), "html", null, true);
        echo "
         <i class=\"fas fa-chevron-right ms-1\"></i>
      </button>

      <input type=\"hidden\" name=\"install\" value=\"Etape_1\">
      ";
        // line 52
        echo twig_escape_filter($this->env, ($context["common_hiddens"] ?? null), "html", null, true);
        echo "
   </form>
";
        $context["continue_form"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 55
        echo "
";
        // line 56
        ob_start(function () { return ''; });
        // line 57
        echo "   <form action=\"install.php\" method=\"post\" class=\"d-inline\" data-submit-once>
      <button type=\"submit\" name=\"submit\" class=\"btn btn-warning\">
         ";
        // line 59
        echo twig_escape_filter($this->env, __("Try again"), "html", null, true);
        echo "
         <i class=\"fas fa-redo ms-1\"></i>
      </button>

      <input type=\"hidden\" name=\"install\" value=\"Etape_0\">
      ";
        // line 64
        echo twig_escape_filter($this->env, ($context["common_hiddens"] ?? null), "html", null, true);
        echo "
   </form>
";
        $context["retry_form"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 67
        echo "
";
        // line 68
        if (twig_get_attribute($this->env, $this->source, ($context["requirements"] ?? null), "hasMissingMandatoryRequirements", [], "method", false, false, false, 68)) {
            // line 69
            echo "   <h3>";
            echo twig_escape_filter($this->env, __("Do you want to continue?"), "html", null, true);
            echo "</h3>
   <div class=\"text-center\">
      ";
            // line 71
            echo twig_escape_filter($this->env, ($context["retry_form"] ?? null), "html", null, true);
            echo "
   </div>
";
        } elseif (twig_get_attribute($this->env, $this->source,         // line 73
($context["requirements"] ?? null), "hasMissingOptionalRequirements", [], "method", false, false, false, 73)) {
            // line 74
            echo "   <h3>";
            echo twig_escape_filter($this->env, __("Do you want to continue?"), "html", null, true);
            echo "</h3>
   <div class=\"text-center\">
      ";
            // line 76
            echo twig_escape_filter($this->env, ($context["continue_form"] ?? null), "html", null, true);
            echo "
      ";
            // line 77
            echo twig_escape_filter($this->env, ($context["retry_form"] ?? null), "html", null, true);
            echo "
   </div>
";
        } else {
            // line 80
            echo "   <div class=\"text-center\">
      ";
            // line 81
            echo twig_escape_filter($this->env, ($context["continue_form"] ?? null), "html", null, true);
            echo "
   </div>
";
        }
    }

    public function getTemplateName()
    {
        return "install/step1.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  149 => 81,  146 => 80,  140 => 77,  136 => 76,  130 => 74,  128 => 73,  123 => 71,  117 => 69,  115 => 68,  112 => 67,  106 => 64,  98 => 59,  94 => 57,  92 => 56,  89 => 55,  83 => 52,  75 => 47,  71 => 45,  69 => 44,  66 => 43,  61 => 41,  57 => 40,  52 => 39,  50 => 38,  45 => 36,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "install/step1.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\install\\step1.html.twig");
    }
}
