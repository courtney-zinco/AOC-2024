<?php

// Open the input file in read mode
$input_data = fopen("./input.txt", "r");
$map = [];
$visitedLocationTracker = [];

// Row / Column
$positionTracker = [0,0];

$lineCount = 0;

// 0 = up
// 1 = right 
// 2 = down
// 3 = left
$currentDirection = 0;

// Read the input file line by line and build a matrix map for the puzzle
// Also find the starting position of the person
while (($line = fgets($input_data)) !== false) {
    $row = str_split(trim($line));  
    $map[] = $row;      
    $visitedLocationTracker[] = $row;
    if (in_array('^', $row)) {        
        $positionTracker = [
            array_search('^', $row),
            $lineCount
        ];
    }      
    $lineCount++;
}

$i = 0;
while (checkNextPosition($map, $positionTracker, $currentDirection) != 'X') {    
    $nextPosition = checkNextPosition($map, $positionTracker, $currentDirection);

    if ($nextPosition != '#' && $nextPosition != 'X') {        
        $positionTracker = moveNewPosition($positionTracker, $currentDirection);
        $visitedLocationTracker[$positionTracker[1]][$positionTracker[0]] = '0';                    
    } elseif ($nextPosition == '#') {
        $currentDirection = updateDirection($currentDirection);
    }

    $i++;    
}

printMap($visitedLocationTracker);
echo countStepsInMap($visitedLocationTracker)."\n";
exit;

function countStepsInMap($visitedLocationTracker){
    $locationCounter = 0;
    foreach($visitedLocationTracker as $row){
        foreach($row as $value){
            if($value == '0'){
                $locationCounter++;
            }
        }
    }
    return $locationCounter+1;
}

function updateDirection($currentDirection){
    if($currentDirection >= 3){
        $currentDirection = 0;
    }else{
        $currentDirection++;
    }
    //echo 'changing direction to '.$currentDirection."\n";
    return $currentDirection;
}


function moveNewPosition($currentPosition, $currentDirection){    
    if($currentDirection == 0){ // up        
        $currentPosition = [$currentPosition[0], $currentPosition[1]-1]; // Moving up        
    }elseif($currentDirection == 1){ // right
        $currentPosition = [$currentPosition[0]+1, $currentPosition[1]]; // Moving right
    }elseif($currentDirection == 2){ // down
        $currentPosition = [$currentPosition[0], $currentPosition[1]+1]; // Moving down
    }elseif($currentDirection == 3){ // left
        $currentPosition = [$currentPosition[0]-1, $currentPosition[1]]; // Moving left
    }
    return $currentPosition;
}

function checkNextPosition($map, $currentPosition, $currentDirection){
    $nextStepType = 'X'; // Default value if the next position is out of bounds

    if($currentDirection == 0){ // up
        if (isset($map[$currentPosition[1]-1][$currentPosition[0]])) {
            $nextStepType = $map[$currentPosition[1]-1][$currentPosition[0]]; // Moving up
        }
    } elseif($currentDirection == 1){ // right
        if (isset($map[$currentPosition[1]][$currentPosition[0]+1])) {
            $nextStepType = $map[$currentPosition[1]][$currentPosition[0]+1]; // Moving right
        }
    } elseif($currentDirection == 2){ // down
        if (isset($map[$currentPosition[1]+1][$currentPosition[0]])) {
            $nextStepType = $map[$currentPosition[1]+1][$currentPosition[0]]; // Moving down
        }
    } elseif($currentDirection == 3){ // left
        if (isset($map[$currentPosition[1]][$currentPosition[0]-1])) {
            $nextStepType = $map[$currentPosition[1]][$currentPosition[0]-1]; // Moving left
        }
    }

    return $nextStepType;
}

function printMap($map){
    foreach ($map as $row) {        
        foreach ($row as $element) {
            echo $element . " ";
        }
        echo PHP_EOL;
    }
}

//4938 is too low
//4939 is correct - for some reason there is an off by one discrepancy between test and actual input -- dunno why