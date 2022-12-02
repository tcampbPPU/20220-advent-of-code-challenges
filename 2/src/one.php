<?php

use Illuminate\Support\Facades\Http;

// ! SETUP
$problemUrl = 'https://adventofcode.com/2022/day/2/input';
$sessionKey = $_ENV['SESSION_KEY'];
$response = Http::withOptions(['verify' => false])
    ->withCookies(['session' => $sessionKey], 'adventofcode.com')
    ->withUserAgent('Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36')
    ->get($problemUrl);
$input = $response->body();

$data = collect(explode("\n", $input))
    ->map(function ($game, $i) {
        $str = str_replace(' ', '', $game);
        if ($str === '') {
            return 0;
        }
        $result = match ($str) {
            'AY','BZ','CX' => 6,
            'AZ','BX','CY' => 0,
            'AX','BY','CZ' => 3,
            default => 0
        };
        $play = match ($str[1]) {
            'X' => 1,
            'Y' => 2,
            'Z' => 3,
            default => 0
        };

        return $result + $play;
    })
    ->sum(fn ($val) => $val);

dd("Total score is: {$data}"); // 15422
