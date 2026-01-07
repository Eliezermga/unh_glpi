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

/* layout/parts/impersonate_banner.html.twig */
class __TwigTemplate_a956520e3d3e81c0a803b99cf3a3c1eb extends Template
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
        if (($context["is_impersonate_active"] ?? null)) {
            // line 35
            echo "<div class=\"banner-impersonate\">
   <form name=\"form\" method=\"post\" action=\"";
            // line 36
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeFormPath("User"), "html", null, true);
            echo "\" data-submit-once>
      ";
            // line 37
            echo twig_escape_filter($this->env, twig_sprintf(__("You are impersonating %s."), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemName(($context["user"] ?? null))), "html", null, true);
            echo "
      <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
            // line 38
            echo twig_escape_filter($this->env, Session::getNewCSRFToken(), "html", null, true);
            echo "\" />
      <button type=\"submit\" name=\"impersonate\" class=\"btn btn-outline-danger\" value=\"0\">
         ";
            // line 40
            echo twig_escape_filter($this->env, __("Stop impersonating"), "html", null, true);
            echo "
      </button>
   </form>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "layout/parts/impersonate_banner.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 40,  53 => 38,  49 => 37,  45 => 36,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "layout/parts/impersonate_banner.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\layout\\parts\\impersonate_banner.html.twig");
    }
}
