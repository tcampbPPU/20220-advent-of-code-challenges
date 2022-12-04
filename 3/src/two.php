<?php

use Illuminate\Support\Facades\Http;

// ! SETUP
$problemUrl = 'https://adventofcode.com/2022/day/3/input';
$sessionKey = $_ENV['SESSION_KEY'];
$response = Http::withOptions(['verify' => false])
    ->withCookies(['session' => $sessionKey], 'adventofcode.com')
    ->withUserAgent('Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36')
    ->get($problemUrl);
$input = $response->body();
$input = explode("\n", $input);
$input = array_filter($input, fn($line) => $line !== '');

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

dd("Total score is: {$data}"); // 2497

