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

        $play = match ($str[1]) {
            'X' => 0,
            'Y' => 3,
            'Z' => 6,
        };

        $result = match ($str) {
            'BX','AY','CZ' => 1,
            'AZ','BY','CX' => 2,
            'AX','CY','BZ' => 3,
        };

        return $result + $play;
    })
    ->sum(fn ($val) => $val);

// Output
dd("Total score is: {$data}"); // 15442
