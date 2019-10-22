<?php

namespace KSolo\Lifx\Util;

class Validators
{
    /**
     * @param int $value
     * @param int $min
     * @param int $max
     *
     * @return bool
     */
    public function intInRange(int $value, int $min, int $max): bool
    {
        if ($value > $max || $value < $min) {
            throw new \OutOfRangeException(sprintf('The value needs to be in the range of %s-%s: %s', $min, $max, $value));
        }

        return true;
    }

    /**
     * @param float $value
     * @param float $min
     * @param float $max
     *
     * @return bool
     */
    public function floatInRange(float $value, float $min, float $max): bool
    {
        if ($value > $max) {
            throw new \OutOfRangeException(sprintf('The level cannot exceed %s -- %s given', $max, $value));
        }

        if ($value < $min) {
            throw new \OutOfRangeException(sprintf('The level be below %s -- %s given', $min, $value));
        }

        return true;
    }
}
