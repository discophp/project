<?php
//Require the composer autoloader. 
require(dirname(dirname(__FILE__)).'/vendor/autoload.php');

//setup the application
\Disco\classes\App::instance()->setUp();


/**
 * YOUR APPLICATION LOGIC GOES BELOW
 * ---------------------------------
*/



// Swap the View Service With an Extended View Class.
App::make('View','StandardView');



/**
 * ---------------------------------
 * YOUR APPLICATION LOGIC STAYS ABOVE 
*/
App::tearDown();
