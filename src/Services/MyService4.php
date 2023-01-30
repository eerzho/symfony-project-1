<?php

namespace App\Services;

class MyService4
{
    public $my;
    public $logger;

    public function __construct()
    {
        dump($this->my);
        dump($this->logger);
    }

    public function someAction()
    {
        dump($this->my);
        dump($this->logger);
    }
}
