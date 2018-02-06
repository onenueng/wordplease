<?php

namespace Tests\Unit;
// Tests\Unit\RegisterCheckUserTest
class RegisterCheckUserTest
{
    protected $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => 'http://localhost:1304',
        ]);
    }

    public function test($key)
    {
        return $this->client->post('/register/check-id', ['form_params' => ['org_id' => $key]]);
    }
}