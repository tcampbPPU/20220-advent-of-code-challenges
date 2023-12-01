<?php

// Input
$input = file_get_contents(dirname(__FILE__) . '/data/input.txt');

// Solution
$data = collect(explode("\n", $input))
    ->map(function ($game, $i) {
        $str = str_replace(' ', '', $game);
        if ($str === '') {
            return 0;
        }
        $result = match ($str) {
            'AY','BZ','CX' => 6,
            'AZ','BX','CY' => 0,
            'AX','BY','CZ' => 3,
            default => 0
        };
        $play = match ($str[1]) {
            'X' => 1,
            'Y' => 2,
            'Z' => 3,
            default => 0
        };

        return $result + $play;
    })
    ->sum(fn ($val) => $val);

// Output
dd("Total score is: {$data}"); // 15422
