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

// Sort the two lists by value
sort($list1);
sort($list2);

// Loop the lists and calculate the distance between the two values
// Absolute value is used to ensure the distance is always positive
foreach($list1 as $key => $value) {
    // Store the value in the distances list
    $distances[] = abs($list1[$key] - $list2[$key]);
}

// Output the sum of the distances
echo array_sum($distances);