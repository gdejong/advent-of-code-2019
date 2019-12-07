<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day7\Part1;

use gdejong\AdventOfCode\InputUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunDay7Part1Command extends Command
{
    protected static $defaultName = 'day7:part1';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user_input = InputUtils::convertFileToIntArray(dirname(__DIR__) . DIRECTORY_SEPARATOR . "input.txt", ",");

        // Generate all possible phase settings
        $phase_settings = [];
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                for ($k = 0; $k < 5; $k++) {
                    for ($l = 0; $l < 5; $l++) {
                        for ($m = 0; $m < 5; $m++) {
                            if (count(array_unique([$i, $j, $k, $l, $m])) === 5) {
                                $phase_settings[] = [$i, $j, $k, $l, $m];
                            }
                        }
                    }
                }
            }
        }

        $output_signals = [];
        foreach ($phase_settings as $phase) {
            $amplifier_input_value = 0;
            for ($amplifiers = 0; $amplifiers < 5; $amplifiers++) {
                $intcode = new Intcode();
                $amplifier_input_value = $intcode->run($user_input, $phase[$amplifiers], $amplifier_input_value);
            }
            $output_signals[] = $amplifier_input_value;
        }

        $output->writeln("Largest output signal that can be sent to the thrusters: " . max($output_signals));

        return 0;
    }
}
