<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day3\Part2;

use PHPUnit\Framework\TestCase;

class Part1Test extends TestCase
{
    public function testPart1()
    {
        $finder = new IntersectionFinderV2();

        $this->assertSame(
            30,
            $finder->find(
                "R8,U5,L5,D3",
                "U7,R6,D4,L4"
            )
        );

        $this->assertSame(
            610,
            $finder->find(
                "R75,D30,R83,U83,L12,D49,R71,U7,L72",
                "U62,R66,U55,R34,D71,R55,D58,R83"
            )
        );
        $this->assertSame(
            410,
            $finder->find(
                "R98,U47,R26,D63,R33,U87,L62,D20,R33,U53,R51",
                "U98,R91,D20,R16,D67,R40,U7,R15,U6,R7"
            )
        );
    }
}