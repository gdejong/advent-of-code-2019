<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day8\Part2;

use gdejong\AdventOfCode\InputUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunDay8Part2Command extends Command
{
    protected static $defaultName = 'day8:part2';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user_input = InputUtils::convertFileToStringArray(dirname(__DIR__) . DIRECTORY_SEPARATOR . "input.txt", ",");
        $encoded_password = $user_input[0];
        $decoder = new RoverPassword();

        $layers = $decoder->getLayers($encoded_password, 25, 6);
        $stacked = $decoder->stackLayers($layers);
        $output->write($decoder->render($stacked, "| ", "  ", "  "));
        return 0;
    }
}
