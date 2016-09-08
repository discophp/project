<?php

return function(){
    \View::html('
        <div class="container center-align">
            <h1 class="header">404 :[</h1>
            <p>Pstt: This is being served from <span class="chip">app/error/404.php</span>. You should custmoize it and make it unique!</p>
        </div>
    ');
};

?>
