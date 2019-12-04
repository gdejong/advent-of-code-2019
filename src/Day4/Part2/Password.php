<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day4\Part2;

class Password
{
    public function isAMatch(string $number): bool
    {
        // It is a six-digit number.
        if (strlen($number) !== 6) {
            return false;
        }

        $last_char = "";

        $values = [];
        foreach (str_split($number) as $char) {
            // Two adjacent digits are the same (like 22 in 122345).
            if (isset($values[$char])) {
                $values[$char]++;
            } else {
                $values[$char] = 1;
            }

            // Going from left to right, the digits never decrease
            if ((int)$char < (int)$last_char) {
                return false;
            }
            $last_char = $char;
        }

        foreach ($values as $index => $value) {
            if ($value === 2) {
                return true;
            }
        }

        return false;
    }
}