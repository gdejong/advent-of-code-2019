<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day4\Part1;

use PHPUnit\Framework\TestCase;

class Part1Test extends TestCase
{
    public function testPart1()
    {
        $p = new Password();

        $this->assertTrue($p->isAMatch("111111"));
        $this->assertFalse($p->isAMatch("223450"));
        $this->assertFalse($p->isAMatch("123789"));
        $this->assertFalse($p->isAMatch("1"));
    }
}