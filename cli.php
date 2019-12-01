<?php
declare(strict_types=1);

require_once __DIR__ . DIRECTORY_SEPARATOR . "vendor/autoload.php";

use gdejong\AdventOfCode\Day1\Part1\RunDay1Part1Command;
use gdejong\AdventOfCode\Day1\Part2\RunDay1Part2Command;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new RunDay1Part1Command());
$application->add(new RunDay1Part2Command());

$application->run();