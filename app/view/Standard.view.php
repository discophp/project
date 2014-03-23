<?php

Class Standard extends BaseView {

    public function header(){
        return " 
            <h1>Now you Disco</h1>
        ";
    }//header

    public function __construct(){

        $this->scriptSrc('http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
        $this->scriptSrc('/scripts/js.js');
        $this->styleSrc('/css/css.css');

    }//construct

    public function footer(){
        return "<p>A footer</p>";
    }//footer

}//Standard

?>
