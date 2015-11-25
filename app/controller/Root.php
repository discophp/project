<?php
namespace App\controller;

Class Root {



    /**
     * Logic for `/` route.
    */
    public function getIndex(){
        Template::with('index.html');
    }//index



}//Index
