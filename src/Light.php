<?php
declare(strict_types=1);

namespace KSolo\Lifx;

class Light
{
    private const POWER_ON = 'on';
    private const POWER_OFF = 'off';

    private const EFFECT_OFF = 'OFF';
    private const EFFECT_MOVE = 'MOVE';

    /**
     * @var array
     */
    private $data;

    /**
     * @var \KSolo\Lifx\Color
     */
    private $color;

    /**
     * Light constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * ID
     *
     * @return string
     */
    public function id(): string
    {
        return $this->data['id'];
    }

    /**
     * UUID
     *
     * @return string
     */
    public function uuid(): string
    {
        return $this->data['uuid'];
    }

    /**
     * Label
     *
     * @return string
     */
    public function label(): string
    {
        return $this->data['label'];
    }

    /**
     * Is the light connected?
     *
     * @return bool
     */
    public function connected(): bool
    {
        return $this->data['connected'];
    }

    /**
     * Power On?
     *
     * @return bool
     */
    public function powerOn(): bool
    {
        return $this->data['power'] === self::POWER_ON;
    }

    /**
     * Color
     *
     * @return \KSolo\Lifx\Color
     */
    public function color(): Color
    {
        if (! $this->color) {
            $this->color = new Color($this->data['color']);
        }

        return $this->color;
    }

    /**
     * Brightness
     *
     * @return float
     */
    public function brightness(): float
    {
        return (float) $this->data['brightness'];
    }

    /**
     * Effect On?
     *
     * @return bool
     */
    public function effectOn(): bool
    {
        return $this->data['effect'] !== self::EFFECT_OFF;
    }

    /**
     * Effect
     *
     * @return string
     */
    public function effect(): string
    {
        return $this->data['effect'];
    }
}