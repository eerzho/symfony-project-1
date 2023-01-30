<?php

namespace App\Trait;

use App\Services\MyService3;
use Symfony\Contracts\Service\Attribute\Required;

trait OptionalServiceTrait
{
    #[Required]
    public function setSecondService(MyService3 $myService3): void
    {
        dump($myService3);
    }
}
