<?php

// Rules:
// The levels mist be either all increasing or all decreasing.
// Any two adjacent levels differ by at least one and at most three.
// If successful with the removal of any one level in the set, it is still safe.

$input_data = fopen("./input.txt", "r");

$safeTracker = [];
$safeSum = 0;
// Read in each line one by one
while (($line = fgets($input_data)) !== false) {        
    // Get the levels from the line as an array of values
    $levels = explode(" ", $line);
    // Assume unsafe to start with
    $isSafe = false;

    // Check the base level with no changes to remove the levels
    $isSafe = checkLevels($levels);
    
    // If it's not safe, check each set of levels where one is removed, looping to find a safe set    
    if(!$isSafe) {
        foreach($levels as $key => $level) {
            $levelclone = $levels;
            unset($levelclone[$key]);

            if(checkLevels(array_values($levelclone))){      // IMPORTANT - must use array_values to reset the keys      
                $isSafe = true;
            }
        }
    }

    // If safe (either with no changes, or with one level removed) increment the safe sum
    if($isSafe) {
        $safeSum++;
    }

}


// Function to check the levels are incremending/decrementing and within the correct range
function checkLevels($levelsArray){

    echo 'Checking levels: '.implode(" ", $levelsArray)."\n";
    // Assume the first level is the base level
    $track = $levelsArray[0];
    // Assume we are increasing to start with
    $decreasing = false;
    // assume safe to start with, we will check for unsafe conditions
    $isSafe = true;

    // Check if we are decreasing or increasing to start with. This will determine the direction we are checking
    if($levelsArray[0] > $levelsArray[1]) {
        $decreasing = true;
    }
    // Loop through the levels to check they are increasing or decreasing and within the correct range
    foreach($levelsArray as $key => $level) {
        // Skip the first level as we are using it as the base level
        if($key == 0) {
            continue;
        }

        // Check we are still decreasing if we started decreasing
        if($decreasing && $level > $track) {
            // The levels are not decreasing but should be
            $isSafe = false;
            break;            
        }elseif(!$decreasing && $level < $track) {
            // The levels are not increasing but should be
            $isSafe = false;
            break;
        }

        // Check the value between the numbers change is not greater than 3 and is more than 1
        if(abs($track - $level) > 3 || abs($track - $level) < 1) {  
            // The levels are not within the correct range          
            $isSafe = false;            
            break;
        }
        $track = $level;        
    }    
    return $isSafe;
}

// Output the count of the safe levels
echo $safeSum."\n";
exit;
