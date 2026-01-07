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

/* components/itilobject/footer.html.twig */
class __TwigTemplate_d61357eeb6befd0a42946684bff40c8a extends Template
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
        $context["timeline_btns_cls"] = ($context["left_regular_cls"] ?? null);
        // line 35
        $context["form_btns_cls"] = ((($context["is_expanded"] ?? null)) ? (($context["right_expanded_cls"] ?? null)) : ("col-lg"));
        // line 36
        $context["timeline_btn_layout"] = $this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpitimeline_action_btn_layout");
        // line 37
        $context["switch_btn_cls"] = "fa-caret-left";
        // line 38
        if (($context["is_expanded"] ?? null)) {
            // line 39
            echo "    ";
            $context["timeline_btns_cls"] = ($context["left_expanded_cls"] ?? null);
            // line 40
            echo "    ";
            $context["form_btns_cls"] = ($context["right_expanded_cls"] ?? null);
            // line 41
            echo "    ";
            $context["switch_btn_cls"] = "fa-caret-right";
        }
        // line 43
        echo "
<div class=\"mx-n2 mb-n2 itil-footer itil-footer p-0 border-top\" id=\"itil-footer\">
   <div class=\"buttons-bar d-flex py-2\">
      <div class=\"col ";
        // line 46
        echo twig_escape_filter($this->env, ($context["timeline_btns_cls"] ?? null), "html", null, true);
        echo " ps-3 timeline-buttons d-flex\">
         ";
        // line 47
        if ( !twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 47)) {
            // line 48
            echo "            ";
            $context["main_actions_itemtypes"] = twig_array_filter($this->env, ($context["timeline_itemtypes"] ?? null), function ($__v__, $__k__) use ($context, $macros) { $context["v"] = $__v__; $context["k"] = $__k__; return ( !twig_get_attribute($this->env, $this->source, ($context["v"] ?? null), "hide_in_menu", [], "any", true, true, false, 48) || (twig_get_attribute($this->env, $this->source, ($context["v"] ?? null), "hide_in_menu", [], "any", false, false, false, 48) != true)); });
            // line 49
            echo "
            ";
            // line 50
            $context["default_action_data"] = twig_first($this->env, ($context["main_actions_itemtypes"] ?? null));
            // line 51
            echo "            ";
            $context["default_action"] = twig_first($this->env, twig_get_array_keys_filter(($context["main_actions_itemtypes"] ?? null)));
            // line 52
            echo "            ";
            if ((twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isNotSolved", [], "method", false, false, false, 52) && (($context["default_action_data"] ?? null) != false))) {
                // line 53
                echo "               ";
                if ((twig_length_filter($this->env, ($context["main_actions_itemtypes"] ?? null)) > 1)) {
                    // line 54
                    echo "                  ";
                    $context["btn_class"] = (((($context["timeline_btn_layout"] ?? null) == twig_constant("Config::TIMELINE_ACTION_BTN_SPLITTED"))) ? ("") : ("btn-group"));
                    // line 55
                    echo "                  <div class=\"";
                    echo twig_escape_filter($this->env, ($context["btn_class"] ?? null), "html", null, true);
                    echo " me-2 main-actions\" style=\"";
                    echo (((($context["load_kb_sol"] ?? null) > 0)) ? ("display:none;") : (""));
                    echo "\">
               ";
                } else {
                    // line 57
                    echo "                  ";
                    // line 58
                    echo "                  <div class=\"main-actions\" style=\"display:inline-flex\">
               ";
                }
                // line 60
                echo "                  <button
                     class=\"btn btn-primary answer-action mb-2 ";
                // line 61
                (((($context["default_action"] ?? null) != "answer")) ? (print (twig_escape_filter($this->env, ("action-" . ($context["default_action"] ?? null)), "html", null, true))) : (print ("")));
                echo "\"
                     data-bs-toggle=\"collapse\"
                     data-bs-target=\"#new-";
                // line 63
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["default_action_data"] ?? null), "class", [], "any", false, false, false, 63), "html", null, true);
                echo "-block\"
                  >
                     <i class=\"";
                // line 65
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["default_action_data"] ?? null), "icon", [], "any", false, false, false, 65), "html", null, true);
                echo "\"></i>
                     <span>";
                // line 66
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["default_action_data"] ?? null), "label", [], "any", false, false, false, 66), "html", null, true);
                echo "</span>
                  </button>

                  ";
                // line 69
                if ((twig_length_filter($this->env, ($context["main_actions_itemtypes"] ?? null)) > 1)) {
                    // line 70
                    echo "                     ";
                    if ((($context["timeline_btn_layout"] ?? null) == twig_constant("Config::TIMELINE_ACTION_BTN_SPLITTED"))) {
                        // line 71
                        echo "                        ";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(($context["main_actions_itemtypes"] ?? null));
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
                        foreach ($context['_seq'] as $context["action"] => $context["timeline_itemtype"]) {
                            // line 72
                            echo "                        ";
                            if ((twig_get_attribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 72) > 0)) {
                                // line 73
                                echo "                              <button class=\"ms-2 mb-2 btn btn-primary answer-action action-";
                                echo twig_escape_filter($this->env, $context["action"], "html", null, true);
                                echo "\" data-bs-toggle=\"collapse\" data-bs-target=\"#new-";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["timeline_itemtype"], "class", [], "any", false, false, false, 73), "html", null, true);
                                echo "-block\">
                                 <i class=\"";
                                // line 74
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["timeline_itemtype"], "icon", [], "any", false, false, false, 74), "html", null, true);
                                echo "\"></i>
                                 <span>";
                                // line 75
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["timeline_itemtype"], "short_label", [], "any", false, false, false, 75), "html", null, true);
                                echo "</span>
                              </button>
                              ";
                            }
                            // line 78
                            echo "                        ";
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
                        unset($context['_seq'], $context['_iterated'], $context['action'], $context['timeline_itemtype'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 79
                        echo "                     ";
                    } else {
                        // line 80
                        echo "                        <button
                           type=\"button\"
                           class=\"btn btn-primary dropdown-toggle dropdown-toggle-split mb-2 ";
                        // line 82
                        (((($context["default_action"] ?? null) != "answer")) ? (print (twig_escape_filter($this->env, ("action-" . ($context["default_action"] ?? null)), "html", null, true))) : (print ("")));
                        echo "\"
                           data-bs-toggle=\"dropdown\"
                           aria-expanded=\"false\"
                        >
                           <span class=\"visually-hidden\">";
                        // line 86
                        echo twig_escape_filter($this->env, __("View other actions"), "html", null, true);
                        echo "</span>
                        </button>
                        <ul class=\"dropdown-menu\">
                              ";
                        // line 89
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(($context["main_actions_itemtypes"] ?? null));
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
                        foreach ($context['_seq'] as $context["action"] => $context["timeline_itemtype"]) {
                            // line 90
                            echo "                                 ";
                            if ((twig_get_attribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 90) > 0)) {
                                // line 91
                                echo "                                 <li><a class=\"dropdown-item action-";
                                echo twig_escape_filter($this->env, $context["action"], "html", null, true);
                                echo " answer-action\" href=\"#\"
                                    data-bs-toggle=\"collapse\" data-bs-target=\"#new-";
                                // line 92
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["timeline_itemtype"], "class", [], "any", false, false, false, 92), "html", null, true);
                                echo "-block\">
                                    <i class=\"";
                                // line 93
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["timeline_itemtype"], "icon", [], "any", false, false, false, 93), "html", null, true);
                                echo "\"></i>
                                    <span>";
                                // line 94
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["timeline_itemtype"], "label", [], "any", false, false, false, 94), "html", null, true);
                                echo "</span>
                                 </a></li>
                                 ";
                            }
                            // line 97
                            echo "                              ";
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
                        unset($context['_seq'], $context['_iterated'], $context['action'], $context['timeline_itemtype'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 98
                        echo "                        </ul>
                     ";
                    }
                    // line 100
                    echo "                  ";
                }
                // line 101
                echo "               </div>
            ";
            }
            // line 103
            echo "
            <ul class=\"legacy-timeline-actions\">
               ";
            // line 105
            echo ((array_key_exists("legacy_timeline_actions", $context)) ? (_twig_default_filter(($context["legacy_timeline_actions"] ?? null), "")) : (""));
            echo "
            </ul>
            ";
            // line 107
            echo twig_include($this->env, $context, "components/itilobject/timeline/filter_timeline.html.twig");
            echo "
         ";
        }
        // line 109
        echo "     </div>

      <div class=\"form-buttons ";
        // line 111
        echo twig_escape_filter($this->env, ($context["form_btns_cls"] ?? null), "html", null, true);
        echo " d-flex justify-content-between ms-auto ms-lg-0 my-n2 py-2 pe-3 card-footer border-top-0 position-relative\">
         <span class=\"d-none d-lg-block ms-n3\"
               data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"";
        // line 113
        echo twig_escape_filter($this->env, __("Toggle panels width"), "html", null, true);
        echo "\">
            <button type=\"button\" class=\"switch-panel-width btn btn-icon btn-ghost-secondary px-0\">
               <i class=\"fas ";
        // line 115
        echo twig_escape_filter($this->env, ($context["switch_btn_cls"] ?? null), "html", null, true);
        echo "\"></i>
            </button>
            <button type=\"button\" class=\"collapse-panel btn btn-icon btn-ghost-secondary px-0 mr-1\">
               <i class=\"fas fa-caret-right\"></i>
            </button>
         </span>

         <span>
         ";
        // line 123
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 123)) {
            // line 124
            echo "            <button class=\"btn btn-primary\" type=\"submit\" name=\"add\" form=\"itil-form\"
                  title=\"";
            // line 125
            echo twig_escape_filter($this->env, _x("button", "Add"), "html", null, true);
            echo "\">
               <i class=\"fas fa-plus\"></i>
               <span class=\"d-none d-lg-block\">";
            // line 127
            echo twig_escape_filter($this->env, _x("button", "Add"), "html", null, true);
            echo "</span>
            </button>
         ";
        } else {
            // line 130
            echo "
            <div class=\"btn-group\" role=\"group\">
               ";
            // line 132
            if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "canDeleteItem", [], "method", false, false, false, 132)) {
                // line 133
                echo "                  ";
                if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isDeleted", [], "method", false, false, false, 133)) {
                    // line 134
                    echo "                     <button class=\"btn btn-outline-secondary\" type=\"submit\" name=\"restore\" form=\"itil-form\"
                           title=\"";
                    // line 135
                    echo twig_escape_filter($this->env, _x("button", "Restore"), "html", null, true);
                    echo "\">
                        <i class=\"fas fa-trash-restore-alt\"></i>
                        <span class=\"d-none d-lg-block\">";
                    // line 137
                    echo twig_escape_filter($this->env, _x("button", "Restore"), "html", null, true);
                    echo "</span>
                     </button>

                     <button class=\"btn btn-outline-danger\" type=\"submit\" name=\"purge\" form=\"itil-form\"
                           title=\"";
                    // line 141
                    echo twig_escape_filter($this->env, _x("button", "Delete permanently"), "html", null, true);
                    echo "\"
                           onclick=\"return confirm('";
                    // line 142
                    echo twig_escape_filter($this->env, __("Confirm the final deletion?"), "html", null, true);
                    echo "');\">
                        <i class=\"ti ti-trash\"></i>
                        <span class=\"d-none d-lg-block\">";
                    // line 144
                    echo twig_escape_filter($this->env, _x("button", "Delete permanently"), "html", null, true);
                    echo "</span>
                     </button>
                  ";
                } else {
                    // line 147
                    echo "                     <button class=\"btn btn-outline-danger\" type=\"submit\" name=\"delete\" form=\"itil-form\"
                           title=\"";
                    // line 148
                    echo twig_escape_filter($this->env, _x("button", "Put in trashbin"), "html", null, true);
                    echo "\"
                           data-bs-toggle=\"tooltip\" data-bs-placement=\"top\">
                        <i class=\"ti ti-trash\"></i>
                     </button>
                  ";
                }
                // line 153
                echo "               ";
            }
            // line 154
            echo "
               ";
            // line 155
            if (($context["canupdate"] ?? null)) {
                // line 156
                echo "                  ";
                echo twig_include($this->env, $context, "components/form/single-action.html.twig", ["onlyicon" => true]);
                // line 158
                echo "
               ";
            }
            // line 160
            echo "
               ";
            // line 161
            $context["is_locked"] = (twig_get_attribute($this->env, $this->source, ($context["params"] ?? null), "locked", [], "array", true, true, false, 161) && (($__internal_compile_0 = ($context["params"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["locked"] ?? null) : null));
            // line 162
            echo "               ";
            $context["display_save_btn"] = ( !($context["is_locked"] ?? null) && ((((($context["canupdate"] ?? null) || ($context["can_requester"] ?? null)) || ($context["canpriority"] ?? null)) || ($context["canassign"] ?? null)) || ($context["canassigntome"] ?? null)));
            // line 163
            echo "               ";
            if (($context["display_save_btn"] ?? null)) {
                // line 164
                echo "                  <button class=\"btn btn-primary\" type=\"submit\" name=\"update\" form=\"itil-form\"
                        title=\"";
                // line 165
                echo twig_escape_filter($this->env, _x("button", "Save"), "html", null, true);
                echo "\">
                     <i class=\"far fa-save\"></i>
                     <span class=\"d-none d-xl-block\">";
                // line 167
                echo twig_escape_filter($this->env, _x("button", "Save"), "html", null, true);
                echo "</span>
                  </button>
               ";
            }
            // line 170
            echo "            </div>

         ";
        }
        // line 173
        echo "         </span>
      </div>
   </div>
</div>

";
        // line 178
        $context["openfollowup"] = (((twig_get_attribute($this->env, $this->source, ($context["_get"] ?? null), "_openfollowup", [], "array", true, true, false, 178) &&  !(null === (($__internal_compile_1 = ($context["_get"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["_openfollowup"] ?? null) : null)))) ? ((($__internal_compile_2 = ($context["_get"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["_openfollowup"] ?? null) : null)) : (false));
        // line 179
        $context["is_timeline_reversed"] = ($this->extensions['Glpi\Application\View\Extension\SessionExtension']->userPref("timeline_order") == twig_constant("CommonITILObject::TIMELINE_ORDER_REVERSE"));
        // line 180
        echo "
<script type=\"text/javascript\">

(function(){
    ";
        // line 189
        echo "   var scrollToTimelineStart = function() {
        // scroll body to ensure we are at bottom (useful for responsive display)
        \$('html, body').animate({
        scrollTop: ";
        // line 192
        echo ((($context["is_timeline_reversed"] ?? null)) ? ("-") : (""));
        echo "\$(document).height()
        }, 0, function(){
            // scroll timeline with animation
            var timeline = \$(\"#itil-object-container .itil-left-side\");
            timeline.animate({
                scrollTop: ";
        // line 197
        echo ((($context["is_timeline_reversed"] ?? null)) ? ("-") : (""));
        echo "timeline.prop('scrollHeight')
            }, 'slow');
        });
   };

   \$(document).on(\"click\", \"#itil-footer .answer-action\", function() {
      scrollToTimelineStart();
      ";
        // line 204
        if ((($context["timeline_btn_layout"] ?? null) == twig_constant("Config::TIMELINE_ACTION_BTN_MERGED"))) {
            // line 205
            echo "         // hide answer button after clicking on it only for merge btn
         \$(this).closest(\".main-actions\").hide();
      ";
        }
        // line 208
        echo "   });

   \$(function() {
      // when close button of new answer block is clicked, show again the new answer button
      ";
        // line 212
        if ((($context["timeline_btn_layout"] ?? null) == twig_constant("Config::TIMELINE_ACTION_BTN_MERGED"))) {
            // line 213
            echo "         \$(document).on(\"click\", \"#new-itilobject-form .close-itil-answer\", function() {
            \$(\"#itil-footer .main-actions\").show();
         });
      ";
        }
        // line 217
        echo "
      ";
        // line 218
        if (($context["openfollowup"] ?? null)) {
            // line 219
            echo "         // trigger for reopen, show followup form in timeline
         var myCollapse = document.getElementById('new-ITILFollowup-block')
         var bsCollapse = new bootstrap.Collapse(myCollapse);
         bsCollapse.show();

         scrollToTimelineStart();
      ";
        }
        // line 226
        echo "   });
})();

</script>
";
    }

    public function getTemplateName()
    {
        return "components/itilobject/footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  494 => 226,  485 => 219,  483 => 218,  480 => 217,  474 => 213,  472 => 212,  466 => 208,  461 => 205,  459 => 204,  449 => 197,  441 => 192,  436 => 189,  430 => 180,  428 => 179,  426 => 178,  419 => 173,  414 => 170,  408 => 167,  403 => 165,  400 => 164,  397 => 163,  394 => 162,  392 => 161,  389 => 160,  385 => 158,  382 => 156,  380 => 155,  377 => 154,  374 => 153,  366 => 148,  363 => 147,  357 => 144,  352 => 142,  348 => 141,  341 => 137,  336 => 135,  333 => 134,  330 => 133,  328 => 132,  324 => 130,  318 => 127,  313 => 125,  310 => 124,  308 => 123,  297 => 115,  292 => 113,  287 => 111,  283 => 109,  278 => 107,  273 => 105,  269 => 103,  265 => 101,  262 => 100,  258 => 98,  244 => 97,  238 => 94,  234 => 93,  230 => 92,  225 => 91,  222 => 90,  205 => 89,  199 => 86,  192 => 82,  188 => 80,  185 => 79,  171 => 78,  165 => 75,  161 => 74,  154 => 73,  151 => 72,  133 => 71,  130 => 70,  128 => 69,  122 => 66,  118 => 65,  113 => 63,  108 => 61,  105 => 60,  101 => 58,  99 => 57,  91 => 55,  88 => 54,  85 => 53,  82 => 52,  79 => 51,  77 => 50,  74 => 49,  71 => 48,  69 => 47,  65 => 46,  60 => 43,  56 => 41,  53 => 40,  50 => 39,  48 => 38,  46 => 37,  44 => 36,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/footer.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\components\\itilobject\\footer.html.twig");
    }
}
