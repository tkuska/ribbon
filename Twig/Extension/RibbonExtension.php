<?php

namespace tkuska\RibbonBundle\Twig\Extension;

use tkuska\RibbonBundle\Ribbon\Ribbon;

class RibbonExtension extends \Twig_Extension
{
    private $ribbon;

    private $environment;

    public function __construct(Ribbon $ribbon)
    {
        $this->ribbon = $ribbon;
    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array (
            'print_ribbon' => new \Twig_Function_Method($this, 'printRibbon', array('is_safe' => array('html')))
        );
    }

    /**
     * Converts a string to time
     *
     * @return int
     */
    public function printRibbon ()
    {
        return $this->environment->render(
            "tkuskaRibbonBundle:Ribbon:menu.html.twig", array('ribbon' => $this->ribbon)
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'tkuska_ribbon';
    }
}
