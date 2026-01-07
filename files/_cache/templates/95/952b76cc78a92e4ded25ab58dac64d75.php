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

/* layout/parts/global_search_form.html.twig */
class __TwigTemplate_e2bb543d58bc559a8fa9494afc62ef16 extends Template
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
        if (($this->extensions['Glpi\Application\View\Extension\SessionExtension']->getCurrentInterface() == "central")) {
            // line 35
            echo "<form action=\"";
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("front/search.php"), "html", null, true);
            echo "\" role=\"search\" method=\"get\" data-submit-once>
   <div class=\"input-group input-group-flat\">
      <input type\"text\" class=\"form-control\" name=\"globalsearch\" placeholder=\"";
            // line 37
            echo twig_escape_filter($this->env, __("Search…"), "html", null, true);
            echo "\" />
      <span class=\"input-group-text\">
         <button type=\"submit\" class=\"btn btn-link p-0 m-0\" title=\"";
            // line 39
            echo twig_escape_filter($this->env, __("Search…"), "html", null, true);
            echo "\">
            <span class=\"ti ti-search\" aria-hidden=\"true\"></span>
         </button>
      </span>
   </div>
</form>
";
        }
    }

    public function getTemplateName()
    {
        return "layout/parts/global_search_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 39,  48 => 37,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "layout/parts/global_search_form.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\layout\\parts\\global_search_form.html.twig");
    }
}
