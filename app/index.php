<?php

//***************************************
// Setup your application envinornment
// and then start defining some routes!
//***************************************


//Register the Standard View into the application container.
\App::make('View','\App\view\Standard');


Router::get('/','\App\controller\Root@getIndex');


?>
