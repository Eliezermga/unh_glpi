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

/* components/itilobject/timeline/new_form.html.twig */
class __TwigTemplate_631020b7c6fc7f32831e5fa2fe1a660f extends Template
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
        $context["users_id"] = $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiID");
        // line 35
        echo "
<div class=\"itil-timeline\">
   <div class=\"timeline-item ITILContent\">
      <div class=\"row\">
         <div class=\"col-auto d-flex flex-column picture-block\">
            ";
        // line 40
        echo twig_include($this->env, $context, "components/user/picture.html.twig", ["users_id" => ($context["users_id"] ?? null)], false);
        echo "
         </div>
         <div class=\"col-12 col-sm content-block\">
            <div class=\"d-flex\">
               <div class=\"d-none d-md-block\">
                  <strong>";
        // line 45
        echo $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemLink("User", ($context["users_id"] ?? null));
        echo "</strong>
               </div>
            </div>
            <span class=\"mt-2 timeline-content left card\">
               <div class=\"card-body\">
                  ";
        // line 50
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 50)) {
            // line 51
            echo "                     <div class=\"alert alert-info\" role=\"alert\">
                        ";
            // line 52
            ob_start(function () { return ''; });
            // line 53
            echo "                           <span class=\"ms-1\">
                              ";
            // line 54
            echo $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Entity::badgeCompletenameById", [0 => (($__internal_compile_0 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 54)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["entities_id"] ?? null) : null)]);
            echo "
                           </span>
                        ";
            $context["entitybadge"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 57
            echo "
                        ";
            // line 58
            echo twig_sprintf(__("%1\$s will be added in entity %2\$s"), twig_get_attribute($this->env, $this->source,             // line 59
($context["item"] ?? null), "getTypeName", [0 => 1], "method", false, false, false, 59),             // line 60
($context["entitybadge"] ?? null));
            // line 61
            echo "
                     </div>
                  ";
        }
        // line 64
        echo "
                  ";
        // line 65
        echo twig_include($this->env, $context, "components/itilobject/timeline/simple_form.html.twig", ["no_form" => true]);
        // line 67
        echo "
               </div>
            </span>
         </div>
      </div>
   </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "components/itilobject/timeline/new_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  98 => 67,  96 => 65,  93 => 64,  88 => 61,  86 => 60,  85 => 59,  84 => 58,  81 => 57,  75 => 54,  72 => 53,  70 => 52,  67 => 51,  65 => 50,  57 => 45,  49 => 40,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/timeline/new_form.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\components\\itilobject\\timeline\\new_form.html.twig");
    }
}
