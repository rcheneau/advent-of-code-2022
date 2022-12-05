<?php

/**
 * @param string $line
 * @return array containing in the following order: move value, from value and to value.
 */
function parseInstructions(string $line): array {
    $instructions = explode(' ', $line);

    return [$instructions[1], $instructions[3] - 1, $instructions[5] - 1];
}

$input = file_get_contents('input/day5.txt');
$lines = explode("\n", $input);

$cranes = [];
$j = 0;
foreach ($lines as $j => $line) {
    $row = str_split($line);
    if ($row[1] === '1') {
        break;
    }

    for ($i = 1; $i < count($row); $i += 4) {
        $idx = $i - 1 / 4;
        if (!isset($cranes[$idx])) {
            $cranes[$idx] = [];
        }
        if ($row[$i] === ' ') {
            continue;
        }

        $cranes[$idx][] = $row[$i];
    }
}

$cranes = array_values(array_map(fn(array $v) => array_reverse($v), $cranes));
$cranes2 = $cranes;

for ($i = $j + 2; $i < count($lines); $i++) {
    list($move, $from, $to) = parseInstructions($lines[$i]);

    for($k = 0; $k < $move; $k++) {
        $cranes[$to][] = array_pop($cranes[$from]);
    }

    $cranes2[$to] = array_merge(
        $cranes2[$to],
        array_splice($cranes2[$from], -$move)
    );
}

echo '1st: ' . join('', array_map(fn(array $c) => $c[count($c) - 1], $cranes));
echo "\n2nd: " . join('', array_map(fn(array $c) => $c[count($c) - 1], $cranes2));
