<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class CheckGeolocationListener
{
    private SessionInterface $session;

    /**
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @param RequestEvent $event
     * @return void
     */
    public function onKernelRequest(RequestEvent $event): void
    {
        //Todo Delete line 23 and uncomment line 22 for production
        //$ip = $_SERVER['REMOTE_ADDR'];
        $ip = "109.219.71.16";
        $ipApi = file_get_contents("http://ip-api.com/json/".$ip."?fields=9&lang=fr");
        $decodeApi = json_decode($ipApi, true);

        $this->session->has('localisation') ?: $this->session->set('localisation', $decodeApi);
    }
}
