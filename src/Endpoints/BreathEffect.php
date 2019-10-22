<?php

namespace KSolo\Lifx\Endpoints;

use GuzzleHttp\Psr7\Request;
use KSolo\Lifx\Builders\Color;
use KSolo\Lifx\Builders\Selector;
use KSolo\Lifx\Util\Validators;

class BreathEffect implements CreatesRequest
{
    /**
     * @var \KSolo\Lifx\Builders\Selector
     */
    private $selector;

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var \KSolo\Lifx\Util\Validators
     */
    private $validators;

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
     * The color to use for the breathe effect.
     *
     * @param \KSolo\Lifx\Builders\Color $color
     *
     * @return $this
     */
    public function setColor(Color $color): self
    {
        $this->data['color'] = $color;

        return $this;
    }

    /**
     * The color to start the effect from. If this parameter is omitted then the color
     *   the bulb is currently set to is used instead.
     *
     * @param \KSolo\Lifx\Builders\Color $fromColor Default: current bulb color
     *
     * @return $this
     */
    public function setFromColor(Color $fromColor): self
    {
        $this->data['from_color'] = $fromColor;

        return $this;
    }

    /**
     * The time in seconds for one cycle of the effect.
     *
     * @param float $period Default: 1.0
     *
     * @return $this
     */
    public function setPeriod(float $period): self
    {
        // 0-100 years
        $this->validators->floatInRange($period, 0.0, 3155760000.0);

        $this->data['period'] = $period;

        return $this;
    }

    /**
     * The number of times to repeat the effect.
     *
     * @param float $cycles Default: 1.0
     *
     * @return $this
     */
    public function setCycles(float $cycles): self
    {
        // 0-100 years
        $this->validators->floatInRange($cycles, 0.0, 3155760000.0);

        $this->data['cycles'] = $cycles;

        return $this;
    }

    /**
     * If false set the light back to its previous value when effect ends, if true leave the last effect color.
     *
     * @param bool $toPersist Default: false
     *
     * @return $this
     */
    public function setPersist(bool $toPersist): self
    {
        $this->data['persist'] = $toPersist;

        return $this;
    }

    /**
     * If true, turn the bulb on if it is not already on.
     *
     * @param bool $turnPowerOn Default: true
     *
     * @return $this
     */
    public function setPowerOn(bool $turnPowerOn): self
    {
        $this->data['power_on'] = $turnPowerOn;

        return $this;
    }

    /**
     * Defines where in a period the target color is at its maximum. Minimum 0.0, maximum 1.0.
     *
     * @param float $peak Default: 0.5
     *
     * @return $this
     */
    public function setPeak(float $peak): self
    {
        $this->validators->floatInRange($peak, 0.0, 1.0);

        $this->data['peak'] = $peak;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toRequest(): Request
    {
        $uri = sprintf('%s/effects/breathe', $this->selector);

        return new Request('POST', $uri, [], json_encode($this->data));
    }
}