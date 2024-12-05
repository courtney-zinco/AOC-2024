<?php

// Open the input file in read mode
$input_data = fopen("./input.txt", "r");

// Set error reporting to only show errors and parse errors
error_reporting(E_ERROR | E_PARSE);

// The following code is a brute force approach to find the MAS in an X format in the input data
//  M.S
//  .A.
//  M.S
// Or other permutations of the same

// To do this, we find the A and check the surrounding 'corners' clockwise, if these strings match what we'd expect
// for MAS in the X format, we increment the match counter

// Initialize an empty matrix to store the input data
$matrix = [];
$matchCounter = 0;

// Read the input file line by line
while (($line = fgets($input_data)) !== false) {
    // Split each line into characters and add to the matrix
    $matrix[] = str_split(trim($line));
}

// Iterate through each row and column of the matrix
foreach($matrix as $row => $line) {
    foreach($line as $column => $char) {
        // If the character is 'A', start checking for the sequence
        if($char == 'A') {
            //echo "found an A at $row, $column\n";
            // Check the surrounding characters and increment the match counter if the sequence is found
            $matchCounter += checkSurrounding($matrix, $row, $column);
        }
    }
}

// Output the total number of matches found
echo $matchCounter."\n";


function checkSurrounding($matrix, $row, $column) {
  
    //Check if the top left, then top right, then bottom right, then bottom left are either
    // MSSM, SMMS MMSS, SSMM
    // NOT SMSM MSMS -- Could probably make this better for checking the NOT rather than the IS

    $topLeft   = $matrix[$row-1][$column-1];
    $topRight  = $matrix[$row-1][$column+1];
    $bottomRight = $matrix[$row+1][$column+1];
    $bottomLeft = $matrix[$row+1][$column-1];

    // Build the string of the surrounding characters
    $string = $topLeft.$topRight.$bottomRight.$bottomLeft;    
    // Check if a valid format is found
    if($string == "MSSM" || $string == "SMMS" || $string == "MMSS" || $string == "SSMM") {
        return 1;
    }    
    return 0;
}