<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day10\Part2;

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
                    $map[$y][$x] = self::ASTEROID;
                } else {
                    $map[$y][$x] = self::NO_ASTEROID;
                }
            }
        }

        return $map;
    }

    public function getNthAsteroidToBeDestroyed(int $asteroid_x, int $asteroid_y, $n = 200)
    {
        $result = [];
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
                    $result[(string)$angle][] = [
                        "angle" => $angle,
                        "x" => $x,
                        "y" => $y,
                        "distance" => $this->manhattanDistance($asteroid_x, $asteroid_y, $x, $y),
                    ];
                }
            }
        }

        ksort($result);


        $keys = array_keys($result);

        $asteroids_for_angle = $result[$keys[$n - 1]];

        // get the angle with the least distance
        usort($asteroids_for_angle, function ($a, $b) {
            return $a["distance"] > $b["distance"];
        });

        $item = reset($asteroids_for_angle);

        return [$item["x"], $item["y"]];
    }

    private function manhattanDistance(int $x, int $y, int $x2, int $y2): int
    {
        return abs($x - $x2) + abs($y - $y2);
    }

    public function find(): array
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
                        $result[$asteroid_y][$asteroid_x][] = [
                            "angle" => $angle,
                            "x" => $x,
                            "y" => $y,
                        ];
                    }
                }
            }
        }

        $max = -1;
        $return_x = -1;
        $return_y = -1;
        foreach ($result as $y => $rows) {
            foreach ($rows as $x => $row) {
                $count = count(array_unique(array_map(static function ($point) {
                    return $point["angle"];
                }, $row)));
                if ($count > $max) {
                    $max = $count;
                    $return_x = $x;
                    $return_y = $y;
                }
            }
        }

        return [
            "max" => $max,
            "x" => $return_x,
            "y" => $return_y,
        ];
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

        // convert to easy to work with 0 - 360 range
        $a = rad2deg(atan2($dy, $dx));

        $a -= 90.0;
        if ($a < 0) {
            $a += 360.0;
        }

        return $a;
    }
}
