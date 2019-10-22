<?php

namespace KSolo\Lifx\Endpoints\Effects;

use GuzzleHttp\Psr7\Request;
use KSolo\Lifx\Endpoints\CreatesRequest;

class MoveEffect extends Effect implements CreatesRequest
{
    /**
     * {@inheritdoc}
     */
    public function toRequest(): Request
    {
        return $this->makeRequest('move');
    }
}
