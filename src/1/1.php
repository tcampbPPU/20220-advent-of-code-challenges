<?php

// Input
$input = file_get_contents(dirname(__FILE__) . '/data/input.txt');

// Solution
$collectionSum = collect(explode("\n\n", $input))
    ->map(fn($group) => collect(explode("\n", $group))
    ->sum(fn ($val) => (int) $val))
    ->max();

// Output
dd("Highest sum is: {$collectionSum}"); // 67633
