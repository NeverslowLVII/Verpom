<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Routing\RouterInterface;

class RedirectAuthenticatedUserListener
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $response = new RedirectResponse($this->router->generate('recette_index'));
        $event->getRequest()->getSession()->set('_security.main.target_path', $response->getTargetUrl());
    }
}
