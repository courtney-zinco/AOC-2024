<?php

$input_data = fopen("./input.txt", "r");

error_reporting(E_ERROR | E_PARSE);


// brute force - could go every character for an X (first letter of xmas) 
// then check every character surrounding it for an M
// if found, check every character surrounding the M for an A
// if found, check every character surrounding the A for an S
// If we have an S log it as a successful match 
// Continue until we have checked all characters in the input file

// First build a matrix of the input data
$matrix = [];
$matchCounter = 0;
while (($line = fgets($input_data)) !== false) {      
    $matrix[] = str_split(trim($line));        
}


// This is a decent start, but it doesn't account for the fact that the matches must be linear!
foreach($matrix as $row=>$line){
    foreach($line as $column=>$char){        
        if($char == 'X'){            
            echo "found an X at $row, $column\n";            
            $matchCounter+= checkSurrounding($matrix, $row, $column, 'M');                             
        }
    }
}
echo "\n".$matchCounter."\n";
function checkSurrounding($matrix, $row, $column, $char){
    $matches = 0;
    if($matrix[$row-1][$column-1] == $char){      
        echo "found a $char in the top left\n";          
        // check the line going in the direction of the M for a A
        if($matrix[$row-2][$column-2] == 'A'){     
            echo "found an A in the top left\n";       
            // check the line going in the direction of the A for a S
            if($matrix[$row-3][$column-3] == 'S'){               
                echo "found an S in the top left\n";
                echo 'SUCCESSFUL MATCH FOUND';                 
                $matches++;
            }
        }
        
    }
    if($matrix[$row-1][$column] == $char){
        echo "found a $char in the top\n";
        if($matrix[$row-2][$column] == 'A'){            
            echo "found an A in the top\n";
            if($matrix[$row-3][$column] == 'S'){           
                echo "found an S in the top\n";
                echo 'SUCCESSFUL MATCH FOUND';                     
                $matches++;
            }
        }
    } 
    if($matrix[$row-1][$column+1] == $char){
        echo "found a $char in the top right\n";
        if($matrix[$row-2][$column+2] == 'A'){  
            echo "found an A in the top right\n";          
            if($matrix[$row-3][$column+3] == 'S'){                                
                echo "found an S in the top right\n";
                echo 'SUCCESSFUL MATCH FOUND';
                $matches++;
            }
        }
    }
    if($matrix[$row][$column-1] == $char){
        echo "found a $char in the left\n";
        if($matrix[$row][$column-2] == 'A'){   
            echo "found an A in the left\n";         
            if($matrix[$row][$column-3] == 'S'){     
                echo "found an S in the left\n";                           
                $matches++;
            }
        }
    }
    if($matrix[$row][$column+1] == $char){
        echo "found a $char in the right\n";
        if($matrix[$row][$column+2] == 'A'){    
            echo "found an A in the right\n";        
            if($matrix[$row][$column+3] == 'S'){     
                echo "found an S in the right\n";                           
                $matches++;
            }
        }
    }
    if($matrix[$row+1][$column-1] == $char){
        echo "found a $char in the bottom left\n";
        if($matrix[$row+2][$column-2] == 'A'){        
            echo "found an A in the bottom left\n";    
            if($matrix[$row+3][$column-3] == 'S'){     
                echo "found an S in the bottom left\n";                           
                $matches++;
            }
        }
    }
    if($matrix[$row+1][$column] == $char){
        echo "found a $char in the bottom\n";
        if($matrix[$row+2][$column] == 'A'){        
            echo "found an A in the bottom\n";    
            if($matrix[$row+3][$column] == 'S'){   
                echo "found an S in the bottom\n";                             
                $matches++;
            }
        }
    }
    if($matrix[$row+1][$column+1] == $char){
        echo "found a $char in the bottom right\n";
        if($matrix[$row+2][$column+2] == 'A'){      
            echo "found an A in the bottom right\n";      
            if($matrix[$row+3][$column+3] == 'S'){  
                echo "found an S in the bottom right\n";                              
                $matches++;
            }
        }
    }
    return $matches;    
}

// 2312 is too low
// 2427 is Correct
// 5824 is too high