<?php

$input_data = fopen("./input.txt", "r");

$list1 = [];
$list2 = [];
$calcVals = [];

while (($line = fgets($input_data)) !== false) {        
    $lineArray = explode(" ", $line);
    $list1[] = $lineArray[0];
    $list2[] = trim($lineArray[3]);
}

$countedValues = array_count_values($list2);

foreach($list1 as $key=>$list1Value) {
    if(isset($countedValues[$list1Value])){
        $calcVals[] = $list1Value * $countedValues[$list1Value];
    }
}

echo array_sum($calcVals);
