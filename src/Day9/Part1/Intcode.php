<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day9\Part1;

use RuntimeException;

class Intcode
{
    private const MODE_POSITION = 0;
    private const MODE_IMMEDIATE = 1;
    private const MODE_RELATIVE = 2;

    private const VALID_MODES = [
        self::MODE_POSITION,
        self::MODE_IMMEDIATE,
        self::MODE_RELATIVE,
    ];

    private function getValue(int $mode, int $instruction_pointer, array $result, int $relative_base, int $parameter_offset)
    {
        if ($mode === self::MODE_POSITION) {
            return $result[$result[$instruction_pointer + $parameter_offset]];
        }

        if ($mode === self::MODE_IMMEDIATE) {
            return $result[$instruction_pointer + $parameter_offset];
        }

        return $result[$relative_base + $result[$instruction_pointer + $parameter_offset]];
    }

    private function setValue(int $mode, int $instruction_pointer, array $result, int $relative_base, int $parameter_offset, int $value_to_set): array
    {
        if ($mode === self::MODE_POSITION) {
            $result[$result[$instruction_pointer + 3]] = $value_to_set;
        }

        if ($mode === self::MODE_IMMEDIATE) {
            $result[$instruction_pointer + 3] = $value_to_set;
        }

        $result[$relative_base + $result[$instruction_pointer + $parameter_offset]] = $value_to_set;

        return $result;
    }

    public function run(array $program, int $input): int
    {
        $return = PHP_INT_MAX;
        $result = $program;
        $instruction_pointer = 0;
        $relative_base = 0;

        while (true) {
            $mode_1 = isset(((string)$result[$instruction_pointer])[-3]) ? (int)((string)($result[$instruction_pointer]))[-3] : 0;  //hundreds digit
            if (!in_array($mode_1, self::VALID_MODES, true)) {
                throw new RuntimeException("Unexpected parameter mode for first parameter" . $mode_1);
            }
            $mode_2 = isset(((string)$result[$instruction_pointer])[-4]) ? (int)((string)($result[$instruction_pointer]))[-4] : 0;  //thousands digit
            if (!in_array($mode_2, self::VALID_MODES, true)) {
                throw new RuntimeException("Unexpected parameter mode for second parameter" . $mode_2);
            }
            $mode_3 = isset(((string)$result[$instruction_pointer])[-5]) ? (int)((string)($result[$instruction_pointer]))[-5] : 0;  //ten-thousands digit
            if (!in_array($mode_3, self::VALID_MODES, true)) {
                throw new RuntimeException("Unexpected parameter mode for third parameter" . $mode_3);
            }

            // % 100 to get the rightmost two digits
            switch ($result[$instruction_pointer] % 100) {
                case 1:
                    $value_1 = $this->getValue($mode_1, $instruction_pointer, $result, $relative_base, 1);
                    $value_2 = $this->getValue($mode_2, $instruction_pointer, $result, $relative_base, 2);

                    $value_to_set = $value_1 + $value_2;

                    $result = $this->setValue($mode_3, $instruction_pointer, $result, $relative_base, 3, $value_to_set);

                    $instruction_pointer += 4;
                    break;
                case 2:
                    $value_1 = $this->getValue($mode_1, $instruction_pointer, $result, $relative_base, 1);
                    $value_2 = $this->getValue($mode_2, $instruction_pointer, $result, $relative_base, 2);
                    $value_to_set = $value_1 * $value_2;

                    $result = $this->setValue($mode_3, $instruction_pointer, $result, $relative_base, 3, $value_to_set);

                    $instruction_pointer += 4;
                    break;
                case 3:
                    // Opcode 3 takes a single integer as input and saves it to the position given by its only parameter.
                    // For example, the instruction 3,50 would take an input value and store it at address 50.
                    $result = $this->setValue($mode_1, $instruction_pointer, $result, $relative_base, 1, $input);

                    $instruction_pointer += 2;
                    break;
                case 4:
                    // Opcode 4 outputs the value of its only parameter. For example, the instruction 4,50 would output
                    // the value at address 50.
                    $return = $this->getValue($mode_1, $instruction_pointer, $result, $relative_base, 1);

                    $instruction_pointer += 2;

                    break;
                case 5:
                    // Opcode 5 is jump-if-true: if the first parameter is non-zero, it sets the instruction pointer to the value from the second parameter. Otherwise, it does nothing.
                    $value_1 = $this->getValue($mode_1, $instruction_pointer, $result, $relative_base, 1);
                    $value_2 = $this->getValue($mode_2, $instruction_pointer, $result, $relative_base, 2);
                    if ($value_1 !== 0) {
                        $instruction_pointer = $value_2;
                    } else {
                        $instruction_pointer += 3;
                    }
                    break;
                case 6:
                    // Opcode 6 is jump-if-false: if the first parameter is zero, it sets the instruction pointer to the value from the second parameter. Otherwise, it does nothing.
                    $value_1 = $this->getValue($mode_1, $instruction_pointer, $result, $relative_base, 1);
                    $value_2 = $this->getValue($mode_2, $instruction_pointer, $result, $relative_base, 2);
                    if ($value_1 === 0) {
                        $instruction_pointer = $value_2;
                    } else {
                        $instruction_pointer += 3;
                    }
                    break;
                case 7:
                    // Opcode 7 is less than: if the first parameter is less than the second parameter, it stores 1 in the position given by the third parameter. Otherwise, it stores 0.
                    $value_1 = $this->getValue($mode_1, $instruction_pointer, $result, $relative_base, 1);
                    $value_2 = $this->getValue($mode_2, $instruction_pointer, $result, $relative_base, 2);
                    if ($value_1 < $value_2) {
                        $result = $this->setValue($mode_3, $instruction_pointer, $result, $relative_base, 3, 1);
                    } else {
                        $result = $this->setValue($mode_3, $instruction_pointer, $result, $relative_base, 3, 0);
                    }
                    $instruction_pointer += 4;
                    break;
                case 8:
                    // Opcode 8 is equals: if the first parameter is equal to the second parameter, it stores 1 in the position given by the third parameter. Otherwise, it stores 0.
                    $value_1 = $this->getValue($mode_1, $instruction_pointer, $result, $relative_base, 1);
                    $value_2 = $this->getValue($mode_2, $instruction_pointer, $result, $relative_base, 2);
                    if ($value_1 === $value_2) {
                        $result = $this->setValue($mode_3, $instruction_pointer, $result, $relative_base, 3, 1);
                    } else {
                        $result = $this->setValue($mode_3, $instruction_pointer, $result, $relative_base, 3, 0);
                    }
                    $instruction_pointer += 4;
                    break;
                case 9:
                    // Opcode 9 adjusts the relative base by the value of its only parameter.
                    $relative_base += $this->getValue($mode_1, $instruction_pointer, $result, $relative_base, 1);

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
