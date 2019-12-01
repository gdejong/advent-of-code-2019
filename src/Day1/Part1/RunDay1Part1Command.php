<?php
declare(strict_types=1);

namespace gdejong\AdventOfCode\Day1\Part1;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunDay1Part1Command extends Command
{
    protected static $defaultName = 'day1:part1';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $calculator = new FuelCalculator();
        $input = file_get_contents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "input.txt");
        if ($input === false) {
            die("Failed to open input file!");
        }
        $lines = explode(PHP_EOL, $input);

        $fuel = $calculator->calculateFromInput($lines);

        $output->writeln("Fuel needed: " . $fuel);
        return 0;
    }
}