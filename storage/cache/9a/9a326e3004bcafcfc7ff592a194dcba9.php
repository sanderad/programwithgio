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

/* invoices/index.twig */
class __TwigTemplate_4263634e2e91e1978b814e90c7f6f36a extends Template
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
        // line 1
        echo "    <style>
        table {
            width: 100%;
        }
    </style>
<table>
    <thead>
        <tr>
            <th>Invoice #</th>
            <th>Amount</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["invoices"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
            // line 16
            echo "            <tr>
                <td>";
            // line 17
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["invoice"], "invoice_number", [], "any", false, false, false, 17), "html", null, true);
            echo " </td>
                <td>";
            // line 18
            echo twig_escape_filter($this->env, $this->extensions['Twig\Extra\Intl\IntlExtension']->formatCurrency(twig_get_attribute($this->env, $this->source, $context["invoice"], "amount", [], "any", false, false, false, 18), "USD"), "html", null, true);
            echo " </td>
                <td>";
            // line 19
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 19), "html", null, true);
            echo " </td>
            </tr>

        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 23
            echo "            <tr><td colspan=\"4\">No Invoices Found</td></tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        echo "    </tbody>
</table>";
    }

    public function getTemplateName()
    {
        return "invoices/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 25,  78 => 23,  69 => 19,  65 => 18,  61 => 17,  58 => 16,  53 => 15,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "invoices/index.twig", "/var/www/views/invoices/index.twig");
    }
}
