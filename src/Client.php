<?php

namespace Iamdevelopment\Iamapi\SDK;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class Client
 *
 * @package Iamdevelopment\Iamapi\SDK
 */
class Client
{
    const USER_AGENT_SUFFIX = 'iamstudent-api-php-client/';
    const API_BASE_PATH = 'https://api2.iamstudent.at';

    /**
     * @var array
     */
    private $basePath;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $refreshToken;

    public function __construct(string $basePath = null, string $token = null, string $refreshToken = null)
    {
        $this->basePath = $basePath ?? self::API_BASE_PATH;
        $this->token = $token;
        $this->refreshToken = $refreshToken;
        $this->client = Httpclient::create();
    }

    /**
     * @param $username
     * @param $password
     * @return ResponseInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function authenticate($username, $password): ResponseInterface
    {
        $body = ['username' => $username, 'password' => $password];

        $response = $this->client->request('POST', $this->basePath . '/api/login_check', [
            'json' => $body
        ]);

        $this->token = $response->toArray()['token'];
        $this->refreshToken = $response->toArray()['refresh_token'];

        return $response;
    }

    public function postVoucherFav(int $id): ResponseInterface
    {
        $response = $this->client->request('POST', $this->basePath . '/api/v1/voucher/' . $id . '/fav', ['auth_bearer' => $this->token]);

        return $response;
    }
}