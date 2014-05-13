<?php

/**
 * Load Disco 
 * The only require you must write
*/
require_once('../vendor/jbhamilton/disco-core/core/Disco.core.php');


/**
 *      Don't want to use the Util Facade? Comment below out,or delete it.
*/

Disco::make('Util',function(){
    return new Disco/classes/Util;
});



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
    return new StandardView();
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
