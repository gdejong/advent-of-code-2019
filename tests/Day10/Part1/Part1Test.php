<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day10\Part1;

use PHPUnit\Framework\TestCase;

class Part1Test extends TestCase
{
    public function testDegreesBetweenPoints()
    {
        $this->assertSame(-135.0, AsteroidMap::degreesBetweenPoints(1, 1, 2, 2));
        $this->assertSame(45.0, AsteroidMap::degreesBetweenPoints(2, 2, 1, 1));
    }

    public function testPart1()
    {
        $map = new AsteroidMap(
            ".#..#
.....
#####
....#
...##"
        );

        $this->assertSame(8, $map->find());
    }

    public function testPart1b()
    {
        $map = new AsteroidMap(
            "......#.#.
#..#.#....
..#######.
.#.#.###..
.#..#.....
..#....#.#
#..#....#.
.##.#..###
##...#..#.
.#....####"
        );

        $this->assertSame(33, $map->find());
    }

}
