<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day1\Part2;

class FuelCalculator
{
    public function calculateFromInput(array $masses): int
    {
        $fuel_needed = 0;
        foreach ($masses as $mass) {
            $input = $mass;
            while (($input = $this->calculate((int)$input)) > 0) {
                $fuel_needed += $input;
            }
        }
        return $fuel_needed;
    }

    private function calculate(int $mass): int
    {
        return (int)floor($mass / 3) - 2;
    }
}

