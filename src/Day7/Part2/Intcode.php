<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day7\Part2;

use RuntimeException;

class Intcode
{
    private const MODE_POSITION = 0;
    private const MODE_IMMEDIATE = 1;

    private const HALT = PHP_INT_MAX;

    private array $memory = [];
    private array $inputs = [];
    private int $instruction_pointer = 0;
    private int $input_pointer = 0;

    public function __construct(array $program)
    {
        $this->memory = $program;
    }

    public static function runPhase(array $program, array $phases, $number_of_amplifiers)
    {
        /** @var self[] $amps */
        $amps = [];
        for ($amplifiers = 0; $amplifiers < $number_of_amplifiers; $amplifiers++) {
            $amps[$amplifiers] = new self($program);
        }

        $gave_input = [];
        $amplifier_input_value = 0;
        $last_values = [];

        while (true) {
            for ($amplifiers = 0; $amplifiers < $number_of_amplifiers; $amplifiers++) {
                if (isset($gave_input[$amplifiers])) {
                    $input = [$amplifier_input_value];
                } else {
                    $input = [$phases[$amplifiers], $amplifier_input_value];
                }
                $amplifier_input_value = $amps[$amplifiers]->run($input);
                if ($amplifier_input_value !== self::HALT) {
                    // Store the last outputted value
                    $last_values[$amplifiers] = $amplifier_input_value;
                }
                $gave_input[$amplifiers] = 1;
                if ($amplifiers === $number_of_amplifiers - 1 && $amplifier_input_value === self::HALT) {
                    return $last_values[$amplifiers];
                }
            }
        }

        throw new RuntimeException("No answer found");
    }

