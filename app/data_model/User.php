<?php
namespace App\data_model;

class User extends \Disco\classes\DataModel {

    protected $definition = Array(
        'username' => Array(
            'type'      => 'string',
            'minlen'    => 2,
            'maxlen'    => 60,
            'required'  => true,
            'premassage' => 'alphaOnly',
        ),
        'email' => Array(
            'premassage' => 'trim',
            'method' => 'isEmail',
            'required'  => true,
        ),
        'password' => Array(
            'type' => 'string',
            'minlen' => 6,
            'required' => true,
        ),
        'password_verify' => Array(
            'method' => 'passwordVerify',
        )

    );


    public function alphaOnly($value){
        return preg_replace("/[^a-zA-Z0-9\s\_\-]/",' ',$value);
    }//alphaOnly



    public function isEmail($value){

        if(!$value || strpos($value,'@') === false){
            return false;
        }//if

        $pieces = explode('@',$value);

        if(!isset($pieces[0]) || !strlen($pieces[0]) || !isset($pieces[1]) || !strlen($pieces[1])){
            return false;
        }//if

        if(strlen($value) > 120){
            $this->definition['email']['error'] = 'Email must be less than 120 characters';
            return false;
        }//if

        if(\App::with('User')->loggedIn()){
            if(\App::with('User')->checkUniqueEmail(\App::with('User')->userId(),$value)){
                $this->definition['email']['error'] = 'That email address is already in use';
                return false;
            }//if
        }//if
        else if(\App::with('User')->emailInUse($value)){
            $this->definition['email']['error'] = 'That email address is already in use, maybe you <a href="/forgot-password">forgot your password?</a>';
            return false;
        }//if

        return true;

    }//isEmail



    public function trim($value){
        return trim($value);
    }//trim



    public function passwordVerify($value){

        if(!$value || !isset($this['password']) || $value !== $this['password']){
            $this->definition['password_verify']['error'] = 'Passwords do not match!';
            return false;
        }//if

        return true;

    }//passwordVerify

}//User
