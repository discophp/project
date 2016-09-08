<?php


// Register the Standard View into the application container.
// See https://discophp.com/docs/service/view for more information.
App::make('View','App\view\Standard');


// We are forcing the use of CSRF token for all `POST`,`DELETE`, and `PUT` operations,
// validate that we recieved a valid token. See https://discophp.com/docs/service/data for more information.
if(!Data::validateCSRFToken()){
    throw new \Exception('Bad token sent with request, action is denied!');
}//if


// If the current user isn't logged in check to see if they have a permanent login cookie set.
// If they do they will have a session created for them.
if(!\App::with('User')->loggedIn()){
    \App::with('User')->checkForPermanentLoginToken();
}//if


//*******************************************************************
// Start defining application routes.
// See https://discophp.com/docs/service/router for more information.
//*******************************************************************


// Resolve the root (index) route
Router::get('/','App\controller\Root@getIndex');


// Resolve user routes, both public and private
Router::useRouter('user');


?>
