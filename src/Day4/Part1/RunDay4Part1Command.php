<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day4\Part1;

use gdejong\AdventOfCode\InputUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunDay4Part1Command extends Command
{
    protected static $defaultName = 'day4:part1';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $puzzle_input = InputUtils::convertFileToStringArray(dirname(__DIR__) . DIRECTORY_SEPARATOR . "input.txt")[0];

        [$low, $high] = explode("-", $puzzle_input);

        $p = new Password();
        $count = 0;
        for ($i = (int)$low; $i < (int)$high; $i++) {
            if ($p->isAMatch((string)$i)) {
                $count++;
            }
        }

        $output->writeln("Different passwords within the range given: " . $count);
        return 0;
    }
}
