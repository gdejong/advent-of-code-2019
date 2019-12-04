<?php

declare(strict_types=1);

require_once __DIR__ . DIRECTORY_SEPARATOR . "vendor/autoload.php";

use gdejong\AdventOfCode\Day1\Part1\RunDay1Part1Command;
use gdejong\AdventOfCode\Day1\Part2\RunDay1Part2Command;
use gdejong\AdventOfCode\Day2\Part1\RunDay2Part1Command;
use gdejong\AdventOfCode\Day2\Part2\RunDay2Part2Command;
use gdejong\AdventOfCode\Day3\Part1\RunDay3Part1Command;
use gdejong\AdventOfCode\Day3\Part2\RunDay3Part2Command;
use gdejong\AdventOfCode\Day4\Part1\RunDay4Part1Command;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new RunDay1Part1Command());
$application->add(new RunDay1Part2Command());
$application->add(new RunDay2Part1Command());
$application->add(new RunDay2Part2Command());
$application->add(new RunDay3Part1Command());
$application->add(new RunDay3Part2Command());
$application->add(new RunDay4Part1Command());

$application->run();
