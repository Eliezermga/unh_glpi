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

/* components/itilobject/add_items.html.twig */
class __TwigTemplate_18e271f2c6ea4b02ef7801944b9abb32 extends Template
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
<div id=\"itemAddForm";
        // line 34
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "\">
   ";
        // line 35
        if (($context["can_edit"] ?? null)) {
            // line 36
            echo "      ";
            echo ($context["my_items_dropdown"] ?? null);
            echo "
      ";
            // line 37
            echo ($context["all_items_dropdown"] ?? null);
            echo "
      <a href=\"javascript:itemAction";
            // line 38
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "('add');\" class=\"btn btn-sm btn-outline-secondary\">
         <i class=\"fas fa-plus\"></i>
         <span>";
            // line 40
            echo twig_escape_filter($this->env, _x("button", "Add"), "html", null, true);
            echo "</span>
      </a>
   ";
        }
        // line 43
        echo "
   ";
        // line 44
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["items_to_add"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item_to_add"]) {
            // line 45
            echo "      ";
            echo $context["item_to_add"];
            echo "
   ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item_to_add'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 47
        echo "
   ";
        // line 48
        if ((($context["count"] ?? null) == 0)) {
            // line 49
            echo "      <input type=\"hidden\" value=\"0\" name=\"items_id\">
   ";
        }
        // line 51
        echo "
   ";
        // line 52
        if (((twig_get_attribute($this->env, $this->source, ($context["params"] ?? null), "id", [], "any", false, false, false, 52) > 0) && (($context["usedcount"] ?? null) != ($context["count"] ?? null)))) {
            // line 53
            echo "      <i>";
            echo twig_escape_filter($this->env, twig_sprintf(_n("%1\$s item not saved", "%1\$s items not saved", (($context["count"] ?? null) - ($context["usedcount"] ?? null))), (($context["count"] ?? null) - ($context["usedcount"] ?? null))), "html", null, true);
            echo "</i>
   ";
        }
        // line 55
        echo "   ";
        if (((twig_get_attribute($this->env, $this->source, ($context["params"] ?? null), "id", [], "any", false, false, false, 55) > 0) && (($context["usedcount"] ?? null) > 5))) {
            // line 56
            echo "      <i><a href=\"";
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeFormPath("Ticket", twig_get_attribute($this->env, $this->source, ($context["params"] ?? null), "id", [], "any", false, false, false, 56)), "html", null, true);
            echo "&amp;forcetab=Item_Ticket\$1\">";
            echo twig_escape_filter($this->env, (((__("Display all items") . "(") . ($context["usedcount"] ?? null)) . ")"), "html", null, true);
            echo "</a></i>
   ";
        }
        // line 58
        echo "   <script>
      function refreshItemCounter";
        // line 59
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "() {
         const item_form = \$(\"#itemAddForm";
        // line 60
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "\");
         let item_count = item_form.find('input[type=\"hidden\"][name^=\"items_id[\"]').length;
         item_form.closest('.accordion-item').find('.item-counter').text(item_count);
      }

      function itemAction";
        // line 65
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "(action, itemtype, items_id) {
          if (itemtype === undefined && items_id === undefined) {
              const my_items_dropdown = \$('#dropdown_my_items";
        // line 67
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "');
              if (my_items_dropdown.length > 0) {
                 const val = my_items_dropdown.val();
                 if (val && val.includes('_')) {
                    itemtype = val.split('_')[0];
                    items_id = val.split('_')[1];
                 }
              }
              if (itemtype === undefined && items_id === undefined) {
                  const dropdown_itemtype = \$('#dropdown_itemtype";
        // line 76
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "');
                  const dropdown_items_id = \$('#dropdown_add_items_id";
        // line 77
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "');
                  if (dropdown_itemtype.length > 0 && dropdown_items_id.length > 0) {
                      itemtype = dropdown_itemtype.val();
                      items_id = dropdown_items_id.val();
                  }
              }
          }
         if (!itemtype || !items_id) {
            glpi_toast_error(__('Please select an item to add'));
            return;
         }
         \$.ajax({
            url: CFG_GLPI.root_doc + '/ajax/itemTicket.php',
            dataType: 'html',
            data: {
               'action': action,
               'rand': ";
        // line 93
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo ",
               'params': ";
        // line 94
        echo json_encode(($context["opt"] ?? null));
        echo ",
               'my_items': \$('#dropdown_my_items";
        // line 95
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "').val(),
               'itemtype': itemtype,
               'items_id': items_id,
            },
            success: function(response) {
               \$(\"#itemAddForm";
        // line 100
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "\").replaceWith(response);
            }
         });
      }
      refreshItemCounter";
        // line 104
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "();
   </script>
</div>
";
    }

    public function getTemplateName()
    {
        return "components/itilobject/add_items.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  191 => 104,  184 => 100,  176 => 95,  172 => 94,  168 => 93,  149 => 77,  145 => 76,  133 => 67,  128 => 65,  120 => 60,  116 => 59,  113 => 58,  105 => 56,  102 => 55,  96 => 53,  94 => 52,  91 => 51,  87 => 49,  85 => 48,  82 => 47,  73 => 45,  69 => 44,  66 => 43,  60 => 40,  55 => 38,  51 => 37,  46 => 36,  44 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/add_items.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\components\\itilobject\\add_items.html.twig");
    }
}
