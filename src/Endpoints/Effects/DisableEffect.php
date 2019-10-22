<?php

namespace KSolo\Lifx\Endpoints\Effects;

use GuzzleHttp\Psr7\Request;
use KSolo\Lifx\Endpoints\CreatesRequest;

class DisableEffect extends Effect implements CreatesRequest
{
    /**
     * {@inheritdoc}
     */
    public function toRequest(): Request
    {
        return $this->makeRequest('off');
    }
}
