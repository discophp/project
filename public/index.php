<?php
/**
 * Require the composer autoloader. 
*/
require(dirname(dirname(__FILE__)).'/vendor/autoload.php');

/**
 * YOUR APPLICATION LOGIC GOES BELOW
 * ---------------------------------
*/

$app = new Disco;


// Swap the View Facade With an Extended View Class.
Disco::make('View','StandardView');




//match the index route
Router::get('/',function(){

    View::html('Disco is working');

});




/**
 * ---------------------------------
 * YOUR APPLICATION LOGIC STAYS ABOVE 
*/
Disco::tearDownApp();
