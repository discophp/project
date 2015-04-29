<?php

Class StandardView extends Disco\classes\View {

    public function header(){
        return Template::build('header.html');
    }//header

    public function __construct(){

        $this->scriptSrc('http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
        $this->scriptSrc('/js/modernizr.js');
        $this->scriptSrc('/js/foundation.min.js');
        $this->scriptSrc('/js/js.js');

        $this->styleSrc('/css/foundation.min.css');
        $this->styleSrc('/css/css.css');

        $this->script('$(document).foundation();');

    }//construct

    public function footer(){
        return Template::build('footer.html');
    }//footer

}//Standard

?>
