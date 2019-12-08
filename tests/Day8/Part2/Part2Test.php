<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day8\Part2;

use PHPUnit\Framework\TestCase;

class Part2Test extends TestCase
{
    public function testRender()
    {
        $p = new RoverPassword();
        $layers = $p->getLayers("0222112222120000", 2, 2);

        $stack = $p->stackLayers($layers);
        $this->assertSame([
            [0, 1],
            [1, 0]
        ], $stack);

        $this->assertSame("01" . PHP_EOL . "10", $p->render($stack));
    }

    public function testPart1()
    {
        $p = new RoverPassword();
        $layers = $p->getLayers("123", 3, 1);

        $this->assertSame([
            1 =>
                [
                    ['1', '2', '3',],
                ],
        ], $layers);
    }

    public function testPart1b()
    {
        $p = new RoverPassword();
        $layers = $p->getLayers("123456", 3, 2);

        $this->assertSame([
            1 =>
                [
                    ['1', '2', '3',],
                    ['4', '5', '6',],
                ],
        ], $layers);
    }

    public function testPart1c()
    {
        $p = new RoverPassword();
        $layers = $p->getLayers("123456789", 3, 2);

        $this->assertSame([
            1 =>
                [
                    ['1', '2', '3',],
                    ['4', '5', '6',],
                ],
            2 =>
                [
                    ['7', '8', '9',],
                ],
        ], $layers);
    }

    public function testPart1d()
    {
        $p = new RoverPassword();
        $layers = [
            1 =>
                [
                    ['0', '2', '3',],
                    ['4', '5', '6',],
                ],
            2 =>
                [
                    ['0', '0', '9',],
                ],
        ];

        $l = $p->getLayerWithFewestDigits($layers, 0);
        $this->assertSame([
            ['0', '2', '3',],
            ['4', '5', '6',],
        ], $l);
    }
}