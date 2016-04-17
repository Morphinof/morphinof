<?php
namespace CoreBundle\Listener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ControllerListener
{
    public function onCoreController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller))
        {
            return;
        }

        if ($controller[0] instanceof Controller)
        {
            if(method_exists($controller[0], 'preExecute'))
            {
                $controller[0]->preExecute($event->getRequest());
            }
        }
    }
}