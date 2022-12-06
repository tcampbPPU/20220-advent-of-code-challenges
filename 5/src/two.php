<?php

$input = file_get_contents(
    '/home/tanner/code/tanner/2022-advent-of-code-challenges/5/src/input.txt'
);

$data = [];

[$crates, $moves] = explode("\n\n", $input);

$crateLines = array_reverse(array_slice(explode("\n", $crates), 0, -1));

collect($crateLines)->map(function ($crateLine) use (&$data) {
    $idx = 0;
    $craneIdx = 0;
    while ($idx < strlen($crateLine)) {
        if (count($data) <= $craneIdx) {
            $data[$craneIdx] = [];
        }
        if ($crateLine[$idx] === '[') {
            $char = $crateLine[$idx + 1];
            $data[$craneIdx][] = $char;
        }
        $idx += 4; // [_] + whitespace
        $craneIdx += 1;
    }
});

collect(explode("\n", $moves))->map(function ($move, $i) use (&$data) {
    $instruction = explode(' ', $move);
    $amount = $instruction[1];
    $from = $instruction[3] - 1;
    $to = $instruction[5] - 1;

    // multiple cranes can move at the same time
    $cratesToMove = array_splice($data[$from], -$amount);

    $data[$to] = array_merge($data[$to], $cratesToMove);
});

$output = '';
foreach ($data as $crane) {
    $output .= array_pop($crane);
}
dd("The output is: {$output}");