<?php

namespace Maras0830\TwitchApi\Core;

use GuzzleHttp\Client;
use Maras0830\TwitchApi\Exceptions\AuthenticationException;

class Base
{

    /**
     * @var $token
     */
    protected $token;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param null $token
     *
     * @variable Client $client
     */
    public function __construct($token = null)
    {
        if ($token)
            $this->setToken($token);


        $this->client = new Client([
            'base_uri' => config('twitch-api.api_url'),
            'defaults' => [
                'headers' => [
                    'Accept' => 'application/vnd.twitchtv[v3]+json',
                    'Client-ID' => config('twitch-api.client_id')
                ]
            ]
        ]);
    }

    /**
     * @param $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @param null $token
     *
     * @return null
     *
     * @throws AuthenticationException
     */
    public function getToken($token = null)
    {
        if ($token != null)
            return $token;

        if ($this->token == null)
            throw new AuthenticationException();

        return $this->token;
    }

    /**
     * Creates an authorized request
     *
     * @param $type
     * @param $url
     * @param $token
     *
     * @return \GuzzleHttp\Message\Request|\GuzzleHttp\Message\RequestInterface
     */
    protected function createRequest($type, $url, $token)
    {
        return $this->client->createRequest($type, $url, $this->getDefaultHeaders($token));
    }

    /**
     * @param null $token
     *
     * @return array
     */
    protected function getDefaultHeaders($token = null)
    {
        $headers = [
            'headers' => [
                'Accept' => 'application/vnd.twitchtv.v3+json',
                'Client-ID' => config('twitch-api.client_id')
            ]
        ];

        if ($token != null)
            $headers['headers']['Authorization'] = 'OAuth ' . $token;

        return $headers;
    }
}
