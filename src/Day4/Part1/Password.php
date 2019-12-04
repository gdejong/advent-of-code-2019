<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day4\Part1;

class Password
{
    public function isAMatch(string $number): bool
    {
        // It is a six-digit number.
        if (strlen($number) !== 6) {
            return false;
        }

        $two_adjacent_values_are_the_same = false;
        $last_char = "";
        foreach (str_split($number) as $char) {
            // Two adjacent digits are the same (like 22 in 122345).
            if ($two_adjacent_values_are_the_same === false && $last_char === $char) {
                $two_adjacent_values_are_the_same = true;
            }

            // Going from left to right, the digits never decrease
            if ((int)$char < (int)$last_char) {
                return false;
            }
            $last_char = $char;
        }

        if ($two_adjacent_values_are_the_same === false) {
            return false;
        }

        return true;
    }
}