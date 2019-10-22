<?php

namespace KSolo\Lifx\Endpoints\Effects;

use GuzzleHttp\Psr7\Request;
use KSolo\Lifx\Builders\Selector;
use KSolo\Lifx\Util\Validators;

class Effect
{
    /**
     * @var \KSolo\Lifx\Builders\Selector
     */
    protected $selector;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var \KSolo\Lifx\Util\Validators
     */
    protected $validators;

    /**
     * ListLights constructor.
     *
     * @param \KSolo\Lifx\Builders\Selector|null $selector
     */
    public function __construct(Selector $selector = null)
    {
        $this->selector = $selector ?? Selector::all();
        $this->validators = new Validators();
    }

    /**
     * Makes the Request object using an effect name
     *
     * @param string $effectName
     *
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function makeRequest(string $effectName): Request
    {
        $uri = sprintf('%s/effects/%s', $this->selector, $effectName);

        return new Request('POST', $uri, [], json_encode($this->data));
    }
}
