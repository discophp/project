<?php
namespace App\controller;

Class Root {



    /**
     * Logic for `/` route.
    */
    public function getIndex(){
        \View::title('Your Site Home Page');
        \Template::with('index.html');
    }//index



}//Index
