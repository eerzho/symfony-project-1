<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class VideoCreatedSubscriber implements EventSubscriberInterface
{
    public function onVideoCreatedEvent($event): void
    {
        dump($event->video->title);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'video.created.event' => 'onVideoCreatedEvent',
//            KernelEvents::RESPONSE => [
//                ['onKernelResponse1', 2],
//                ['onKernelResponse2', 1],
//            ]
        ];
    }

    public function onKernelResponse1(ResponseEvent $event)
    {
        $response = new Response('dua1');
//        $event->setResponse($response);
        dump('1');
    }

    public function onKernelResponse2(ResponseEvent $event)
    {
        $response = new Response('dua2');
//        $event->setResponse($response);
        dump('2');
    }
}
