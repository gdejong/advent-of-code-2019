<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day7\Part1;

use PHPUnit\Framework\TestCase;

class Part1Test extends TestCase
{
    public function testPart1a()
    {
        $intcode = new Intcode();

        $this::assertSame(
            43210,
            $intcode->runPhase(
                [3, 15, 3, 16, 1002, 16, 10, 16, 1, 16, 15, 15, 4, 15, 99, 0, 0],
                [4, 3, 2, 1, 0],
                5
            )
        );
    }

    public function testPart1b()
    {
        $intcode = new Intcode();

        $this::assertSame(
            54321,
            $intcode->runPhase(
                [
                    3,
                    23,
                    3,
                    24,
                    1002,
                    24,
                    10,
                    24,
                    1002,
                    23,
                    -1,
                    23,
                    101,
                    5,
                    23,
                    23,
                    1,
                    24,
                    23,
                    23,
                    4,
                    23,
                    99,
                    0,
                    0
                ],
                [0, 1, 2, 3, 4],
                5
            )
        );
    }

    public function testPart1c()
    {
        $intcode = new Intcode();

        $this::assertSame(
            65210,
            $intcode->runPhase(
                [
                    3,
                    31,
                    3,
                    32,
                    1002,
                    32,
                    10,
                    32,
                    1001,
                    31,
                    -2,
                    31,
                    1007,
                    31,
                    0,
                    33,
                    1002,
                    33,
                    7,
                    33,
                    1,
                    33,
                    31,
                    31,
                    1,
                    32,
                    31,
                    31,
                    4,
                    31,
                    99,
                    0,
                    0,
                    0
                ],
                [1, 0, 4, 3, 2],
                5
            )
        );
    }
}