<?php

// Open the input file in read mode
$input_data = fopen("./input.txt", "r");

// Set error reporting to only show errors and parse errors
error_reporting(E_ERROR | E_PARSE);

// The following code is a brute force approach to find the word "XMAS" in the input data
// The idea is to look for the letter 'X' and then check the surrounding characters for 'M'
// If 'M' is found, check the surrounding characters for 'A'
// If 'A' is found, check the surrounding characters for 'S'
// If 'S' is found, log it as a successful match
// Continue until all characters in the input file are checked

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
        // If the character is 'X', start checking for the sequence
        if($char == 'X') {
            echo "found an X at $row, $column\n";
            // Check the surrounding characters for 'M' and continue the sequence check
            $matchCounter += checkSurrounding($matrix, $row, $column, 'M');
        }
    }
}

// Output the total number of matches found
echo "\n".$matchCounter."\n";

// Function to check the surrounding characters for the given character
function checkSurrounding($matrix, $row, $column, $char) {
    $matches = 0;

    // Check top-left direction
    if($matrix[$row-1][$column-1] == $char) {
        echo "found a $char in the top left\n";
        // Check for 'A' in the same direction
        if($matrix[$row-2][$column-2] == 'A') {
            echo "found an A in the top left\n";
            // Check for 'S' in the same direction
            if($matrix[$row-3][$column-3] == 'S') {
                echo "found an S in the top left\n";
                echo 'SUCCESSFUL MATCH FOUND';
                $matches++;
            }
        }
    }

    // Check top direction
    if($matrix[$row-1][$column] == $char) {
        echo "found a $char in the top\n";
        if($matrix[$row-2][$column] == 'A') {
            echo "found an A in the top\n";
            if($matrix[$row-3][$column] == 'S') {
                echo "found an S in the top\n";
                echo 'SUCCESSFUL MATCH FOUND';
                $matches++;
            }
        }
    }

    // Check top-right direction
    if($matrix[$row-1][$column+1] == $char) {
        echo "found a $char in the top right\n";
        if($matrix[$row-2][$column+2] == 'A') {
            echo "found an A in the top right\n";
            if($matrix[$row-3][$column+3] == 'S') {
                echo "found an S in the top right\n";
                echo 'SUCCESSFUL MATCH FOUND';
                $matches++;
            }
        }
    }

    // Check left direction
    if($matrix[$row][$column-1] == $char) {
        echo "found a $char in the left\n";
        if($matrix[$row][$column-2] == 'A') {
            echo "found an A in the left\n";
            if($matrix[$row][$column-3] == 'S') {
                echo "found an S in the left\n";
                $matches++;
            }
        }
    }

    // Check right direction
    if($matrix[$row][$column+1] == $char) {
        echo "found a $char in the right\n";
        if($matrix[$row][$column+2] == 'A') {
            echo "found an A in the right\n";
            if($matrix[$row][$column+3] == 'S') {
                echo "found an S in the right\n";
                $matches++;
            }
        }
    }

    // Check bottom-left direction
    if($matrix[$row+1][$column-1] == $char) {
        echo "found a $char in the bottom left\n";
        if($matrix[$row+2][$column-2] == 'A') {
            echo "found an A in the bottom left\n";
            if($matrix[$row+3][$column-3] == 'S') {
                echo "found an S in the bottom left\n";
                $matches++;
            }
        }
    }

    // Check bottom direction
    if($matrix[$row+1][$column] == $char) {
        echo "found a $char in the bottom\n";
        if($matrix[$row+2][$column] == 'A') {
            echo "found an A in the bottom\n";
            if($matrix[$row+3][$column] == 'S') {
                echo "found an S in the bottom\n";
                $matches++;
            }
        }
    }

    // Check bottom-right direction
    if($matrix[$row+1][$column+1] == $char) {
        echo "found a $char in the bottom right\n";
        if($matrix[$row+2][$column+2] == 'A') {
            echo "found an A in the bottom right\n";
            if($matrix[$row+3][$column+3] == 'S') {
                echo "found an S in the bottom right\n";
                $matches++;
            }
        }
    }

    // Return the number of matches found
    return $matches;
}