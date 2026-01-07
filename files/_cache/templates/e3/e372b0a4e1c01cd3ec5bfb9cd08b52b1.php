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

/* pages/login.html.twig */
class __TwigTemplate_2158f4fe498adc30e36bb2a47799c579 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content_block' => [$this, 'block_content_block'],
            'footer_block' => [$this, 'block_footer_block'],
            'javascript_block' => [$this, 'block_javascript_block'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 34
        return "layout/page_card_notlogged.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout/page_card_notlogged.html.twig", "pages/login.html.twig", 34);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 36
    public function block_content_block($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 37
        echo "   <form action=\"";
        echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("front/login.php"), "html", null, true);
        echo "\" method=\"post\" autocomplete=\"off\"  data-submit-once>
      <input type=\"hidden\" name=\"noAUTO\" value=\"";
        // line 38
        echo twig_escape_filter($this->env, ($context["noAuto"] ?? null), "html", null, true);
        echo "\" />
      <input type=\"hidden\" name=\"redirect\" value=\"";
        // line 39
        echo twig_escape_filter($this->env, ($context["redirect"] ?? null), "html", null, true);
        echo "\" />
      <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
        // line 40
        echo twig_escape_filter($this->env, Session::getNewCSRFToken(), "html", null, true);
        echo "\" />

      <div class=\"row justify-content-center\">
         <div class=\"col-md-5\">
            <div class=\"card-header mb-4\">
               <h2 class=\"mx-auto\">";
        // line 45
        echo twig_escape_filter($this->env, __("Login to your account"), "html", null, true);
        echo "</h2>
            </div>
            <div class=\"mb-3\">
               <label class=\"form-label\">";
        // line 48
        echo twig_escape_filter($this->env, __("Login"), "html", null, true);
        echo "</label>
               <input type=\"text\" class=\"form-control\" id=\"login_name\" name=\"";
        // line 49
        echo twig_escape_filter($this->env, ($context["namfield"] ?? null), "html", null, true);
        echo "\" placeholder=\"\" tabindex=\"1\" />
            </div>
            <div class=\"mb-4\">
               <label class=\"form-label\">
                  ";
        // line 53
        echo twig_escape_filter($this->env, __("Password"), "html", null, true);
        echo "

                  ";
        // line 55
        if (($context["show_lost_password"] ?? null)) {
            // line 56
            echo "                     <span class=\"form-label-description\">
                        <a href=\"";
            // line 57
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("front/lostpassword.php?lostpassword=1"), "html", null, true);
            echo "\">
                           ";
            // line 58
            echo twig_escape_filter($this->env, __("Forgotten password?"), "html", null, true);
            echo "
                        </a>
                     </span>
                  ";
        }
        // line 62
        echo "               </label>
               <input type=\"password\" class=\"form-control\" name=\"";
        // line 63
        echo twig_escape_filter($this->env, ($context["pwdfield"] ?? null), "html", null, true);
        echo "\" placeholder=\"\" autocomplete=\"off\" tabindex=\"2\" />
            </div>

            ";
        // line 66
        if (twig_constant("GLPI_DEMO_MODE")) {
            // line 67
            echo "               <div class=\"mb-3\">
                  <label class=\"form-label\">";
            // line 68
            echo twig_escape_filter($this->env, __("Language"), "html", null, true);
            echo "</label>
                  ";
            // line 69
            echo ($context["languages_dropdown"] ?? null);
            echo "
               </div>
            ";
        }
        // line 72
        echo "
            ";
        // line 73
        if ($this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("display_login_source")) {
            // line 74
            echo "               <div class=\"mb-3\">
                  <label class=\"form-label\">";
            // line 75
            echo twig_escape_filter($this->env, __("Login source"), "html", null, true);
            echo "</label>
                  ";
            // line 76
            echo ($context["auth_dropdown_login"] ?? null);
            echo "
               </div>
            ";
        }
        // line 79
        echo "
            ";
        // line 80
        if ($this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("login_remember_time")) {
            // line 81
            echo "               <div class=\"mb-2\">
                  <label class=\"form-check\">
                     <input type=\"checkbox\" class=\"form-check-input\" name=\"";
            // line 83
            echo twig_escape_filter($this->env, ($context["rmbfield"] ?? null), "html", null, true);
            echo "\" ";
            echo (($this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("login_remember_default")) ? ("checked") : (""));
            echo " />
                     <span class=\"form-check-label\">";
            // line 84
            echo twig_escape_filter($this->env, __("Remember me"), "html", null, true);
            echo "</span>
                  </label>
               </div>
            ";
        }
        // line 88
        echo "
            <div class=\"form-footer\">
               <button type=\"submit\" name=\"submit\" class=\"btn btn-primary w-100\" tabindex=\"3\">
                  ";
        // line 91
        echo twig_escape_filter($this->env, __("Sign in"), "html", null, true);
        echo "
               </button>
            </div>

            ";
        // line 95
        if ((twig_length_filter($this->env, ($context["errors"] ?? null)) > 0)) {
            // line 96
            echo "               <hr />
               <div class=\"alert alert-danger\" role=\"alert\">
                  ";
            // line 98
            echo twig_escape_filter($this->env, ($context["errors"] ?? null), "html", null, true);
            echo "
               </div>
            ";
        }
        // line 101
        echo "         </div>

         ";
        // line 103
        if (($context["right_panel"] ?? null)) {
            // line 104
            echo "            <div class=\"col-auto px-2 text-center\">
               ";
            // line 105
            if ((twig_length_filter($this->env, ($context["text_login"] ?? null)) > 0)) {
                // line 106
                echo "                  <div class=\"rich_text_container\">
                     ";
                // line 107
                echo $this->extensions['Glpi\Application\View\Extension\DataHelpersExtension']->getSafeHtml(($context["text_login"] ?? null));
                echo "
                  </div>
               ";
            }
            // line 110
            echo "
               ";
            // line 111
            if ($this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("use_public_faq")) {
                // line 112
                echo "                  <hr />

                  <a class=\"btn btn-outline-secondary btn-icon\" href=\"front/helpdesk.faq.php\">
                     <i class=\"fas fa-question\"></i>&nbsp;
                     ";
                // line 116
                echo twig_escape_filter($this->env, __("FAQ"), "html", null, true);
                echo "
                  </a>
               ";
            }
            // line 119
            echo "
               ";
            // line 120
            echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\PluginExtension']->callPluginHook(twig_constant("Glpi\\Plugin\\Hooks::DISPLAY_LOGIN")), "html", null, true);
            echo "
            </div>
         ";
        }
        // line 123
        echo "      </div>
   </form>
