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

/* components/alerts_macros.html.twig */
class __TwigTemplate_334066ee4b2cf62ba8cb08b7c48022e8 extends Template
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
        $macros["_self"] = $this->macros["_self"] = $this;
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 33
        echo "
";
        // line 62
        echo "
";
        // line 72
        echo "
";
        // line 82
        echo "
";
        // line 92
        echo "
";
    }

    // line 34
    public function macro_alert($__alert_type__ = "", $__title__ = "", $__messages__ = [], $__icon__ = "", $__important__ = false, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "alert_type" => $__alert_type__,
            "title" => $__title__,
            "messages" => $__messages__,
            "icon" => $__icon__,
            "important" => $__important__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 35
            echo "   <div class=\"alert alert-";
            echo twig_escape_filter($this->env, ($context["alert_type"] ?? null), "html", null, true);
            echo " ";
            echo ((($context["important"] ?? null)) ? ("alert-important") : (""));
            echo "\" role=\"alert\">
      <div class=\"d-flex\">
         <div>
            <i class=\"";
            // line 38
            echo twig_escape_filter($this->env, ($context["icon"] ?? null), "html", null, true);
            echo " fa-2x alert-icon\"></i>
         </div>
         <div>
            ";
            // line 41
            if (twig_length_filter($this->env, ($context["title"] ?? null))) {
                // line 42
                echo "               <h4 class=\"alert-title\">
                  ";
                // line 43
                echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
                echo "
               </h4>
            ";
            }
            // line 46
            echo "            ";
            if ((twig_length_filter($this->env, ($context["messages"] ?? null)) > 0)) {
                // line 47
                echo "               <div class=\"text-muted\">
                  ";
                // line 48
                if (twig_test_iterable(($context["messages"] ?? null))) {
                    // line 49
                    echo "                     ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["messages"] ?? null));
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
                    foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                        // line 50
                        echo "                        ";
                        echo twig_escape_filter($this->env, $context["message"], "html", null, true);
                        echo "
                        ";
                        // line 51
                        if (twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 51)) {
                            echo "<br />";
                        }
                        // line 52
                        echo "                     ";
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
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 53
                    echo "                  ";
                } else {
                    // line 54
                    echo "                     ";
                    echo twig_escape_filter($this->env, ($context["messages"] ?? null), "html", null, true);
                    echo "
                  ";
                }
                // line 56
                echo "               </div>
            ";
            }
            // line 58
            echo "         </div>
      </div>
   </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 63
    public function macro_alert_success($__title__ = "", $__messages__ = [], $__important__ = false, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "title" => $__title__,
            "messages" => $__messages__,
            "important" => $__important__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 64
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_alert", ["success",             // line 66
($context["title"] ?? null),             // line 67
($context["messages"] ?? null), "fas fa-check",             // line 69
($context["important"] ?? null)], 64, $context, $this->getSourceContext());
            // line 70
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 73
    public function macro_alert_info($__title__ = "", $__messages__ = [], $__important__ = false, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "title" => $__title__,
            "messages" => $__messages__,
            "important" => $__important__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 74
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_alert", ["info",             // line 76
($context["title"] ?? null),             // line 77
($context["messages"] ?? null), "fas fa-info-circle",             // line 79
($context["important"] ?? null)], 74, $context, $this->getSourceContext());
            // line 80
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 83
    public function macro_alert_warning($__title__ = "", $__messages__ = [], $__important__ = false, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "title" => $__title__,
            "messages" => $__messages__,
            "important" => $__important__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 84
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_alert", ["warning",             // line 86
($context["title"] ?? null),             // line 87
($context["messages"] ?? null), "fas fa-exclamation-triangle",             // line 89
($context["important"] ?? null)], 84, $context, $this->getSourceContext());
            // line 90
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    // line 93
    public function macro_alert_danger($__title__ = "", $__messages__ = [], $__important__ = false, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "title" => $__title__,
            "messages" => $__messages__,
            "important" => $__important__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 94
            echo "   ";
            echo twig_call_macro($macros["_self"], "macro_alert", ["danger",             // line 96
($context["title"] ?? null),             // line 97
($context["messages"] ?? null), "fas fa-exclamation-circle",             // line 99
($context["important"] ?? null)], 94, $context, $this->getSourceContext());
            // line 100
            echo "
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "components/alerts_macros.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  286 => 100,  284 => 99,  283 => 97,  282 => 96,  280 => 94,  265 => 93,  255 => 90,  253 => 89,  252 => 87,  251 => 86,  249 => 84,  234 => 83,  224 => 80,  222 => 79,  221 => 77,  220 => 76,  218 => 74,  203 => 73,  193 => 70,  191 => 69,  190 => 67,  189 => 66,  187 => 64,  172 => 63,  160 => 58,  156 => 56,  150 => 54,  147 => 53,  133 => 52,  129 => 51,  124 => 50,  106 => 49,  104 => 48,  101 => 47,  98 => 46,  92 => 43,  89 => 42,  87 => 41,  81 => 38,  72 => 35,  55 => 34,  50 => 92,  47 => 82,  44 => 72,  41 => 62,  38 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/alerts_macros.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\components\\alerts_macros.html.twig");
    }
}
