<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day6\Part2;

use PHPUnit\Framework\TestCase;

class Part2Test extends TestCase
{
    public function testPart1()
    {
        $o = new OrbitCalculator();
        $this->assertSame(4, $o->parse([
            "COM)B",
            "B)C",
            "C)D",
            "D)E",
            "E)F",
            "B)G",
            "G)H",
            "D)I",
            "E)J",
            "J)K",
            "K)L",
            "K)YOU",
            "I)SAN",
        ]));
    }
}