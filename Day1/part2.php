<?php

$input_data = fopen("./input.txt", "r");

// Define 2 empty lists to store the numbers
$list1 = [];
$list2 = [];

// Define an empty list to store the distances
$distances = [];

// Read in each line one by one
while (($line = fgets($input_data)) !== false) {        
    // Split the line into an array of just the numbers
    $lineArray = explode(" ", $line);
    // Add the first and last numbers to the lists
    $list1[] = $lineArray[0];
    $list2[] = $lineArray[3];
}

// Count the values in list2 and store them in an array
$countedValues = array_count_values($list2);

// For each value in list1, multiply it by the count of that value in list2
foreach($list1 as $key=>$list1Value) {
    // If the value exists in the counted values array, multiply it by the count
    if(isset($countedValues[$list1Value])){
        // Store the calculated value in an array
        $calcVals[] = $list1Value * $countedValues[$list1Value];
    }
}

// Output the sum of the calculated values
echo array_sum($calcVals);