";
    }

    // line 127
    public function block_footer_block($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 128
        echo "   ";
        echo ($context["copyright_message"] ?? null);
        echo "
";
    }

    // line 131
    public function block_javascript_block($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 132
        echo "<script type=\"text/javascript\">
   \$(function () {
\$('#login_name').focus();
});
</script>
";
    }

    public function getTemplateName()
    {
        return "pages/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  266 => 132,  262 => 131,  255 => 128,  251 => 127,  245 => 123,  239 => 120,  236 => 119,  230 => 116,  224 => 112,  222 => 111,  219 => 110,  213 => 107,  210 => 106,  208 => 105,  205 => 104,  203 => 103,  199 => 101,  193 => 98,  189 => 96,  187 => 95,  180 => 91,  175 => 88,  168 => 84,  162 => 83,  158 => 81,  156 => 80,  153 => 79,  147 => 76,  143 => 75,  140 => 74,  138 => 73,  135 => 72,  129 => 69,  125 => 68,  122 => 67,  120 => 66,  114 => 63,  111 => 62,  104 => 58,  100 => 57,  97 => 56,  95 => 55,  90 => 53,  83 => 49,  79 => 48,  73 => 45,  65 => 40,  61 => 39,  57 => 38,  52 => 37,  48 => 36,  37 => 34,);
    }

    public function getSourceContext()
    {
        return new Source("", "pages/login.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\pages\\login.html.twig");
    }
}
