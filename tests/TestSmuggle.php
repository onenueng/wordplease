<?php

namespace Tests;

use GuzzleHttp\Client;

class TestSmuggle
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://smuggle.lullabears.co', // macgrant
            'timeout'  => 8.0,
        ]);
    }

    public function run()
    {
        $this->testFunc([
            ['function' => 'recently-admit' ,'key' => '53362643'],
            ['function' => 'admission','key' => '57122208'],
            ['function' => 'user' ,'key' => '10001392'],
            ['function' => 'patient','key' => '53362428'],
            ['function' => 'recently-admit' ,'key' => '53362428'],
            ['function' => 'admission','key' => '57116708'],
            ['function' => 'user' ,'key' => '10001394'],
            ['function' => 'patient','key' => '53362054'],
            ['function' => 'recently-admit' ,'key' => '53362196'],
            ['function' => 'admission','key' => '57108759'],
            ['function' => 'patient','key' => '53361787'],
            ['function' => 'user' ,'key' => '10001395'],
            ['function' => 'recently-admit' ,'key' => '53362239'],
            ['function' => 'admission','key' => '57109416'],
            ['function' => 'user' ,'key' => '10001396'],
            ['function' => 'patient','key' => '53362207'],
            ['function' => 'recently-admit' ,'key' => '53362207'],
            ['function' => 'admission','key' => '57108997'],
            ['function' => 'user' ,'key' => '10001397'],
            ['function' => 'patient','key' => '53362643'],
            ['function' => 'admission','key' => '57119498'],
            ['function' => 'patient','key' => '53361612'],
            ['function' => 'recently-admit' ,'key' => '53361612'],
            ['function' => 'admission','key' => '57119692'],
            ['function' => 'patient','key' => '53361508'],
            ['function' => 'admission','key' => '57108327'],
            ['function' => 'patient','key' => '53361617'],
            ['function' => 'recently-admit' ,'key' => '53361617'],
            ['function' => 'patient','key' => '53361697'],
            ['function' => 'admission','key' => '57110549'],
            ['function' => 'user' ,'key' => '10001414'],
            ['function' => 'admission','key' => '57109874'],
            ['function' => 'user' ,'key' => '10001411'],
            ['function' => 'admission','key' => '57113896'],
            ['function' => 'user' ,'key' => '10001408'],
            ['function' => 'admission','key' => '57114229'],
            ['function' => 'user' ,'key' => '10001406'],
            ['function' => 'recently-admit' ,'key' => '53361697'],
            ['function' => 'patient','key' => '53362196'],
            ['function' => 'admission','key' => '57114229'],
            ['function' => 'user' ,'key' => '10001404'],
            ['function' => 'recently-admit' ,'key' => '53361787'],
            ['function' => 'patient','key' => '53362207'],
            ['function' => 'admission','key' => '57114229'],
            ['function' => 'user' ,'key' => '10001402'],
            ['function' => 'recently-admit' ,'key' => '53362054'],
            ['function' => 'admission','key' => '57107999'],
            ['function' => 'user' ,'key' => '10001399'],
            ['function' => 'recently-admit' ,'key' => '53361508'],
        ]);
    }

    protected function testFunc($calls)
    {
        foreach ($calls as $call) {
            echo \Carbon\Carbon::now()->toDatetimeString();
            echo ' call => ' . $call['function'];
            echo '@' . $this->accio(['function' => $call['function'], 'key' => $call['key']])['reply_text'];
            echo "\n";
            
            sleep(1);
        }
    }

    public function accio(array $data)
    {
        if ( $data['function'] == 'user' ) {
            $key = 'org_id';
        } elseif ( $data['function'] == 'admission' ) {
            $key = 'an';
        } else {
            $key = 'hn';
        }
        
        $response = $this->client->post('/accio', [
            'headers' => [
                'Accept' => 'application/json',
                'token'  => 'q989zGPYBC5qIoMJou6cdPpjmhkjpUrXZy7wzjZbQVnlDVtQNx2l0Hyf4Ic2Xmx3', // macgrant
                'secret' => 'accio'
            ],
            'form_params' => [
                'function' => $data['function'],
                $key       => $data['key']
            ]
        ]);

        if ( $response->getStatusCode() == 200 ) {
            return json_decode($response->getBody(), true);
        }

        return ['text' => 'request failed'];
    }
}
