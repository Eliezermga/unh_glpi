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

/* components/itilobject/actors/main.html.twig */
class __TwigTemplate_c89dfc401c594185a90372f9936eb3df extends Template
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
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "components/itilobject/actors/main.html.twig", 34)->unwrap();
        // line 35
        echo "
";
        // line 36
        if ( !array_key_exists("display_actortypes", $context)) {
            // line 37
            echo "   ";
            $context["display_actortypes"] = [0 => "requester", 1 => "observer", 2 => "assign"];
        }
        // line 39
        if ( !array_key_exists("display_labels", $context)) {
            // line 40
            echo "   ";
            $context["display_labels"] = true;
        }
        // line 42
        echo "
";
        // line 43
        $context["actor_options"] = twig_array_merge(($context["field_options"] ?? null), ["is_horizontal" => false, "add_field_class" => ((        // line 45
($context["is_expanded"] ?? null)) ? ("col-sm-4") : (""))]);
        // line 47
        $context["can_admin"] = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "canAdminActors", [], "method", false, false, false, 47);
        // line 48
        if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isNewItem", [], "method", false, false, false, 48)) {
            // line 49
            echo "   ";
            $context["can_admin"] = true;
        }
        // line 51
        echo "
";
        // line 53
        echo "
";
        // line 55
        echo "
