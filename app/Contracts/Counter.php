<?php

namespace App\Contracts;

interface Counter
{
    public function increment(string $key, array $tags = null): int;
}