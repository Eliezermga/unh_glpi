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

/* components/form/single-action.html.twig */
class __TwigTemplate_d9d40f3b2d46d6d51ef2b55f729d6d97 extends Template
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
        if ( !array_key_exists("onlyicon", $context)) {
            // line 35
            echo "   ";
            $context["onlyicon"] = false;
        }
        // line 37
        echo "
";
        // line 38
        if (( !twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 38) && $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call((twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 38) . "::isMassiveActionAllowed"), [0 => (($__internal_compile_0 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 38)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["id"] ?? null) : null)]))) {
            // line 39
            echo "   ";
            $context["input"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getMassiveActionsForItem", [], "method", false, false, false, 39), "getInput", [], "method", false, false, false, 39);
            // line 40
            echo "   ";
            if ((twig_length_filter($this->env, (($__internal_compile_1 = ($context["input"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["actions"] ?? null) : null)) > 0)) {
                // line 41
                echo "   ";
                $context["ms_auto"] = ((($context["single_actions_ms_auto"] ?? null)) ? ("ms-auto") : (""));
                // line 42
                echo "<div class=\"d-none d-sm-block btn-group ";
                echo twig_escape_filter($this->env, ($context["ms_auto"] ?? null), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, __("Actions"), "html", null, true);
                echo "\"
     ";
                // line 43
                if (($context["onlyicon"] ?? null)) {
                    echo "data-bs-toggle=\"tooltip\" data-bs-placement=\"top\"";
                }
                echo ">
   <button class=\"btn ";
                // line 44
                echo ((($context["onlyicon"] ?? null)) ? ("btn-icon") : ("dropdown-toggle"));
                echo " btn-outline-secondary\" type=\"button\"
           id=\"single-action\" data-bs-toggle=\"dropdown\" aria-haspopup=\"true\"
           aria-expanded=\"false\">
      <i class=\"ti ti-dots-vertical\"></i>
      ";
                // line 48
                if ( !($context["onlyicon"] ?? null)) {
                    // line 49
                    echo "         <span>";
                    echo twig_escape_filter($this->env, __("Actions"), "html", null, true);
                    echo "</span>
      ";
                }
                // line 51
                echo "   </button>

   <div id=\"single-ma-action-menu\" class=\"dropdown-menu dropdown-menu-end dropdown-menu-arrow mt-2\" aria-labelledby=\"single-action\">
      ";
                // line 54
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((($__internal_compile_2 = ($context["input"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["actions"] ?? null) : null));
                foreach ($context['_seq'] as $context["key"] => $context["action"]) {
                    // line 55
                    echo "         <a class=\"dropdown-item\" data-action=\"";
                    echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                    echo "\" href=\"#\">";
                    echo $context["action"];
                    echo "</a>
      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['action'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 57
                echo "   </div>
</div>
<script>
\$(function () {
   var ma = ";
                // line 61
                echo json_encode(($context["input"] ?? null));
                echo ";

   \$(document).on('click', '#single-ma-action-menu .moreactions', function () {
      \$('.moreactions + .dropdown-menu').toggle();
   });

   \$(document).on('click', function (event) {
      var target = \$(event.target);
      var parent = target.parent();

      if (!target.hasClass('moreactions')
         && !parent.hasClass('moreactions')) {
         \$('.moreactions + .dropdown-menu').hide();
      }
   });

   \$(document).on('click', '#single-ma-action-menu [data-action]', function () {
      \$('.moreactions + .dropdown-menu').hide();

      var current_action = \$(this).data('action');

      glpi_ajax_dialog({
         url: '";
                // line 83
                echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("/ajax/dropdownMassiveAction.php"), "html", null, true);
                echo "',
         title: ma.actions[current_action],
         params: Object.assign(
            { action: current_action },
            ma
         ),
         appendTo: '#massive_container_";
                // line 89
                echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
                echo "',
      });
   });
});
</script>
   ";
            }
        }
    }

    public function getTemplateName()
    {
        return "components/form/single-action.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  148 => 89,  139 => 83,  114 => 61,  108 => 57,  97 => 55,  93 => 54,  88 => 51,  82 => 49,  80 => 48,  73 => 44,  67 => 43,  60 => 42,  57 => 41,  54 => 40,  51 => 39,  49 => 38,  46 => 37,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/form/single-action.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\components\\form\\single-action.html.twig");
    }
}
