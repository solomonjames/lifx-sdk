<?php

namespace KSolo\Lifx\Endpoints\Effects;

use GuzzleHttp\Psr7\Request;
use KSolo\Lifx\Endpoints\CreatesRequest;

/**
 * Class FlameEffect
 *
 * @link https://api.developer.lifx.com/docs/flame-effect
 */
class FlameEffect extends Effect implements CreatesRequest
{
    /**
     * Duration
     *
     * How long the animation lasts for in seconds.
     * Not specifying a duration makes the animation never stop.
     * Specifying 0 makes the animation stop.
     *
     * Note that there is a known bug where the tile remains in the animation once it has completed if duration is nonzero.
     *
     * @param float $duration
     *
     * @return \KSolo\Lifx\Endpoints\Effects\FlameEffect
     */
    public function setDuration(float $duration): self
    {
        $this->data['duration'] = $duration;
        return $this;
    }

    /**
     * Period
     *
     * This controls how quickly the flame runs. It is measured in seconds.
     * A lower number means the animation is faster
     *
     * @param float $period
     *
     * @return \KSolo\Lifx\Endpoints\Effects\FlameEffect
     */
    public function setPeriod(float $period): self
    {
        $this->data['period'] = $period;
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
        return $this->makeRequest('flame');
    }
}