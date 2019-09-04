<?php

namespace Iamdevelopment\Iamapi\SDK;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;

class Client
{
    public static function getVoucherById(): ResponseInterface
    {
        $client = HttpClient::create();

        $response = $client->request('GET', 'https://api2.dev.iamstudent.at/api/v1/voucher/15');

        return $response;
    }

    public static function login(): ResponseInterface
    {
        $client = HttpClient::create();

        $body = ['username' => 'raffael.tunder@iamstudent.at', 'password' => 'mypassword'];

        $response = $client->request('POST', 'https://api2.dev.iamstudent.at/api/login_check', [
            'json' => $body
        ]);

        return $response;
    }
}