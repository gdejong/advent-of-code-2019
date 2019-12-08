<?php
declare(strict_types=1);

namespace gdejong\AdventOfCode\Day8\Part1;

class RoverPassword
{
    public function getLayers(string $input, int $width, int $height): array
    {
        $chars = str_split($input, 1);
        $layers = [];
        $layer = 1;
        $row = 0;
        foreach ($chars as $index => $char) {
            if ($index > 0 && $index % $width === 0) {
                $row++;
            }
            if ($row === $height) {
                $row = 0;
                $layer++;
            }
            $layers[$layer][$row][] = $char;
        }
        return $layers;
    }

    public function getLayerWithFewestDigits(array $layers, int $digit): array
    {
        $per_layer = [];
        foreach ($layers as $index => $layer) {
            $per_layer[$index] = $this->countDigitsInLayer($layer, $digit);
        }
        $layer_id = array_keys($per_layer, min($per_layer))[0];

        return $layers[$layer_id];
    }

    public function countDigitsInLayer(array $layer, int $digit): int
    {
        $c = 0;
        foreach ($layer as $row) {
            foreach ($row as $item) {
                if ((int)$item === $digit) {
                    $c++;
                }
            }
        }
        return $c;
    }
}