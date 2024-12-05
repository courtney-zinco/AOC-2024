<?php

// Open the input file in read mode
$input_data = fopen("./input.txt", "r");

// Get the rules
// For each list of pages, check against each rule
// If all rules succeed, then get the middle number of the list and store in out totaller array
// Sum the values
$successfulPageRowsCenterValues = [];

$rules = [];
$pageNumbers = [];


$aboveTheFold = true;
// Read the input file line by line
while (($line = fgets($input_data)) !== false) {
    // if we have reached a line with nothing in it, this is the delimiter between the rules and the page numbers
    // so we can set the aboveTheFold flag to false and handle the page numbers and rules separately
    if(trim($line) == '') {
        $aboveTheFold = false;
    }else{
        if($aboveTheFold){
            $rules[] = array_map('intval',explode('|', trim($line)));
        }else{
            $pageNumbers[] = array_map('intval', explode(',',trim($line)));
        }
    }
}

// We now have a list of the rules and a list of the page numbers
foreach($pageNumbers as $pageNumberLine){
    //echo 'Checking'.json_encode($pageNumberLine)."\n";
    $success = true;
    foreach($rules as $rule){
        // check the line against the rule  
        // Check if the line includes the numbers in the rule...if not we can ignore this rule
        if(!in_array($rule[0], $pageNumberLine) || !in_array($rule[1], $pageNumberLine)){
            //echo 'we can ignore line '.json_encode($pageNumberLine)." for rule ".json_encode($rule)."\n";
            continue;
        }

        // Find the position of the first rule number in the line
        $firstRuleNumberPosition = array_search($rule[0], $pageNumberLine);
        // Find the position of the second rule number in the line
        $secondRuleNumberPosition = array_search($rule[1], $pageNumberLine);

        if($firstRuleNumberPosition > $secondRuleNumberPosition){
           $success = false;
        }                
    }
    if($success){
        $successfulPageRowsCenterValue = $pageNumberLine[floor(count($pageNumberLine)/2)];
        $successfulPageRowsCenterValues[] = $successfulPageRowsCenterValue;
        //echo ''.json_encode($pageNumberLine)." is a success - its middle value is ".$successfulPageRowsCenterValue."\n";

    }
}


echo array_sum($successfulPageRowsCenterValues)."\n";

exit;
