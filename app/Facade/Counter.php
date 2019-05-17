<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;
use App\Service\Counter as CounterService;

/**
 * @method static int increment(string $key, array $tags = null)
 */
class Counter extends Facade
{
    protected static function getFacadeAccessor() 
    { 
        return CounterService::class; 
    }
}