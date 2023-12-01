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

        if ($two[0] >= $one[0] && $two[0] <= end($one) && end($two) <= end($one)) {
            return 1;
        }

        if ($one[0] >= $two[0] && $one[0] <= end($one) && end($one) <= end($two)) {
            return 1;
        }
    })
    ->sum(fn ($val) => $val);

// Output
dd("Total score is: {$data}"); // 542
