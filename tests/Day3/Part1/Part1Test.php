<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day3\Part1;

use PHPUnit\Framework\TestCase;

class Part1Test extends TestCase
{
    public function testPart1()
    {
        $finder = new IntersectionFinder();

        $this->assertSame(159, $finder->find("R1,D1,R1,U1,L1,D1,R1,U1,L1", "U62,R66,U55,R34,D71,R55,D58,R83"));
//        $this->assertSame(159, $finder->find("R75,D30,R83,U83,L12,D49,R71,U7,L72", "U62,R66,U55,R34,D71,R55,D58,R83"));
//        $this->assertSame(135, $finder->find("R98,U47,R26,D63,R33,U87,L62,D20,R33,U53,R51", "U98,R91,D20,R16,D67,R40,U7,R15,U6,R7"));
    }

    public function testFillGrid(): void
    {
        $finder = new IntersectionFinder();
        $expected = [];
        $expected[0][1] = 1;
        $expected[-1][1] = 1;
        $this->assertSame($expected, $finder->fillGrid("R1,D1"));
    }
}