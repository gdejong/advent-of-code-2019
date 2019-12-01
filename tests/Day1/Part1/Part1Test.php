<?php

declare(strict_types=1);

use gdejong\AdventOfCode\Day1\Part1\FuelCalculator;
use PHPUnit\Framework\TestCase;

class Part1Test extends TestCase
{
    public function testPart1()
    {
        $fuel_calculator = new FuelCalculator();

        $this->assertSame(2, $fuel_calculator->calculateFromInput([12]));
        $this->assertSame(2, $fuel_calculator->calculateFromInput([14]));
        $this->assertSame(654, $fuel_calculator->calculateFromInput([1969]));
        $this->assertSame(33583, $fuel_calculator->calculateFromInput([100756]));
    }
}