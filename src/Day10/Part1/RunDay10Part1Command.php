<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day10\Part1;

use gdejong\AdventOfCode\InputUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunDay10Part1Command extends Command
{
    protected static $defaultName = 'day10:part1';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user_input = InputUtils::convertFileToStringArray(dirname(__DIR__) . DIRECTORY_SEPARATOR . "input.txt")[0];

        $asteroid_map = new AsteroidMap($user_input);

        $result = $asteroid_map->find();

        $output->writeln($result);
        return 0;
    }
}
