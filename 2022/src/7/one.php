<?php

use Illuminate\Support\Str;

// Input
$input = file(dirname(__FILE__) . '/data/input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Solution
$dirs = [];
$maxAmount = 100000;
$pwd = '/';
foreach ($input as $line) {
    if ($line === '$ cd /' || $line === '$ ls') {
        continue;
    }
    if (Str::startsWith($line, '$ cd ')) {
        $dir = substr($line, 5);
        if ($dir === '..') {
            $pwd = (dirname($pwd) == '/') ? '/' : dirname($pwd) . '/';
        } else {
            $pwd .= $dir . '/';
        }

        continue;
    }

    [$size, $name] = explode(' ', $line);
    if (is_numeric($size)) {
        $file = $pwd . $name;
        while ($file != '/') {
            $file = (dirname($file) == '/') ? '/' : dirname($file) . '/';
            if (! isset($dirs[$file])) {
                $dirs[$file] = 0;
            }
            $dirs[$file] += $size;
        }
    }
}

$result = collect($dirs)->filter(fn ($dir) => $dir <= $maxAmount)->sum();

// Output
dd('Result: ' . $result); // 1297683
