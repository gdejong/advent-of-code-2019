<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day4\Part2;

use PHPUnit\Framework\TestCase;

class Part2Test extends TestCase
{
    public function testPart1()
    {
        $p = new Password();

        $this->assertTrue($p->isAMatch("112233"));
        $this->assertFalse($p->isAMatch("123444"));
        $this->assertTrue($p->isAMatch("111122"));
    }
}