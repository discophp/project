<?php

/**
 * Load Disco 
 * The only require you must write
*/
require_once('../vendor/discophp/framework/core/Disco.core.php');



/**
 *
 *              YOUR APPLICATION LOGIC GOES BELOW
 *              ---------------------------------
 *
*/





/**
 *      Don't want to use the Util Facade? Comment below out,or delete it.
 *        - you can subsequently remove the Util.class.php file from app/class/
*/

Disco::make('Util',function(){
    return new Disco\classes\Util;
});


/**
 *      Swap the View Facade With an Extended View Class 
*/
Disco::make('View',function(){
    return new StandardView();
});




//match the index route
Router::get('/',function(){

    View::html('Disco is working');

});






/**
 *
 *              ---------------------------------
 *              YOUR APPLICATION LOGIC STAYS ABOVE 
 *
*/



/**
 *      ---------- 404 --------------
*/
Router::get('/404',function(){
    header('HTTP/1.0 404 Not Found');
    View::html('<h1>404</h1>');
});


/**
 *      If we never resolve a Router to an endpoint then we need to send
 *      the user to the 404 page
 */
if(!Router::routeMatch()){
    header('Location:/404');
    exit;
}//if


/**
 *      Print out our View
 *      Do no remove this method call unless you wish to 
 *      call View::printPage() after satisifying every router condition
*/
View::printPage();


?>
