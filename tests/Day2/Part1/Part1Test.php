<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day2\Part1;

use PHPUnit\Framework\TestCase;

class Part1Test extends TestCase
{
    public function testPart1()
    {
        $intcode = new Intcode();

        $this->assertSame([2, 0, 0, 0, 99], $intcode->run([1, 0, 0, 0, 99]));
        $this->assertSame([2, 3, 0, 6, 99], $intcode->run([2, 3, 0, 3, 99]));
        $this->assertSame([2, 4, 4, 5, 99, 9801], $intcode->run([2, 4, 4, 5, 99, 0]));
        $this->assertSame([30, 1, 1, 4, 2, 5, 6, 0, 99], $intcode->run([1, 1, 1, 4, 99, 5, 6, 0, 99]));
    }
}
