<?php

// Input
$input = file_get_contents(dirname(__FILE__) . '/data/input.txt');

// Solution
$data = collect($input)
    ->map(function ($list) {
        [$one, $two] = explode(',', $list);
        $one = explode('-', $one);
        $one = range($one[0], $one[1]);
        $two = explode('-', $two);
        $two = range($two[0], $two[1]);

        $matches = array_intersect($one, $two);

        return count($matches) > 0;
    })
    ->sum(fn ($val) => $val);

// Output
dd("Total score is: {$data}"); // 900
