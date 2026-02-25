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

/* components/pager.html.twig */
class __TwigTemplate_c0cd86f43248fdc07bc21e180a7dafba extends Template
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
        if ( !array_key_exists("additional_params", $context)) {
            // line 35
            echo "    ";
            $context["additional_params"] = "";
        } else {
            // line 37
            echo "    ";
            if (((twig_length_filter($this->env, ($context["additional_params"] ?? null)) > 0) &&  !(is_string($__internal_compile_0 = ($context["additional_params"] ?? null)) && is_string($__internal_compile_1 = "&") && ('' === $__internal_compile_1 || 0 === strpos($__internal_compile_0, $__internal_compile_1))))) {
                // line 38
                echo "        ";
                $context["additional_params"] = ("&" . ($context["additional_params"] ?? null));
                // line 39
                echo "    ";
            }
        }
        // line 41
        echo "
";
        // line 42
        $context["href"] = ((($context["href"] ?? null) . "&start=%start%") . ($context["additional_params"] ?? null));
        // line 43
        if ((array_key_exists("is_tab", $context) && (($context["is_tab"] ?? null) == true))) {
            // line 44
            echo "   ";
            $context["href"] = (("javascript:reloadTab('start=%start%" . ($context["additional_params"] ?? null)) . "');");
        }
        // line 46
        if ( !array_key_exists("limit", $context)) {
            // line 47
            echo "    ";
            $context["limit"] = $this->extensions['Glpi\Application\View\Extension\SessionExtension']->userPref("list_limit");
        }
        // line 49
        echo "
";
        // line 50
        $context["forward"] = (($context["start"] ?? null) + ($context["limit"] ?? null));
        // line 51
        $context["end"] = (($context["count"] ?? null) - ($context["limit"] ?? null));
        // line 52
        $context["current_start"] = (($context["start"] ?? null) + 1);
        // line 53
        $context["current_end"] = ((($context["current_start"] ?? null) + ($context["limit"] ?? null)) - 1);
        // line 54
        if ((($context["current_end"] ?? null) > ($context["count"] ?? null))) {
            // line 55
            echo "    ";
            $context["current_end"] = ($context["count"] ?? null);
        }
        // line 57
        echo "
";
        // line 58
        $context["back"] = (($context["start"] ?? null) - ($context["limit"] ?? null));
        // line 59
        if (((($context["current_start"] ?? null) - ($context["list_limit"] ?? null)) <= 0)) {
            // line 60
            echo "   ";
            $context["back"] = 0;
        }
        // line 62
        echo "
";
        // line 63
        $context["nb_pages"] = twig_round((($context["count"] ?? null) / ($context["limit"] ?? null)), 0, "ceil");
        // line 64
        $context["current_page"] = (twig_round(((($context["current_start"] ?? null) - 1) / ($context["limit"] ?? null)), 0, "ceil") + 1);
        // line 65
        echo "
";
        // line 67
        $context["adjacents"] = 2;
        // line 68
        $context["skip_adjacents"] = false;
        // line 69
        echo "
