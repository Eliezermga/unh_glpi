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

/* pages/login_error.html.twig */
class __TwigTemplate_2520c1e0533649552f4eca1690e7d3e2 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content_block' => [$this, 'block_content_block'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 34
        return "layout/page_card_notlogged.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout/page_card_notlogged.html.twig", "pages/login_error.html.twig", 34);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 36
    public function block_content_block($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 37
        echo "<div class=\"alert alert-warning\">
    <div class=\"d-flex align-items-center\">
        <div class=\"me-4\">
            <i class=\"ti ti-alert-triangle fa-2x\"></i>
        </div>
        <div>
            <h4 class=\"alert-title\">
                ";
        // line 44
        echo twig_escape_filter($this->env, __("Error"), "html", null, true);
        echo "
            </h4>
            <div>
                ";
        // line 47
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["errors"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
            // line 48
            echo "                    ";
            echo twig_escape_filter($this->env, $context["error"], "html", null, true);
            echo "<br />
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "            </div>

            <a href=\"";
        // line 52
        echo twig_escape_filter($this->env, ($context["login_url"] ?? null), "html", null, true);
        echo "\" class=\"btn btn-primary mt-3\">
                <i class=\"ti ti-login\"></i>
                <span>";
        // line 54
        echo twig_escape_filter($this->env, __("Log in again"), "html", null, true);
        echo "</span>
            </a>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "pages/login_error.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 54,  82 => 52,  78 => 50,  69 => 48,  65 => 47,  59 => 44,  50 => 37,  46 => 36,  35 => 34,);
    }

    public function getSourceContext()
    {
        return new Source("", "pages/login_error.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\pages\\login_error.html.twig");
    }
}
