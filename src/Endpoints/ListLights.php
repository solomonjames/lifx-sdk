<?php

namespace KSolo\Lifx\Endpoints;

use GuzzleHttp\Psr7\Request;
use KSolo\Lifx\Selector;

class ListLights implements CreatesRequest
{
    /**
     * @var \KSolo\Lifx\Selector
     */
    private $selector;

    /**
     * ListLights constructor.
     *
     * @param \KSolo\Lifx\Selector|null $selector
     */
    public function __construct(Selector $selector = null)
    {
        $this->selector = $selector ?? Selector::all();
    }

    /**
     * {@inheritdoc}
     */
    public function toRequest(): Request
    {
        $uri = sprintf('%s', $this->selector);

        return new Request('GET', $uri);
    }
}