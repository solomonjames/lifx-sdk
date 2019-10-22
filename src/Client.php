<?php

namespace KSolo\Lifx;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use KSolo\Lifx\Endpoints\CreatesRequest;

class Client
{
    private const BASE_URL = 'https://api.lifx.com/v1/lights/';

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * Client constructor.
     *
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param \KSolo\Lifx\Endpoints\CreatesRequest $createsRequest
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function send(CreatesRequest $createsRequest)
    {
        return $this->sendRequest($createsRequest->toRequest());
    }

    /**
     * @param \GuzzleHttp\Psr7\Request $request
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function sendRequest(Request $request)
    {
        return $this->client->send($request);
    }

    /**
     * @param string $token
     *
     * @return \KSolo\Lifx\Client
     */
    public static function create(string $token): self
    {
        $client = new GuzzleClient([
            'base_uri' => static::BASE_URL,
            RequestOptions::HEADERS => [
                'Authorization' => sprintf('Bearer %s', $token),
            ],
        ]);

        return new static($client);
    }
}
