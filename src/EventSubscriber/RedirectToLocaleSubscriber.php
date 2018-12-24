<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Date: 20-12-2018 19:47
 * Licence: GPLv3 - General Public Licence version 3
 */

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class RedirectToLocaleSubscriber implements EventSubscriberInterface
{
    private $urlGenerator;
    private $locales;
    private $defaultLocale;

    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        string $locales,
        string $defaultLocale = null
    ) {
        $this->urlGenerator = $urlGenerator;
        $this->locales      = explode( '|', trim( $locales ) );
        if ( empty( $this->locales ) )
        {
            throw new \UnexpectedValueException(
                'The list of supported locales must not be empty.'
            );
        }
        $this->defaultLocale = $defaultLocale ?: $this->locales[ 0 ];
        if ( !\in_array( $this->defaultLocale, $this->locales, true ) )
        {
            throw new \UnexpectedValueException(
                sprintf(
                    'The default locale ("%s") must be one of "%s".',
                    $this->defaultLocale,
                    $locales
                )
            );
        }
        // Add the default locale at the first position of the array,
        // because Symfony\HttpFoundation\Request::getPreferredLanguage
        // returns the first element when no an appropriate language is found
        array_unshift( $this->locales, $this->defaultLocale );
        $this->locales = array_unique( $this->locales );
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    public function onKernelRequest( GetResponseEvent $event ): void
    {
        $request = $event->getRequest();
        // Ignore sub-requests and all URLs but the homepage
        if ( !$event->isMasterRequest() || '/' !== $request->getPathInfo() )
        {
            return;
        }
        // Ignore requests from referrers with the same HTTP host in order to prevent
        // changing language for users who possibly already selected it for this application.
        if (
            0 === mb_stripos(
                $request->headers->get( 'referer' ),
                $request->getSchemeAndHttpHost()
            ) )
        {
            return;
        }
        $preferredLanguage = $request->getPreferredLanguage( $this->locales );
        if ( $preferredLanguage !== $this->defaultLocale )
        {
            $response = new RedirectResponse(
                $this->urlGenerator->generate(
                    'homepage',
                    [ '_locale' => $preferredLanguage ]
                )
            );
            $event->setResponse( $response );
        }
    }
}