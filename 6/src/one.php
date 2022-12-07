<?php

$input = file_get_contents(dirname(__FILE__) . '/input.txt');
$windowSize = 4;

$result = collect(str_split($input))
    ->map(function ($char, $idx) use ($input, $windowSize) {
        if ($idx === strlen($input) - 1) {
            return null;
        }
        return array_slice(str_split($input), $idx, $windowSize);
    })
    ->filter()
    ->filter(fn ($window) => count(array_unique($window)) === $windowSize)
    ->take(1)
    ->keys()
    ->first() + $windowSize;

dd("The position of first char is: {$result}"); // 1134

