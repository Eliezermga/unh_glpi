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

/* layout/parts/menu.html.twig */
class __TwigTemplate_d19fc378bf61411e2d4234dba96d1273 extends Template
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
        $context["is_vertical"] = ($this->extensions['Glpi\Application\View\Extension\SessionExtension']->userPref("page_layout") == "vertical");
        // line 35
        $context["is_horizontal"] = ($this->extensions['Glpi\Application\View\Extension\SessionExtension']->userPref("page_layout") == "horizontal");
        // line 36
        $context["is_menu_folded"] = ($this->extensions['Glpi\Application\View\Extension\SessionExtension']->userPref("fold_menu") == "1");
        // line 37
        $context["rand"] = twig_random($this->env);
        // line 38
        echo "
<ul class=\"navbar-nav\" id=\"menu_";
        // line 39
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "\">
";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["menu"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["firstlevel"]) {
            // line 41
            echo "   ";
            $context["firstlevel_active"] = ((($__internal_compile_0 = (($__internal_compile_1 = ($context["menu"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[($context["sector"] ?? null)] ?? null) : null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["title"] ?? null) : null) == (($__internal_compile_2 = $context["firstlevel"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["title"] ?? null) : null));
            // line 42
            echo "   ";
            $context["firstlevel_shown"] = ((((($__internal_compile_3 = (($__internal_compile_4 = ($context["menu"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[($context["sector"] ?? null)] ?? null) : null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["title"] ?? null) : null) == (($__internal_compile_5 = $context["firstlevel"]) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["title"] ?? null) : null)) && ($context["is_vertical"] ?? null)) && (($context["is_menu_folded"] ?? null) == false));
            // line 43
            echo "   ";
            $context["has_subitems"] = false;
            // line 44
            echo "   ";
            if (twig_get_attribute($this->env, $this->source, $context["firstlevel"], "content", [], "array", true, true, false, 44)) {
                // line 45
                echo "      ";
                // line 46
                echo "      ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((($__internal_compile_6 = $context["firstlevel"]) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["content"] ?? null) : null));
                foreach ($context['_seq'] as $context["_key"] => $context["secondlevel"]) {
                    // line 47
                    echo "         ";
                    if (twig_get_attribute($this->env, $this->source, $context["secondlevel"], "page", [], "array", true, true, false, 47)) {
                        // line 48
                        echo "            ";
                        $context["has_subitems"] = true;
                        // line 49
                        echo "         ";
                    }
                    // line 50
                    echo "      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['secondlevel'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 51
                echo "   ";
            }
            // line 52
            echo "   ";
            if (($context["has_subitems"] ?? null)) {
                // line 53
                echo "   <li class=\"nav-item dropdown ";
                echo ((($context["firstlevel_active"] ?? null)) ? ("active") : (""));
                echo "\"
       title=\"";
                // line 54
                echo twig_escape_filter($this->env, (($__internal_compile_7 = $context["firstlevel"]) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["title"] ?? null) : null), "html", null, true);
                echo "\">
      <a class=\"nav-link dropdown-toggle ";
                // line 55
                echo ((($context["firstlevel_active"] ?? null)) ? ("active") : (""));
                echo " ";
                echo ((($context["firstlevel_shown"] ?? null)) ? ("show") : (""));
                echo "\"
         data-bs-toggle=\"dropdown\" role=\"button\"
         aria-expanded=\"";
                // line 57
                echo ((($context["firstlevel_shown"] ?? null)) ? ("true") : ("false"));
                echo "\">
         <i class=\"fa-fw ";
                // line 58
                (((twig_get_attribute($this->env, $this->source, $context["firstlevel"], "icon", [], "array", true, true, false, 58) &&  !(null === (($__internal_compile_8 = $context["firstlevel"]) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["icon"] ?? null) : null)))) ? (print (twig_escape_filter($this->env, (($__internal_compile_9 = $context["firstlevel"]) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["icon"] ?? null) : null), "html", null, true))) : (print ("")));
                echo "\"></i>
         <span class=\"menu-label\">";
                // line 59
                echo twig_escape_filter($this->env, (($__internal_compile_10 = $context["firstlevel"]) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["title"] ?? null) : null), "html", null, true);
                echo "</span>
      </a>
      <div class=\"dropdown-menu ";
                // line 61
                echo (((($context["firstlevel_active"] ?? null) && (($context["is_vertical"] ?? null) != false))) ? ("") : ("animate__animated"));
                echo " ";
                echo ((($context["is_vertical"] ?? null)) ? ("animate__fadeInLeft") : ("animate__zoomIn"));
                echo " ";
                echo ((($context["firstlevel_shown"] ?? null)) ? ("show") : (""));
                echo "\">
         <h6 class=\"dropdown-header\">";
                // line 62
                echo twig_escape_filter($this->env, (($__internal_compile_11 = $context["firstlevel"]) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["title"] ?? null) : null), "html", null, true);
                echo "</h6>
         <div class=\"dropdown-menu-columns\">
            <div class=\"dropdown-menu-column\">
            ";
                // line 65
                $context["has_dashboard"] = twig_get_attribute($this->env, $this->source, $context["firstlevel"], "default_dashboard", [], "array", true, true, false, 65);
                // line 66
                echo "            ";
                if (($context["has_dashboard"] ?? null)) {
                    // line 67
                    echo "               <a class=\"dropdown-item\"
                  href=\"";
                    // line 68
                    echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path((($__internal_compile_12 = $context["firstlevel"]) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["default_dashboard"] ?? null) : null)), "html", null, true);
                    echo "\">
                  <i class=\"ti ti-dashboard\"></i>
                  ";
                    // line 70
                    echo twig_escape_filter($this->env, __("Dashboard"), "html", null, true);
                    echo "
               </a>
            ";
                }
                // line 73
                echo "            ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((($__internal_compile_13 = $context["firstlevel"]) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["content"] ?? null) : null));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["sublevel"]) {
                    // line 74
                    echo "               ";
                    if (twig_get_attribute($this->env, $this->source, $context["sublevel"], "page", [], "array", true, true, false, 74)) {
                        // line 75
                        echo "               <a class=\"dropdown-item ";
                        echo (((($context["menu_active"] ?? null) == (($__internal_compile_14 = $context["sublevel"]) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["title"] ?? null) : null))) ? ("active") : (""));
                        echo "\"
                  href=\"";
                        // line 76
                        echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path((($__internal_compile_15 = $context["sublevel"]) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["page"] ?? null) : null)), "html", null, true);
                        echo "\"
                  accesskey=\"";
                        // line 77
                        (((twig_get_attribute($this->env, $this->source, $context["sublevel"], "shortcut", [], "array", true, true, false, 77) &&  !(null === (($__internal_compile_16 = $context["sublevel"]) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["shortcut"] ?? null) : null)))) ? (print (twig_escape_filter($this->env, (($__internal_compile_17 = $context["sublevel"]) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["shortcut"] ?? null) : null), "html", null, true))) : (print ("")));
                        echo "\" title=\"";
                        echo twig_escape_filter($this->env, (($__internal_compile_18 = $context["sublevel"]) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["title"] ?? null) : null), "html", null, true);
                        echo "\">
                  <i class=\"fa-fw ";
                        // line 78
                        (((twig_get_attribute($this->env, $this->source, $context["sublevel"], "icon", [], "array", true, true, false, 78) &&  !(null === (($__internal_compile_19 = $context["sublevel"]) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["icon"] ?? null) : null)))) ? (print (twig_escape_filter($this->env, (($__internal_compile_20 = $context["sublevel"]) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["icon"] ?? null) : null), "html", null, true))) : (print ("")));
                        echo "\"></i>
                  <span class='text-wrap'>
                     ";
                        // line 80
                        echo $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->underlineShortcutLetter((($__internal_compile_21 = $context["sublevel"]) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["title"] ?? null) : null), (((twig_get_attribute($this->env, $this->source, $context["sublevel"], "shortcut", [], "array", true, true, false, 80) &&  !(null === (($__internal_compile_22 = $context["sublevel"]) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["shortcut"] ?? null) : null)))) ? ((($__internal_compile_23 = $context["sublevel"]) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["shortcut"] ?? null) : null)) : ("")));
                        echo "
                  </span>
               </a>
               ";
                    }
                    // line 84
                    echo "
               ";
                    // line 85
                    $context["count_per_column"] = 6;
                    // line 86
                    echo "               ";
                    if ((((twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 86) % ($context["count_per_column"] ?? null)) == ((($context["has_dashboard"] ?? null)) ? ((($context["count_per_column"] ?? null) - 1)) : (0))) &&  !twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 86))) {
                        // line 87
                        echo "                  </div>
                  <div class=\"dropdown-menu-column\">
               ";
                    }
                    // line 90
                    echo "            ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sublevel'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 91
                echo "            </div>
         </div>
      </div>
   </li>
   ";
            } elseif ((twig_get_attribute($this->env, $this->source,             // line 95
$context["firstlevel"], "default", [], "array", true, true, false, 95) && ((((twig_get_attribute($this->env, $this->source, $context["firstlevel"], "display", [], "array", true, true, false, 95) &&  !(null === (($__internal_compile_24 = $context["firstlevel"]) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["display"] ?? null) : null)))) ? ((($__internal_compile_25 = $context["firstlevel"]) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["display"] ?? null) : null)) : (true)) != false))) {
                // line 96
                echo "      <li class=\"nav-item dropdown ";
                echo ((($context["firstlevel_active"] ?? null)) ? ("active") : (""));
                echo "\" data-bs-toggle=\"tooltip\"
       title=\"";
                // line 97
                echo twig_escape_filter($this->env, (($__internal_compile_26 = $context["firstlevel"]) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["title"] ?? null) : null), "html", null, true);
                echo "\">
         <a class=\"nav-link\" href=\"";
                // line 98
                echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path((($__internal_compile_27 = $context["firstlevel"]) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["default"] ?? null) : null)), "html", null, true);
                echo "\">
            <i class=\"fa-fw ";
                // line 99
                (((twig_get_attribute($this->env, $this->source, $context["firstlevel"], "icon", [], "array", true, true, false, 99) &&  !(null === (($__internal_compile_28 = $context["firstlevel"]) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["icon"] ?? null) : null)))) ? (print (twig_escape_filter($this->env, (($__internal_compile_29 = $context["firstlevel"]) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29["icon"] ?? null) : null), "html", null, true))) : (print ("")));
                echo "\"></i>
            <span class=\"menu-label\">";
                // line 100
                echo twig_escape_filter($this->env, (($__internal_compile_30 = $context["firstlevel"]) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30["title"] ?? null) : null), "html", null, true);
                echo "</span>
         </a>
      <li>
   ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['firstlevel'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 105
        echo "</ul>

";
        // line 107
        if (($context["is_vertical"] ?? null)) {
            // line 108
            echo "<script type=\"text/javascript\">
\$(function() {
   // below, some modifications of dropdowns menu behavior
   document.querySelectorAll('#menu_";
            // line 111
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo " > .dropdown').forEach(function(menuDropdown) {
      // prevent menu closes
      menuDropdown.addEventListener('hide.bs.dropdown', function (event) {
         var orig_event = event.clickEvent;
         if (typeof orig_event != \"undefined\"
             && typeof orig_event.target != \"undefined\") {
            // prevent body clicking to hide menu
            if (!document.getElementById('menu_";
            // line 118
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "').contains(orig_event.target)) {
               event.preventDefault();
               return;
            }

            // prevent menu links to close menu (waiting the page redirection)
            if (orig_event.target.className.indexOf('dropdown-item') !== false) {
               for (var item of document.querySelectorAll('#menu_";
            // line 125
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo " .dropdown-item')) {
                  item.classList.remove('active');
               }
               orig_event.target.classList.add('active');
               event.preventDefault();
            }
         }
      });

      // opening a sub menu close others
      menuDropdown.addEventListener('show.bs.dropdown', function (event) {
         \$('#menu_";
            // line 136
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo " .nav-link').removeClass('show active');
         \$('#menu_";
            // line 137
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo " .nav-item').removeClass('active');
         \$('#menu_";
            // line 138
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo " .dropdown-menu').removeClass('show');
      })
   });

});
</script>
";
        }
    }

    public function getTemplateName()
    {
        return "layout/parts/menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  325 => 138,  321 => 137,  317 => 136,  303 => 125,  293 => 118,  283 => 111,  278 => 108,  276 => 107,  272 => 105,  261 => 100,  257 => 99,  253 => 98,  249 => 97,  244 => 96,  242 => 95,  236 => 91,  222 => 90,  217 => 87,  214 => 86,  212 => 85,  209 => 84,  202 => 80,  197 => 78,  191 => 77,  187 => 76,  182 => 75,  179 => 74,  161 => 73,  155 => 70,  150 => 68,  147 => 67,  144 => 66,  142 => 65,  136 => 62,  128 => 61,  123 => 59,  119 => 58,  115 => 57,  108 => 55,  104 => 54,  99 => 53,  96 => 52,  93 => 51,  87 => 50,  84 => 49,  81 => 48,  78 => 47,  73 => 46,  71 => 45,  68 => 44,  65 => 43,  62 => 42,  59 => 41,  55 => 40,  51 => 39,  48 => 38,  46 => 37,  44 => 36,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "layout/parts/menu.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\layout\\parts\\menu.html.twig");
    }
}
