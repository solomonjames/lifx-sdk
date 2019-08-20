<?php

namespace KSolo\Lifx\Endpoints;

use GuzzleHttp\Psr7\Request;
use KSolo\Lifx\Color;
use KSolo\Lifx\Selector;
use KSolo\Lifx\Util\Validators;

class SetState implements CreatesRequest
{
    /**
     * @var \KSolo\Lifx\Selector
     */
    private $selector;

    /**
     * @var \KSolo\Lifx\Color
     */
    private $color;

    /**
     * @var float
     */
    private $brightness;

    /**
     * @var float
     */
    private $duration;

    /**
     * @var \KSolo\Lifx\Util\Validators
     */
    private $validators;

    /**
     * @var float
     */
    private $infrared;

    /**
     * @var bool
     */
    private $fastEnabled = false;

    /**
     * @var string
     */
    private $power;

    /**
     * SetState constructor.
     *
     * @param \KSolo\Lifx\Selector|null $selector
     */
    public function __construct(Selector $selector = null)
    {
        $this->selector = $selector ?? Selector::all();
        $this->validators = new Validators();
    }

    /**
     * @param \KSolo\Lifx\Color $color
     *
     * @return \KSolo\Lifx\Endpoints\SetState
     */
    public function setColor(Color $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @param float $brightness
     *
     * @return \KSolo\Lifx\Endpoints\SetState
     */
    public function setBrightness(float $brightness): self
    {
        $this->validators->floatInRange($brightness, 0.0, 1.0);

        $this->brightness = $brightness;

        return $this;
    }

    /**
     * @param float $duration
     *
     * @return \KSolo\Lifx\Endpoints\SetState
     */
    public function setDuration(float $duration): self
    {
        // 0-100 years
        $this->validators->floatInRange($duration, 0.0, 3155760000.0);

        $this->duration = $duration;

        return $this;
    }

    /**
     * @param float $infrared
     *
     * @return \KSolo\Lifx\Endpoints\SetState
     */
    public function setInfrared(float $infrared): self
    {
        $this->validators->floatInRange($infrared, 0.0, 1.0);

        $this->infrared = $infrared;

        return $this;
    }

    /**
     * @param bool $enabled
     *
     * @return \KSolo\Lifx\Endpoints\SetState
     */
    public function setFast(bool $enabled = true): self
    {
        $this->fastEnabled = $enabled;

        return $this;
    }

    /**
     * @return \KSolo\Lifx\Endpoints\SetState
     */
    public function setPowerOn(): self
    {
        return $this->setPower('on');
    }

    /**
     * @return \KSolo\Lifx\Endpoints\SetState
     */
    public function setPowerOff(): self
    {
        return $this->setPower('off');
    }

    /**
     * @param string $state
     *
     * @return \KSolo\Lifx\Endpoints\SetState
     */
    public function setPower(string $state): self
    {
        $this->power = $state;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toRequest(): Request
    {
        $uri = sprintf('%s/state', $this->selector);
        $body = [];

        $settings = ['color', 'brightness', 'power', 'infrared', 'fast', 'duration'];

        foreach ($settings as $setting) {
            $body[$setting] = (string) $this->$setting;
        }

        return new Request('PUT', $uri, [], http_build_query($body));
    }
}