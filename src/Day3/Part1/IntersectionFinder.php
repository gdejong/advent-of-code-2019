<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day3\Part1;

use RuntimeException;

class IntersectionFinder
{
    public function find(string $first_path, string $second_path): int
    {
        $grid1 = $this->fillGrid($first_path);
        $grid2 = $this->fillGrid($second_path);

        $manhattan = null;
        foreach ($grid1 as $y => $rows) {
            foreach ($rows as $x => $_) {
                if (isset($grid2[$y][$x])) {
                    $m = $this->manhattanDistance($x, $y);
                    if ($manhattan === null || $m < $manhattan) {
                        $manhattan = $m;
                    }
                }
            }
        }

        if ($manhattan === null) {
            throw new RuntimeException("No intersection found");
        }

        return $manhattan;
    }

    /**
     * @param string $path "R75,D30,R83,U83,L12,D49,R71,U7,L72"
     * @return array
     */
    public function fillGrid(string $path): array
    {
        $grid = [];
        $x = 0;
        $y = 0;

        foreach (explode(",", $path) as $item => $value) {
            $length = (int)substr($value, 1);

            switch (substr($value, 0, 1)) {
                case "U":
                    for ($i = 1; $i <= $length; $i++) {
                        $grid[$y + $i][$x] = 1;
                    }
                    $y += $length;
                    break;
                case "D":
                    for ($i = 1; $i <= $length; $i++) {
                        $grid[$y - $i][$x] = 1;
                    }
                    $y -= $length;
                    break;
                case "R":
                    for ($i = 1; $i <= $length; $i++) {
                        $grid[$y][$x + $i] = 1;
                    }
                    $x += $length;
                    break;
                case "L":
                    for ($i = 1; $i <= $length; $i++) {
                        $grid[$y][$x - $i] = 1;
                    }
                    $x -= $length;
                    break;
                default:
                    throw new RuntimeException("Unknown instruction");
            }
        }

        return $grid;
    }

    private function manhattanDistance(int $x, int $y): int
    {
        return abs($x) + abs($y);
    }
}