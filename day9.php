<?php

function getNewHeadPosition(string $dir, array $currentPosition): array
{
    return [
        $dir === 'R' ? $currentPosition[0] + 1 : ($dir === 'L' ? $currentPosition[0] - 1 : $currentPosition[0]),
        $dir === 'U' ? $currentPosition[1] + 1 : ($dir === 'D' ? $currentPosition[1] - 1 : $currentPosition[1])
    ];
}

function getTailPositionFromHead(array $headPosition, array $tailPosition): array
{
    $xDiff = $headPosition[0] - $tailPosition[0];
    $yDiff = $headPosition[1] - $tailPosition[1];

    // same row or line
    if ($headPosition[0] === $tailPosition[0] || $headPosition[1] === $tailPosition[1]) {
        $x = match ($xDiff) {
            -2 => $tailPosition[0] - 1,
            2 => $tailPosition[0] + 1,
            default => $tailPosition[0]
        };
        $y = match ($yDiff) {
            -2 => $tailPosition[1] - 1,
            2 => $tailPosition[1] + 1,
            default => $tailPosition[1]
        };
    } else if(abs($xDiff) > 1 || abs($yDiff) > 1) { // Diagonal
        $x = match ($xDiff > 0) {
            true => $tailPosition[0] + 1,
            false => $tailPosition[0] - 1,
        };
        $y = match ($yDiff > 0) {
            true => $tailPosition[1] + 1,
            false => $tailPosition[1] - 1,
        };
    }

    return [$x ?? $tailPosition[0], $y ?? $tailPosition[1]];
}

$input = file_get_contents('input/day9.txt');
$instructions = array_map(fn(string $v) => explode(' ', $v), explode("\n", $input));

$headPosition = [0,0];
$tailPosition = [0,0];
$visitedTailPositions = ['0,0'];

$length = 10;
$snake = array_fill(0, $length, [0,0]);
$visitedSnakeTailPositions = ['0,0'];

foreach ($instructions as $instruction) {
    list($dir, $n) = $instruction;

    for($i = 0; $i < $n; $i++) {
        // Pt. 1
        $headPosition = getNewHeadPosition($dir, $headPosition);
        $tailPosition = getTailPositionFromHead($headPosition, $tailPosition);
        $s = "${tailPosition[0]},${tailPosition[1]}";
        if(!in_array($s, $visitedTailPositions)) {
            $visitedTailPositions[] = $s;
        }

        // Pt.2
        $snake[0] = getNewHeadPosition($dir, $snake[0]);
        for($j = 1; $j < $length; $j++) {
            $snake[$j] = getTailPositionFromHead($snake[$j-1], $snake[$j]);
        }
        $s2 = $snake[$length-1][0] . ',' . $snake[$length-1][1];
        if(!in_array($s2, $visitedSnakeTailPositions)) {
            $visitedSnakeTailPositions[] = $s2;
        }
    }
}

echo 'Nb pos: ' . count($visitedTailPositions) . "\n";
echo 'Nb pos snake: ' . count($visitedSnakeTailPositions);