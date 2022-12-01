<?php

use Illuminate\Support\Facades\Http;

$problemUrl = 'https://adventofcode.com/2022/day/1/input';
$sessionKey = $_ENV['SESSION_KEY'];

$response = Http::withOptions(['verify' => false])
    ->withCookies(['session' => $sessionKey], 'adventofcode.com')
    ->withUserAgent('Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36')
    ->get($problemUrl);

$input = $response->body();

// break up by new line character
$baseData = explode("\n", $input);

$matrix = [];
$lastRow = 0;

for ($i = 0; $i < count($baseData); $i++) {
    if ($baseData[$i] === '') {
        $matrix[] = array_slice($baseData, $lastRow, $i - $lastRow);
        $lastRow = $i + 1;
    }
}

$highestSum = 0;
foreach ($matrix as $m) {
    $sum = 0;
    foreach ($m as $n) {
        $sum += $n;
    }

    if ($sum > $highestSum) {
        $highestSum = $sum;
    }
}

dd("Highest sum is: {$highestSum}");
