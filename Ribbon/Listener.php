<?php

namespace tkuska\RibbonBundle\Ribbon;

use Symfony\Component\HttpKernel\HttpKernelInterface;

class Listener
{
    protected $ribbon;
    protected $request;
    protected $security_context;

    public function __construct(Ribbon $ribbon = null, \Symfony\Component\Security\Core\SecurityContextInterface $security_context = null)
    {
        $this->ribbon = $ribbon;
        $this->security_context = $security_context;
    }

    public function initializeRibbon(\Symfony\Component\HttpKernel\Event\FilterControllerEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType()) {
            $controllers = $event->getController();

            if (!is_array($controllers)) {
                // not a object but a different kind of callable. Do nothing
                return;
            }

            if (is_array($controllers)) {
                $controller = $controllers[0];

                if (is_object($controller)) {
                    $class = get_class($controller);
                    list($vendor, $bundle, $c, $controller_name) = explode('\\', $class);
                    //bierzemy nazwę kontrolera
                    $controller_name = str_replace('Controller', '', $controller_name);

                    //jeżeli zakładka istnieje i nie ma żadnej aktywnej zakładki domyślnie zaznaczamy tą której ID jest zgodne z kontrolerem
                    if (($tab = $this->ribbon->getTabByName($controller_name))) {
                        $tab->setActive();
                    }
                    //pozniejsze zaznaczenie innej zakladki w kontrolerze udznacza poprzendnie

                }
            }
        }
    }
}
