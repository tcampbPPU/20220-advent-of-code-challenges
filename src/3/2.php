<?php

use Illuminate\Support\Facades\Http;

// Input
$input = file_get_contents(dirname(__FILE__) . '/data/input.txt');

// Solution
$data = collect($input)
    ->chunk(3)
    ->map(function ($chunk) {
        $matches = [];
        foreach ($chunk as $string) {
            $matches[] = str_split($string);
        }
        $matches = array_intersect(...$matches);
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
dd("Total score is: {$data}"); // 2497

