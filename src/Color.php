<?php
declare(strict_types=1);

namespace KSolo\Lifx;

class Color
{
    /**
     * @var array
     */
    private $data;

    /**
     * Color constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Hue
     *
     * @return int
     */
    public function hue(): int
    {
        return $this->data['hue'];
    }

    /**
     * Saturation
     *
     * @return int
     */
    public function saturation(): int
    {
        return $this->data['saturation'];
    }

    /**
     * Kelvin
     *
     * @return int
     */
    public function kelvin(): int
    {
        return $this->data['kelvin'];
    }
}