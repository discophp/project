<?php
//Require the composer autoloader. 
require dirname(__DIR__) . '/vendor/autoload.php';

//Setup the application
\Disco\App::instance()->setUp();

//Include the application logic
require app()->path('/app/index.php');

//Tear down the app
app()->shutdown();
