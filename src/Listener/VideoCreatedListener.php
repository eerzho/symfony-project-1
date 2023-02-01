<?php

namespace App\Listener;

class VideoCreatedListener
{
    public function onVideoCreatedEvent($event)
    {
        dump($event->video->title);
    }
}
