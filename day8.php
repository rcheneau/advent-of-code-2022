<?php

function idxVisibleFromLeft(array $map, int $x, int $y): int
{
    if ($x === 0) {
        return $x;
    }
    $current = $map[$y][$x];
    for ($i = $x-1; $i >= 0; $i--) {
        if ($map[$y][$i] >= $current) {
            return $i+1;
        }
    }
    return 0;
}

function idxVisibleFromTop(array $map, int $x, int $y): int
{
    if ($y === 0) {
        return $y;
    }
    $current = $map[$y][$x];
    for ($i = $y-1; $i >= 0; $i--) {
        if ($map[$i][$x] >= $current) {
            return $i+1;
        }
    }
    return 0;
}

function idxVisibleFromRight(array $map, int $x, int $y): int
{
    if ($x === count($map[0])-1) {
        return $x;
    }
    $current = $map[$y][$x];
    for ($i = $x+1; $i < count($map[0]); $i++) {
        if ($map[$y][$i] >= $current) {
            return $i-1;
        }
    }
    return $i-1;
}

function idxVisibleFromBottom(array $map, int $x, int $y): int
{
    if ($y === count($map)-1) {
        return $y;
    }
    $current = $map[$y][$x];
    for ($i = $y+1; $i < count($map); $i++) {
        if ($map[$i][$x] >= $current) {
            return $i-1;
        }
    }
    return $i-1;
}

$input = file_get_contents('input/day8.txt');
$map = array_map(fn(string $v) => str_split($v), explode("\n", $input));
$treeVisible = 0;
$maxScenicScore = 0;

$height = count($map);
$width = count($map[0]);

for ($y = 0; $y < $height; $y++) {
    for ($x = 0; $x < $width; $x++) {
        $top = idxVisibleFromTop($map, $x, $y);
        $right = idxVisibleFromRight($map, $x, $y);
        $bottom = idxVisibleFromBottom($map, $x, $y);
        $left = idxVisibleFromLeft($map, $x, $y);

        $lengthTop = $y - $top + ($top===0? 0:1);
        $lengthRight = $right - $x + ($right===$width-1? 0:1);
        $lengthLeft = $x - $left + ($left===0? 0:1);
        $lengthBottom = $bottom - $y + ($bottom===$height-1? 0:1);

        $isVisible = $top === 0 || $left === 0 || $right === $width-1 || $bottom === $height-1;

        $treeVisible += ($isVisible ? 1 : 0);

        $maxScenicScore = max($lengthTop * $lengthRight * $lengthLeft * $lengthBottom, $maxScenicScore);
    }
}

echo "Visible trees: $treeVisible\nMax scenic score: $maxScenicScore";

