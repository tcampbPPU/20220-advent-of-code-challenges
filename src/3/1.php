<?php

// Input
$input = file_get_contents(dirname(__FILE__) . '/data/input.txt');

// Solution
$data = collect(explode("\n", $input))
    ->map(function ($pack) {
        if ($pack === '') {
            return;
        }
        [$one, $two] = str_split($pack, strlen($pack) / 2);
        $matches = preg_grep("/[$one]/", str_split($two));
        $char = collect($matches)->first();

        $score = 0;
        if (preg_match('/[a-z]/', $char)) {
            $score = ord($char) - 96;
        } elseif (preg_match('/[A-Z]/', $char)) {
            $score = ord($char) - 38;
        }

        return $score;
    })
        ->sum(fn ($val) => $val);

// Output
dd("Total score is: {$data}"); // 7872
