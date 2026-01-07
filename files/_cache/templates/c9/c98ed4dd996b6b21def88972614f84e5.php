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

/* components/user/picture.html.twig */
class __TwigTemplate_e9e32a13edf89c13f00b16634570e820 extends Template
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
        $context["enable_anonymization"] = (($context["enable_anonymization"]) ?? (false));
        // line 35
        $context["avatar_size"] = (($context["avatar_size"]) ?? ("avatar-md"));
        // line 36
        $context["anonymized"] = (($context["enable_anonymization"] ?? null) && ($this->extensions['Glpi\Application\View\Extension\ConfigExtension']->getEntityConfig("anonymize_support_agents", $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactive_entity")) != twig_constant("Entity::ANONYMIZE_DISABLED")));
        // line 37
        $context["user"] = $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItem("User", ($context["users_id"] ?? null));
        // line 38
        $context["with_link"] = (($context["with_link"]) ?? (true));
        // line 39
        $context["user_thumbnail"] = twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "getThumbnailPicturePath", [0 => ($context["enable_anonymization"] ?? null)], "method", false, false, false, 39);
        // line 40
        if (((($context["user_thumbnail"] ?? null) == null) &&  !$this->extensions['Glpi\Application\View\Extension\ConfigExtension']->getEntityConfig("display_users_initials", $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpiactive_entity")))) {
            // line 41
            echo "    ";
            $context["user_thumbnail"] = twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "getPicturePath", [0 => ($context["enable_anonymization"] ?? null)], "method", false, false, false, 41);
        }
        // line 43
        echo "
";
        // line 44
        if ((($context["with_link"] ?? null) &&  !($context["anonymized"] ?? null))) {
            // line 45
            echo "   <a href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "getLinkURL", [], "method", false, false, false, 45), "html", null, true);
            echo "\" class=\"d-flex align-items-center\">
";
        }
        // line 47
        echo "
<span class=\"avatar ";
        // line 48
        echo twig_escape_filter($this->env, ($context["avatar_size"] ?? null), "html", null, true);
        echo " rounded\"
      style=\"";
        // line 49
        if ( !(null === ($context["user_thumbnail"] ?? null))) {
            echo "background-image: url(";
            echo twig_escape_filter($this->env, ($context["user_thumbnail"] ?? null), "html", null, true);
            echo "); background-color: inherit; ";
        } else {
            echo " background-color: ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "getUserInitialsBgColor", [], "method", false, false, false, 49), "html", null, true);
        }
        echo "\">
   ";
        // line 50
        if ((null === ($context["user_thumbnail"] ?? null))) {
            // line 51
            echo "         ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "getUserInitials", [0 => ($context["enable_anonymization"] ?? null)], "method", false, false, false, 51), "html", null, true);
            echo "
   ";
        }
        // line 53
        echo "</span>

";
        // line 55
        if ((($context["with_link"] ?? null) &&  !($context["anonymized"] ?? null))) {
            // line 56
            echo "   ";
            if (($context["display_login"] ?? null)) {
                // line 57
                echo "      <span class=\"ms-2\">";
                echo twig_escape_filter($this->env, (($__internal_compile_0 = twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "fields", [], "any", false, false, false, 57)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["name"] ?? null) : null), "html", null, true);
                echo "</span>
   ";
            }
            // line 59
            echo "
   </a>
";
        }
    }

    public function getTemplateName()
    {
        return "components/user/picture.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  110 => 59,  104 => 57,  101 => 56,  99 => 55,  95 => 53,  89 => 51,  87 => 50,  76 => 49,  72 => 48,  69 => 47,  63 => 45,  61 => 44,  58 => 43,  54 => 41,  52 => 40,  50 => 39,  48 => 38,  46 => 37,  44 => 36,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/user/picture.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\components\\user\\picture.html.twig");
    }
}
