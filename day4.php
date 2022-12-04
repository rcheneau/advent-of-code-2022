<?php

function fullyOverlap(array $a, array $b): bool {
    return $a[0] >= $b[0] && $a[1] <= $b[1] || $b[0] >= $a[0] && $b[1] <= $a[1];
}

function overlap(array $a, array $b): bool {
    $itv = [$a, $b];
    usort($itv, fn(array $v) => $a[0] > $b[0] ? 1 : -1);
    return $itv[0][1] >= $itv[1][0];
}

$input = file_get_contents('input/day4.txt');
$lines = explode("\n", $input);

$nbFullyContain = 0;
$nbOverlap = 0;
foreach ($lines as $line) {
    list($a, $b) = explode(',', $line);
    $i1 = explode('-', $a);
    $i2 = explode('-', $b);

    $nbFullyContain += fullyOverlap($i1, $i2) ? 1 : 0;
    $nbOverlap += overlap($i1, $i2) ? 1 : 0;
}

echo "Fully contain: $nbFullyContain\n";
echo "Overlap: $nbOverlap";