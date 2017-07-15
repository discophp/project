<?php


// Register the Standard View into the application container.
// See https://discophp.com/docs/service/view for more information.
app()->make('View', 'App\view\Standard');


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
router()->get('/','Root@getIndex')->name('index');


// Resolve user routes, both public and private
router()->useRouter('user');


?>
