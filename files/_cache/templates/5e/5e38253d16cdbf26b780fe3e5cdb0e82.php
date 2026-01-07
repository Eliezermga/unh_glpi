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

/* components/search/table.html.twig */
class __TwigTemplate_1a087368c52e189dac8c20376c1334f2 extends Template
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
        $context["searchform_id"] = ((twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "searchform_id", [], "array", true, true, false, 34)) ? (_twig_default_filter((($__internal_compile_0 = ($context["data"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["searchform_id"] ?? null) : null), ("search_" . ($context["rand"] ?? null)))) : (("search_" . ($context["rand"] ?? null))));
        // line 35
        echo "
<div class=\"table-responsive-lg\">
   <table class=\"search-results table card-table table-hover ";
        // line 37
        echo (((($__internal_compile_1 = (($__internal_compile_2 = ($context["data"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["search"] ?? null) : null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["is_deleted"] ?? null) : null)) ? ("table-danger deleted-results") : ("table-striped"));
        echo "\"
          id=\"";
        // line 38
        echo twig_escape_filter($this->env, ($context["searchform_id"] ?? null), "html", null, true);
        echo "\">
      <thead>
         <tr ";
        // line 40
        if ((($context["count"] ?? null) == 0)) {
            echo "style=\"display: none;\"";
        }
        echo ">
            ";
        // line 41
        if (($context["showmassiveactions"] ?? null)) {
            // line 42
            echo "            <th style=\"width: 30px;\">
               <div>
                  <input class=\"form-check-input massive_action_checkbox\" type=\"checkbox\" id=\"checkall_";
            // line 44
            echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
            echo "\"
                        value=\"\" aria-label=\"";
            // line 45
            echo twig_escape_filter($this->env, __("Check all as"), "html", null, true);
            echo "\"
                        onclick=\"checkAsCheckboxes(this, '";
            // line 46
            echo twig_escape_filter($this->env, ($context["searchform_id"] ?? null), "html", null, true);
            echo "', '.massive_action_checkbox');\" />
               </div>
            </th>
            ";
        }
        // line 50
        echo "
            ";
        // line 51
        $context["sorts"] = (($__internal_compile_3 = (($__internal_compile_4 = ($context["data"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["search"] ?? null) : null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["sort"] ?? null) : null);
        // line 52
        echo "
            ";
        // line 53
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((($__internal_compile_5 = (($__internal_compile_6 = ($context["data"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["data"] ?? null) : null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["cols"] ?? null) : null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["col"]) {
            // line 54
            echo "               ";
            // line 55
            echo "               ";
            $context["linkto"] = "";
            // line 56
            echo "               ";
            $context["so_no_sort"] = (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["col"], "searchopt", [], "array", false, true, false, 56), "nosort", [], "array", true, true, false, 56) &&  !(null === (($__internal_compile_7 = twig_get_attribute($this->env, $this->source, $context["col"], "searchopt", [], "array", false, true, false, 56)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["nosort"] ?? null) : null)))) ? ((($__internal_compile_8 = twig_get_attribute($this->env, $this->source, $context["col"], "searchopt", [], "array", false, true, false, 56)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["nosort"] ?? null) : null)) : (false));
            // line 57
            echo "               ";
            $context["meta"] = (((twig_get_attribute($this->env, $this->source, $context["col"], "meta", [], "array", true, true, false, 57) &&  !(null === (($__internal_compile_9 = $context["col"]) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["meta"] ?? null) : null)))) ? ((($__internal_compile_10 = $context["col"]) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["meta"] ?? null) : null)) : (false));
            // line 58
            echo "               ";
            $context["sort_order"] = "nosort";
            // line 59
            echo "               ";
            $context["sort_num"] = "";
            // line 60
            echo "               ";
            $context["can_sort"] = (( !($context["meta"] ?? null) &&  !($context["no_sort"] ?? null)) &&  !($context["so_no_sort"] ?? null));
            // line 61
            echo "               ";
            if (($context["can_sort"] ?? null)) {
                // line 62
                echo "                  ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["sorts"] ?? null));
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
                foreach ($context['_seq'] as $context["_key"] => $context["sort_opt"]) {
                    // line 63
                    echo "                     ";
                    if (($context["sort_opt"] == (($__internal_compile_11 = $context["col"]) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["id"] ?? null) : null))) {
                        // line 64
                        echo "                        ";
                        $context["sort_order"] = ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "search", [], "array", false, true, false, 64), "order", [], "array", false, true, false, 64), twig_get_attribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 64), [], "array", true, true, false, 64)) ? (_twig_default_filter((($__internal_compile_12 = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "search", [], "array", false, true, false, 64), "order", [], "array", false, true, false, 64)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12[twig_get_attribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 64)] ?? null) : null), "ASC")) : ("ASC"));
                        // line 65
                        echo "                        ";
                        $context["sort_num"] = twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 65);
                        // line 66
                        echo "                     ";
                    }
                    // line 67
                    echo "                  ";
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
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sort_opt'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 68
                echo "               ";
            }
            // line 69
            echo "
               ";
            // line 70
            $context["col_name"] = (($__internal_compile_13 = $context["col"]) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["name"] ?? null) : null);
            // line 71
            echo "               ";
            // line 72
            echo "               ";
            if (twig_get_attribute($this->env, $this->source, $context["col"], "groupname", [], "array", true, true, false, 72)) {
                // line 73
                echo "                  ";
                $context["groupname"] = (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["col"], "groupname", [], "array", false, true, false, 73), "name", [], "array", true, true, false, 73) &&  !(null === (($__internal_compile_14 = twig_get_attribute($this->env, $this->source, $context["col"], "groupname", [], "array", false, true, false, 73)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["name"] ?? null) : null)))) ? ((($__internal_compile_15 = twig_get_attribute($this->env, $this->source, $context["col"], "groupname", [], "array", false, true, false, 73)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["name"] ?? null) : null)) : ((($__internal_compile_16 = $context["col"]) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["groupname"] ?? null) : null)));
                // line 74
                echo "                  ";
                $context["col_name"] = twig_sprintf(__("%1\$s - %2\$s"), ($context["groupname"] ?? null), (($__internal_compile_17 = $context["col"]) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["name"] ?? null) : null));
                // line 75
                echo "               ";
            }
            // line 76
            echo "
               ";
            // line 78
            echo "               ";
            if (( !($context["itemtype"] ?? null) == (($__internal_compile_18 = $context["col"]) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["itemtype"] ?? null) : null))) {
                // line 79
                echo "                  ";
                $context["col_name"] = twig_sprintf(__("%1\$s - %2\$s"), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName((($__internal_compile_19 = $context["col"]) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["itemtype"] ?? null) : null)), ($context["col_name"] ?? null));
                // line 80
                echo "               ";
            }
            // line 81
            echo "
               <th data-searchopt-id=\"";
            // line 82
            echo twig_escape_filter($this->env, (($__internal_compile_20 = $context["col"]) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["id"] ?? null) : null), "html", null, true);
            echo "\" ";
            if ( !($context["can_sort"] ?? null)) {
                echo "data-nosort=\"true\"";
            }
            echo " data-sort-order=\"";
            echo twig_escape_filter($this->env, ($context["sort_order"] ?? null), "html", null, true);
            echo "\"
                  ";
            // line 83
            if ( !twig_test_empty(($context["sort_num"] ?? null))) {
                echo "data-sort-num=\"";
                echo twig_escape_filter($this->env, (($context["sort_num"] ?? null) - 1), "html", null, true);
                echo "\"";
            }
            echo ">
                  ";
            // line 84
            $context["sort_icon"] = (((($context["sort_order"] ?? null) == "ASC")) ? ("fas fa-sort-up") : ((((($context["sort_order"] ?? null) == "DESC")) ? ("fas fa-sort-down") : (""))));
            // line 85
            echo "                  ";
            echo twig_escape_filter($this->env, ($context["col_name"] ?? null), "html", null, true);
            echo "
                  ";
            // line 86
            if (($context["can_sort"] ?? null)) {
                // line 87
                echo "                     <span class=\"sort-indicator\"><i class=\"";
                echo twig_escape_filter($this->env, ($context["sort_icon"] ?? null), "html", null, true);
                echo "\"></i><span class=\"sort-num\">";
                (((twig_length_filter($this->env, ($context["sorts"] ?? null)) > 1)) ? (print (twig_escape_filter($this->env, ($context["sort_num"] ?? null), "html", null, true))) : (print ("")));
                echo "</span></span>
                  ";
            }
            // line 89
            echo "               </th>
            ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['col'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 91
        echo "
            ";
        // line 93
        echo "            ";
        if (twig_get_attribute($this->env, $this->source, ($context["union_search_type"] ?? null), ($context["itemtype"] ?? null), [], "array", true, true, false, 93)) {
            // line 94
            echo "               <th>
                  ";
            // line 95
            echo twig_escape_filter($this->env, __("Item type"), "html", null, true);
            echo "
               </th>
            ";
        }
        // line 98
        echo "         </tr>
      </thead>
      <tbody>
         ";
        // line 101
        if ((($context["count"] ?? null) == 0)) {
            // line 102
            echo "            <tr>
               <td colspan=\"";
            // line 103
            echo twig_escape_filter($this->env, twig_length_filter($this->env, (($__internal_compile_21 = (($__internal_compile_22 = ($context["data"] ?? null)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["data"] ?? null) : null)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["cols"] ?? null) : null)), "html", null, true);
            echo "\">
                  <div class=\"alert alert-info mb-0 rounded-0 border-top-0 border-bottom-0 border-right-0\" role=\"alert\">
                     ";
            // line 105
            echo twig_escape_filter($this->env, __("No item found"), "html", null, true);
            echo "
                  </div>
               </td>
            </tr>
         ";
        } else {
            // line 110
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((($__internal_compile_23 = (($__internal_compile_24 = ($context["data"] ?? null)) && is_array($__internal_compile_24) || $__internal_compile_24 instanceof ArrayAccess ? ($__internal_compile_24["data"] ?? null) : null)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["rows"] ?? null) : null));
            foreach ($context['_seq'] as $context["rowkey"] => $context["row"]) {
                // line 111
                echo "               <tr>
                  ";
                // line 112
                if (($context["showmassiveactions"] ?? null)) {
                    // line 113
                    echo "                  <td>
                     <div>
                        ";
                    // line 116
                    echo "                        ";
                    if (((($context["itemtype"] ?? null) == "Entity") &&  !Session::haveAccessToEntity((($__internal_compile_25 = $context["row"]) && is_array($__internal_compile_25) || $__internal_compile_25 instanceof ArrayAccess ? ($__internal_compile_25["id"] ?? null) : null)))) {
                        // line 117
                        echo "                        ";
                    } elseif ((((($context["itemtype"] ?? null) == "User") &&  !Session::canViewAllEntities()) &&  !$this->extensions['Glpi\Application\View\Extension\SessionExtension']->hasAccessToUserEntities((($__internal_compile_26 = $context["row"]) && is_array($__internal_compile_26) || $__internal_compile_26 instanceof ArrayAccess ? ($__internal_compile_26["id"] ?? null) : null)))) {
                        // line 118
                        echo "                        ";
                    } elseif ((($this->extensions['Glpi\Application\View\Extension\PhpExtension']->isInstanceOf(($context["item"] ?? null), "CommonDBTM") && twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "maybeRecursive", [], "method", false, false, false, 118)) &&  !Session::haveAccessToEntity((($__internal_compile_27 = $context["row"]) && is_array($__internal_compile_27) || $__internal_compile_27 instanceof ArrayAccess ? ($__internal_compile_27["entities_id"] ?? null) : null)))) {
                        // line 119
                        echo "                        ";
                    } else {
                        // line 120
                        echo "
                           ";
                        // line 121
                        if (($this->extensions['Glpi\Application\View\Extension\PhpExtension']->isInstanceOf(($context["item"] ?? null), "CommonDBTM") && $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call((($context["itemtype"] ?? null) . "::isMassiveActionAllowed"), [0 => (($__internal_compile_28 = $context["row"]) && is_array($__internal_compile_28) || $__internal_compile_28 instanceof ArrayAccess ? ($__internal_compile_28["id"] ?? null) : null)]))) {
                            // line 122
                            echo "                              ";
                            $context["checked"] = (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpimassiveactionselected"), ($context["itemtype"] ?? null), [], "array", false, true, false, 122), (($__internal_compile_29 = $context["row"]) && is_array($__internal_compile_29) || $__internal_compile_29 instanceof ArrayAccess ? ($__internal_compile_29["id"] ?? null) : null), [], "array", true, true, false, 122) &&  !(null === (($__internal_compile_30 = twig_get_attribute($this->env, $this->source, $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpimassiveactionselected"), ($context["itemtype"] ?? null), [], "array", false, true, false, 122)) && is_array($__internal_compile_30) || $__internal_compile_30 instanceof ArrayAccess ? ($__internal_compile_30[(($__internal_compile_31 = $context["row"]) && is_array($__internal_compile_31) || $__internal_compile_31 instanceof ArrayAccess ? ($__internal_compile_31["id"] ?? null) : null)] ?? null) : null)))) ? ((($__internal_compile_32 = twig_get_attribute($this->env, $this->source, $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpimassiveactionselected"), ($context["itemtype"] ?? null), [], "array", false, true, false, 122)) && is_array($__internal_compile_32) || $__internal_compile_32 instanceof ArrayAccess ? ($__internal_compile_32[(($__internal_compile_33 = $context["row"]) && is_array($__internal_compile_33) || $__internal_compile_33 instanceof ArrayAccess ? ($__internal_compile_33["id"] ?? null) : null)] ?? null) : null)) : (false));
                            // line 123
                            echo "                              <input class=\"form-check-input massive_action_checkbox\" type=\"checkbox\" data-glpicore-ma-tags=\"common\"
                                 value=\"1\" aria-label=\"\" ";
                            // line 124
                            if (($context["checked"] ?? null)) {
                                echo "checked=\"checked\"";
                            }
                            // line 125
                            echo "                                 name=\"item[";
                            echo twig_escape_filter($this->env, (((twig_get_attribute($this->env, $this->source, $context["row"], "TYPE", [], "array", true, true, false, 125) &&  !(null === (($__internal_compile_34 = $context["row"]) && is_array($__internal_compile_34) || $__internal_compile_34 instanceof ArrayAccess ? ($__internal_compile_34["TYPE"] ?? null) : null)))) ? ((($__internal_compile_35 = $context["row"]) && is_array($__internal_compile_35) || $__internal_compile_35 instanceof ArrayAccess ? ($__internal_compile_35["TYPE"] ?? null) : null)) : (($context["itemtype"] ?? null))), "html", null, true);
                            echo "][";
                            echo twig_escape_filter($this->env, (($__internal_compile_36 = $context["row"]) && is_array($__internal_compile_36) || $__internal_compile_36 instanceof ArrayAccess ? ($__internal_compile_36["id"] ?? null) : null), "html", null, true);
                            echo "]\" />
                           ";
                        }
                        // line 127
                        echo "                        ";
                    }
                    // line 128
                    echo "                     </div>
                  </td>
                  ";
                }
                // line 131
                echo "
                  ";
                // line 132
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((($__internal_compile_37 = (($__internal_compile_38 = ($context["data"] ?? null)) && is_array($__internal_compile_38) || $__internal_compile_38 instanceof ArrayAccess ? ($__internal_compile_38["data"] ?? null) : null)) && is_array($__internal_compile_37) || $__internal_compile_37 instanceof ArrayAccess ? ($__internal_compile_37["cols"] ?? null) : null));
                foreach ($context['_seq'] as $context["_key"] => $context["col"]) {
                    // line 133
                    echo "                     ";
                    $context["colkey"] = (((($__internal_compile_39 = $context["col"]) && is_array($__internal_compile_39) || $__internal_compile_39 instanceof ArrayAccess ? ($__internal_compile_39["itemtype"] ?? null) : null) . "_") . (($__internal_compile_40 = $context["col"]) && is_array($__internal_compile_40) || $__internal_compile_40 instanceof ArrayAccess ? ($__internal_compile_40["id"] ?? null) : null));
                    // line 134
                    echo "                     ";
                    // line 135
                    echo "                     ";
                    if (twig_get_attribute($this->env, $this->source, $context["col"], "meta", [], "array", true, true, false, 135)) {
                        // line 136
                        echo "                        ";
                        echo $this->extensions['Glpi\Application\View\Extension\SearchExtension']->showItem(0, (($__internal_compile_41 = (($__internal_compile_42 = $context["row"]) && is_array($__internal_compile_42) || $__internal_compile_42 instanceof ArrayAccess ? ($__internal_compile_42[($context["colkey"] ?? null)] ?? null) : null)) && is_array($__internal_compile_41) || $__internal_compile_41 instanceof ArrayAccess ? ($__internal_compile_41["displayname"] ?? null) : null), 0, 0);
                        echo "
                     ";
                    } else {
                        // line 138
                        echo "                        ";
                        echo $this->extensions['Glpi\Application\View\Extension\SearchExtension']->showItem(0, (($__internal_compile_43 = (($__internal_compile_44 = $context["row"]) && is_array($__internal_compile_44) || $__internal_compile_44 instanceof ArrayAccess ? ($__internal_compile_44[($context["colkey"] ?? null)] ?? null) : null)) && is_array($__internal_compile_43) || $__internal_compile_43 instanceof ArrayAccess ? ($__internal_compile_43["displayname"] ?? null) : null), 0, 0, $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Search::displayConfigItem", [0 => ($context["itemtype"] ?? null), 1 => (($__internal_compile_45 = $context["col"]) && is_array($__internal_compile_45) || $__internal_compile_45 instanceof ArrayAccess ? ($__internal_compile_45["id"] ?? null) : null), 2 => $context["row"]]));
                        echo "
                     ";
                    }
                    // line 140
                    echo "                  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['col'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 141
                echo "
                  ";
                // line 143
                echo "                  ";
                if (twig_get_attribute($this->env, $this->source, ($context["union_search_type"] ?? null), ($context["itemtype"] ?? null), [], "array", true, true, false, 143)) {
                    // line 144
                    echo "                     <td>
                        ";
                    // line 145
                    echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName((($__internal_compile_46 = $context["row"]) && is_array($__internal_compile_46) || $__internal_compile_46 instanceof ArrayAccess ? ($__internal_compile_46["TYPE"] ?? null) : null)), "html", null, true);
                    echo "
                     </td>
                  ";
                }
                // line 148
                echo "               </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['rowkey'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 150
            echo "         ";
        }
        // line 151
        echo "      </tbody>
   </table>
</div>
";
    }

    public function getTemplateName()
    {
        return "components/search/table.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  414 => 151,  411 => 150,  404 => 148,  398 => 145,  395 => 144,  392 => 143,  389 => 141,  383 => 140,  377 => 138,  371 => 136,  368 => 135,  366 => 134,  363 => 133,  359 => 132,  356 => 131,  351 => 128,  348 => 127,  340 => 125,  336 => 124,  333 => 123,  330 => 122,  328 => 121,  325 => 120,  322 => 119,  319 => 118,  316 => 117,  313 => 116,  309 => 113,  307 => 112,  304 => 111,  299 => 110,  291 => 105,  286 => 103,  283 => 102,  281 => 101,  276 => 98,  270 => 95,  267 => 94,  264 => 93,  261 => 91,  246 => 89,  238 => 87,  236 => 86,  231 => 85,  229 => 84,  221 => 83,  211 => 82,  208 => 81,  205 => 80,  202 => 79,  199 => 78,  196 => 76,  193 => 75,  190 => 74,  187 => 73,  184 => 72,  182 => 71,  180 => 70,  177 => 69,  174 => 68,  160 => 67,  157 => 66,  154 => 65,  151 => 64,  148 => 63,  130 => 62,  127 => 61,  124 => 60,  121 => 59,  118 => 58,  115 => 57,  112 => 56,  109 => 55,  107 => 54,  90 => 53,  87 => 52,  85 => 51,  82 => 50,  75 => 46,  71 => 45,  67 => 44,  63 => 42,  61 => 41,  55 => 40,  50 => 38,  46 => 37,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/search/table.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\components\\search\\table.html.twig");
    }
}
