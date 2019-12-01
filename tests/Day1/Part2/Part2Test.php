<?php

declare(strict_types=1);

use gdejong\AdventOfCode\Day1\Part2\FuelCalculator;
use PHPUnit\Framework\TestCase;

class Part2Test extends TestCase
{
    public function testPart2()
    {
        $fuel_calculator = new FuelCalculator();

        $this->assertSame(2, $fuel_calculator->calculateFromInput([14]));
        $this->assertSame(966, $fuel_calculator->calculateFromInput([1969]));
        $this->assertSame(50346, $fuel_calculator->calculateFromInput([100756]));
    }
}