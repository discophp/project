<?php
namespace App\controller;

Class Root {



    /**
     * Logic for `/` route.
    */
    public function getIndex(){
        \View::title('Disco Boogie Nights');
        \Template::with('index.html');
    }//index



}//Index
