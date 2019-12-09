<?php

declare(strict_types=1);

require_once __DIR__ . DIRECTORY_SEPARATOR . "vendor/autoload.php";

use gdejong\AdventOfCode\Day1\Part1\RunDay1Part1Command;
use gdejong\AdventOfCode\Day1\Part2\RunDay1Part2Command;
use gdejong\AdventOfCode\Day10\Part1\RunDay10Part1Command;
use gdejong\AdventOfCode\Day10\Part2\RunDay10Part2Command;
use gdejong\AdventOfCode\Day11\Part1\RunDay11Part1Command;
use gdejong\AdventOfCode\Day11\Part2\RunDay11Part2Command;
use gdejong\AdventOfCode\Day12\Part1\RunDay12Part1Command;
use gdejong\AdventOfCode\Day12\Part2\RunDay12Part2Command;
use gdejong\AdventOfCode\Day2\Part1\RunDay2Part1Command;
use gdejong\AdventOfCode\Day2\Part2\RunDay2Part2Command;
use gdejong\AdventOfCode\Day3\Part1\RunDay3Part1Command;
use gdejong\AdventOfCode\Day3\Part2\RunDay3Part2Command;
use gdejong\AdventOfCode\Day4\Part1\RunDay4Part1Command;
use gdejong\AdventOfCode\Day4\Part2\RunDay4Part2Command;
use gdejong\AdventOfCode\Day5\Part1\RunDay5Part1Command;
use gdejong\AdventOfCode\Day5\Part2\RunDay5Part2Command;
use gdejong\AdventOfCode\Day6\Part1\RunDay6Part1Command;
use gdejong\AdventOfCode\Day6\Part2\RunDay6Part2Command;
use gdejong\AdventOfCode\Day7\Part1\RunDay7Part1Command;
use gdejong\AdventOfCode\Day7\Part2\RunDay7Part2Command;
use gdejong\AdventOfCode\Day8\Part1\RunDay8Part1Command;
use gdejong\AdventOfCode\Day8\Part2\RunDay8Part2Command;
use gdejong\AdventOfCode\Day9\Part1\RunDay9Part1Command;
use gdejong\AdventOfCode\Day9\Part2\RunDay9Part2Command;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new RunDay1Part1Command());
$application->add(new RunDay1Part2Command());
$application->add(new RunDay2Part1Command());
$application->add(new RunDay2Part2Command());
$application->add(new RunDay3Part1Command());
$application->add(new RunDay3Part2Command());
$application->add(new RunDay4Part1Command());
$application->add(new RunDay4Part2Command());
$application->add(new RunDay5Part1Command());
$application->add(new RunDay5Part2Command());
$application->add(new RunDay6Part1Command());
$application->add(new RunDay6Part2Command());
$application->add(new RunDay7Part1Command());
$application->add(new RunDay7Part2Command());
$application->add(new RunDay8Part1Command());
$application->add(new RunDay8Part2Command());
$application->add(new RunDay9Part1Command());
$application->add(new RunDay9Part2Command());
$application->add(new RunDay10Part1Command());
$application->add(new RunDay10Part2Command());
$application->add(new RunDay11Part1Command());
$application->add(new RunDay11Part2Command());
$application->add(new RunDay12Part1Command());
$application->add(new RunDay12Part2Command());

$application->run();
