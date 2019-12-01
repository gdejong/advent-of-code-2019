<?php
declare(strict_types=1);

namespace gdejong\AdventOfCode;

class InputUtils
{
    public static function convertFileToIntArray(string $filename): array
    {
        $input = file_get_contents($filename);
        if ($input === false) {
            die("Failed to open input file: " . $filename);
        }

        $output = [];
        foreach (explode(PHP_EOL, $input) as $line) {
            $output[] = (int)$line;
        }

        return $output;
    }
}