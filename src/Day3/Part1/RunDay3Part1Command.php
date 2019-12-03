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
        $intersection_finder = new IntersectionFinder();

        $puzzle_input = InputUtils::convertFileToStringArray(dirname(__DIR__) . DIRECTORY_SEPARATOR . "input.txt");

        if (count($puzzle_input) !== 2) {
            throw new \RuntimeException("Invalid input, must be two lines of text");
        }

        $result = $intersection_finder->find($puzzle_input[0], $puzzle_input[1]);

        $output->writeln("Manhattan distance from the central port to the closest intersection: " . $result);
        return 0;
    }
}
