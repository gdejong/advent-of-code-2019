<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode\Day8\Part1;

use gdejong\AdventOfCode\InputUtils;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunDay8Part1Command extends Command
{
    protected static $defaultName = 'day8:part1';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user_input = InputUtils::convertFileToStringArray(dirname(__DIR__) . DIRECTORY_SEPARATOR . "input.txt", ",");
        $encoded_password = $user_input[0];

        $decoder = new RoverPassword();
        $layers = $decoder->getLayers($encoded_password, 25, 6);

        $layer_with_fewest_0 = $decoder->getLayerWithFewestDigits($layers, 0);

        $ones = $decoder->countDigitsInLayer($layer_with_fewest_0, 1);
        $twos = $decoder->countDigitsInLayer($layer_with_fewest_0, 2);

        $answer = $ones * $twos;

        $output->writeln($answer);

        return 0;
    }
}
