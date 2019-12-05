<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day5\Part2;

use gdejong\AdventOfCode\InputUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunDay5Part2Command extends Command
{
    protected static $defaultName = 'day5:part2';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user_input = InputUtils::convertFileToIntArray(dirname(__DIR__) . DIRECTORY_SEPARATOR . "input.txt", ",");

        $intcode = new Intcode();
        $result = $intcode->run($user_input, 5);

        $output->writeln($result);
        return 0;
    }
}
