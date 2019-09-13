<?php

namespace Iamsmartad\Iamapi\SDK;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface ClientInterface
{
    public const USER_AGENT_SUFFIX = 'iamstudent-api-php-client/';
    public const API_BASE_PATH = 'https://api2.iamstudent.at';

    public const OPTIONS_DEFAULT = [
        'timeout' => 5
    ];

    public function login(string $username, string $password) : ResponseInterface;
}