<?php

function hasDuplicate(array $a): bool
{
    return count($a) !== count(array_unique($a));
}

function findStartingIndex(array $chars, int $length): int {
    for($i = $length; $i < count($chars); $i++) {
        $buffer = array_slice($chars, $i-$length, $length);
        if(!hasDuplicate($buffer)) {
            return $i;
        }
    }
    return -1;
}

$input = file_get_contents('input/day6.txt');
$chars = str_split($input);

echo 'Length 4: ' . findStartingIndex($chars, 4);
echo "\nLength 14: " . findStartingIndex($chars, 14);