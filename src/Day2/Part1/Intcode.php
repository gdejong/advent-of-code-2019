<?php
declare(strict_types=1);

namespace gdejong\AdventOfCode\Day2\Part1;


use RuntimeException;

class Intcode
{
    public function run(array $input): array
    {
        $output = $input;
        $current_position = 0;
        while (true) {
            switch ($output[$current_position]) {
                case 1:
                    $value_1 = $output[$output[$current_position + 1]];
                    $value_2 = $output[$output[$current_position + 2]];
                    $value_to_set = $value_1 + $value_2;

                    $override_spot = $output[$current_position + 3];
                    $output[$override_spot] = $value_to_set;
                    break;
                case 2:
                    $value_1 = $output[$output[$current_position + 1]];
                    $value_2 = $output[$output[$current_position + 2]];
                    $value_to_set = $value_1 * $value_2;

                    $override_spot = $output[$current_position + 3];
                    $output[$override_spot] = $value_to_set;
                    break;
                case 99:
                    return $output;
                default:
                    throw new RuntimeException("Unexpected intcode " . $output[$current_position]);
            }
            $current_position += 4;
        }

        throw new RuntimeException("Should not get here");
    }
}
