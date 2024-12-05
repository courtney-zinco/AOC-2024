<?php

// Open the input file in read mode
$input_data = fopen("./input.txt", "r");

// Initialize an array to keep track of safety messages
$safeTracker = [];
// Initialize a counter to keep track of the number of safe sequences
$safeSum = 0;

// Read the file line by line
while (($line = fgets($input_data)) !== false) {        
    // Split the line into an array of levels
    $levels = explode(" ", $line);
        
    // Initialize the first level as the track
    $track = $levels[0];
    // Flag to indicate if the sequence is decreasing
    $decreasing = false;
    // Flag to indicate if the sequence is safe
    $isSafe = true;

    // Check if the first level is greater than the second level
    if($levels[0] > $levels[1]) {
        // If so, set the decreasing flag to true
        $decreasing = true;
    }
    
    // Iterate through each level in the sequence
    foreach($levels as $key => $level) {
        // Skip the first level as it is already set as the track
        if($key == 0) {
            continue;
        }

        // Check if the sequence is still decreasing if it started decreasing
        if($decreasing && $level > $track) {
            // If not, mark the sequence as not safe and add a message to the tracker
            $safeTracker[] = 'Not decreasing or increasing properly 1';
            $isSafe = false;
            break;            
        } elseif(!$decreasing && $level < $track) {
            // If the sequence is supposed to be increasing but a level is less than the previous level
            // mark the sequence as not safe and add a message to the tracker
            $isSafe = false;
            $safeTracker[] = 'Not decreasing or increasing properly 2';
            break;
        }

        // Check if the difference between consecutive levels is greater than 3 or less than 1
        if(abs($track - $level) > 3 || abs($track - $level) < 1) {            
            // If so, mark the sequence as not safe and add a message to the tracker
            $isSafe = false;
            $safeTracker[] = 'Difference between levels is greater than 3 or less than 1, it is: '.abs($track - $level);
            break;
        }
        // Update the track to the current level
        $track = $level;        
    }    
    // If the sequence is safe, increment the safe counter and add a safe message to the tracker
    if($isSafe) {
        $safeSum++;
        $safeTracker[] = 'Safe';
    }
}

// Output the number of safe sequences
echo $safeSum."\n";