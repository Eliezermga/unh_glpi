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

/* install/accept_license.html.twig */
class __TwigTemplate_b90daa4845310b0417e62f41ac76471f extends Template
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
<div class=\"container text-center license-container\">
    <textarea id=\"license\" style=\"height:250px\" readonly=\"readonly\" class=\"form-control\">";
        // line 35
        echo twig_escape_filter($this->env, ($context["copying"] ?? null), "html", null, true);
        echo "</textarea>

    <p>
        <a class=\"btn btn-sm btn-info\" target=\"_blank\" href=\"https://www.gnu.org/licenses/translations.html\">
            <i class=\"fas fa-external-link-alt me-1\"></i>
            ";
        // line 40
        echo twig_escape_filter($this->env, __("Unofficial translations are also available"), "html", null, true);
        echo "
        </a>
    </p>

    <form action=\"install.php\" method=\"post\" data-submit-once>
        <input type=\"hidden\" name=\"install\" value=\"License\" />

        <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">
            ";
        // line 48
        echo twig_escape_filter($this->env, __("Continue"), "html", null, true);
        echo "
            <i class=\"fas fa-chevron-right ms-1\"></i>
        </button>

        <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
        // line 52
        echo twig_escape_filter($this->env, Session::getNewCSRFToken(), "html", null, true);
        echo "\">
    </form>
</div>
";
    }

    public function getTemplateName()
    {
        return "install/accept_license.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 52,  60 => 48,  49 => 40,  41 => 35,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "install/accept_license.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\install\\accept_license.html.twig");
    }
}