";
        // line 56
        if ((twig_in_filter("requester", ($context["display_actortypes"] ?? null)) && ( !twig_get_attribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isHiddenField", [0 => "_users_id_requester"], "method", false, false, false, 56) ||  !twig_get_attribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isHiddenField", [0 => "_groups_id_requester"], "method", false, false, false, 56)))) {
            // line 57
            echo "   ";
            ob_start(function () { return ''; });
            // line 58
            echo "      ";
            echo twig_include($this->env, $context, "components/itilobject/actors/field.html.twig", ["item" =>             // line 59
($context["item"] ?? null), "actortypeint" => twig_constant("CommonITILActor::REQUESTER"), "actortype" => "requester", "entities_id" =>             // line 62
($context["entities_id"] ?? null), "itiltemplate" =>             // line 63
($context["itiltemplate"] ?? null), "params" =>             // line 64
($context["params"] ?? null), "canupdate" =>             // line 65
($context["canupdate"] ?? null), "canassigntome" => ((            // line 66
$context["canassigntome"]) ?? (false)), "main_rand" =>             // line 67
($context["main_rand"] ?? null)], false);
            // line 68
            echo "
   ";
            $context["requester_field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 70
            echo "   ";
            if (($context["display_labels"] ?? null)) {
                // line 71
                echo "      ";
                echo twig_call_macro($macros["fields"], "macro_field", ["requester",                 // line 73
($context["requester_field"] ?? null), _n("Requester", "Requesters", 1), twig_array_merge(                // line 75
($context["actor_options"] ?? null), ["required" => (twig_get_attribute($this->env, $this->source,                 // line 76
($context["itiltemplate"] ?? null), "isMandatoryField", [0 => "_users_id_requester"], "method", false, false, false, 76) || twig_get_attribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isMandatoryField", [0 => "_groups_id_requester"], "method", false, false, false, 76))])], 71, $context, $this->getSourceContext());
                // line 78
                echo "
   ";
            } else {
                // line 80
                echo "      ";
                echo twig_escape_filter($this->env, ($context["requester_field"] ?? null), "html", null, true);
                echo "
   ";
            }
        }
        // line 83
        echo "
";
        // line 84
        if ((twig_in_filter("observer", ($context["display_actortypes"] ?? null)) && ( !twig_get_attribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isHiddenField", [0 => "_users_id_observer"], "method", false, false, false, 84) ||  !twig_get_attribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isHiddenField", [0 => "_groups_id_observer"], "method", false, false, false, 84)))) {
            // line 85
            echo "   ";
            ob_start(function () { return ''; });
            // line 86
            echo "      ";
            echo twig_include($this->env, $context, "components/itilobject/actors/field.html.twig", ["item" =>             // line 87
($context["item"] ?? null), "actortypeint" => twig_constant("CommonITILActor::OBSERVER"), "actortype" => "observer", "entities_id" =>             // line 90
($context["entities_id"] ?? null), "itiltemplate" =>             // line 91
($context["itiltemplate"] ?? null), "params" =>             // line 92
($context["params"] ?? null), "canupdate" =>             // line 93
($context["canupdate"] ?? null), "canassigntome" => ((            // line 94
$context["canassigntome"]) ?? (false)), "main_rand" =>             // line 95
($context["main_rand"] ?? null)], false);
            // line 96
            echo "
   ";
            $context["observer_field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 98
            echo "   ";
            if (($context["display_labels"] ?? null)) {
                // line 99
                echo "      ";
                echo twig_call_macro($macros["fields"], "macro_field", ["observer",                 // line 101
($context["observer_field"] ?? null), __("Observer"), twig_array_merge(                // line 103
($context["actor_options"] ?? null), ["required" => (twig_get_attribute($this->env, $this->source,                 // line 104
($context["itiltemplate"] ?? null), "isMandatoryField", [0 => "_users_id_observer"], "method", false, false, false, 104) || twig_get_attribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isMandatoryField", [0 => "_groups_id_observer"], "method", false, false, false, 104))])], 99, $context, $this->getSourceContext());
                // line 106
                echo "
   ";
            } else {
                // line 108
                echo "      ";
                echo twig_escape_filter($this->env, ($context["observer_field"] ?? null), "html", null, true);
                echo "
   ";
            }
        }
        // line 111
        echo "
";
        // line 112
        if ((twig_in_filter("assign", ($context["display_actortypes"] ?? null)) && (( !twig_get_attribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isHiddenField", [0 => "_users_id_assign"], "method", false, false, false, 112) ||  !twig_get_attribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isHiddenField", [0 => "_groups_id_assign"], "method", false, false, false, 112)) ||  !twig_get_attribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isHiddenField", [0 => "_supplier_id_assign"], "method", false, false, false, 112)))) {
            // line 113
            echo "   ";
            ob_start(function () { return ''; });
            // line 114
            echo "      ";
            echo twig_include($this->env, $context, "components/itilobject/actors/field.html.twig", ["item" =>             // line 115
($context["item"] ?? null), "actortypeint" => twig_constant("CommonITILActor::ASSIGN"), "actortype" => "assign", "users_right" => "own_ticket", "entities_id" =>             // line 119
($context["entities_id"] ?? null), "itiltemplate" =>             // line 120
($context["itiltemplate"] ?? null), "params" =>             // line 121
($context["params"] ?? null), "canupdate" =>             // line 122
($context["canassign"] ?? null), "canassigntome" => ((            // line 123
$context["canassigntome"]) ?? (false)), "main_rand" =>             // line 124
($context["main_rand"] ?? null)], false);
            // line 125
            echo "
   ";
            $context["assign_field"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 127
            echo "   ";
            if (($context["display_labels"] ?? null)) {
                // line 128
                echo "      ";
                echo twig_call_macro($macros["fields"], "macro_field", ["assign",                 // line 130
($context["assign_field"] ?? null), __("Assigned to"), twig_array_merge(                // line 132
($context["actor_options"] ?? null), ["required" => ((twig_get_attribute($this->env, $this->source,                 // line 133
($context["itiltemplate"] ?? null), "isMandatoryField", [0 => "_users_id_assign"], "method", false, false, false, 133) || twig_get_attribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isMandatoryField", [0 => "_groups_id_assign"], "method", false, false, false, 133)) || twig_get_attribute($this->env, $this->source, ($context["itiltemplate"] ?? null), "isMandatoryField", [0 => "_supplier_id_assign"], "method", false, false, false, 133))])], 128, $context, $this->getSourceContext());
                // line 135
                echo "
   ";
            } else {
                // line 137
                echo "      ";
                echo twig_escape_filter($this->env, ($context["assign_field"] ?? null), "html", null, true);
                echo "
   ";
            }
        }
        // line 140
        echo "
<input type=\"hidden\" name=\"_actors\" id=\"_actors\" />

";
        // line 144
        echo "<div class=\"modal fade\" id=\"editActorNotifySettings\" tabindex=\"-1\" aria-hidden=\"true\">
  <div class=\"modal-dialog\">
    <div class=\"modal-content\">
      <div class=\"modal-header\">
         <h5 class=\"modal-title\">
            <i class=\"fas fa-envelope\"></i>
            &nbsp;";
        // line 150
        echo twig_escape_filter($this->env, __("Edit notification settings"), "html", null, true);
        echo "
         </h5>
         <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"";
        // line 152
        echo twig_escape_filter($this->env, __("Close"), "html", null, true);
        echo "\"></button>
      </div>
      <div class=\"modal-body\">
         <div class=\"mb-3\">
            <label class=\"form-label\" for=\"actorname\">";
        // line 156
        echo twig_escape_filter($this->env, __("Actor"), "html", null, true);
        echo "</label>
            <input type=\"text\" class=\"form-control\" id=\"actorname\" name=\"_notifications_actorname\" />
            <input type=\"hidden\" name=\"_notifications_actortype\" value=\"\" />
            <input type=\"hidden\" name=\"_notifications_actorindex\" value=\"\" />
         </div>
         <div class=\"mb-3\">
            <label for=\"alternative_email\" class=\"form-label\">";
        // line 162
        echo twig_escape_filter($this->env, __("Email address"), "html", null, true);
        echo "</label>
            <div class=\"form-check form-switch\">
               <input class=\"form-check-input\" type=\"checkbox\" id=\"use_notification\" name=\"_notifications_use_notification\" />
               <label class=\"form-check-label\" for=\"use_notification\">";
        // line 165
        echo twig_escape_filter($this->env, __("Email followup"), "html", null, true);
        echo "</label>
            </div>
            <input type=\"email\" class=\"form-control\" id=\"alternative_email\" name=\"_notifications_alternative_email\" />
         </div>
      </div>
      <div class=\"modal-footer\">
         <button type=\"button\" class=\"btn btn-outline-secondary\" data-bs-dismiss=\"modal\">
            <i class=\"ti ti-x\"></i>
            <span>";
        // line 173
        echo twig_escape_filter($this->env, __("Close"), "html", null, true);
        echo "<span>
         </button>
         <button type=\"button\" class=\"btn btn-primary\" id=\"saveActorNotifySettings\">
            <i class=\"far fa-save\"></i>
            <span>";
        // line 177
        echo twig_escape_filter($this->env, __("Save"), "html", null, true);
        echo "</span>
         </button>
      </div>
    </div>
  </div>
</div>

";
        // line 184
        $context["actortypes"] = ["requester" => twig_constant("CommonITILActor::REQUESTER"), "observer" => twig_constant("CommonITILActor::OBSERVER"), "assign" => twig_constant("CommonITILActor::ASSIGN")];
        // line 189
        echo "
<script type=\"text/javascript\">
   /* global bootstrap */
   var editActorNotifySettings_modal = null;
   \$(function () {
      editActorNotifySettings_modal = new bootstrap.Modal(document.getElementById('editActorNotifySettings'), {});
   });

   var actors = {
      ";
        // line 198
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["actortypes"] ?? null));
        foreach ($context['_seq'] as $context["actortype"] => $context["actortypeint"]) {
            // line 199
            echo "         ";
            echo twig_escape_filter($this->env, $context["actortype"], "html", null, true);
            echo ": [
            ";
            // line 200
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "getActorsForType", [0 => $context["actortypeint"], 1 => ($context["params"] ?? null)], "method", false, false, false, 200));
            foreach ($context['_seq'] as $context["_key"] => $context["actor"]) {
                // line 201
                echo "            {
               itemtype: \"";
                // line 202
                echo twig_escape_filter($this->env, (($__internal_compile_0 = $context["actor"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["itemtype"] ?? null) : null), "html", null, true);
                echo "\",
               items_id: \"";
                // line 203
                echo twig_escape_filter($this->env, (($__internal_compile_1 = $context["actor"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["items_id"] ?? null) : null), "html", null, true);
                echo "\",
               use_notification: ";
                // line 204
                echo (((($__internal_compile_2 = $context["actor"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["use_notification"] ?? null) : null)) ? ("1") : ("0"));
                echo ",
               ";
                // line 205
                if (twig_get_attribute($this->env, $this->source, $context["actor"], "alternative_email", [], "array", true, true, false, 205)) {
                    // line 206
                    echo "                  alternative_email: \"";
                    echo twig_escape_filter($this->env, (($__internal_compile_3 = $context["actor"]) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["alternative_email"] ?? null) : null), "html", null, true);
                    echo "\",
               ";
                }
                // line 208
                echo "            },
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['actor'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 210
            echo "         ],
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['actortype'], $context['actortypeint'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 212
        echo "   };

   // edit email preference when .edit-notify-user button is activated
   function openNotifyModal(event) {
      event.stopPropagation();

      var element = \$(event.target).closest('.actor_entry');
      var itemtype  = element.data('itemtype');
      var items_id  = element.data('items-id');
      var actortype = element.data('actortype');
      var text      = element.data('text');

      var actorIndex = actors[actortype].findIndex(element => (element.itemtype == itemtype && element.items_id == items_id));
      var actor      = actors[actortype][actorIndex];

      var modal = \$('#editActorNotifySettings');
      modal.find(\"input[name=_notifications_actortype]\").val(actortype);
      modal.find(\"input[name=_notifications_actorindex]\").val(actorIndex);
      modal.find(\"input[name=_notifications_actorname]\").removeAttr('readonly').val(text).attr('readonly', 'true');
      modal.find(\"input[name=_notifications_use_notification]\").prop('checked', parseInt(actor.use_notification));
      modal.find(\"input[name=_notifications_alternative_email]\").val(actor.alternative_email);

      editActorNotifySettings_modal.show();
   }

   // save edited actor when clicking on save button
   \$(document).on('click', '#saveActorNotifySettings', function(event) {
      saveNotificationSettings();
   });

   // prevent submit on enter key in modal (but save notification settings)
   \$(document).on('keyup keypress', '#editActorNotifySettings input', function(event) {
      var keyCode = event.keyCode || event.which;
      if (keyCode === 13) {
         event.preventDefault();
         saveNotificationSettings();
         return false;
      }
   });

   // save settings from modal (get modal data, and serialize them into input hidden)
   function saveNotificationSettings() {
      var modal = \$('#editActorNotifySettings');
      var actortype  = modal.find(\"input[name=_notifications_actortype]\").val();
      var actorIndex = modal.find(\"input[name=_notifications_actorindex]\").val();
      var use_notif  = (modal.find(\"input[name=_notifications_use_notification]\").is(\":checked\") ? 1 : 0);
      var alt_email  = modal.find(\"input[name=_notifications_alternative_email]\").val();

      var actor = actors[actortype][actorIndex];
      actor.use_notification = use_notif;
      actor.alternative_email = alt_email;

      // update notif setting icon for actor
      var fa_class = \"far\";
      if (use_notif) {
         fa_class = \"fas\";
      }

      var actor_entry = \$('.actor_entry[data-itemtype='+actor.itemtype+'][data-items-id='+actor.items_id+'][data-actortype='+actortype+']');

      // toggle notify icon
      actor_entry.find('.notify-icon')
         .removeClass('fas far')
         .addClass(fa_class);

      // toggle text for direct email
      if (actor.itemtype == \"User\" && parseInt(actor.items_id) == 0) {
         actor_entry.find('.actor_text').html(alt_email);
      }


      editActorNotifySettings_modal.hide();
      saveActorsToDom();
   }

   // save actors object to dom
   function saveActorsToDom() {
      \$('#_actors').val(JSON.stringify(actors));
   }
   saveActorsToDom();
</script>
";
    }

    public function getTemplateName()
    {
        return "components/itilobject/actors/main.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  334 => 212,  327 => 210,  320 => 208,  314 => 206,  312 => 205,  308 => 204,  304 => 203,  300 => 202,  297 => 201,  293 => 200,  288 => 199,  284 => 198,  273 => 189,  271 => 184,  261 => 177,  254 => 173,  243 => 165,  237 => 162,  228 => 156,  221 => 152,  216 => 150,  208 => 144,  203 => 140,  196 => 137,  192 => 135,  190 => 133,  189 => 132,  188 => 130,  186 => 128,  183 => 127,  179 => 125,  177 => 124,  176 => 123,  175 => 122,  174 => 121,  173 => 120,  172 => 119,  171 => 115,  169 => 114,  166 => 113,  164 => 112,  161 => 111,  154 => 108,  150 => 106,  148 => 104,  147 => 103,  146 => 101,  144 => 99,  141 => 98,  137 => 96,  135 => 95,  134 => 94,  133 => 93,  132 => 92,  131 => 91,  130 => 90,  129 => 87,  127 => 86,  124 => 85,  122 => 84,  119 => 83,  112 => 80,  108 => 78,  106 => 76,  105 => 75,  104 => 73,  102 => 71,  99 => 70,  95 => 68,  93 => 67,  92 => 66,  91 => 65,  90 => 64,  89 => 63,  88 => 62,  87 => 59,  85 => 58,  82 => 57,  80 => 56,  77 => 55,  74 => 53,  71 => 51,  67 => 49,  65 => 48,  63 => 47,  61 => 45,  60 => 43,  57 => 42,  53 => 40,  51 => 39,  47 => 37,  45 => 36,  42 => 35,  40 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/itilobject/actors/main.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\components\\itilobject\\actors\\main.html.twig");
    }
}
