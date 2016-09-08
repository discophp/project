<?php

return function(){
    \View::html('
        <div class="container center-align">
            <h1 class="header">Oops we messed up and couldn\'t process your request</h1>
            <p>AKA <i>Internal Server Error</i></p>
            <p>Pstt: This is being served from <span class="chip">app/error/500.php</span>.</p>
        </div>
    ');

};
