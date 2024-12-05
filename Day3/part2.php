<?php

// Open the input file "input.txt" for reading
$input_data = fopen("./input.txt", "r");

// Initialize an empty array to store the results of the multiplications
$globalTotaller = [];

// Loop through each line of the input file
while (($line = fgets($input_data)) !== false) {      
    
    // Split the input by 'do()' then string anything past 'don't()' on each line
    // This gives us everything past a 'do()', including the start of the input
    // Then apply the same checkString function from part1 to each string and sum the results
    $strings = explode('do()', $line);
    foreach($strings as $string){
        
        // Find the position of 'don't()' in the string
        $position = strpos($string, 'don\'t()');
        if($position){
            // Extract the part of the string before 'don't()'
            $result = substr($string, 0, $position);
            // Apply the checkString function to the extracted part and add the result to the globalTotaller array
            $globalTotaller[] = checkString($result);
        } else {
            // If 'don't()' is not found, apply the checkString function to the whole string
            $globalTotaller[] = checkString($string);            
        }
    }
    
    // Print the sum of all the products in the globalTotaller array for the current line
    echo array_sum($globalTotaller)."\n";
}

// Function to check the string for 'mul(number,number)' patterns and calculate their products
function checkString($string){
    
    // Initialize an empty array to store the results of the multiplications
    $totaller = [];
    
    // Check if the string contains any matches for the pattern 'mul(number,number)'
    if(preg_match_all('/mul\(\d+,\d+\)/', $string, $matches)) {
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
    
    // Return the sum of all the products in the totaller array
    return array_sum($totaller);
}