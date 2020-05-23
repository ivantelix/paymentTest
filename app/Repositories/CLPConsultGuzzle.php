<?php

namespace App\Repositories;
use GuzzleHttp\Client;

class CLPConsultGuzzle {
    public function get()
    {
        $client = new Client([
            'base_uri' => 'https://mindicador.cl/api',
            'timeout' => 2.0
        ]);

        $response = $client->request('GET', 'dolar');
        return json_decode( $response->getBody()->getContents() );
    }
}
