<?php
namespace App\controller;

class UserPublic {


    public function __construct(){

        if(\App::with('User')->loggedIn()){
            \View::redirect('/user/');
        }//if

    }//__construct


    public function getLogin(){
        \View::title('Login');
        \Template::with('user/login');
    }//getLogin



    public function postLogin(){

        $data = \Data::post(Array('name_or_email','password','remember_me'));

        $data['remember_me'] = isset($data['remember_me']) && $data['remember_me'] == 'on';

        if(
            !$data['name_or_email'] || 
            !$data['password'] || 
            (($status = \App::with('User')->login($data['name_or_email'],$data['password'],$data['remember_me'])) !== 1)
        ){

            $error = 'Invalid Login Credentials!';

            if($status === -1){
                $error = 'Your account needs to be verified before you can log in, we sent you a verification email when you signed up.';
            }//if

            \Session::setFlash('login-error',$error);
            \Session::setFlash('login-data',Array('name_or_email' => $data['name_or_email']));

            \View::redirect('/login');

        }//if
            
        \View::redirect('/user/');

    }//postLogin



    public function getSignUp(){
        \View::title('Sign Up');
        \Template::with('user/signup');
    }//getSignUp



    public function postSignUp(){

        $data = \Data::post()->all();

        $UserDataModel = new \App\data_model\User($data);

        if(!$UserDataModel->verify()){

            \Session::setFlash('signup-data',$UserDataModel->getData());
            \Session::setFlash('signup-errors',$UserDataModel->getErrors());

        }//if
        else {

            $UserRecord = new \App\record\User($data);

            $UserRecord['password'] = \Crypt::hash($UserRecord['password']);

            $UserRecord['created_on_date'] = Array('raw' => 'NOW()');

            $UserRecord->insert();

            \App::with('User')->sendActivationEmail($UserRecord['id']);

            \Session::setFlash('signup-success',1);

        }//el

        \View::redirect('/signup');

    }//postSignUp



    public function getForgotPassword(){
        \View::title('Request A Password Reset');
        \Template::with('user/forgot-password');
    }//getForgotPassword



    public function postForgotPassword(){
        \App::with('User')->sendPasswordResetEmail(\Data::post('email'));
        \Session::setFlash('pw-reset',1);
        \View::redirect('/forgot-password');
    }//postForgotPassword



    public function getActivateAccount($token){

        if(!\App::with('User')->activateAccount($token)){
            return false;
        }//if

        \View::title('Your Account Has Been Activated');
        \Template::with('user/account-activated');

    }//getActiveAccount



    public function getPasswordReset($token){

        if(!\Session::hasFlash('pw-reset-success') && !\App::with('User')->isValidToken($token,'password')){
            return false;
        }//if

        \View::title('Reset Your Password');
        \Template::with('user/password-reset');
        
    }//getPasswordReset



    public function postPasswordReset($token){

        $user_id = \App::with('User')->isValidToken($token,'password');

        if(!$user_id){
            return false;
        }//if

        $UserDataModel = new \App\data_model\User(\Data::post()->all());

        if(!$UserDataModel->verifySetData()){
            \Session::setFlash('pw-reset-errors',$UserDataModel->getErrors());
        }//if
        else {
            \App::with('User')->changePassword($UserDataModel['password'],$user_id);
            \App::with('User')->deleteToken($user_id,'password');
            \Session::setFlash('pw-reset-success',1);
        }//el

        \View::redirect($_SERVER['REQUEST_URI']);

    }//postPasswordReset


}//User
