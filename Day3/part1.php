<?php

// Open the input file "input.txt" for reading
$input_data = fopen("./input.txt", "r");

// Initialize an empty array to store the results of the multiplications
$totaller = [];

// Loop through each line of the input file
while (($line = fgets($input_data)) !== false) {      
    
    // Check if the line contains any matches for the pattern 'mul(number,number)'
    if(preg_match_all('/mul\(\d+,\d+\)/', $line, $matches)) {
        // Loop through each match found
        foreach($matches[0] as $match){
            // Split the match into two parts using the comma as a delimiter
            $numbers = explode(',', $match);
            
            // Extract the first number from the match
            preg_match_all('/\d+/', $numbers[0], $num1Matches);
            // Extract the second number from the match
            preg_match_all('/\d+/', $numbers[1], $num2Matches);

            // Get the first number from the matches
            $num1 = $num1Matches[0][0];
            // Get the second number from the matches
            $num2 = $num2Matches[0][0];
                        
            // Multiply the two numbers and add the result to the totaller array
            $totaller[] = $num1 * $num2;
        }
    }
}

// Calculate the sum of all the products in the totaller array and print it
echo array_sum($totaller)."\n";

// Exit the script
exit;