<?php

$input = file_get_contents('input/day7.txt');
$lines = explode("\n", $input);

$tree = [];
$path = '';
$stack = [];

foreach ($lines as $i => $line) {
    $words = explode(' ', $line);

    if ($words[0] === '$' && $words[1] === 'cd') {
        $dirname = $words[2];
        if ($dirname === '..') {
            $path = substr($path, 0, strrpos($path, '/'));
            array_pop($stack);
            continue;
        }
        $path .= ($path !== '/' && $dirname !== '/' ? '/' : '') . $dirname;
        $stack[] = $path;
        if (!isset($tree[$path])) {
            $tree[$path] = 0;
        }
    } else if (ctype_digit($words[0])) {
        foreach ($stack as $s) {
            $tree[$s] += (int)$words[0];
        }
    }
}

$sumDirsLessThan100000 = array_sum(array_filter($tree, fn(int $n) => $n <= 100000));

echo "Sum dirs less than 100000: $sumDirsLessThan100000\n";

$freeSpace = 70000000 - $tree['/'];
$spaceToClear = 30000000-$freeSpace;

$min = $tree['/'];
foreach ($tree as $t) {
    if($t >= $spaceToClear && $t < $min) {
        $min = $t;
    }
}

echo "Minimum size folder to clear: $min";