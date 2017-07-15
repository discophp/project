<?php
namespace App\controller;
use \Disco\http\Controller;

Class Root extends Controller {



    /**
     * Logic for `/` route.
    */
    public function getIndex(){
        view()->title('Your Site Home Page');
        return $this->view('index.html');
    }//index



}//Index
