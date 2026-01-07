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

/* components/itilobject/fields/global_validation.html.twig */
class __TwigTemplate_74d83ee12e0007e2c366f040c814aed4 extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/itilobject/fields/global_validation.html.twig", 34)->unwrap();
        // line 35
        echo "
";
        // line 36
        $context["validation"] = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getValidationClassInstance", [], "method", false, false, false, 36);
        // line 37
        echo "
";
        // line 38
        if ( !(null === ($context["validation"] ?? null))) {
            // line 39
            echo "   ";
            $context["create_right_val"] = twig_constant("CREATE");
            // line 40
            echo "   ";
            $context["validation_right"] = "validate";
            // line 41
            echo "   ";
            if ((twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getType", [], "method", false, false, false, 41) == "Ticket")) {
                // line 42
                echo "      ";
                if (((($__internal_compile_0 = ($context["params"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["type"] ?? null) : null) == twig_constant("Ticket::INCIDENT_TYPE"))) {
                    // line 43
                    echo "         ";
                    $context["create_right_val"] = twig_constant("TicketValidation::CREATEINCIDENT");
                    // line 44
                    echo "         ";
                    $context["validation_right"] = "validate_incident";
                    // line 45
                    echo "      ";
                } elseif (((($__internal_compile_1 = ($context["params"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["type"] ?? null) : null) == twig_constant("Ticket::DEMAND_TYPE"))) {
                    // line 46
                    echo "         ";
                    $context["create_right_val"] = twig_constant("TicketValidation::CREATEREQUEST");
                    // line 47
                    echo "         ";
                    $context["validation_right"] = "validate_request";
                    // line 48
                    echo "      ";
                }
                // line 49
                echo "   ";
            }
            // line 50
            echo "   ";
            $context["can_create"] = Session::haveRight($this->extensions['Glpi\Application\View\Extension\PhpExtension']->getStatic(($context["validation"] ?? null), "rightname"), ($context["create_right_val"] ?? null));
            // line 51
            echo "
   ";
            // line 52
            if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 52)) {
                // line 53
                echo "      ";
                if (($context["can_create"] ?? null)) {
                    // line 54
                    echo "         ";
                    $context["required"] = [];
                    // line 55
                    echo "         ";
                    if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["field_options"] ?? null), "fields_template", [], "any", false, false, false, 55), "isMandatoryField", [0 => "_add_validation"], "method", false, false, false, 55)) {
                        // line 56
                        echo "            ";
                        $context["required"] = ["required" => true];
                        // line 59
                        echo "         ";
                    }
                    // line 60
                    echo "
         ";
                    // line 61
                    echo twig_call_macro($macros["fields"], "macro_field", ["_add_validation", twig_get_attribute($this->env, $this->source,                     // line 63
($context["validation"] ?? null), "dropdownValidator", [0 => twig_array_merge(["name" => "users_id_validate", "entity" => (($__internal_compile_2 = twig_get_attribute($this->env, $this->source,                     // line 65
($context["item"] ?? null), "fields", [], "any", false, false, false, 65)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["entities_id"] ?? null) : null), "right" =>                     // line 66
($context["validation_right"] ?? null), "users_id_validate" => (($__internal_compile_3 =                     // line 67
($context["params"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["users_id_validate"] ?? null) : null), "display" => false, "disabled" =>  !                    // line 69
($context["canupdate"] ?? null)],                     // line 70
($context["required"] ?? null))], "method", false, false, false, 63), __("Approval request"),                     // line 72
($context["field_options"] ?? null)], 61, $context, $this->getSourceContext());
                    // line 73
                    echo "

         <input type=\"hidden\" name=\"_add_validation\" value=\"";
                    // line 75
                    echo twig_escape_filter($this->env, (($__internal_compile_4 = ($context["params"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["_add_validation"] ?? null) : null), "html", null, true);
                    echo "\" />
      ";
                }
                // line 77
                echo "   ";
            } else {
                // line 78
                echo "        ";
                if ( !twig_get_attribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isHiddenField", [0 => "global_validation"], "method", false, false, false, 78)) {
                    // line 79
                    echo "            ";
                    echo twig_call_macro($macros["fields"], "macro_htmlField", ["global_validation", $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("TicketValidation::getStatus", [0 => (($__internal_compile_5 = twig_get_attribute($this->env, $this->source,                     // line 81
($context["item"] ?? null), "fields", [], "any", false, false, false, 81)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["global_validation"] ?? null) : null), 1 => true]), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("CommonITILValidation"),                     // line 83
($context["field_options"] ?? null)], 79, $context, $this->getSourceContext());
                    // line 84
                    echo "
        ";
                }
                // line 86
                echo "   ";
            }
        }
    }

    public function getTemplateName()
    {
        return "components/itilobject/fields/global_validation.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  144 => 86,  140 => 84,  138 => 83,  137 => 81,  135 => 79,  132 => 78,  129 => 77,  124 => 75,  120 => 73,  118 => 72,  117 => 70,  116 => 69,  115 => 67,  114 => 66,  113 => 65,  112 => 63,  111 => 61,  108 => 60,  105 => 59,  102 => 56,  99 => 55,  96 => 54,  93 => 53,  91 => 52,  88 => 51,  85 => 50,  82 => 49,  79 => 48,  76 => 47,  73 => 46,  70 => 45,  67 => 44,  64 => 43,  61 => 42,  58 => 41,  55 => 40,  52 => 39,  50 => 38,  47 => 37,  45 => 36,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/fields/global_validation.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\components\\itilobject\\fields\\global_validation.html.twig");
    }
}
