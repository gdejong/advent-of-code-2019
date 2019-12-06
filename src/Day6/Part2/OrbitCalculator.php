<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day6\Part2;

class OrbitCalculator
{
    private const CENTER_OF_MASS = "COM";
    private const SANTA = "SAN";
    private const YOU = "YOU";

    public function parse(array $orbit_map): int
    {
        $result = 0;
        $tree = [];
        $san_to_com = [];
        $you_to_com = [];
        foreach ($orbit_map as $orbit) {
            [$left, $right] = explode(")", $orbit);
            $tree[$right] = $left;
        }

        // Determine routes to COM for SAN and YOU
        $s = self::SANTA;
        while ($s !== self::CENTER_OF_MASS) {
            $s = $tree[$s];
            $san_to_com[] = $s;
        }
        $y = self::YOU;
        while ($y !== self::CENTER_OF_MASS) {
            $y = $tree[$y];
            $you_to_com[] = $y;
        }

        // Find orbit that both routes cross
        $intersections = array_intersect($san_to_com, $you_to_com);
        $point = reset($intersections);

        // Count orbit transfers up to the crossing point
        foreach ($san_to_com as $index => $item) {
            if ($item === $point) {
                break;
            }
            $result++;
        }
        foreach ($you_to_com as $index => $item) {
            if ($item === $point) {
                break;
            }
            $result++;
        }

        return $result;
    }

}