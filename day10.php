<?php

function isShown(int $x, int $cycle): bool
{
    return $x-1 <= $cycle && $x+1 >= $cycle;
}

function getSignalStrength(int $x, int $cycle): int
{
    return ($cycle + 20) % 40 === 0 ? $cycle * $x : 0;
}

function doCycleActions(int $x, int &$cycle, int &$sumSignalStrength):void
{
    echo isShown($x, $cycle % 40) ? '#' : '.';
    $cycle += 1;
    $sumSignalStrength += getSignalStrength($x, $cycle);
    echo $cycle % 40 === 0 ? "\n" : '';
}

$input = file_get_contents('input/day10.txt');
$instructions = explode("\n", $input);

$cycle = 0;
$x = 1;
$sumSignalStrength = 0;

foreach ($instructions as $instruction) {
    $c = explode(' ', $instruction);

    doCycleActions($x, $cycle, $sumSignalStrength);
    if ($c[0] === 'noop') {
        continue;
    }
    doCycleActions($x, $cycle, $sumSignalStrength);
    $x += (int)$c[1];
}

echo "\nSum signals: $sumSignalStrength";