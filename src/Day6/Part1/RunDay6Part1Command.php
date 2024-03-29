<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day6\Part1;

use gdejong\AdventOfCode\InputUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunDay6Part1Command extends Command
{
    protected static $defaultName = 'day6:part1';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $input = InputUtils::convertFileToStringArray(dirname(__DIR__) . DIRECTORY_SEPARATOR . "input.txt");

        $orbit_calculator = new OrbitCalculator();
        $result = $orbit_calculator->parse($input);

        $output->writeln($result);
        return 0;
    }
}
