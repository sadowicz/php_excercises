<?php

namespace Storage;

use Concept\Distinguishable;
use Predis\Client;


class RedisStorage implements Storage
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function store(Distinguishable $distinguishable) : void
    {
        $this->client->set($distinguishable->key(), serialize($distinguishable));
    }

    public function loadAll(): array
    {
        $keys = $this->client->keys("widget_*_*");
        $result = [];

        foreach($keys as $key) {
            $result[] = unserialize($this->client->get($key));
        }

        return $result;
    }
}