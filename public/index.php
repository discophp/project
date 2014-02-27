<?php

//debug
$time = microtime();

/**
 * Load Disco 
 * The only require you must write
*/
require_once('../vendor/jbhamilton/disco-core/core/Disco.core.php');



/**
 * Swap the View Facade with a new instance 
*/
//Disco::make('View',function(){
//    return new bitcoin();
//});




/**
 * Set up a Router
*/
//Disco::useRouter('bitcoin/bitcoinRouter');




/**
 * Print out our View
*/
View::printPage();







//debug
echo '<script>console.log("'.(microtime()-$time).'");</script>';

?>
