<?php

namespace KSolo\Lifx\Endpoints;

interface HydratesResults
{
    /**
     * Return the class name to map the results into
     *
     * @return string
     */
    public function hydrator(): string;
}
