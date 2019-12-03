<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day3\Part1;

class IntersectionFinder
{
    public function find(string $first_path, string $second_path): int
    {
        $grid1 = $this->fillGrid($first_path);
        $grid2 = $this->fillGrid($second_path);

        foreach ($grid1 as $x1 => $rows) {
            foreach ($rows as $y1) {
                if (isset($grid2[$x1]) && isset($grid2[$x1][$y1])) {
                    var_dump($grid2[$x1][$y1]);
                }
            }
        }

        return 0;
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
            switch (substr($value, 0, 1)) {
                case "U":
                    $newY = (int)substr($value, 1);
                    for ($i = $y; $i < $newY; $i++) {
                        $grid[$x][$i] = 1;
                    }
                    $y += $newY;
                    break;
                case "D":
                    $newY = (int)substr($value, 1);
                    for ($i = $y; $i < $newY; $i++) {
                        $grid[$x][$i] = 1;
                    }
                    $y -= $newY;
                    break;
                case "R":
                    $newX = (int)substr($value, 1);
                    $x += $newX;
                    for ($i = $x; $i < $newX; $i++) {
                        $grid[$i][$y] = 1;
                    }

                    break;
                case "L":
                    $newX = (int)substr($value, 1);
                    for ($i = $x; $i < $newX; $i++) {
                        $grid[$i][$y] = 1;
                    }
                    $x -= $newX;
                    break;
                default:
                    throw new \RuntimeException("Unknown instruction");
            }
        }

        return $grid;
    }
}