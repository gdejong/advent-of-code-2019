<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day6\Part1;

use PHPUnit\Framework\TestCase;

class Part1Test extends TestCase
{
    public function testPart1()
    {
        $o = new OrbitCalculator();
        $this->assertSame(42, $o->parse([
            "COM)B",
            "B)C",
            "C)D",
            "D)E",
            "E)F",
            "B)G",
            "G)Hv",
            "D)I",
            "E)J",
            "J)K",
            "K)L",
        ]));
    }
}