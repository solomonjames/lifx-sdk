<?php
declare(strict_types=1);

namespace KSolo\Lifx\Builders;

/**
 * Class Selector
 *
 * @link https://api.developer.lifx.com/docs/selectors
 */
class Selector
{
    /**
     * @var array
     */
    private $selectors = [];

    /**
     * Static factory for selecting all lights
     */
    public static function all(): Selector
    {
        return (new self())->setAll();
    }

    /**
     * @return \KSolo\Lifx\Selector
     */
    public function setAll(): self
    {
        $this->selectors = ['all'];

        return $this;
    }

    /**
     * @param string $value
     * @param bool   $pickRandom
     * @param string $zones
     *
     * @return \KSolo\Lifx\Selector
     */
    public function addLocationId(string $value, bool $pickRandom = false, string $zones = ''): self
    {
        return $this->addSelector('location_id', $value, $pickRandom, $zones);
    }

    /**
     * @param string $value
     * @param bool   $pickRandom
     * @param string $zones
     *
     * @return \KSolo\Lifx\Selector
     */
    public function addLocation(string $value, ?bool $pickRandom = false, string $zones = ''): self
    {
        return $this->addSelector('location', $value, $pickRandom, $zones);
    }

    /**
     * @param string $value
     * @param bool   $pickRandom
     * @param string $zones
     *
     * @return \KSolo\Lifx\Selector
     */
    public function addLabel(string $value, ?bool $pickRandom = false, string $zones = ''): self
    {
        return $this->addSelector('label', $value, $pickRandom, $zones);
    }

    /**
     * @param string $value
     * @param bool   $pickRandom
     * @param string $zones
     *
     * @return \KSolo\Lifx\Selector
     */
    public function addId(string $value, ?bool $pickRandom = false, string $zones = ''): self
    {
        return $this->addSelector('id', $value, $pickRandom, $zones);
    }

    /**
     * @param string $value
     * @param bool   $pickRandom
     * @param string $zones
     *
     * @return \KSolo\Lifx\Selector
     */
    public function addGroupId(string $value, ?bool $pickRandom = false, string $zones = ''): self
    {
        return $this->addSelector('group_id', $value, $pickRandom, $zones);
    }

    /**
     * @param string $value
     * @param bool   $pickRandom
     * @param string $zones
     *
     * @return \KSolo\Lifx\Selector
     */
    public function addGroup(string $value, ?bool $pickRandom = false, string $zones = ''): self
    {
        return $this->addSelector('group', $value, $pickRandom, $zones);
    }

    /**
     * @param string $value
     * @param bool   $pickRandom
     * @param string $zones
     *
     * @return \KSolo\Lifx\Selector
     */
    public function addSceneId(string $value, ?bool $pickRandom = false, string $zones = ''): self
    {
        return $this->addSelector('scene_id', $value, $pickRandom, $zones);
    }

    /**
     * @param string $key
     * @param string $value
     * @param bool   $pickRandom
     * @param string $zones
     *
     * @return \KSolo\Lifx\Selector
     */
    private function addSelector(string $key, string $value, bool $pickRandom, string $zones): self
    {
        $formatted = sprintf('%s:%s', $key, $value);

        $formatted = $this->applyRandom($formatted, $pickRandom);
        $formatted = $this->applyZones($formatted, $zones);

        $this->selectors[] = $formatted;

        return $this;
    }

    /**
     * @param string $selector
     * @param string $zones
     *
     * @return string
     */
    private function applyZones(string $selector, string $zones): string
    {
        if ($zones === '') {
            return $selector;
        }

        return sprintf('%s|%s', $selector, $zones);
    }

    /**
     * @param string $selector
     * @param bool   $random
     *
     * @return string
     */
    private function applyRandom(string $selector, bool $random = false): string
    {
        if (! $random) {
            return $selector;
        }

        return sprintf('%s:random', $selector);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return implode(',', $this->selectors);
    }
}