<?php
//Require the composer autoloader. 
require(dirname(dirname(__FILE__)).'/vendor/autoload.php');

//setup the application
\Disco\classes\App::instance()->setUp();


/**
 * YOUR APPLICATION LOGIC GOES BELOW
 * ---------------------------------
*/


try {

    require 'app/index.php';

} catch(\Exception $e){

    //*************************
    // You better handle this!
    // 500 error for default.
    //*************************

    http_response_code(500);
    ob_end_clean();
    echo 'Internal Server Error';
    exit;
    
}//catch


/**
 * ---------------------------------
 * YOUR APPLICATION LOGIC STAYS ABOVE 
*/
App::tearDown();
