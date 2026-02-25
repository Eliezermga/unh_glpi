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

/* components/form/inventory_info.html.twig */
class __TwigTemplate_460496478bc11e0bcd210743614cef15 extends Template
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
        if ((Session::haveRight("inventory", twig_constant("READ")) && (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isDynamic", [], "method", false, false, false, 34) != false))) {
            // line 35
            echo "<div class=\"card m-n2 border-0 shadow-none\">
   <div class=\"card-header\">
      <div class=\"ribbon ribbon-bookmark ribbon-top ribbon-start bg-blue s-1\">
         <i class=\"fas fa-cloud-download-alt\"></i>
      </div>
      <h4 class=\"card-title ps-4\">
         ";
            // line 41
            echo twig_escape_filter($this->env, __("Inventory information"), "html", null, true);
            echo "
      </h4>
      ";
            // line 43
            $context["inventory_filename"] = (($this->extensions['Glpi\Application\View\Extension\PhpExtension']->isUsingTrait(($context["item"] ?? null), "Glpi\\Features\\Inventoriable")) ? (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getInventoryFileName", [0 => false], "method", false, false, false, 43)) : (null));
            // line 44
            echo "      ";
            if ( !(null === ($context["inventory_filename"] ?? null))) {
                // line 45
                echo "         <a href=\"";
                echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path(("front/document.send.php?file=_inventory/" . ($context["inventory_filename"] ?? null))), "html", null, true);
                echo "\"
            class=\"btn btn-sm btn-secondary ms-auto\" target=\"_blank\"
            data-bs-toggle=\"tooltip\" data-bs-placement=\"right\"
            title=\"";
                // line 48
                echo twig_escape_filter($this->env, twig_sprintf(__("Download \"%1\$s\" inventory file"), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemName(($context["item"] ?? null))), "html", null, true);
                echo "\">
            <i class=\"fas fa-download\"></i>
         </a>
      ";
            } else {
                // line 52
                echo "         <span class=\"ms-auto\" title=\"";
                echo twig_escape_filter($this->env, __("Inventory file missing"), "html", null, true);
                echo "\">
            <i class=\"fas fa-ban\"></i>
            <span class=\"visually-hidden\">";
                // line 54
                echo twig_escape_filter($this->env, __("Inventory file missing"), "html", null, true);
                echo "</span>
         </span>
      ";
            }
            // line 57
            echo "   </div>
   ";
            // line 58
            $context["agent"] = (($this->extensions['Glpi\Application\View\Extension\PhpExtension']->isUsingTrait(($context["item"] ?? null), "Glpi\\Features\\Inventoriable")) ? (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getInventoryAgent", [], "method", false, false, false, 58)) : (null));
            // line 59
            echo "   ";
            if ( !(null === ($context["agent"] ?? null))) {
                // line 60
                echo "      <div class=\"card-body row\">
         <div class=\"mb-3 col-12 col-sm-6\">
            <label class=\"form-label\" >";
                // line 62
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["agent"] ?? null), "getTypeName", [], "method", false, false, false, 62), "html", null, true);
                echo "</label>
            <span>
               <i class=\"";
                // line 64
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["agent"] ?? null), "getIcon", [], "method", false, false, false, 64), "html", null, true);
                echo "\"></i>
               ";
                // line 65
                echo $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemLink(($context["agent"] ?? null));
                echo "
            </span>
         </div>

         <div class=\"mb-3 col-12 col-sm-6\">
            <label class=\"form-label\" >";
                // line 70
                echo twig_escape_filter($this->env, __("Useragent"), "html", null, true);
                echo "</label>
            <span>";
                // line 71
                echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue((($__internal_compile_0 = twig_get_attribute($this->env, $this->source, ($context["agent"] ?? null), "fields", [], "any", false, false, false, 71)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["useragent"] ?? null) : null)), "html", null, true);
                echo "</span>
         </div>

         <div class=\"mb-3 col-12 col-sm-6\">
            <label class=\"form-label\" >";
                // line 75
                echo twig_escape_filter($this->env, __("Inventory tag"), "html", null, true);
                echo "</label>
            <span>";
                // line 76
                echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue((($__internal_compile_1 = twig_get_attribute($this->env, $this->source, ($context["agent"] ?? null), "fields", [], "any", false, false, false, 76)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["tag"] ?? null) : null)), "html", null, true);
                echo "</span>
         </div>

         <div class=\"mb-3 col-12 col-sm-6\">
            <label class=\"form-label\" >";
                // line 80
                echo twig_escape_filter($this->env, __("Last inventory"), "html", null, true);
                echo "</label>
            <span>";
                // line 81
                echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedDatetime((($__internal_compile_2 = twig_get_attribute($this->env, $this->source, ($context["agent"] ?? null), "fields", [], "any", false, false, false, 81)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["last_contact"] ?? null) : null)), "html", null, true);
                echo "</span>
         </div>

         <div class=\"mb-3 col-12 col-sm-6\">
            <label class=\"form-label\" >";
                // line 85
                echo twig_escape_filter($this->env, __("Public contact address"), "html", null, true);
                echo "</label>
            <span>";
                // line 86
                echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue((($__internal_compile_3 = twig_get_attribute($this->env, $this->source, ($context["agent"] ?? null), "fields", [], "any", false, false, false, 86)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["remote_addr"] ?? null) : null)), "html", null, true);
                echo "</span>
         </div>


         <div class=\"mb-3 col-12 col-sm-6\">
         </div>

         <div class=\"mb-3 col-12 col-sm-6\">
            <label class=\"form-label\" >
               ";
                // line 95
                echo twig_escape_filter($this->env, __("Agent status"), "html", null, true);
                echo "
               <i id=\"update-status\" class=\"fas fa-sync\" role=\"button\" title=\"";
                // line 96
                echo twig_escape_filter($this->env, __("Ask agent about its current status"), "html", null, true);
                echo "\"></i>
            </label>
            <span id='agent_status'>";
                // line 98
                echo twig_escape_filter($this->env, __("Unknown"), "html", null, true);
                echo "</span>
         </div>

         <div class=\"mb-3 col-12 col-sm-6\">
            <label class=\"form-label\" >
               ";
                // line 103
                echo twig_escape_filter($this->env, __("Request inventory"), "html", null, true);
                echo "
               <i id=\"update-inventory\" class=\"fas fa-sync\" role=\"button\" title=\"";
                // line 104
                echo twig_escape_filter($this->env, __("Request agent to proceed an new inventory"), "html", null, true);
                echo "\"></i>
            </label>
            <span id='inventory_status'>";
                // line 106
                echo twig_escape_filter($this->env, __("Unknown"), "html", null, true);
                echo "</span>
         </div>
      </div>

      <script>
      \$(function () {
         \$('#update-status').on('click', function() {
            var icon = \$(this);
            icon.addClass('fa-spin');
            \$.ajax({
               type: 'POST',
               url: '";
                // line 117
                echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("/ajax/agent.php"), "html", null, true);
                echo "',
               timeout: 30000, // 30 seconds timeout
               dataType: 'json',
               data: {
                  action: '";
                // line 121
                echo twig_escape_filter($this->env, twig_constant("Agent::ACTION_STATUS"), "html", null, true);
                echo "',
                  id: '";
                // line 122
                echo twig_escape_filter($this->env, (($__internal_compile_4 = twig_get_attribute($this->env, $this->source, ($context["agent"] ?? null), "fields", [], "any", false, false, false, 122)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["id"] ?? null) : null), "html", null, true);
                echo "'
               },
               success: function(json) {
                  \$('#agent_status').html(json.answer);
               },
               complete: function() {
                  icon.removeClass('fa-spin');
               }
            });
         });

         \$('#update-inventory').on('click', function() {
            var icon = \$(this);
            icon.addClass(\"fa-spin\");
            \$.ajax({
               type: 'POST',
               url: '";
                // line 138
                echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("/ajax/agent.php"), "html", null, true);
                echo "',
               timeout: 30000, // 30 seconds timeout
               dataType: 'json',
               data: {
                  action: '";
                // line 142
                echo twig_escape_filter($this->env, twig_constant("Agent::ACTION_INVENTORY"), "html", null, true);
                echo "',
                  id: '";
                // line 143
                echo twig_escape_filter($this->env, (($__internal_compile_5 = twig_get_attribute($this->env, $this->source, ($context["agent"] ?? null), "fields", [], "any", false, false, false, 143)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["id"] ?? null) : null), "html", null, true);
                echo "'
               },
               success: function(json) {
                  \$('#inventory_status').html(json.answer);
               },
               complete: function() {
                  icon.removeClass('fa-spin');
               }
            });
         });
      });
      </script>
   ";
            } else {
                // line 156
                echo "   <div class=\"card-body row\">
      <div class=\"mb-3 col-12 col-sm-6\">
         ";
                // line 158
                echo twig_escape_filter($this->env, __("Agent information is not available."), "html", null, true);
                echo "
      </div>
   </div>
   ";
            }
            // line 162
            echo "
   ";
            // line 164
            echo "   ";
            // line 165
            echo "   ";
            if ((($this->extensions['Glpi\Application\View\Extension\PhpExtension']->isUsingTrait(($context["item"] ?? null), "Glpi\\Features\\Inventoriable") && (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getInventoryAgent", [], "method", false, false, false, 165) == null)) && twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "last_inventory_update"], "method", false, false, false, 165))) {
                // line 166
                echo "      <div class=\"card-body row\">
         <div class=\"mb-3 col-12 col-sm-6\">
            <label class=\"form-label\" >";
                // line 168
                echo twig_escape_filter($this->env, __("Last inventory"), "html", null, true);
                echo "</label>
            <span>";
                // line 169
                echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getFormattedDatetime((($__internal_compile_6 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 169)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["last_inventory_update"] ?? null) : null)), "html", null, true);
                echo "</span>
         </div>
      </div>
   ";
            }
            // line 173
            echo "
   ";
            // line 174
            if ((((($__internal_compile_7 = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 174)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["id"] ?? null) : null) > 0) && twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isField", [0 => "is_dynamic"], "method", false, false, false, 174))) {
                // line 175
                echo "      ";
                echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook(twig_constant("Glpi\\Plugin\\Hooks::AUTOINVENTORY_INFORMATION"), ($context["item"] ?? null)), "html", null, true);
                echo "
   ";
            }
            // line 177
            echo "</div>
";
        }
    }

    public function getTemplateName()
    {
        return "components/form/inventory_info.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  306 => 177,  300 => 175,  298 => 174,  295 => 173,  288 => 169,  284 => 168,  280 => 166,  277 => 165,  275 => 164,  272 => 162,  265 => 158,  261 => 156,  245 => 143,  241 => 142,  234 => 138,  215 => 122,  211 => 121,  204 => 117,  190 => 106,  185 => 104,  181 => 103,  173 => 98,  168 => 96,  164 => 95,  152 => 86,  148 => 85,  141 => 81,  137 => 80,  130 => 76,  126 => 75,  119 => 71,  115 => 70,  107 => 65,  103 => 64,  98 => 62,  94 => 60,  91 => 59,  89 => 58,  86 => 57,  80 => 54,  74 => 52,  67 => 48,  60 => 45,  57 => 44,  55 => 43,  50 => 41,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/form/inventory_info.html.twig", "C:\\xampp1\\htdocs\\unh_glpi\\templates\\components\\form\\inventory_info.html.twig");
    }
}
