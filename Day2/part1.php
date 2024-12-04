<?php

$input_data = fopen("./input.txt", "r");

$safeTracker = [];
$safeSum = 0;

while (($line = fgets($input_data)) !== false) {        
    $levels = explode(" ", $line);
        
    $track = $levels[0];
    $decreasing = false;
    $isSafe = true;

    if($levels[0] > $levels[1]) {
        $decreasing = true;
    }
    

    foreach($levels as $key => $level) {

        if($key == 0) {
            continue;
        }

        // Check we are still decreasing if we started decreasing
        if($decreasing && $level > $track) {
            $safeTracker[] = 'Not decreasing or increasing properly 1';
            $isSafe = false;
            break;            
        }elseif(!$decreasing && $level < $track) {
            $isSafe = false;
            $safeTracker[] = 'Not decreasing or increasing properly 2';
            break;
        }

        // Check the value bwtween the numbers change is not greater than 3 and is more than 1
        if(abs($track - $level) > 3 || abs($track - $level) < 1) {            
            $isSafe = false;
            $safeTracker[] = 'Difference between levels is greater than 3 or less than 1, it is: '.abs($track - $level);
            break;
        }
        $track = $level;        
    }    
    if($isSafe) {
        $safeSum++;
        $safeTracker[] = 'Safe';
    }

}

//print_r($safeTracker);
echo $safeSum."\n";
exit;

//The levels are either all increasing or all decreasing.
//Any two adjacent levels differ by at least one and at most three.