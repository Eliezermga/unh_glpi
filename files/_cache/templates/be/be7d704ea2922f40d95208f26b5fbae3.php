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

/* layout/parts/page_footer.html.twig */
class __TwigTemplate_2aae7a7abf1b496d4aa2f377c2d64df3 extends Template
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
            </main> ";
        // line 35
        echo "         </div> ";
        // line 36
        echo "      </div> ";
        // line 37
        echo "   </div> ";
        // line 38
        echo "
   <div class=\"floating-buttons d-inline-flex\">
      <span class=\"btn btn-secondary d-none me-1\" id=\"backtotop\">
         <i class=\"fas fa-arrow-up\" title=\"";
        // line 41
        echo twig_escape_filter($this->env, __("Back to top of the page"), "html", null, true);
        echo "\">
            <span class=\"visually-hidden\">";
        // line 42
        echo twig_escape_filter($this->env, __("Top of the page"), "html", null, true);
        echo "</span>
         </i>
      </span>
   </div>

   ";
        // line 47
        if ($this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("maintenance_mode")) {
            // line 48
            echo "      <div id=\"maintenance-float\">
         <a href=\"";
            // line 49
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("front/config.form.php?forcetab=Config\$5"), "html", null, true);
            echo "\">GLPI MAINTENANCE MODE</a>
      </div>
   ";
        }
        // line 52
        echo "
   ";
        // line 53
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["js_files"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["js_file"]) {
            // line 54
            echo "      <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\FrontEndAssetsExtension']->jsPath(twig_get_attribute($this->env, $this->source, $context["js_file"], "path", [], "any", false, false, false, 54), (((twig_get_attribute($this->env, $this->source, $context["js_file"], "options", [], "any", true, true, false, 54) &&  !(null === twig_get_attribute($this->env, $this->source, $context["js_file"], "options", [], "any", false, false, false, 54)))) ? (twig_get_attribute($this->env, $this->source, $context["js_file"], "options", [], "any", false, false, false, 54)) : ([]))), "html", null, true);
            echo "\"></script>
   ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['js_file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        echo "
   ";
        // line 57
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["js_modules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["js_file"]) {
            // line 58
            echo "      <script type=\"module\" src=\"";
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\FrontEndAssetsExtension']->jsPath(twig_get_attribute($this->env, $this->source, $context["js_file"], "path", [], "any", false, false, false, 58), (((twig_get_attribute($this->env, $this->source, $context["js_file"], "options", [], "any", true, true, false, 58) &&  !(null === twig_get_attribute($this->env, $this->source, $context["js_file"], "options", [], "any", false, false, false, 58)))) ? (twig_get_attribute($this->env, $this->source, $context["js_file"], "options", [], "any", false, false, false, 58)) : ([]))), "html", null, true);
            echo "\"></script>
   ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['js_file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 60
        echo "
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "layout/parts/page_footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 60,  97 => 58,  93 => 57,  90 => 56,  81 => 54,  77 => 53,  74 => 52,  68 => 49,  65 => 48,  63 => 47,  55 => 42,  51 => 41,  46 => 38,  44 => 37,  42 => 36,  40 => 35,  37 => 33,);
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

            </main> {# #page #}
         </div> {# .page-body #}
      </div> {# .page-wrapper #}
   </div> {# .page #}

   <div class=\"floating-buttons d-inline-flex\">
      <span class=\"btn btn-secondary d-none me-1\" id=\"backtotop\">
         <i class=\"fas fa-arrow-up\" title=\"{{ __('Back to top of the page') }}\">
            <span class=\"visually-hidden\">{{ __('Top of the page') }}</span>
         </i>
      </span>
   </div>

   {% if config('maintenance_mode') %}
      <div id=\"maintenance-float\">
         <a href=\"{{ path('front/config.form.php?forcetab=Config\$5') }}\">GLPI MAINTENANCE MODE</a>
      </div>
   {% endif %}

   {% for js_file in js_files %}
      <script type=\"text/javascript\" src=\"{{ js_path(js_file.path, js_file.options ?? []) }}\"></script>
   {% endfor %}

   {% for js_file in js_modules %}
      <script type=\"module\" src=\"{{ js_path(js_file.path, js_file.options ?? []) }}\"></script>
   {% endfor %}

</body>
</html>
", "layout/parts/page_footer.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\layout\\parts\\page_footer.html.twig");
    }
}
