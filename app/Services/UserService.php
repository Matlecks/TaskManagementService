<?php

namespace App\Services;

use GuzzleHttp\Client;

class UserService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://usermanagementservice.ru/api/',
        ]);
    }

    public function getAllUsers()
    {
        $response = $this->client->get('give_users');
        return json_decode($response->getBody()->getContents(), true);
    }
}
