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

/* install/step3.html.twig */
class __TwigTemplate_a9e71d0fad9836610b99f9e6e65e7d1f extends Template
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
        $macros["alerts"] = $this->macros["alerts"] = $this->loadTemplate("components/alerts_macros.html.twig", "install/step3.html.twig", 34)->unwrap();
        // line 35
        echo "
<h3>";
        // line 36
        echo twig_escape_filter($this->env, __("Test of the connection at the database"), "html", null, true);
        echo "</h3>

";
        // line 38
        if ((((twig_length_filter($this->env, ($context["host"] ?? null)) == 0) || (twig_length_filter($this->env, ($context["user"] ?? null)) == 0)) || twig_get_attribute($this->env, $this->source, ($context["link"] ?? null), "connect_error", [], "any", false, false, false, 38))) {
            // line 39
            echo "
   ";
            // line 40
            echo twig_call_macro($macros["alerts"], "macro_alert_danger", [__("Can't connect to the database"), twig_sprintf(__("The server answered: %s"), twig_get_attribute($this->env, $this->source,             // line 42
($context["link"] ?? null), "connect_error", [], "any", false, false, false, 42))], 40, $context, $this->getSourceContext());
            // line 43
            echo "

   <form action=\"install.php\" method=\"post\" class=\"d-inline\" data-submit-once>
      <button type=\"submit\" name=\"submit\" class=\"btn btn-warning\">
         <i class=\"fas fa-chevron-left me-1 fa-2x alert-icon\"></i>
         ";
            // line 48
            echo twig_escape_filter($this->env, __("Back"), "html", null, true);
            echo "
      </button>

      <input type=\"hidden\" name=\"update\" value=\"";
            // line 51
            echo twig_escape_filter($this->env, ($context["update"] ?? null), "html", null, true);
            echo "\">
      <input type=\"hidden\" name=\"install\" value=\"Etape_1\">
      <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
            // line 53
            echo twig_escape_filter($this->env, Session::getNewCSRFToken(), "html", null, true);
            echo "\">
   </form>
";
        } else {
            // line 56
            echo "   ";
            echo twig_call_macro($macros["alerts"], "macro_alert_success", [__("Database connection successful")], 56, $context, $this->getSourceContext());
            // line 58
            echo "

   ";
            // line 60
            if ( !twig_get_attribute($this->env, $this->source, ($context["engine_requirement"] ?? null), "isValidated", [], "method", false, false, false, 60)) {
                // line 61
                echo "      ";
                echo twig_call_macro($macros["alerts"], "macro_alert_danger", [__("Database engine is not supported."), twig_get_attribute($this->env, $this->source,                 // line 63
($context["engine_requirement"] ?? null), "getValidationMessages", [], "method", false, false, false, 63)], 61, $context, $this->getSourceContext());
                // line 64
                echo "
   ";
            }
            // line 66
            echo "
   ";
            // line 67
            if ( !twig_get_attribute($this->env, $this->source, ($context["config_requirement"] ?? null), "isValidated", [], "method", false, false, false, 67)) {
                // line 68
                echo "      ";
                echo twig_call_macro($macros["alerts"], "macro_alert_danger", [__("Database configuration is not supported."), twig_get_attribute($this->env, $this->source,                 // line 70
($context["config_requirement"] ?? null), "getValidationMessages", [], "method", false, false, false, 70)], 68, $context, $this->getSourceContext());
                // line 71
                echo "
   ";
            }
            // line 73
            echo "
   ";
            // line 74
            if ((twig_get_attribute($this->env, $this->source, ($context["engine_requirement"] ?? null), "isValidated", [], "method", false, false, false, 74) && twig_get_attribute($this->env, $this->source, ($context["config_requirement"] ?? null), "isValidated", [], "method", false, false, false, 74))) {
                // line 75
                echo "      <div class=\"container mt-4\">
         <form action='install.php' method='post'>
            <div class=\"mb-3\">
               <h3>
                  ";
                // line 79
                echo twig_escape_filter($this->env, (((($context["update"] ?? null) == "no")) ? (__("Please select a database:")) : (__("Please select a database to update:"))), "html", null, true);
                echo "
               </h3>
               <div class=\"form-selectgroup form-selectgroup-boxes d-flex flex-column\">
                  ";
                // line 82
                if ((($context["update"] ?? null) == "no")) {
                    // line 83
                    echo "                     <label class=\"form-selectgroup-item flex-fill\">
                        <input type=\"radio\" name=\"databasename\" value=\"0\" class=\"form-selectgroup-input\" checked=\"checked\">
                        <div class=\"form-selectgroup-label d-flex align-items-center p-3\">
                           <div class=\"me-3\">
                              <span class=\"form-selectgroup-check\"></span>
                           </div>
                           <div>
                              <label for=\"new_db\" class=\"form-label\">
                                 ";
                    // line 91
                    echo twig_escape_filter($this->env, __("Create a new database or use an existing one:"), "html", null, true);
                    echo "
                              </label>
                              <input type=\"text\" name=\"newdatabasename\" id=\"new_db\" class=\"form-control\" autofocus>
                           </div>
                        </div>
                     </label>
                  ";
                }
                // line 98
                echo "
                  ";
                // line 99
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["databases"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["database"]) {
                    // line 100
                    echo "                     <label class=\"form-selectgroup-item flex-fill\">
                        <input type=\"radio\" name=\"databasename\" value=\"";
                    // line 101
                    echo twig_escape_filter($this->env, $context["database"], "html", null, true);
                    echo "\" class=\"form-selectgroup-input\">
                        <div class=\"form-selectgroup-label d-flex align-items-center p-3\">
                           <div class=\"me-3\">
                              <span class=\"form-selectgroup-check\"></span>
                           </div>
                           <div>
                              ";
                    // line 107
                    echo twig_escape_filter($this->env, $context["database"], "html", null, true);
                    echo "
                           </div>
                        </div>
                     </label>
                  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['database'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 112
                echo "               </div>
            </div>

            <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">
               ";
                // line 116
                echo twig_escape_filter($this->env, __("Continue"), "html", null, true);
                echo "
               <i class=\"fas fa-chevron-right ms-1\"></i>
            </button>

            ";
                // line 120
                if ((($context["update"] ?? null) == "no")) {
                    // line 121
                    echo "               <input type=\"hidden\" name=\"install\" value=\"Etape_3\">
            ";
                } else {
                    // line 123
                    echo "               <input type=\"hidden\" name=\"install\" value=\"update_1\">
            ";
                }
                // line 125
                echo "
            <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
                // line 126
                echo twig_escape_filter($this->env, Session::getNewCSRFToken(), "html", null, true);
                echo "\">
         </form>
      </div>
   ";
            }
        }
    }

    public function getTemplateName()
    {
        return "install/step3.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  207 => 126,  204 => 125,  200 => 123,  196 => 121,  194 => 120,  187 => 116,  181 => 112,  170 => 107,  161 => 101,  158 => 100,  154 => 99,  151 => 98,  141 => 91,  131 => 83,  129 => 82,  123 => 79,  117 => 75,  115 => 74,  112 => 73,  108 => 71,  106 => 70,  104 => 68,  102 => 67,  99 => 66,  95 => 64,  93 => 63,  91 => 61,  89 => 60,  85 => 58,  82 => 56,  76 => 53,  71 => 51,  65 => 48,  58 => 43,  56 => 42,  55 => 40,  52 => 39,  50 => 38,  45 => 36,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("{#
 # ---------------------------------------------------------------------
 #
 # GLPI - Gestionnaire Libre de Parc Informatique
 #
 # http://glpi-project.org
 #
 # @copyright 2015-2023 Teclib' and contributors.
 # @copyright 2003-2014 by the INDEPNET Development Team.
 # @licence   https://www.gnu.org/licenses/gpl-3.0.html
 #
 # ---------------------------------------------------------------------
 #
 # LICENSE
 #
 # This file is part of GLPI.
 #
 # This program is free software: you can redistribute it and/or modify
 # it under the terms of the GNU General Public License as published by
 # the Free Software Foundation, either version 3 of the License, or
 # (at your option) any later version.
 #
 # This program is distributed in the hope that it will be useful,
 # but WITHOUT ANY WARRANTY; without even the implied warranty of
 # MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 # GNU General Public License for more details.
 #
 # You should have received a copy of the GNU General Public License
 # along with this program.  If not, see <https://www.gnu.org/licenses/>.
 #
 # ---------------------------------------------------------------------
 #}

{% import 'components/alerts_macros.html.twig' as alerts %}

<h3>{{ __('Test of the connection at the database') }}</h3>

{% if host|length == 0 or user|length == 0 or link.connect_error %}

   {{ alerts.alert_danger(
      __(\"Can't connect to the database\"),
      __('The server answered: %s')|format(link.connect_error)
   ) }}

   <form action=\"install.php\" method=\"post\" class=\"d-inline\" data-submit-once>
      <button type=\"submit\" name=\"submit\" class=\"btn btn-warning\">
         <i class=\"fas fa-chevron-left me-1 fa-2x alert-icon\"></i>
         {{ __(\"Back\") }}
      </button>

      <input type=\"hidden\" name=\"update\" value=\"{{ update }}\">
      <input type=\"hidden\" name=\"install\" value=\"Etape_1\">
      <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"{{ csrf_token() }}\">
   </form>
{% else %}
   {{ alerts.alert_success(
      __('Database connection successful'),
   ) }}

   {% if not engine_requirement.isValidated() %}
      {{ alerts.alert_danger(
         __('Database engine is not supported.'),
         engine_requirement.getValidationMessages()
      ) }}
   {% endif %}

   {% if not config_requirement.isValidated() %}
      {{ alerts.alert_danger(
         __('Database configuration is not supported.'),
         config_requirement.getValidationMessages()
      ) }}
   {% endif %}

   {% if engine_requirement.isValidated() and config_requirement.isValidated() %}
      <div class=\"container mt-4\">
         <form action='install.php' method='post'>
            <div class=\"mb-3\">
               <h3>
                  {{ update == \"no\" ? __('Please select a database:') : __('Please select a database to update:') }}
               </h3>
               <div class=\"form-selectgroup form-selectgroup-boxes d-flex flex-column\">
                  {% if update == \"no\" %}
                     <label class=\"form-selectgroup-item flex-fill\">
                        <input type=\"radio\" name=\"databasename\" value=\"0\" class=\"form-selectgroup-input\" checked=\"checked\">
                        <div class=\"form-selectgroup-label d-flex align-items-center p-3\">
                           <div class=\"me-3\">
                              <span class=\"form-selectgroup-check\"></span>
                           </div>
                           <div>
                              <label for=\"new_db\" class=\"form-label\">
                                 {{ __('Create a new database or use an existing one:') }}
                              </label>
                              <input type=\"text\" name=\"newdatabasename\" id=\"new_db\" class=\"form-control\" autofocus>
                           </div>
                        </div>
                     </label>
                  {% endif %}

                  {% for database in databases %}
                     <label class=\"form-selectgroup-item flex-fill\">
                        <input type=\"radio\" name=\"databasename\" value=\"{{ database }}\" class=\"form-selectgroup-input\">
                        <div class=\"form-selectgroup-label d-flex align-items-center p-3\">
                           <div class=\"me-3\">
                              <span class=\"form-selectgroup-check\"></span>
                           </div>
                           <div>
                              {{ database }}
                           </div>
                        </div>
                     </label>
                  {% endfor %}
               </div>
            </div>

            <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">
               {{ __(\"Continue\") }}
               <i class=\"fas fa-chevron-right ms-1\"></i>
            </button>

            {% if update == \"no\" %}
               <input type=\"hidden\" name=\"install\" value=\"Etape_3\">
            {% else %}
               <input type=\"hidden\" name=\"install\" value=\"update_1\">
            {% endif %}

            <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"{{ csrf_token() }}\">
         </form>
      </div>
   {% endif %}
{% endif %}
", "install/step3.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\install\\step3.html.twig");
    }
}
