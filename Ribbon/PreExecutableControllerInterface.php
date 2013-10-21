<?php

namespace kusior\RibbonBundle\Ribbon;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * @author Tomasz Kuśka <tomasz.kuska@gmail.com>
 */
interface PreExecutableControllerInterface
{
    public function prepareMenu(Ribbon $ribbon, Request $request = null, SecurityContextInterface $security_context = null);
}
