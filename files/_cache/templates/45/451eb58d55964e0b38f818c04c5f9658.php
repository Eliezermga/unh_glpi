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

/* layout/parts/profile_selector.html.twig */
class __TwigTemplate_5e6b1829747442aa82aab3df66b2bbc3 extends Template
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
        $context["rand"] = twig_random($this->env);
        // line 35
        echo "
<div class=\"dropdown dropstart\">
   <button class=\"dropdown-item dropdown-toggle\" type=\"button\" data-bs-toggle=\"dropdown\"
           aria-haspopup=\"true\" aria-expanded=\"false\">
      <i class=\"ti ti-user-check\"></i>
      ";
        // line 40
        echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue((((twig_get_attribute($this->env, $this->source, $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactiveprofile"), "name", [], "array", true, true, false, 40) &&  !(null === (($__internal_compile_0 = $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactiveprofile")) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["name"] ?? null) : null)))) ? ((($__internal_compile_1 = $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactiveprofile")) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["name"] ?? null) : null)) : (""))), "html", null, true);
        echo "
   </button>
   <div class=\"dropdown-menu\" data-bs-popper=\"none\">
      <span class=\"dropdown-header\">";
        // line 43
        echo twig_escape_filter($this->env, __("Profiles"), "html", null, true);
        echo "</span>
      ";
        // line 44
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiprofiles"));
        foreach ($context['_seq'] as $context["profile_id"] => $context["profile"]) {
            // line 45
            echo "      <a class=\"dropdown-item ";
            echo ((($context["profile_id"] == (((twig_get_attribute($this->env, $this->source, $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactiveprofile"), "id", [], "array", true, true, false, 45) &&  !(null === (($__internal_compile_2 = $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactiveprofile")) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["id"] ?? null) : null)))) ? ((($__internal_compile_3 = $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactiveprofile")) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["id"] ?? null) : null)) : (0)))) ? ("active") : (""));
            echo "\"
         href=\"";
            // line 46
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->indexPath(), "html", null, true);
            echo "?newprofile=";
            echo twig_escape_filter($this->env, $context["profile_id"], "html", null, true);
            echo "\">
         <i class=\"ti ti-user-check\"></i>";
            // line 47
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue((($__internal_compile_4 = $context["profile"]) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["name"] ?? null) : null)), "html", null, true);
            echo "
      </a>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['profile_id'], $context['profile'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "   </div>
</div>

";
        // line 53
        $context["target"] = $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("front/central.php");
        // line 54
        if (($this->extensions['Glpi\Application\View\Extension\SessionExtension']->getCurrentInterface() == "helpdesk")) {
            // line 55
            echo "   ";
            $context["target"] = $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("front/helpdesk.public.php");
        }
        // line 57
        echo "
";
        // line 58
        $context["current_entity"] = $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue($this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactive_entity_name"));
        // line 59
        $context["current_entity_short"] = $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getVerbatimValue($this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactive_entity_shortname"));
        // line 60
        if ((($context["current_entity"] ?? null) != ($context["current_entity_short"] ?? null))) {
            // line 61
            echo "   ";
            $context["current_entity_short"] = ("... > " . ($context["current_entity_short"] ?? null));
        }
        // line 63
        if ( !Session::isMultiEntitiesMode()) {
            // line 64
            echo "   <span class=\"dropdown-item dropdown-item-text\" title=\"";
            echo twig_escape_filter($this->env, ($context["current_entity"] ?? null), "html", null, true);
            echo "\">
      <i class=\"fa-fw ti ti-stack\"></i>
      ";
            // line 66
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $this->extensions['Twig\Extra\String\StringExtension']->createUnicodeString(($context["current_entity_short"] ?? null)), "truncate", [0 => 35, 1 => "..."], "method", false, false, false, 66), "html", null, true);
            echo "
   </span>
";
        } else {
            // line 69
            echo "   <div class=\"dropdown dropstart\">
      <a href=\"#\" class=\"dropdown-item dropdown-toggle entity-dropdown-toggle\" data-bs-toggle=\"dropdown\" data-bs-auto-close=\"outside\" title=\"";
            // line 70
            echo twig_escape_filter($this->env, ($context["current_entity"] ?? null), "html", null, true);
            echo "\">
         <i class=\"fa-fw ti ti-stack\"></i>
         ";
            // line 72
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $this->extensions['Twig\Extra\String\StringExtension']->createUnicodeString(($context["current_entity_short"] ?? null)), "truncate", [0 => 35, 1 => "..."], "method", false, false, false, 72), "html", null, true);
            echo "
      </a>
      <div class=\"dropdown-menu p-3\">
         <h3>";
            // line 75
            echo twig_escape_filter($this->env, __("Select the desired entity"), "html", null, true);
            echo "</h3>

         <div class=\"alert alert-info\" role=\"alert\">
            ";
            // line 78
            $context["shortcut"] = __("Ctrl + Alt + E");
            // line 79
            echo "            ";
            if ((($context["platform"] ?? null) == twig_constant("donatj\\UserAgent\\Platforms::MACINTOSH"))) {
                // line 80
                echo "                ";
                $context["shortcut"] = __("⌥ (option) + ⌘ (command) + E");
                // line 81
                echo "            ";
            }
            // line 82
            echo "            ";
            echo twig_sprintf(__("Tip: You can call this modal with %s keys combination"), (("<kbd>" . ($context["shortcut"] ?? null)) . "</kbd>"));
            echo "
         </div>
         <div class=\"alert alert-info\" role=\"alert\">
            <i class=\"fas fa-info-circle\"></i>
            <span class=\"ms-2\">
               ";
            // line 87
            ob_start(function () { return ''; });
            // line 88
            echo "                  <i class=\"fas fa-angle-double-down\" title=\"";
            echo twig_escape_filter($this->env, __("+ sub-entities"), "html", null, true);
            echo "\"></i>
               ";
            $context["recursive_icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 90
            echo "               ";
            echo twig_sprintf(__("Click on the %s icon to load the elements of the selected entity, as well as its sub-entities."), ($context["recursive_icon"] ?? null));
            echo "
            </span>
         </div>

         <form id=\"entsearchform";
            // line 94
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "\">
            <div class=\"input-group\">
               <input type=\"text\" class=\"form-control\" name=\"entsearchtext\" id=\"entsearchtext";
            // line 96
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "\"
                     placeholder=\"";
            // line 97
            echo twig_escape_filter($this->env, __("Search entity"), "html", null, true);
            echo "\" autocomplete=\"off\">
               <button type=\"submit\" class=\"btn btn-icon btn-primary\" title=\"";
            // line 98
            echo twig_escape_filter($this->env, __("Search"), "html", null, true);
            echo "\"
                     data-bs-toggle=\"tooltip\" data-bs-placement=\"top\">
                  <i class=\"ti ti-search\"></i>
               </button>
               <a class=\"btn btn-icon btn-outline-secondary\" href=\"#\" id=\"entsearchtext";
            // line 102
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "_clear\"
                  title=\"";
            // line 103
            echo twig_escape_filter($this->env, __("Clear search"), "html", null, true);
            echo "\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\">
                     <i class=\"ti ti-x\"></i>
               </a>
               <a href=\"";
            // line 106
            echo twig_escape_filter($this->env, ($context["target"] ?? null), "html", null, true);
            echo "?active_entity=all\" class=\"btn btn-secondary\"
                  title=\"";
            // line 107
            echo twig_escape_filter($this->env, __("Select all"), "html", null, true);
            echo "\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\">
                  <i class=\"ti ti-eye\"></i>
               </a>
            </div>
         </form>

         <div class=\"fancytree-grid-container flexbox-item-grow entity_tree\">
            <table id=\"tree_entity";
            // line 114
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "\">
               <colgroup>
                  <col></col>
               </colgroup>
               <thead>
                  <tr>
                     <th class=\"parent-path\"></th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
            </table>
            <div id=\"verticalScrollbar-";
            // line 126
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "\" style=\"height:100%;\"></div>
         </div>
      </div>
   </div>

   <script type=\"text/javascript\">
   \$(function() {
      \$('#tree_entity";
            // line 133
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "').fancytree({
         // load plugins
         extensions: ['filter', 'glyph', 'grid'],

         // Scroll node into visible area, when focused by keyboard
         autoScroll: true,

         // enable font-awesome icons
         glyph: {
            preset: \"awesome5\",
            map: {}
         },

         // enable virtual dom, it requires the grid (table extension) plugin
         table: {
            indentation: 20,       // indent 20px per node level
            nodeColumnIdx: 0,      // render the node title into the 1st column
            mergeStatusColumns: false,
         },
         grid: {
            mergeStatusColumns: false,
         },
         viewport: {
            enabled: true,
            count: 15, // number of items to display at once
         },

         // load data by ajax
         source: {
            url:  '";
            // line 162
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("/ajax/entitytreesons.php"), "html", null, true);
            echo "',
            cache: false
         },

         // filter plugin options
         filter: {
            mode: \"hide\", // remove unmatched nodes
            autoExpand: true, // if results found in children, auto-expand parent
            nodata: '";
            // line 170
            echo twig_escape_filter($this->env, __("No entity found"), "html", null, true);
            echo "', // message when no data found
            highlight: false, // do not highlight matches by wrapping inside tags (when true, this strip the a tag)
            counter: false, // do not show counters when filtering entity tree
         },

         // load 3rd party scrollbar extension for viewport mode
         preInit: function(event, data) {
            var tree = data.tree;

            tree.verticalScrollbar = new PlainScrollbar({
               alwaysVisible: true,
               arrows: true,
               orientation: \"vertical\",
               onSet: function(numberOfItems) {
                  tree.setViewport({
                     start: Math.round(numberOfItems.start),
                  });
               },
               scrollbarElement: document.getElementById(\"verticalScrollbar-";
            // line 188
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "\"),
            });
         },

         // update scrollbar when viewport is updated
         updateViewport: function(event, data) {
            var tree = data.tree;

            tree.verticalScrollbar.set({
               start: tree.viewport.start,
               total: tree.visibleNodeList.length,
               visible: tree.viewport.count,
            }, true);  // do not trigger `onSet`

            initTooltips();
         },

        // update toolips on node expand
        expand: function(event, data) {
            initTooltips();
        },
      });

      var searchTree = function() {
         var search_text = \$(\"#entsearchtext";
            // line 212
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "\").val();
         \$.ui.fancytree.getTree(\"#tree_entity";
            // line 213
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "\").filterBranches(search_text);
      }

      \$('#entsearchform";
            // line 216
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "').submit(function(event) {
         // cancel submit of entity search form
         event.preventDefault();

         searchTree();
      });

      \$('#entsearchtext";
            // line 223
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "').keyup(function () {
         var inputsearch = \$(this);
         typewatch(function () {
            if (inputsearch.val().length >= 3) {
               searchTree();
            }
         }, 500);
      }).focus();

      \$('#entsearchtext";
            // line 232
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "_clear').click(function () {
         \$('#entsearchtext";
            // line 233
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "').val('');
         searchTree();
      });

      // when the shortcut for entity form is called
      hotkeys('ctrl+alt+e, option+command+e', async function(e) {
         e.stopPropagation();
         e.preventDefault();
         \$('.user-menu-dropdown-toggle').dropdown('show');
         await new Promise(r => setTimeout(r, 100));
         \$('.entity-dropdown-toggle').dropdown('show');
         \$('input[name=entsearchtext]').filter(\":visible\")[0].focus();
      });
   });
   </script>
";
        }
    }

    public function getTemplateName()
    {
        return "layout/parts/profile_selector.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  375 => 233,  371 => 232,  359 => 223,  349 => 216,  343 => 213,  339 => 212,  312 => 188,  291 => 170,  280 => 162,  248 => 133,  238 => 126,  223 => 114,  213 => 107,  209 => 106,  203 => 103,  199 => 102,  192 => 98,  188 => 97,  184 => 96,  179 => 94,  171 => 90,  165 => 88,  163 => 87,  154 => 82,  151 => 81,  148 => 80,  145 => 79,  143 => 78,  137 => 75,  131 => 72,  126 => 70,  123 => 69,  117 => 66,  111 => 64,  109 => 63,  105 => 61,  103 => 60,  101 => 59,  99 => 58,  96 => 57,  92 => 55,  90 => 54,  88 => 53,  83 => 50,  74 => 47,  68 => 46,  63 => 45,  59 => 44,  55 => 43,  49 => 40,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "layout/parts/profile_selector.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\layout\\parts\\profile_selector.html.twig");
    }
}
