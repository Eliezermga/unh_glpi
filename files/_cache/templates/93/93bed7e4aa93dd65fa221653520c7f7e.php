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

/* install/step8.html.twig */
class __TwigTemplate_4f8489962a1261734689c821fc76d4cb extends Template
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
<h2>";
        // line 34
        echo twig_escape_filter($this->env, __("The installation is finished"), "html", null, true);
        echo "</h2>

<p>
   ";
        // line 37
        echo twig_escape_filter($this->env, __("Default logins / passwords are:"), "html", null, true);
        echo "
</p>

<p>
   <ul>
      <li>";
        // line 42
        echo twig_escape_filter($this->env, __("glpi/glpi for the administrator account"), "html", null, true);
        echo "</li>
      <li>";
        // line 43
        echo twig_escape_filter($this->env, __("tech/tech for the technician account"), "html", null, true);
        echo "</li>
      <li>";
        // line 44
        echo twig_escape_filter($this->env, __("normal/normal for the normal account"), "html", null, true);
        echo "</li>
      <li>";
        // line 45
        echo twig_escape_filter($this->env, __("post-only/postonly for the postonly account"), "html", null, true);
        echo "</li>
   </ul>
</p>

<p>
   ";
        // line 50
        echo twig_escape_filter($this->env, __("You can delete or modify these accounts as well as the initial data."), "html", null, true);
        echo "
</p>

<p class=\"center\">
   <a class=\"btn btn-primary\" href=\"../index.php\">
      <i class=\"fas fa-thumbs-up me-1\"></i>
      ";
        // line 56
        echo twig_escape_filter($this->env, __("Use GLPI"), "html", null, true);
        echo "
   </a>
</p>
";
    }

    public function getTemplateName()
    {
        return "install/step8.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 56,  74 => 50,  66 => 45,  62 => 44,  58 => 43,  54 => 42,  46 => 37,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "install/step8.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\install\\step8.html.twig");
    }
}
