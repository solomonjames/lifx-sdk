<?php

namespace KSolo\Lifx\Endpoints;

use GuzzleHttp\Psr7\Request;

interface CreatesRequest
{
    /**
     * @return \GuzzleHttp\Psr7\Request
     */
    public function toRequest(): Request;
}