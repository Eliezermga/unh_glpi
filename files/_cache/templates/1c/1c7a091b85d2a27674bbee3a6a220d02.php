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

/* components/search/controls.html.twig */
class __TwigTemplate_2d0e4c2627a79b8cd7ed632bb44a0a16 extends Template
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
<div class=\"d-inline-flex search-controls\">
   ";
        // line 35
        if ((($context["showmassiveactions"] ?? null) && (($context["count"] ?? null) > 0))) {
            // line 36
            echo "      ";
            $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Html::showMassiveActions", [0 => ($context["massiveactionparams"] ?? null)]);
            // line 37
            echo "   ";
        }
        // line 38
        echo "
   ";
        // line 39
        if ((($context["may_be_located"] ?? null) && ((($context["count"] ?? null) > 0) || ((($__internal_compile_0 = (($__internal_compile_1 = ($context["data"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["search"] ?? null) : null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["as_map"] ?? null) : null) == 1)))) {
            // line 40
            echo "      <label class=\"form-check form-switch btn btn-sm btn-ghost-info me-0 me-sm-1 px-1 mb-0 flex-column-reverse flex-sm-row\"
             data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"";
            // line 41
            echo twig_escape_filter($this->env, __("Show as map"), "html", null, true);
            echo "\">
         <input type=\"checkbox\" class=\"form-check-input ms-0 me-1 mt-0\" role=\"button\"
                name=\"as_map\" value=\"1\" autocomplete=\"off\"
                onclick=\"toogle('as_map','','',''); document.forms['searchform";
            // line 44
            echo twig_escape_filter($this->env, twig_lower_filter($this->env, ($context["itemtype"] ?? null)), "html", null, true);
            echo "'].submit();\"
                ";
            // line 45
            echo ((((($__internal_compile_2 = (($__internal_compile_3 = ($context["data"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["search"] ?? null) : null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["as_map"] ?? null) : null) == 1)) ? ("checked") : (""));
            echo " />
         <span class=\"form-check-label mb-1 mb-sm-0\">
            <i class=\"ti fa-lg ti-map-2\"></i>
         </span >
      </label>
   ";
        }
        // line 51
        echo "
   ";
        // line 52
        if (($context["may_be_browsed"] ?? null)) {
            // line 53
            echo "      <label class=\"form-check form-switch btn btn-sm btn-ghost-info me-0 me-sm-1 px-1 mb-0 flex-column-reverse flex-sm-row\"
             data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"";
            // line 54
            echo twig_escape_filter($this->env, __("Toggle browse"), "html", null, true);
            echo "\">
         <input type=\"checkbox\" class=\"form-check-input ms-0 me-1 mt-0\" role=\"button\"
                name=\"browse\" value=\"1\" autocomplete=\"off\"
                onclick=\"toogle('browse','','',''); document.forms['searchform";
            // line 57
            echo twig_escape_filter($this->env, twig_lower_filter($this->env, ($context["itemtype"] ?? null)), "html", null, true);
            echo "'].submit();\"
                ";
            // line 58
            echo ((((($__internal_compile_4 = (($__internal_compile_5 = ($context["data"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["search"] ?? null) : null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["browse"] ?? null) : null) == 1)) ? ("checked") : (""));
            echo " />
         <span class=\"form-check-label mb-1 mb-sm-0\">
            <i class=\"ti fa-lg ti-subtask\"></i>
         </span>
      </label>
   ";
        }
        // line 64
        echo "
   ";
        // line 65
        if (($context["may_be_deleted"] ?? null)) {
            // line 66
            echo "      <label class=\"form-check form-switch btn btn-sm btn-ghost-danger me-0 me-sm-1 px-1 mb-0 flex-column-reverse flex-sm-row\"
             data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"";
            // line 67
            echo twig_escape_filter($this->env, __("Show the trashbin"), "html", null, true);
            echo "\">
         <input type=\"checkbox\" class=\"form-check-input ms-0 me-1 mt-0\" role=\"button\"
                name=\"is_deleted\" value=\"1\" autocomplete=\"off\"
                onclick=\"toogle('is_deleted','','',''); document.forms['searchform";
            // line 70
            echo twig_escape_filter($this->env, twig_lower_filter($this->env, ($context["itemtype"] ?? null)), "html", null, true);
            echo "'].submit();\"
                ";
            // line 71
            echo ((((($__internal_compile_6 = (($__internal_compile_7 = ($context["data"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["search"] ?? null) : null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["is_deleted"] ?? null) : null) == 1)) ? ("checked") : (""));
            echo " />
         <span class=\"form-check-label mb-1 mb-sm-0\">
            <i class=\"ti fa-lg ti-trash\"></i>
         </span>
      </label>
   ";
        }
        // line 77
        echo "
   <label class=\"form-check form-switch btn btn-sm btn-ghost-secondary me-0 me-sm-1 px-1 mb-0 flex-column-reverse flex-sm-row\"
          data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" data-bs-trigger=\"hover\"
          title=\"";
        // line 80
        echo twig_escape_filter($this->env, __("Toggle search filters"), "html", null, true);
        echo "\">
      <input type=\"checkbox\" class=\"form-check-input ms-0 me-1 mt-0 fold-search\" role=\"button\"
             ";
        // line 82
        echo (($this->extensions['Glpi\Application\View\Extension\SessionExtension']->session("glpifold_search")) ? ("") : ("checked"));
        echo " autocomplete=\"off\" />
      <span class=\"form-check-label mb-1 mb-sm-0\">
         <i class=\"ti fa-lg ti-search\"></i>
      </span>
   </label>

   <div class=\"d-inline-flex\" role=\"group\">

      ";
        // line 90
        if ((($context["can_config"] ?? null) && (($context["count"] ?? null) > 0))) {
            // line 91
            echo "      <button class=\"btn btn-sm btn-icon btn-ghost-secondary show_displaypreference_modal me-0 me-sm-1\"
             title=\"";
            // line 92
            echo twig_escape_filter($this->env, __("Select default items to show"), "html", null, true);
            echo "\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\">
         <i class=\"ti fa-lg ti-tool\"></i>
      </button>
      ";
        }
        // line 96
        echo "
      ";
        // line 97
        if ((($context["count"] ?? null) > 0)) {
            // line 98
            echo "         <button class=\"dropdown-toggle btn btn-sm btn-icon btn-ghost-secondary\" type=\"button\" id=\"dropdown-export\"
               data-bs-toggle=\"dropdown\" aria-expanded=\"false\" >
            <span class=\"py-1 px-2 my-n1 mx-n2\"data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"";
            // line 100
            echo twig_escape_filter($this->env, _x("button", "Export"), "html", null, true);
            echo "\">
               <i id=\"export_dropdown_icon\" class=\"ti fa-lg ti-file-download\"></i>
            </span>
         </button>
      ";
            // line 104
            $context["exporthref"] = ((($this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("/front/report.dynamic.php") . "?") . twig_urlencode_filter(["item_type" =>             // line 105
($context["itemtype"] ?? null), "sort" =>             // line 106
($context["sort"] ?? null), "order" =>             // line 107
($context["order"] ?? null), "start" =>             // line 108
($context["start"] ?? null)])) .             // line 109
($context["posthref"] ?? null));
            // line 110
            echo "      <ul class=\"dropdown-menu\" aria-labelledby=\"dropdown-export\">
         <li><a class=\"dropdown-item\" href=\"";
            // line 111
            echo twig_escape_filter($this->env, ((($context["exporthref"] ?? null) . "&display_type=") . twig_constant("Search::PDF_OUTPUT_LANDSCAPE")), "html", null, true);
            echo "\">
            <i class=\"far fa-lg fa-file-pdf\"></i>
            ";
            // line 113
            echo twig_escape_filter($this->env, __("Current page in landscape PDF"), "html", null, true);
            echo "
         </a></li>
         <li><a class=\"dropdown-item\" href=\"";
            // line 115
            echo twig_escape_filter($this->env, ((($context["exporthref"] ?? null) . "&display_type=") . twig_constant("Search::PDF_OUTPUT_PORTRAIT")), "html", null, true);
            echo "\">
            <i class=\"far fa-lg fa-file-pdf\"></i>
            ";
            // line 117
            echo twig_escape_filter($this->env, __("Current page in portrait PDF"), "html", null, true);
            echo "
         </a></li>
         <li><a class=\"dropdown-item\" href=\"";
            // line 119
            echo twig_escape_filter($this->env, ((($context["exporthref"] ?? null) . "&display_type=") . twig_constant("Search::SYLK_OUTPUT")), "html", null, true);
            echo "\">
            <i class=\"far fa-lg fa-file-excel\"></i>
            ";
            // line 121
            echo twig_escape_filter($this->env, __("Current page in SLK"), "html", null, true);
            echo "
         </a></li>
         <li><a class=\"dropdown-item\" href=\"";
            // line 123
            echo twig_escape_filter($this->env, ((($context["exporthref"] ?? null) . "&display_type=") . twig_constant("Search::CSV_OUTPUT")), "html", null, true);
            echo "\">
            <i class=\"fas fa-lg fa-file-csv\"></i>
            ";
            // line 125
            echo twig_escape_filter($this->env, __("Current page in CSV"), "html", null, true);
            echo "
         </a></li>
         <li><a class=\"dropdown-item\" href=\"";
            // line 127
            echo twig_escape_filter($this->env, ((($context["exporthref"] ?? null) . "&display_type=-") . twig_constant("Search::PDF_OUTPUT_LANDSCAPE")), "html", null, true);
            echo "\">
            <i class=\"far fa-lg fa-file-pdf\"></i>
            ";
            // line 129
            echo twig_escape_filter($this->env, __("All pages in landscape PDF"), "html", null, true);
            echo "
         </a></li>
         <li><a class=\"dropdown-item\" href=\"";
            // line 131
            echo twig_escape_filter($this->env, ((($context["exporthref"] ?? null) . "&display_type=-") . twig_constant("Search::PDF_OUTPUT_PORTRAIT")), "html", null, true);
            echo "\">
            <i class=\"far fa-lg fa-file-pdf\"></i>
            ";
            // line 133
            echo twig_escape_filter($this->env, __("All pages in portrait PDF"), "html", null, true);
            echo "
         </a></li>
         <li><a class=\"dropdown-item\" href=\"";
            // line 135
            echo twig_escape_filter($this->env, ((($context["exporthref"] ?? null) . "&display_type=-") . twig_constant("Search::SYLK_OUTPUT")), "html", null, true);
            echo "\">
            <i class=\"far fa-lg fa-file-excel\"></i>
            ";
            // line 137
            echo twig_escape_filter($this->env, __("All pages in SLK"), "html", null, true);
            echo "
         </a></li>
         <li><a class=\"dropdown-item\" href=\"";
            // line 139
            echo twig_escape_filter($this->env, ((($context["exporthref"] ?? null) . "&display_type=-") . twig_constant("Search::CSV_OUTPUT")), "html", null, true);
            echo "\">
            <i class=\"fas fa-lg fa-file-csv\"></i>
            ";
            // line 141
            echo twig_escape_filter($this->env, __("All pages in CSV"), "html", null, true);
            echo "
         </a></li>
         ";
            // line 143
            if ((($context["itemtype"] ?? null) != "Stat")) {
                // line 144
                echo "         <li id=\"copy_names_to_clipboard\"><a class=\"dropdown-item\" href=\"";
                echo twig_escape_filter($this->env, ((($context["exporthref"] ?? null) . "&display_type=-") . twig_constant("Search::NAMES_OUTPUT")), "html", null, true);
                echo "\">
            <i class=\"far fa-lg fa-copy\"></i>
            ";
                // line 146
                echo twig_escape_filter($this->env, __("Copy names to clipboard"), "html", null, true);
                echo "
         </a></li>
         ";
            }
            // line 149
            echo "      </ul>
      ";
        }
        // line 151
        echo "   </div>
</div>

<script type=\"text/javascript\">
\$(document).ready(function() {
   \$('.show_displaypreference_modal').click(function(e) {
      e.preventDefault();

      var modal = '<div class=\"modal fade\" id=\"displayprefence_modal";
        // line 159
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "\" role=\"dialog\">';
      modal += '<div class=\"modal-dialog modal-lg\">';
      modal += '<div class=\"modal-content\">';
      modal += '<div class=\"modal-header\">';
      modal += '<h4 class=\"modal-title\">";
        // line 163
        echo twig_escape_filter($this->env, __("Select default items to show"), "html", null, true);
        echo "</h4>';
      modal += '<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"";
        // line 164
        echo twig_escape_filter($this->env, __("Close modal"), "html", null, true);
        echo "\"></button>';
      modal += '</div>';
      modal += '<div class=\"modal-body\">';
      modal += '<div class=\"ratio ratio-4x3\">';
      modal += '<iframe src=\"";
        // line 168
        echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path(("front/displaypreference.form.php?itemtype=" . twig_escape_filter($this->env, ($context["itemtype"] ?? null), "url"))), "html", null, true);
        echo "\"></iframe>'
      modal += '</div>';
      modal += '</div>';
      modal += '</div>';
      modal += '</div>';

      // remove old modal
      \$('#displayprefence_modal";
        // line 175
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "').remove();

      // create new one
      \$('body').append(modal);
      \$('#displayprefence_modal";
        // line 179
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "').modal('show');
   });

   \$(\"body\").on('hide.bs.modal', '#displayprefence_modal";
        // line 182
        echo twig_escape_filter($this->env, ($context["rand"] ?? null), "html", null, true);
        echo "', function() {
      location.reload();
   });

   \$('.fold-search').change(function(event) {
      var show_search = \$(this).is(\":checked\");

      // hide tooltips (issue maybe ?)
      \$('[data-toggle=\"tooltip\"]').tooltip('hide');

      event.preventDefault();
      \$.ajax({
         url: '";
        // line 194
        echo twig_escape_filter($this->env, $this->extensions['Glpi\Application\View\Extension\RoutingExtension']->path("/ajax/search.php"), "html", null, true);
        echo "',
         type: 'POST',
         datatype: 'json',
         data: {
            'action': 'fold_search',
            'show_search': (show_search ? 1 : 0),
         },
         success: function() {
            toggle_fold_search(show_search);

            // scroll to top to display the change
            if (show_search) {
               \$(\"html, body, .search-container\").animate({ scrollTop: 0 });
            }
         }
      });
   });

   // Callbacks for copy success/failure
   function copy_success() {
      glpi_toast_info(__('Results copied to clipboard'));
      \$('#export_dropdown_icon').removeClass('fa-circle-notch');
      \$('#export_dropdown_icon').removeClass('fa-spin');
      \$('#export_dropdown_icon').addClass('fa-file-download');
      \$('#export_dropdown_icon').parent().parent().addClass('dropdown-toggle');
   }
   function copy_error() {
      glpi_toast_error(__('Unexpected error'));
      \$('#export_dropdown_icon').removeClass('fa-circle-notch');
      \$('#export_dropdown_icon').removeClass('fa-spin');
      \$('#export_dropdown_icon').addClass('fa-file-download');
      \$('#export_dropdown_icon').parent().parent().addClass('dropdown-toggle');
   }

   \$('#copy_names_to_clipboard').click(function(e) {
      // Get target link
      var link = \$(this).find('a').prop('href');

      // Show loading indicator
      \$('#export_dropdown_icon').removeClass('fa-file-download');
      \$('#export_dropdown_icon').addClass('fa-circle-notch');
      \$('#export_dropdown_icon').addClass('fa-spin');
      \$('#export_dropdown_icon').parent().parent().removeClass('dropdown-toggle');

      // Prevent link from working
      e.preventDefault();

      // Get data using ajax
      \$.get(link, function (data) {
         navigator.clipboard.writeText(data).then(copy_success, copy_error);
      }).fail(copy_error);
   });
});
</script>
";
    }

    public function getTemplateName()
    {
        return "components/search/controls.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  353 => 194,  338 => 182,  332 => 179,  325 => 175,  315 => 168,  308 => 164,  304 => 163,  297 => 159,  287 => 151,  283 => 149,  277 => 146,  271 => 144,  269 => 143,  264 => 141,  259 => 139,  254 => 137,  249 => 135,  244 => 133,  239 => 131,  234 => 129,  229 => 127,  224 => 125,  219 => 123,  214 => 121,  209 => 119,  204 => 117,  199 => 115,  194 => 113,  189 => 111,  186 => 110,  184 => 109,  183 => 108,  182 => 107,  181 => 106,  180 => 105,  179 => 104,  172 => 100,  168 => 98,  166 => 97,  163 => 96,  156 => 92,  153 => 91,  151 => 90,  140 => 82,  135 => 80,  130 => 77,  121 => 71,  117 => 70,  111 => 67,  108 => 66,  106 => 65,  103 => 64,  94 => 58,  90 => 57,  84 => 54,  81 => 53,  79 => 52,  76 => 51,  67 => 45,  63 => 44,  57 => 41,  54 => 40,  52 => 39,  49 => 38,  46 => 37,  43 => 36,  41 => 35,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "components/search/controls.html.twig", "C:\\xampp\\htdocs\\projet\\glpi\\templates\\components\\search\\controls.html.twig");
    }
}
