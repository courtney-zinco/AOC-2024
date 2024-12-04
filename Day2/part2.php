<?php

$input_data = fopen("./input.txt", "r");

$safeTracker = [];
$safeSum = 0;

while (($line = fgets($input_data)) !== false) {        
    $levels = explode(" ", $line);
    $isSafe = false;
    // Check the base level with no changes to remove the levels
    $isSafe = checkLevels($levels);

    if(!$isSafe) {
        foreach($levels as $key => $level) {
            $levelclone = $levels;
            unset($levelclone[$key]);

            if(checkLevels(array_values($levelclone))){      // IMPORTANT - must use array_values to reset the keys      
                $isSafe = true;
            }
        }
    }

    if($isSafe) {
        $safeSum++;
    }

}


function checkLevels($levelsArray){

    echo 'Checking levels: '.implode(" ", $levelsArray)."\n";

    $track = $levelsArray[0];
    $decreasing = false;
    $isSafe = true;

    if($levelsArray[0] > $levelsArray[1]) {
        $decreasing = true;
    }
    
    foreach($levelsArray as $key => $level) {

        if($key == 0) {
            continue;
        }

        // Check we are still decreasing if we started decreasing
        if($decreasing && $level > $track) {
            $isSafe = false;
            break;            
        }elseif(!$decreasing && $level < $track) {
            $isSafe = false;
            break;
        }

        // Check the value between the numbers change is not greater than 3 and is more than 1
        if(abs($track - $level) > 3 || abs($track - $level) < 1) {            
            $isSafe = false;            
            break;
        }
        $track = $level;        
    }    
    return $isSafe;
}

echo $safeSum."\n";
exit;

//The levels are either all increasing or all decreasing.
//Any two adjacent levels differ by at least one and at most three.

// not 402 -- too low
// not 409 -- too low
// not 617 -- too high