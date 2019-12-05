<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day5\Part1;

use RuntimeException;

class Intcode
{
    private const MODE_POSITION = 0;
    private const MODE_IMMEDIATE = 1;

    public function run(array $program, int $input): int
    {
        $return = PHP_INT_MAX;
        $result = $program;
        $instruction_pointer = 0;
        while (true) {
            $mode_1 = isset(((string)$result[$instruction_pointer])[-3]) ? (int)((string)($result[$instruction_pointer]))[-3] : 0;  //hundreds digit
            if ($mode_1 !== self::MODE_POSITION && $mode_1 !== self::MODE_IMMEDIATE) {
                throw new RuntimeException("Unexpected parameter mode for first parameter" . $mode_1);
            }
            $mode_2 = isset(((string)$result[$instruction_pointer])[-4]) ? (int)((string)($result[$instruction_pointer]))[-4] : 0;  //thousands digit
            if ($mode_2 !== self::MODE_POSITION && $mode_2 !== self::MODE_IMMEDIATE) {
                throw new RuntimeException("Unexpected parameter mode for second parameter" . $mode_2);
            }
            $mode_3 = isset(((string)$result[$instruction_pointer])[-5]) ? (int)((string)($result[$instruction_pointer]))[-5] : 0;  //ten-thousands digit
            if ($mode_3 !== self::MODE_POSITION && $mode_3 !== self::MODE_IMMEDIATE) {
                throw new RuntimeException("Unexpected parameter mode for third parameter" . $mode_3);
            }

            // % 100 to get the rightmost two digits
            switch ($result[$instruction_pointer] % 100) {
                case 1:
                    $value_1 = $mode_1 === self::MODE_POSITION ? $result[$result[$instruction_pointer + 1]] : $result[$instruction_pointer + 1];
                    $value_2 = $mode_2 === self::MODE_POSITION ? $result[$result[$instruction_pointer + 2]] : $result[$instruction_pointer + 2];
                    $value_to_set = $value_1 + $value_2;

                    if ($mode_3 === self::MODE_POSITION) {
                        $result[$result[$instruction_pointer + 3]] = $value_to_set;
                    } else {
                        $result[$instruction_pointer + 3] = $value_to_set;
                    }

                    $instruction_pointer += 4;
                    break;
                case 2:
                    $value_1 = $mode_1 === self::MODE_POSITION ? $result[$result[$instruction_pointer + 1]] : $result[$instruction_pointer + 1];
                    $value_2 = $mode_2 === self::MODE_POSITION ? $result[$result[$instruction_pointer + 2]] : $result[$instruction_pointer + 2];
                    $value_to_set = $value_1 * $value_2;

                    if ($mode_3 === self::MODE_POSITION) {
                        $result[$result[$instruction_pointer + 3]] = $value_to_set;
                    } else {
                        $result[$instruction_pointer + 3] = $value_to_set;
                    }

                    $instruction_pointer += 4;
                    break;
                case 3:
                    // Opcode 3 takes a single integer as input and saves it to the position given by its only parameter.
                    // For example, the instruction 3,50 would take an input value and store it at address 50.
                    if ($mode_1 === self::MODE_POSITION) {
                        $result[$result[$instruction_pointer + 1]] = $input;
                    } else {
                        $result[$instruction_pointer + 1] = $input;
                    }

                    $instruction_pointer += 2;
                    break;
                case 4:
                    // Opcode 4 outputs the value of its only parameter. For example, the instruction 4,50 would output
                    // the value at address 50.
                    if ($mode_1 === self::MODE_POSITION) {
                        $return = $result[$result[$instruction_pointer + 1]];
                    } else {
                        $return = $result[$instruction_pointer + 1];
                    }

                    $instruction_pointer += 2;
                    break;
                case 99:
                    return $return;
                default:
                    throw new RuntimeException("Unexpected intcode " . $result[$instruction_pointer]);
            }
        }

        throw new RuntimeException("Should not get here");
    }
}
