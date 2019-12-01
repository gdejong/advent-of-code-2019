<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day1\Part1;

class FuelCalculator
{
    public function calculateFromInput(array $values): int
    {
        $fuel = 0;
        foreach ($values as $value) {
            $fuel += $this->calculate((int)$value);
        }
        return $fuel;
    }

    private function calculate(int $mass): int
    {
        return (int)floor($mass / 3) - 2;
    }
}

