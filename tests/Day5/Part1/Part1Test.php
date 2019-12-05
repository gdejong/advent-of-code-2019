<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day5\Part1;

use PHPUnit\Framework\TestCase;

class Part1Test extends TestCase
{
    public function testPart1()
    {
        $intcode = new Intcode();
        $this::assertSame(1337, $intcode->run([3,0,4,0,99], 1337));
    }
}