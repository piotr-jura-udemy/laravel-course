<?php

namespace App\Service;

use App\Contracts\Counter as CounterContract;

class DummyCounter implements CounterContract
{
    public function increment(string $key, array $tags = null): int
    {
        static $counter = 0;

        $counter++;

        return $counter;
    }
}