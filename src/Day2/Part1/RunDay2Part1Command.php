<?php
declare(strict_types=1);

namespace gdejong\AdventOfCode\Day2\Part1;

use gdejong\AdventOfCode\InputUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunDay2Part1Command extends Command
{
    protected static $defaultName = 'day2:part1';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user_input = InputUtils::convertFileToIntArray(dirname(__DIR__) . DIRECTORY_SEPARATOR . "input.txt", ",");

        // before running the program, replace position 1 with the value 12 and replace position 2 with the value 2.
        $user_input[1] = 12;
        $user_input[2] = 2;

        $intcode = new Intcode();
        $result = $intcode->run($user_input);

        // What value is left at position 0 after the program halts?
        $output->writeln($result[0]);
        return 0;
    }
}
