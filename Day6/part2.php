<?php

// Open the input file in read mode
$input_data = fopen("./testinput.txt", "r");

// Read the input file line by line
while (($line = fgets($input_data)) !== false) {
   // For part 2, we could do what we do for part 1 with a new map where we swap 
   // each . character one by one with a # (apart from the starting position) and test, then check for infinite loop
   // If we have an infinite loop, then increment counter and continue.
   // Once complete our incremented counter is the answer

   // How do we test for an infinite loop -- we could mark each visited space with a - 
   // for left/right and | for up down. If we are going to put a - or | where there is one already, we've hit an infinite loop

   // Is there any way we can do this without iterating over thousands of versions of the map, running out test on each. 

}
