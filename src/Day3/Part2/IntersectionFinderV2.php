<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day3\Part2;

use RuntimeException;

class IntersectionFinderV2
{
    public function find(string $first_path, string $second_path): int
    {
        $grid = [];
        $min_steps = PHP_INT_MAX;

        foreach ([$first_path, $second_path] as $nr => $routes) {
            $x = $y = $steps = 0;
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
                    $grid[$x][$y][$nr] = ++$steps;
                    if (count($grid[$x][$y]) === 2) {
                        $min_steps = min($min_steps, array_sum($grid[$x][$y]));
                    }
                }
            }
        }

        if ($min_steps === PHP_INT_MAX) {
            throw new RuntimeException("Could not find closest distance");
        }

        return $min_steps;
    }
}