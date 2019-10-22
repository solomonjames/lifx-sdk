<?php

namespace KSolo\Lifx\Endpoints\Effects;

use GuzzleHttp\Psr7\Request;
use KSolo\Lifx\Builders\Color;
use KSolo\Lifx\Endpoints\CreatesRequest;

class PulseEffect extends Effect implements CreatesRequest
{
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
     * {@inheritdoc}
     */
    public function toRequest(): Request
    {
        return $this->makeRequest('pulse');
    }
}
