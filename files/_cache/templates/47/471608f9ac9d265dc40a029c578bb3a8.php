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

/* components/messages_after_redirect_toasts.html.twig */
class __TwigTemplate_f1a259c428a7f0a731eb0ed883dbf9c7 extends Template
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
        $context["messages"] = $this->extensions['Glpi\Application\View\Extension\SessionExtension']->pullMessages();
        // line 35
        echo "
";
        // line 36
        ob_start(function () { return ''; });
        // line 37
        echo "    ";
        if (twig_length_filter($this->env, ($context["messages"] ?? null))) {
            // line 38
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["messages"] ?? null));
            foreach ($context['_seq'] as $context["type"] => $context["message"]) {
                // line 39
                echo "            ";
                $context["message"] = twig_join_filter($context["message"], "<br />");
                // line 40
                echo "            ";
                $context["class"] = "";
                // line 41
                echo "            ";
                $context["title"] = "";
                // line 42
                echo "            ";
                if (($context["type"] == twig_constant("ERROR"))) {
                    // line 43
                    echo "                ";
                    $context["class"] = "bg-danger text-white";
                    // line 44
                    echo "                ";
                    $context["title"] = __("Error");
                    // line 45
                    echo "            ";
                } elseif (($context["type"] == twig_constant("WARNING"))) {
                    // line 46
                    echo "                ";
                    $context["class"] = "bg-warning text-white";
                    // line 47
                    echo "                ";
                    $context["title"] = __("Warning");
                    // line 48
                    echo "            ";
                } else {
                    // line 49
                    echo "                ";
                    $context["class"] = "bg-info text-white";
                    // line 50
                    echo "                ";
                    $context["title"] = _n("Information", "Informations", 1);
                    // line 51
                    echo "            ";
                }
                // line 52
                echo "
            <div class=\"toast animate__animated animate__tada animate__delay-2s animate__slow\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\">
                <div class=\"toast-header ";
                // line 54
                echo twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
                echo " \">
                    <strong class=\"me-auto\">";
                // line 55
                echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
                echo "</strong>
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"toast\" aria-label=\"Close\"></button>
                </div>
                <div class=\"toast-body\">
                    ";
                // line 59
                echo $context["message"];
                echo "
                </div>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['type'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 63
            echo "    ";
        }
        $context["toasts_html"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 65
        echo "
";
        // line 66
        if (($context["display_container"] ?? null)) {
            // line 67
            echo "    <div class=\"toast-container bottom-0 end-0 p-3 messages_after_redirect\" id=\"messages_after_redirect\">
        ";
            // line 68
            echo twig_escape_filter($this->env, ($context["toasts_html"] ?? null), "html", null, true);
            echo "

        <script type=\"text/javascript\">
        var initMessagesAfterRedirectToasts = function() {
            var toastElList = [].slice.call(document.querySelectorAll('#messages_after_redirect .toast:not(.show)'));
            var toastList = toastElList.map(function (toastEl) {
                var toast = new bootstrap.Toast(toastEl, {
                    delay: 10000,
                })
                toast.show()

                \$(toastEl).on('hidden.bs.toast', function () {
                    \$(toastEl).remove();
                });

                return toast;
            });
        }
        \$(function() {
            initMessagesAfterRedirectToasts();
        });
        </script>
    </div>
";
        } else {
            // line 92
            echo "    ";
            echo twig_escape_filter($this->env, ($context["toasts_html"] ?? null), "html", null, true);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "components/messages_after_redirect_toasts.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  158 => 92,  131 => 68,  128 => 67,  126 => 66,  123 => 65,  119 => 63,  109 => 59,  102 => 55,  98 => 54,  94 => 52,  91 => 51,  88 => 50,  85 => 49,  82 => 48,  79 => 47,  76 => 46,  73 => 45,  70 => 44,  67 => 43,  64 => 42,  61 => 41,  58 => 40,  55 => 39,  50 => 38,  47 => 37,  45 => 36,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/messages_after_redirect_toasts.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\components\\messages_after_redirect_toasts.html.twig");
    }
}