    public function run(array $inputs): int
    {
        $this->inputs = array_merge($this->inputs, $inputs);

        while (true) {
            $mode_1 = isset(((string)$this->memory[$this->instruction_pointer])[-3]) ? (int)((string)($this->memory[$this->instruction_pointer]))[-3] : 0;  //hundreds digit
            if ($mode_1 !== self::MODE_POSITION && $mode_1 !== self::MODE_IMMEDIATE) {
                throw new RuntimeException("Unexpected parameter mode for first parameter" . $mode_1);
            }
            $mode_2 = isset(((string)$this->memory[$this->instruction_pointer])[-4]) ? (int)((string)($this->memory[$this->instruction_pointer]))[-4] : 0;  //thousands digit
            if ($mode_2 !== self::MODE_POSITION && $mode_2 !== self::MODE_IMMEDIATE) {
                throw new RuntimeException("Unexpected parameter mode for second parameter" . $mode_2);
            }
            $mode_3 = isset(((string)$this->memory[$this->instruction_pointer])[-5]) ? (int)((string)($this->memory[$this->instruction_pointer]))[-5] : 0;  //ten-thousands digit
            if ($mode_3 !== self::MODE_POSITION && $mode_3 !== self::MODE_IMMEDIATE) {
                throw new RuntimeException("Unexpected parameter mode for third parameter" . $mode_3);
            }

            // % 100 to get the rightmost two digits
            switch ($this->memory[$this->instruction_pointer] % 100) {
                case 1:
                    $value_1 = $mode_1 === self::MODE_POSITION ? $this->memory[$this->memory[$this->instruction_pointer + 1]] : $this->memory[$this->instruction_pointer + 1];
                    $value_2 = $mode_2 === self::MODE_POSITION ? $this->memory[$this->memory[$this->instruction_pointer + 2]] : $this->memory[$this->instruction_pointer + 2];
                    $value_to_set = $value_1 + $value_2;

                    if ($mode_3 === self::MODE_POSITION) {
                        $this->memory[$this->memory[$this->instruction_pointer + 3]] = $value_to_set;
                    } else {
                        $this->memory[$this->instruction_pointer + 3] = $value_to_set;
                    }

                    $this->instruction_pointer += 4;
                    break;
                case 2:
                    $value_1 = $mode_1 === self::MODE_POSITION ? $this->memory[$this->memory[$this->instruction_pointer + 1]] : $this->memory[$this->instruction_pointer + 1];
                    $value_2 = $mode_2 === self::MODE_POSITION ? $this->memory[$this->memory[$this->instruction_pointer + 2]] : $this->memory[$this->instruction_pointer + 2];
                    $value_to_set = $value_1 * $value_2;

                    if ($mode_3 === self::MODE_POSITION) {
                        $this->memory[$this->memory[$this->instruction_pointer + 3]] = $value_to_set;
                    } else {
                        $this->memory[$this->instruction_pointer + 3] = $value_to_set;
                    }

                    $this->instruction_pointer += 4;
                    break;
                case 3:
                    // Opcode 3 takes a single integer as input and saves it to the position given by its only parameter.
                    // For example, the instruction 3,50 would take an input value and store it at address 50.
                    if ($mode_1 === self::MODE_POSITION) {
                        $this->memory[$this->memory[$this->instruction_pointer + 1]] = $this->inputs[$this->input_pointer];
                    } else {
                        $this->memory[$this->instruction_pointer + 1] = $this->inputs[$this->input_pointer];
                    }

                    $this->instruction_pointer += 2;
                    $this->input_pointer++;
                    break;
                case 4:
                    // Opcode 4 outputs the value of its only parameter. For example, the instruction 4,50 would output
                    // the value at address 50.
                    if ($mode_1 === self::MODE_POSITION) {
                        $return = $this->memory[$this->memory[$this->instruction_pointer + 1]];
                    } else {
                        $return = $this->memory[$this->instruction_pointer + 1];
                    }

                    $this->instruction_pointer += 2;
                    return $return;
                    break;
                case 5:
                    // Opcode 5 is jump-if-true: if the first parameter is non-zero, it sets the instruction pointer to the value from the second parameter. Otherwise, it does nothing.
                    $value_1 = $mode_1 === self::MODE_POSITION ? $this->memory[$this->memory[$this->instruction_pointer + 1]] : $this->memory[$this->instruction_pointer + 1];
                    $value_2 = $mode_2 === self::MODE_POSITION ? $this->memory[$this->memory[$this->instruction_pointer + 2]] : $this->memory[$this->instruction_pointer + 2];
                    if ($value_1 !== 0) {
                        $this->instruction_pointer = $value_2;
                    } else {
                        $this->instruction_pointer += 3;
                    }
                    break;
                case 6:
                    // Opcode 6 is jump-if-false: if the first parameter is zero, it sets the instruction pointer to the value from the second parameter. Otherwise, it does nothing.
                    $value_1 = $mode_1 === self::MODE_POSITION ? $this->memory[$this->memory[$this->instruction_pointer + 1]] : $this->memory[$this->instruction_pointer + 1];
                    $value_2 = $mode_2 === self::MODE_POSITION ? $this->memory[$this->memory[$this->instruction_pointer + 2]] : $this->memory[$this->instruction_pointer + 2];
                    if ($value_1 === 0) {
                        $this->instruction_pointer = $value_2;
                    } else {
                        $this->instruction_pointer += 3;
                    }
                    break;
                case 7:
                    // Opcode 7 is less than: if the first parameter is less than the second parameter, it stores 1 in the position given by the third parameter. Otherwise, it stores 0.
                    $value_1 = $mode_1 === self::MODE_POSITION ? $this->memory[$this->memory[$this->instruction_pointer + 1]] : $this->memory[$this->instruction_pointer + 1];
                    $value_2 = $mode_2 === self::MODE_POSITION ? $this->memory[$this->memory[$this->instruction_pointer + 2]] : $this->memory[$this->instruction_pointer + 2];
                    if ($value_1 < $value_2) {
                        if ($mode_3 === self::MODE_POSITION) {
                            $this->memory[$this->memory[$this->instruction_pointer + 3]] = 1;
                        } else {
                            $this->memory[$this->instruction_pointer + 3] = 1;
                        }
                    } else {
                        if ($mode_3 === self::MODE_POSITION) {
                            $this->memory[$this->memory[$this->instruction_pointer + 3]] = 0;
                        } else {
                            $this->memory[$this->instruction_pointer + 3] = 0;
                        }
                    }
                    $this->instruction_pointer += 4;
                    break;
                case 8:
                    // Opcode 8 is equals: if the first parameter is equal to the second parameter, it stores 1 in the position given by the third parameter. Otherwise, it stores 0.
                    $value_1 = $mode_1 === self::MODE_POSITION ? $this->memory[$this->memory[$this->instruction_pointer + 1]] : $this->memory[$this->instruction_pointer + 1];
                    $value_2 = $mode_2 === self::MODE_POSITION ? $this->memory[$this->memory[$this->instruction_pointer + 2]] : $this->memory[$this->instruction_pointer + 2];
                    if ($value_1 === $value_2) {
                        if ($mode_3 === self::MODE_POSITION) {
                            $this->memory[$this->memory[$this->instruction_pointer + 3]] = 1;
                        } else {
                            $this->memory[$this->instruction_pointer + 3] = 1;
                        }
                    } else {
                        if ($mode_3 === self::MODE_POSITION) {
                            $this->memory[$this->memory[$this->instruction_pointer + 3]] = 0;
                        } else {
                            $this->memory[$this->instruction_pointer + 3] = 0;
                        }
                    }
                    $this->instruction_pointer += 4;
                    break;
                case 99:
                    return self::HALT;
                default:
                    throw new RuntimeException("Unexpected intcode " . $this->memory[$this->instruction_pointer]);
            }
        }

        throw new RuntimeException("Should not get here");
    }
}
