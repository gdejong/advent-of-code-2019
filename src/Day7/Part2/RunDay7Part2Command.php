<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day7\Part2;

use gdejong\AdventOfCode\InputUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunDay7Part2Command extends Command
{
    protected static $defaultName = 'day7:part2';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user_input = InputUtils::convertFileToIntArray(dirname(__DIR__) . DIRECTORY_SEPARATOR . "input.txt", ",");

        $min = 5;
        $max = 10;
        // Generate all possible phase settings
        $phase_settings = [];
        for ($i = $min; $i < $max; $i++) {
            for ($j = $min; $j < $max; $j++) {
                for ($k = $min; $k < $max; $k++) {
                    for ($l = $min; $l < $max; $l++) {
                        for ($m = $min; $m < $max; $m++) {
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
            $output_signals[] = Intcode::runPhase($user_input, $phase, 5);
        }

        $output->writeln("Largest output signal that can be sent to the thrusters: " . max($output_signals));

        return 0;
    }
}
