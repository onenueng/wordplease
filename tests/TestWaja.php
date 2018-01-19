<?php

namespace Tests;

use GuzzleHttp\Client;

class TestWaja
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost:3000',
            'timeout'  => 2.0,
        ]);
    }

    public function checkRegistryData(array $data)
    {   
        $response = $this->client->post('/check-register-data', [
            'headers' => [
                'Accept' => 'application/json',
                'token'  => 'abcd',
                'secret' => 'secret'
            ],
            'form_params' => [
                'field' => 'email',
                'mode'  => 'valid',
                'value' => 'koramit@siri.co'
            ]
        ]);

        if ( $response->getStatusCode() == 200 ) {
            return json_decode($response->getBody(), true);
        }

        return ['text' => 'request failed'];
    }
}