<div class=\"flex-grow-1 d-flex flex-wrap flex-md-nowrap  align-items-center justify-content-between mb-2 search-pager\">
    ";
        // line 71
        $context["limitdropdown"] = twig_include($this->env, $context, "components/dropdown/limit.html.twig", ["no_onchange" => ((        // line 72
array_key_exists("fluid_search", $context)) ? (_twig_default_filter(($context["fluid_search"] ?? null), false)) : (false)), "select_class" => "search-limit-dropdown"]);
        // line 75
        echo "    <span class=\"search-limit d-none d-md-block\">
        ";
        // line 76
        echo twig_sprintf(__("%s rows / page"), ($context["limitdropdown"] ?? null));
        echo "
    </span>
    <span class=\"search-limit d-block d-md-none\">
        ";
        // line 79
        echo ($context["limitdropdown"] ?? null);
        echo "
    </span>
    <p class=\"m-0 text-muted d-none d-md-block page-infos\">
        ";
        // line 82
        echo twig_escape_filter($this->env, twig_sprintf(__("Showing %s to %s of %s rows"), ($context["current_start"] ?? null), ($context["current_end"] ?? null), ($context["count"] ?? null)), "html", null, true);
        echo "
    </p>
    <p class=\"m-0 text-muted d-block d-md-none text-nowrap ms-2 page-infos\">
        ";
        // line 85
        echo twig_escape_filter($this->env, twig_sprintf(__("%s-%s/%s"), ($context["current_start"] ?? null), ($context["current_end"] ?? null), ($context["count"] ?? null)), "html", null, true);
        echo "
    </p>

    <ul class=\"pagination m-0 mt-sm-2 mt-md-0\">
        ";
        // line 89
        if ((($context["nb_pages"] ?? null) > 1)) {
            // line 90
            echo "            ";
            $context["is_first_page"] = (($context["start"] ?? null) == 0);
            // line 91
            echo "            ";
            $context["is_last_page"] = (($context["forward"] ?? null) >= ($context["count"] ?? null));
            // line 92
            echo "
            <li class=\"page-item ";
            // line 93
            if (($context["is_first_page"] ?? null)) {
                echo "disabled";
            }
            echo "\">
                <a class=\"page-link page-link-start\" href=\"";
            // line 94
            echo twig_escape_filter($this->env, twig_replace_filter(($context["href"] ?? null), ["%start%" => 0]), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, __("Start"), "html", null, true);
            echo "\" data-start=\"0\" ";
            if (($context["is_first_page"] ?? null)) {
                echo "aria-disabled=\"true\"";
            }
            echo ">
                    <i class=\"ti ti-chevrons-left\"></i>
                </a>
            </li>
            <li class=\"page-item ";
            // line 98
            if (($context["is_first_page"] ?? null)) {
                echo "disabled";
            }
            echo "\">
                <a class=\"page-link page-link-prev\" href=\"";
            // line 99
            echo twig_escape_filter($this->env, twig_replace_filter(($context["href"] ?? null), ["%start%" => ($context["back"] ?? null)]), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, __("Previous"), "html", null, true);
            echo "\" data-start=\"";
            echo twig_escape_filter($this->env, ($context["back"] ?? null), "html", null, true);
            echo "\" ";
            if (($context["is_first_page"] ?? null)) {
                echo "aria-disabled=\"true\"";
            }
            echo ">
                    <i class=\"ti ti-chevron-left\"></i>
                </a>
            </li>
            ";
            // line 103
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, ($context["nb_pages"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                // line 104
                echo "                ";
                if ((((($context["current_page"] ?? null) - ($context["adjacents"] ?? null)) <= $context["page"]) && ((($context["current_page"] ?? null) + ($context["adjacents"] ?? null)) >= $context["page"]))) {
                    // line 105
                    echo "                    ";
                    $context["page_start"] = (($context["page"] - 1) * ($context["limit"] ?? null));
                    // line 106
                    echo "                    <li class=\"d-none d-sm-block page-item ";
                    if (($context["page"] == ($context["current_page"] ?? null))) {
                        echo "active selected";
                    }
                    echo "\">
                    <a class=\"page-link page-link-num\" href=\"";
                    // line 107
                    echo twig_escape_filter($this->env, twig_replace_filter(($context["href"] ?? null), ["%start%" => ($context["page_start"] ?? null)]), "html", null, true);
                    echo "\" data-start=\"";
                    echo twig_escape_filter($this->env, ($context["page_start"] ?? null), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["page"], "html", null, true);
                    echo "</a>
                    </li>
                    ";
                    // line 109
                    if (((($context["current_page"] ?? null) + ($context["adjacents"] ?? null)) == $context["page"])) {
                        // line 110
                        echo "                    ";
                        $context["skip_adjacents"] = false;
                        // line 111
                        echo "                    ";
                    }
                    // line 112
                    echo "                ";
                } elseif ((($context["skip_adjacents"] ?? null) == false)) {
                    // line 113
                    echo "                    ";
                    $context["skip_adjacents"] = true;
                    // line 114
                    echo "                    <li class=\"d-none d-sm-block page-item disabled\">
                    <a class=\"page-link\" href=\"#\" aria-disabled=\"true\">...</a>
                    </li>
                ";
                }
                // line 118
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 119
            echo "
            <li class=\"page-item ";
            // line 120
            if (($context["is_last_page"] ?? null)) {
                echo "disabled";
            }
            echo "\">
                <a class=\"page-link page-link-next\" href=\"";
            // line 121
            echo twig_escape_filter($this->env, twig_replace_filter(($context["href"] ?? null), ["%start%" => ($context["forward"] ?? null)]), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, __("Next"), "html", null, true);
            echo "\" data-start=\"";
            echo twig_escape_filter($this->env, ($context["forward"] ?? null), "html", null, true);
            echo "\" ";
            if (($context["is_last_page"] ?? null)) {
                echo "aria-disabled=\"true\"";
            }
            echo ">
                    <i class=\"ti ti-chevron-right\"></i>
                </a>
            </li>
            <li class=\"page-item ";
            // line 125
            if (($context["is_last_page"] ?? null)) {
                echo "disabled";
            }
            echo "\">
                <a class=\"page-link page-link-last\" href=\"";
            // line 126
            echo twig_escape_filter($this->env, twig_replace_filter(($context["href"] ?? null), ["%start%" => ($context["end"] ?? null)]), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, __("End"), "html", null, true);
            echo "\" data-start=\"";
            echo twig_escape_filter($this->env, ($context["end"] ?? null), "html", null, true);
            echo "\" ";
            if (($context["is_last_page"] ?? null)) {
                echo "aria-disabled=\"true\"";
            }
            echo ">
                    <i class=\"ti ti-chevrons-right\"></i>
                </a>
            </li>
        ";
        }
        // line 131
        echo "    </ul>
</div>
";
    }

    public function getTemplateName()
    {
        return "components/pager.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  299 => 131,  283 => 126,  277 => 125,  262 => 121,  256 => 120,  253 => 119,  247 => 118,  241 => 114,  238 => 113,  235 => 112,  232 => 111,  229 => 110,  227 => 109,  218 => 107,  211 => 106,  208 => 105,  205 => 104,  201 => 103,  186 => 99,  180 => 98,  167 => 94,  161 => 93,  158 => 92,  155 => 91,  152 => 90,  150 => 89,  143 => 85,  137 => 82,  131 => 79,  125 => 76,  122 => 75,  120 => 72,  119 => 71,  115 => 69,  113 => 68,  111 => 67,  108 => 65,  106 => 64,  104 => 63,  101 => 62,  97 => 60,  95 => 59,  93 => 58,  90 => 57,  86 => 55,  84 => 54,  82 => 53,  80 => 52,  78 => 51,  76 => 50,  73 => 49,  69 => 47,  67 => 46,  63 => 44,  61 => 43,  59 => 42,  56 => 41,  52 => 39,  49 => 38,  46 => 37,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/pager.html.twig", "C:\\xampp1\\htdocs\\unh_glpi\\templates\\components\\pager.html.twig");
    }
}
