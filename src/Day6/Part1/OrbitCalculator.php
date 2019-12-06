<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day6\Part1;

class OrbitCalculator
{
    private const CENTER_OF_MASS = "COM";

    public function parse(array $orbit_map): int
    {
        $tree = [];
        $num_orbits = 0;
        foreach ($orbit_map as $orbit) {
            [$left, $right] = explode(")", $orbit);
            $tree[$right] = $left;
        }

        foreach ($tree as $right => $left) {
            while ($left !== self::CENTER_OF_MASS) {
                $left = $tree[$left];
                $num_orbits++;
            }
            $num_orbits++;
        }

        return $num_orbits;
    }

}