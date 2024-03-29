<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day3\Part1;

use RuntimeException;

class IntersectionFinder
{
    public function find(string $first_path, string $second_path): int
    {
        $grid = [];
        $manhattan = null;

        foreach ([$first_path, $second_path] as $nr => $routes) {
            $x = $y =  0;
            foreach (explode(",", $routes) as $route) {
                $length = (int)substr($route, 1);
                $dir = substr($route, 0, 1);
                for ($i = 0; $i < $length; $i++) {
                    switch ($dir) {
                        case "U":
                            $x += 0;
                            $y += 1;
                            break;
                        case "D":
                            $x += 0;
                            $y += -1;
                            break;
                        case "R":
                            $x += 1;
                            $y += 0;
                            break;
                        case "L":
                            $x += -1;
                            $y += 0;
                            break;
                        default:
                            throw new RuntimeException("Unknown instruction");
                    }
                    $grid[$x][$y][$nr] = 1337;
                    if (count($grid[$x][$y]) === 2) {
                        $m = $this->manhattanDistance($x, $y);
                        if ($manhattan === null || $m < $manhattan) {
                            $manhattan = $m;
                        }
                    }
                }
            }
        }

        return $manhattan;
    }

    private function manhattanDistance(int $x, int $y): int
    {
        return abs($x) + abs($y);
    }
}