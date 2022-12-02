<?php

/**
 * 0 1 2 0
 * So if we do (x+1)%3, and it's equal it means we were the number "before".
 *
 * @param int $p1
 * @param int $p2
 *
 * @return int returns 1 if p1 is the winner, 0 if it's a draw or -1 otherwise.
 */
function winner(int $p1, int $p2): int {
    if ($p1 === $p2) {
        return 0;
    }

    return ($p2+1)%3 === $p1 ? 1 : -1;
}

$input = file_get_contents('input/day2.txt');
$lines = explode("\n", $input);
$outcomeScores = [-1 => 0, 0 => 3, 1 => 6];

$totalScore = 0;
foreach ($lines as $line) {
    list($a, $b) = explode(' ', $line);
    $opponent = ord($a) - 65;
    $me = ord($b) - 88;
    $totalScore += $me + 1 + $outcomeScores[winner($me, $opponent)];
}
echo "1st: $totalScore";

$totalScore2 = 0;
$expectedResults = ['X' => -1, 'Y' => 0, 'Z' => 1];
foreach ($lines as $line) {
    list($a, $b) = explode(' ', $line);
    $opponent = ord($a) - 65;
    $result = $expectedResults[$b];

    $me = $result === 0
        ? $opponent
        : ($result === 1 ? ($opponent+1)%3 : ($opponent+2)%3);

    $totalScore2 += $me + 1 + $outcomeScores[$result];
}
echo "\n2nd: $totalScore2";
