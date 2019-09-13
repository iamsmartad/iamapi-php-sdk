<?php

namespace Iamsmartad\Iamapi\SDK;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class Client
 *
 */
final class Client implements ClientInterface
{
    /**
     * @var array
     */
    private $options;
    /**
     * @var array
     */
    private $basePath;
    /**
     * @var HttpClientInterface
     */
    private $client;

    public function __construct(array $options = [], string $basePath = null, HttpClientInterface $client = null)
    {
        $this->options = array_merge(self::OPTIONS_DEFAULT, $options);
        $this->basePath = $basePath ?? self::API_BASE_PATH;
        $this->client = $client ?? Httpclient::create();
    }

    /**
     * Reconfigure options provided in each request.
     *
     * @param array $options
     * @param bool  $ignoreDefaults
     */
    public function configure(array $options, bool $ignoreDefaults = false)
    {
        $this->options = $ignoreDefaults ? $options : array_merge(ClientInterface::OPTIONS_DEFAULT, $options);
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
    public function login(string $username, string $password): ResponseInterface
    {
        $body = ['username' => $username, 'password' => $password];

        $this->preparePayload($body);

        $response = $this->client->request('POST', $this->basePath . '/api/login_check', $this->options);

        return $response;
    }

    protected function preparePayload(array $payload)
    {
        $this->options['json'] = $payload;
    }
}