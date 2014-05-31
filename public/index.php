<?php
/**
 * Load Disco. The only require you must write!
*/
require_once('../vendor/discophp/framework/core/Disco.core.php');

/**
 * YOUR APPLICATION LOGIC GOES BELOW
 * ---------------------------------
*/


// Don't want to use the Util Facade? Comment below out,or delete it.
// - you can subsequently remove the Util.class.php file from app/class/
Disco::make('Util',function(){
    return new Disco\classes\Util;
});

// Swap the View Facade With an Extended View Class.
Disco::make('View',function(){
    return new StandardView();
});




//match the index route
Router::get('/',function(){

    View::html('Disco is working');

});





/**
 * ---------------------------------
 * YOUR APPLICATION LOGIC STAYS ABOVE 
*/
Disco::tearDownApp();
?>
