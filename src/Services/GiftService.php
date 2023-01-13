<?php

namespace App\Services;

class GiftService
{
    private array $gifts = ['foo1', 'foo2', 'foo3', 'foo4', 'foo5'];

    public function __construct()
    {
        shuffle($this->gifts);
    }

    public function getGifts(): array
    {
        return $this->gifts;
    }
}
