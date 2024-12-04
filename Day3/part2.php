<?php

$input_data = fopen("./input.txt", "r");
$globalTotaller = [];

while (($line = fgets($input_data)) !== false) {      
    

    //Split the input by do() then string anything past don't() on each line
    // This gives us everything past a do(), including the start of the input
    // Then apply the same checkString function from part1 to each string and sum the results
    $strings = explode('do()', $line);
    foreach($strings as $string){
        
        $position = strpos($string, 'don\'t()');
        if($position){
            // Extract the part of the string before the comma
            $result = substr($string, 0, $position);
            $globalTotaller[] = checkString($result);
        }else{
            $globalTotaller[] = checkString($string);            
        }
    }
    
    echo array_sum($globalTotaller)."\n";
}

function checkString($string){
    
    $totaller = [];
    if(preg_match_all('/mul\(\d+,\d+\)/', $string, $matches)) {
        foreach($matches[0] as $match){
            $numbers = explode(',', $match);
            preg_match_all('/\d+/', $numbers[0], $num1Matches);
            preg_match_all('/\d+/', $numbers[1], $num2Matches);

            $num1 = $num1Matches[0][0];
            $num2 = $num2Matches[0][0];
                        
            $totaller[] = $num1 * $num2;
            
        }
    }
    return array_sum($totaller);
}

