<?php

/**
 * Load Disco 
 * The only require you must write
*/
require_once('../vendor/jbhamilton/disco-core/core/Disco.core.php');



/**
 *
 *      YOUR APPLICATION LOGIC GOES BELOW
 *      ---------------------------------
 *
*/



/**
 * Swap the View Facade with a different Base object
*/
Disco::make('View',function(){
    return new Standard();
});


Router::get('/',function(){

    View::html('Disco is working');

});









/**
 * Print out our View
 * Do no remove this method call unless you wish to 
 * call View::printPage() after satisifying every router condition
*/
View::printPage();


?>
