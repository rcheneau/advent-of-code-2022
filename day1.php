<?php

$input = file_get_contents('input/day1.txt');

$formatted = array_map(
    fn(string $v) => array_sum(explode("\n", $v)),
    explode("\n\n", $input)
);

echo "1st: " . max($formatted);

rsort($formatted);

echo "\nTop 3: " . $formatted[0] + $formatted[1] + $formatted[2];