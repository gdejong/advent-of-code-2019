<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day10\Part2;

use gdejong\AdventOfCode\InputUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunDay10Part2Command extends Command
{
    protected static $defaultName = 'day10:part2';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user_input = InputUtils::getFileContents(dirname(__DIR__) . DIRECTORY_SEPARATOR . "input.txt");

        $asteroid_map = new AsteroidMap($user_input);

        $result = $asteroid_map->find();

        [$x, $y] = $asteroid_map->getNthAsteroidToBeDestroyed($result["x"], $result["y"]);

        $answer = (100 * $x) + $y;

        $output->writeln($answer);
        // 3309 too high
        // 2704 too high
        // 11700 too high

        return 0;
    }
}
