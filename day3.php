<?php

$input = file_get_contents('input/day3.txt');
$lines = explode("\n", $input);

$sacks = array_map(fn(string $v) => str_split($v, strlen($v) / 2), $lines);

$totalPriority = 0;
foreach ($sacks as $sack) {
    $letter = array_values(array_intersect(str_split($sack[0]), str_split($sack[1])))[0];
    $totalPriority += ord($letter) - (ctype_upper($letter) ? 38 : 96);
}

echo "$totalPriority\n";

// Part two
$totalPriority2 = 0;
foreach ($lines as $i => $line) {
    if (($i+1) % 3 === 0) {
        $letter = array_values(array_intersect(str_split($lines[$i - 2]), str_split($lines[$i - 1]), str_split($line)))[0];
        $totalPriority2 += ord($letter) - (ctype_upper($letter) ? 38 : 96);
    }
}
echo "$totalPriority2\n";