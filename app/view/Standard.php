<?php
namespace App\view;

Class Standard extends \Disco\classes\View {

    public function header(){
        return \Template::build('header.html');
    }//header

    public function __construct(){

        $this->styleSrc('http://fonts.googleapis.com/icon?family=Material+Icons');
        $this->styleSrc('https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css');
        $this->styleSrc('/resource/bundle.css',true);

        $this->scriptSrc('https://code.jquery.com/jquery-2.1.1.min.js');
        $this->scriptSrc('https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js');
        $this->scriptSrc('/resource/bundle.js',true);

    }//construct

    public function footer(){
        return \Template::build('footer.html');
    }//footer

}//Standard

?>
