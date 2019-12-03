<?php

declare(strict_types=1);

namespace gdejong\AdventOfCode;

use UnexpectedValueException;

class InputUtils
{
    public static function convertFileToIntArray(string $filename, string $delimiter = PHP_EOL): array
    {
        $strings = self::convertFileToStringArray($filename, $delimiter);

        $output = [];
        foreach ($strings as $line) {
            if (!is_numeric($line)) {
                throw new UnexpectedValueException("Value " . $line . " is not numeric");
            }
            $output[] = (int)$line;
        }

        return $output;
    }

    public static function convertFileToStringArray(string $filename, string $delimiter = PHP_EOL): array
    {
        $input = file_get_contents($filename);
        if ($input === false) {
            die("Failed to open input file: " . $filename);
        }

        return explode($delimiter, $input);
    }
}
