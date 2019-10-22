<?php

namespace KSolo\Lifx;

use Illuminate\Support\Collection;
use KSolo\Lifx\Endpoints\CreatesRequest;
use KSolo\Lifx\Endpoints\HydratesResults;

class Lifx
{
    /**
     * @var \KSolo\Lifx\Client
     */
    private $client;

    /**
     * Lifx constructor.
     *
     * @param \KSolo\Lifx\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param \KSolo\Lifx\Endpoints\CreatesRequest $request
     *
     * @return \Illuminate\Support\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function execute(CreatesRequest $request): Collection
    {
        $response = $this->client->send($request);

        $results = Collection::make(json_decode((string) $response->getBody(), true));

        if ($request instanceof HydratesResults) {
            $results->mapInto($request->hydrator());
        }

        return $results;
    }
}