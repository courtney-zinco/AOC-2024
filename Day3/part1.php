<?php

$input_data = fopen("./input.txt", "r");
$totaller = [];

while (($line = fgets($input_data)) !== false) {      
    
    if(preg_match_all('/mul\(\d+,\d+\)/', $line, $matches)) {
        foreach($matches[0] as $match){
            $numbers = explode(',', $match);
            preg_match_all('/\d+/', $numbers[0], $num1Matches);
            preg_match_all('/\d+/', $numbers[1], $num2Matches);

            $num1 = $num1Matches[0][0];
            $num2 = $num2Matches[0][0];
                        
            $totaller[] = $num1 * $num2;
            
        }
    }
    
}
echo array_sum($totaller)."\n";
exit;