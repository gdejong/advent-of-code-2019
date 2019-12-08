<?php
declare(strict_types=1);

namespace gdejong\AdventOfCode\Day8\Part2;

class RoverPassword
{
    private const BLACK = 0;
    private const WHITE = 1;
    private const TRANSPARENT = 2;

    public function stackLayers(array $layers): array
    {
        $output = [];
        $reverse = array_reverse($layers);
        foreach ($reverse as $layer_id => $layer) {
            foreach ($layer as $row_id => $row) {
                foreach ($row as $item_id => $item) {
                    if (isset($output[$row_id][$item_id])) {
                        if ((int)$item !== self::TRANSPARENT) {
                            $output[$row_id][$item_id] = (int)$item;
                        }
                    } else {
                        $output[$row_id][$item_id] = (int)$item;
                    }
                }
            }
        }

        return $output;
    }

    public function render(array $stacked, string $white = "1", string $black = "0", string $transparent = ""): string
    {
        $out = "";

        foreach ($stacked as $index => $row) {
            foreach ($row as $item) {
                switch ((int)$item) {
                    case self::BLACK:
                        $out .= $black;
                        break;
                    case self::WHITE:
                        $out .= $white;
                        break;
                    default:
                        $out .= $transparent;
                }
            }
            $out .= PHP_EOL;
        }

        return trim($out, PHP_EOL);
    }

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