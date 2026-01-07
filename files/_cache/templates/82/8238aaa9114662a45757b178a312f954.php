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

/* install/step0.html.twig */
class __TwigTemplate_6cd2fce88824850ba8844b28d9fea13d extends Template
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
        $macros["alerts"] = $this->macros["alerts"] = $this->loadTemplate("components/alerts_macros.html.twig", "install/step0.html.twig", 34)->unwrap();
        // line 35
        echo "
<div class=\"container text-center\">
   <div class=\"text-start\">
      ";
        // line 38
        ob_start(function () { return ''; });
        // line 39
        echo "         ";
        echo twig_escape_filter($this->env, __("Choose 'Install' for a completely new installation of GLPI."), "html", null, true);
        echo "<br>
         ";
        // line 40
        echo twig_escape_filter($this->env, __("Select 'Upgrade' to update your version of GLPI from an earlier version"), "html", null, true);
        echo "
      ";
        $context["alert_messages"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 42
        echo "
      ";
        // line 43
        echo twig_call_macro($macros["alerts"], "macro_alert_info", [__("Installation or update of GLPI"),         // line 45
($context["alert_messages"] ?? null)], 43, $context, $this->getSourceContext());
        // line 46
        echo "
   </div>

   <form action=\"install.php\" method=\"post\" class=\"d-inline\" data-submit-once>
      <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">
         ";
        // line 51
        echo twig_escape_filter($this->env, _x("button", "Install"), "html", null, true);
        echo "
         <i class=\"fas fa-download ms-1\"></i>
      </button>

      <input type=\"hidden\" name=\"update\" value=\"no\">
      <input type=\"hidden\" name=\"install\" value=\"Etape_0\">
      <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
        // line 57
        echo twig_escape_filter($this->env, Session::getNewCSRFToken(), "html", null, true);
        echo "\">
   </form>

   <form action=\"install.php\" method=\"post\" class=\"d-inline\" data-submit-once>
      <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">
         ";
        // line 62
        echo twig_escape_filter($this->env, _x("button", "Upgrade"), "html", null, true);
        echo "
         <i class=\"fas fa-caret-square-up ms-1\"></i>
      </button>

      <input type=\"hidden\" name=\"update\" value=\"yes\">
      <input type=\"hidden\" name=\"install\" value=\"Etape_0\">
      <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
        // line 68
        echo twig_escape_filter($this->env, Session::getNewCSRFToken(), "html", null, true);
        echo "\">
   </form>
</div>
";
    }

    public function getTemplateName()
    {
        return "install/step0.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  98 => 68,  89 => 62,  81 => 57,  72 => 51,  65 => 46,  63 => 45,  62 => 43,  59 => 42,  54 => 40,  49 => 39,  47 => 38,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "install/step0.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\install\\step0.html.twig");
    }
}
