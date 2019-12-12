<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day10\Part1;

class AsteroidMap
{
    private array $map;

    private const NO_ASTEROID = 0;
    private const ASTEROID = 1;

    public function __construct(string $input)
    {
        $this->map = $this->parseMap($input);
    }

    private function parseMap(string $input): array
    {
        $map = [];
        foreach (explode("\n", $input) as $y => $row) {
            foreach (str_split($row) as $x => $spot) {
                if ($spot === "#") {
                    $map[$x][$y] = self::ASTEROID;
                } else {
                    $map[$x][$y] = self::NO_ASTEROID;
                }
            }
        }

        return $map;
    }

    public function find()
    {
        $asteroids = $this->getAsteroidsFromMap($this->map);

        $result = [];
        foreach ($asteroids as $asteroid) {
            [$asteroid_x, $asteroid_y] = $asteroid;
            foreach ($this->map as $y => $row) {
                foreach ($row as $x => $spot) {
                    if ($x === $asteroid_x && $y === $asteroid_y) {
                        continue;
                    }
                    if ($spot === self::ASTEROID) {
                        $angle = self::degreesBetweenPoints(
                            $asteroid_x,
                            $asteroid_y,
                            $x,
                            $y
                        );
                        $result[$asteroid_x][$asteroid_y][] = $angle;
                    }
                }
            }
        }

        $max = -1;
        foreach ($result as $rows) {
            foreach ($rows as $row) {
                $max = max($max, count(array_unique($row)));
            }
        }

        return $max;
    }

    private function getAsteroidsFromMap(array $map): array
    {
        $asteroids = [];
        foreach ($map as $y => $row) {
            foreach ($row as $x => $spot) {
                if ($spot === self::ASTEROID) {
                    $asteroids[] = [$x, $y];
                }
            }
        }
        return $asteroids;
    }

    public static function degreesBetweenPoints($x1, $y1, $x2, $y2): float
    {
        $dx = $x1 - $x2;
        $dy = $y1 - $y2;

        return rad2deg(atan2($dy, $dx));
    }
}
