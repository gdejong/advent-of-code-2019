<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day2\Part2;

use gdejong\AdventOfCode\Day2\Part1\Intcode;
use gdejong\AdventOfCode\InputUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunDay2Part2Command extends Command
{
    private const MAGIC_NUMBER = 19690720;
    protected static $defaultName = 'day2:part2';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user_input = InputUtils::convertFileToIntArray(dirname(__DIR__) . DIRECTORY_SEPARATOR . "input.txt", ",");

        $initial_state = $user_input;

        $intcode = new Intcode();
        for ($noun = 0; $noun <= 99; $noun++) {
            for ($verb = 0; $verb <= 99; $verb++) {
                // reset the computer's memory to the values in the program
                $user_input = $initial_state;

                $user_input[1] = $noun;
                $user_input[2] = $verb;
                $result = $intcode->run($user_input);
                if ($result[0] === self::MAGIC_NUMBER) {
                    $output->writeln("Found it!");
                    $output->writeln("Noun: " . $noun);
                    $output->writeln("Verb: " . $verb);
                    $output->writeln("Answer: " . (100 * $noun + $verb));
                    return 0;
                }
            }
        }

        $output->writeln("Failed to determine proper noun/verb combination!");

        return 1;
    }
}
