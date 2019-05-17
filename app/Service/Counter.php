<?php

namespace App\Service;

use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Contracts\Session\Session;
use App\Contracts\Counter as CounterContract;

class Counter implements CounterContract
{
    private $cache;
    private $session;

    public function __construct(Cache $cache, Session $session)
    {
        $this->cache = $cache;
        $this->session = $session;
    }

    public function increment(string $key, array $tags = null): int
    {
        $sessionId = $this->session->getId();
        $counterKey = "{$key}-counter";
        $usersKey = "{$key}-users";
        $cache = null === $tags ? $this->cache : $this->cache->tags($tags);
        $users = $cache->get($usersKey, []);
        $usersUpdate = [];
        $diffrence = 0;
        $now = now();

        foreach ($users as $session => $lastVisit) {
            if ($now->diffInMinutes($lastVisit) >= 1) {
                $diffrence--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if(
            !array_key_exists($sessionId, $users)
            || $now->diffInMinutes($users[$sessionId]) >= 1
        ) {
            $diffrence++;
        }

        $usersUpdate[$sessionId] = $now;
        $cache->forever($usersKey, $usersUpdate);
        
        if (!$cache->has($counterKey)) {
            $cache->forever($counterKey, 1);
        } else {
            $cache->increment($counterKey, $diffrence);
        }

        $counter = $cache->get($counterKey);

        return $counter;
    }
}