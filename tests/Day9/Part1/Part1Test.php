<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day9\Part1;

use PHPUnit\Framework\TestCase;

class Part1Test extends TestCase
{
    public function testPart1()
    {
        $intcode = new Intcode();
        $this::assertSame(1337, $intcode->run([3, 0, 4, 0, 99], 1337));
    }

    public function testPart1b()
    {
        $intcode = new Intcode();
        $this::assertSame(1125899906842624, $intcode->run([104, 1125899906842624, 99], 0));
    }

    public function testPart1regression()
    {
        $intcode = new Intcode();
        $this::assertSame(1337, $intcode->run([3, 0, 4, 0, 99], 1337));
        $this::assertSame(0, $intcode->run([3, 9, 8, 9, 10, 9, 4, 9, 99, -1, 8], 7));
        $this::assertSame(
            999,
            $intcode->run(
                [
                    3,
                    21,
                    1008,
                    21,
                    8,
                    20,
                    1005,
                    20,
                    22,
                    107,
                    8,
                    21,
                    20,
                    1006,
                    20,
                    31,
                    1106,
                    0,
                    36,
                    98,
                    0,
                    0,
                    1002,
                    21,
                    125,
                    20,
                    4,
                    20,
                    1105,
                    1,
                    46,
                    104,
                    999,
                    1105,
                    1,
                    46,
                    1101,
                    1000,
                    1,
                    20,
                    4,
                    20,
                    1105,
                    1,
                    46,
                    98,
                    99
                ],
                7
            )
        );
    }
}
