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

/* layout/parts/page_header_empty.html.twig */
class __TwigTemplate_ada835835c2fd4cb8610cf43623114c6 extends Template
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
<body class=\"horizontal-layout\">
   ";
        // line 35
        if ((twig_constant_is_defined("SKIP_UPDATES") && ($this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Update::isDbUpToDate") == false))) {
            // line 36
            echo "      <div class=\"banner-need-update\">
         ";
            // line 37
            echo twig_escape_filter($this->env, __("You are bypassing a needed update"), "html", null, true);
            echo "
      </div>
   ";
        }
        // line 40
        echo "   <div class=\"page\">

      <header class=\"navbar d-print-none sticky-lg-top shadow-sm topbar\">
         <div class=\"container-fluid\">
            <a href=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->indexPath(), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, __("Home"), "html", null, true);
        echo "\" class=\"navbar-brand\">
               <span class=\"glpi-logo\"></span>
            </a>
         </div>
      </header>

      <div class=\"page-wrapper mb-0\">
         <div class=\"page-body container-fluid\">
            <main role=\"main\" id=\"page\" class=\"legacy\">
";
    }

    public function getTemplateName()
    {
        return "layout/parts/page_header_empty.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 44,  52 => 40,  46 => 37,  43 => 36,  41 => 35,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "layout/parts/page_header_empty.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\layout\\parts\\page_header_empty.html.twig");
    }
}
