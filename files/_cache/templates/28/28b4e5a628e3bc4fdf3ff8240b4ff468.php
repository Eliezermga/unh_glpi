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

/* install/step6.html.twig */
class __TwigTemplate_164b0fea7c0f03fe376efd7dfa235f23 extends Template
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
<h3>";
        // line 34
        echo twig_escape_filter($this->env, __("Collect data"), "html", null, true);
        echo "</h3>

<hr>
<p>
   ";
        // line 38
        echo ($context["telemetry_info"] ?? null);
        echo "
</p>

<hr>
<p>
   ";
        // line 43
        echo ($context["reference_info"] ?? null);
        echo "
</p>

<hr>
<form action=\"install.php\" method=\"post\" data-submit-once>
   <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">
      ";
        // line 49
        echo twig_escape_filter($this->env, __("Continue"), "html", null, true);
        echo "
      <i class=\"fas fa-chevron-right ms-1\"></i>
   </button>

   <input type=\"hidden\" name=\"install\" value=\"Etape_5\">
   <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
        // line 54
        echo twig_escape_filter($this->env, Session::getNewCSRFToken(), "html", null, true);
        echo "\">
</form>
";
    }

    public function getTemplateName()
    {
        return "install/step6.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 54,  64 => 49,  55 => 43,  47 => 38,  40 => 34,  37 => 33,);
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

<h3>{{ __(\"Collect data\") }}</h3>

<hr>
<p>
   {{ telemetry_info|raw }}
</p>

<hr>
<p>
   {{ reference_info|raw }}
</p>

<hr>
<form action=\"install.php\" method=\"post\" data-submit-once>
   <button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">
      {{ __(\"Continue\") }}
      <i class=\"fas fa-chevron-right ms-1\"></i>
   </button>

   <input type=\"hidden\" name=\"install\" value=\"Etape_5\">
   <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"{{ csrf_token() }}\">
</form>
", "install/step6.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\install\\step6.html.twig");
    }
}
