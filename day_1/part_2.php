<?php

$input = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "input_1.txt");

$lines = explode(PHP_EOL, $input);

$fuel = 0;
foreach ($lines as $line) {
    $input = $line;
    while (($input = calculate($input)) > 0) {
        $fuel += $input;
    }
}

function calculate(int $mass)
{
    return floor($mass / 3) - 2;
}

echo $fuel . PHP_EOL;