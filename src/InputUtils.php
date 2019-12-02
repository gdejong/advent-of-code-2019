<?php
declare(strict_types=1);

namespace gdejong\AdventOfCode;

class InputUtils
{
    public static function convertFileToIntArray(string $filename, string $delimiter = PHP_EOL): array
    {
        $input = file_get_contents($filename);
        if ($input === false) {
            die("Failed to open input file: " . $filename);
        }

        $output = [];
        foreach (explode($delimiter, $input) as $line) {
            $output[] = (int)$line;
        }

        return $output;
    }
}
