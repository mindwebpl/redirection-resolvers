<?php
namespace Mindweb\RedirectionResolvers;

use Mindweb\Resolve\Resolve;
use Mindweb\Resolve\Event\ResolveEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectionResolve extends Resolve
{
    /**
     * @param ResolveEvent $resolveEvent
     */
    public function resolve(ResolveEvent $resolveEvent)
    {
        $attribution = $resolveEvent->getAttribution();
        if (isset($attribution['_redirection']['url'])) {
            $redirect = new RedirectResponse($attribution['_redirection']['url']);

            $resolveEvent->getResponse()->setContent(
                $redirect->getContent()
            );

            foreach ($redirect->headers->all() as $key => $value) {
                $resolveEvent->getResponse()->headers->set($key, $value);
            }
        }
    }
}