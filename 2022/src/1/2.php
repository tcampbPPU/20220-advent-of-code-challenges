<?php

// Input
$input = file_get_contents(dirname(__FILE__) . '/data/input.txt');

// Solution
$collectionMaxThreeSum = collect(explode("\n\n", $input))
    ->map(fn($group) => collect(explode("\n", $group))
    ->sum(fn ($val) => (int) $val))
    ->sortDesc()
    ->take(3)
    ->sum();

// Output
dd("Top 3 total is : {$collectionSum}"); // 199628
