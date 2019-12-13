<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day10\Part2;

use PHPUnit\Framework\TestCase;

class Part2Test extends TestCase
{
    public function testPart1()
    {
        $map = new AsteroidMap(
            ".#..#
.....
#####
....#
...##"
        );

        $result = $map->find();

        $this->assertSame(8, $result["max"]);
        $this->assertSame(3, $result["x"]);
        $this->assertSame(4, $result["y"]);
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

        $result = $map->find();

        $this->assertSame(33, $result["max"]);
        $this->assertSame(5, $result["x"]);
        $this->assertSame(8, $result["y"]);
    }

    public function testPart1c()
    {
        $map = new AsteroidMap(
            ".#..##.###...#######
##.############..##.
.#.######.########.#
.###.#######.####.#.
#####.##.#.##.###.##
..#####..#.#########
####################
#.####....###.#.#.##
##.#################
#####.##.###..####..
..######..##.#######
####.##.####...##..#
.#####..#.######.###
##...#.##########...
#.##########.#######
.####.#.###.###.#.##
....##.##.###..#####
.#.#.###########.###
#.#.#.#####.####.###
###.##.####.##.#..##"
        );

        $result = $map->find();

        $this->assertSame(210, $result["max"]);
        $this->assertSame(11, $result["x"]);
        $this->assertSame(13, $result["y"]);

        $this->assertSame([8, 2], $map->getNthAsteroidToBeDestroyed($result["x"], $result["y"], 200));
    }

}
