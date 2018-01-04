<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Exception\ClientException;

class ApiCall extends Model
{
    /**
     * Perform the Kigo API call
     *
     * @param string $uri
     *
     * @return mixed
     */
    public function get($uri)
    {
        $client = new Client();

        try {
            return $client->request('GET', $uri , [
            'headers' => [
                'X-ApiKey' => 'e140adc9-16cd-43ce-87e0-215aa0e2c38b'
                ]
            ]);
        } catch (ClientException $e) {
            echo $e->getMessage();
        }
    }
}
