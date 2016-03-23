<?php
//Require the composer autoloader. 
require dirname(__DIR__) . '/vendor/autoload.php';

//Setup the application
\Disco\classes\App::instance()->setUp();

try {

    //Include the application logic
    require '../app/index.php';

    //Tear down the app
    App::tearDown();

} catch(\Exception $e){

    //*************************
    // You better handle this!
    // 500 error for default.
    //*************************

    error_log($e->getMessage());
    \View::serve(500);
    
}//catch



