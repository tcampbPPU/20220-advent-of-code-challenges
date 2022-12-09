<?php

use Illuminate\Support\Str;

// Input
$input = file(dirname(__FILE__) . '/data/input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Solution
$dirs = [];
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

$totalSpace = 30000000 - (70000000 - $dirs['/']);
$result = collect($dirs)->filter(fn ($dir) => $dir > $totalSpace)->sort()->first();

// Output
dd('Result: ' . $result);
