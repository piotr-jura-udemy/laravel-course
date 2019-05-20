<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Contracts\CounterContract;

/**
 * @method static int increment(string $key, array $tags = null)
 */
class CounterFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return CounterContract::class;
    }
}