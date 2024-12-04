<?php

$input_data = fopen("./input.txt", "r");

$list1 = [];
$list2 = [];
$distances = [];

while (($line = fgets($input_data)) !== false) {        
    $lineArray = explode(" ", $line);
    $list1[] = $lineArray[0];
    $list2[] = $lineArray[3];
}

sort($list1);
sort($list2);

foreach($list1 as $key => $value) {
    $distances[] = abs($list1[$key] - $list2[$key]);
}

echo array_sum($distances);