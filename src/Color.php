<?php
declare(strict_types=1);

namespace KSolo\Lifx;

use KSolo\Lifx\Util\Validators;

class Color
{
    private const SETTING_HEX = 'hex';
    private const SETTING_RGB = 'rgb';
    private const SETTING_BRIGHTNESS = 'brightness';
    private const SETTING_SATURATION = 'saturation';
    private const SETTING_HUE = 'hue';
    private const SETTING_KELVIN = 'kelvin';
    private const SETTING_NAME = 'name';

    /**
     * @var array
     */
    private $colorSettings = [];

    /**
     * @var \KSolo\Lifx\Util\Validators
     */
    private $validators;

    /**
     * Selector constructor.
     */
    public function __construct()
    {
        $this->validators = new Validators();
    }

    /**
     * @param string $hexValue
     *
     * @return \KSolo\Lifx\Color
     */
    public function setHex(string $hexValue): self
    {
        return $this->appendSetting(self::SETTING_HEX, $hexValue);
    }

    /**
     * @param int $r
     * @param int $g
     * @param int $b
     *
     * @return \KSolo\Lifx\Color
     */
    public function setRbg(int $r, int $g, int $b): self
    {
        $this->validators->intInRange($r, 0, 255);
        $this->validators->intInRange($g, 0, 255);
        $this->validators->intInRange($b, 0, 255);

        $value = sprintf('%s:%s,%s,%s', self::SETTING_RGB, $r, $g, $b);

        return $this->appendSetting(self::SETTING_RGB, $value);
    }

    /**
     * @param float $level
     *
     * @return \KSolo\Lifx\Color
     */
    public function setBrightness(float $level): self
    {
        $this->validators->floatInRange($level, 0.0, 1.0);

        $value = sprintf('%s:%s', self::SETTING_BRIGHTNESS, $level);

        return $this->appendSetting(self::SETTING_BRIGHTNESS, $value);
    }

    /**
     * @param float $level
     *
     * @return \KSolo\Lifx\Color
     */
    public function setSaturation(float $level): self
    {
        $this->validators->floatInRange($level, 0.0, 1.0);

        $value = sprintf('%s:%s', self::SETTING_SATURATION, $level);

        return $this->appendSetting(self::SETTING_SATURATION, $value);
    }

    /**
     * @param int $value
     *
     * @return \KSolo\Lifx\Color
     */
    public function setHue(int $value): self
    {
        if ($value > 360 || $value < 0) {
            throw new \OutOfRangeException(sprintf('The value needs to be in the range of 0-360: %s', $value));
        }

        $setting = sprintf('%s:%s', self::SETTING_HUE, $value);

        return $this->appendSetting(self::SETTING_HUE, $setting);
    }

    /**
     * @param int $value
     *
     * @return \KSolo\Lifx\Color
     */
    public function setKelvin(int $value): self
    {
        $this->validators->intInRange($value, 1500, 9000);

        $setting = sprintf('%s:%s', self::SETTING_KELVIN, $value);

        return $this->appendSetting(self::SETTING_KELVIN, $setting);
    }

    /**
     * @param string $value
     *
     * @return \KSolo\Lifx\Color
     */
    public function setColorName(string $value): self
    {
        $validColorNames = ['white', 'red', 'orange', 'yellow', 'cyan', 'green', 'blue', 'purple', 'pink'];

        if (! in_array($value, $validColorNames, true)) {
            throw new \InvalidArgumentException('The color you supplied is not supported: %s', $value);
        }

        return $this->appendSetting(self::SETTING_NAME, $value);
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return \KSolo\Lifx\Color
     */
    private function appendSetting(string $key, string $value): self
    {
        $this->colorSettings[$key] = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return implode(' ', $this->colorSettings);
    }
}