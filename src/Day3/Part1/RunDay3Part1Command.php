<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day3\Part1;

use gdejong\AdventOfCode\InputUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunDay3Part1Command extends Command
{
    protected static $defaultName = 'day3:part1';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $puzzle_input = InputUtils::convertFileToStringArray(dirname(__DIR__) . DIRECTORY_SEPARATOR . "input.txt");

        var_dump($puzzle_input);
        return 0;
    }
}
