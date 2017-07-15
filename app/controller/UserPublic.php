<?php
namespace App\controller;
use \Disco\http\Controller;

class UserPublic extends Controller {

    /**
     * @var \App\service\User $user
     */
    private $user;

    public function __construct(\App\service\User $user){
        $this->user = $user;
    }//__construct


    public function getLogin(){
        view()->title('Login');
        return $this->view('user/login.html');
    }//getLogin



    public function postLogin(){

        $data = data()->post(['name_or_email', 'password', 'remember_me']);

        $data['remember_me'] = isset($data['remember_me']) && $data['remember_me'] == 'on';

        if(
            !$data['name_or_email'] || 
            !$data['password'] || 
            (($status = $this->user->login($data['name_or_email'], $data['password'], $data['remember_me'])) !== 1)
        ){

            $error = 'Invalid Login Credentials!';

            if($status === -1){
                $error = 'Your account needs to be verified before you can log in, we sent you a verification email when you signed up.';
            }//if

            session()->setFlash('login-error',$error);
            session()->setFlash('login-data',Array('name_or_email' => $data['name_or_email']));

            return $this->redirect(request()->uri());

        }//if

        return $this->redirect('/user/');

    }//postLogin



    public function getSignUp(){
        view()->title('Sign Up');
        return $this->view('user/signup.html');
    }//getSignUp



    public function postSignUp(){

        $data = data()->post()->all();

        $UserDataModel = new \App\data_model\User($data);

        if(!$UserDataModel->verify()){

            session()->setFlash('signup-data',$UserDataModel->getData());
            session()->setFlash('signup-errors',$UserDataModel->getErrors());

        }//if
        else {

            $UserRecord = new \App\record\User($data);

            $UserRecord->setPassword( \Crypt::hash( $UserRecord->getPassword() ) );

            $UserRecord['created_on_date'] = Array('raw' => 'NOW()');

            $UserRecord->insert();

            $this->user->sendActivationEmail( $UserRecord->getId() );

            session()->setFlash('signup-success',1);

        }//el

        return $this->redirect(request()->uri());

    }//postSignUp



    public function getForgotPassword(){
        view()->title('Request A Password Reset');
        return $this->view('user/forgot-password.html');
    }//getForgotPassword



    public function postForgotPassword(){
        $this->user->sendPasswordResetEmail(data()->post('email'));
        session()->setFlash('pw-reset', 1);
        return $this->redirect(request()->uri());
    }//postForgotPassword



    public function getActivateAccount($token){

        if(!$this->user->activateAccount($token)){
            return false;
        }//if

        view()->title('Your Account Has Been Activated');
        return $this->view('user/account-activated.html');

    }//getActiveAccount



    public function getPasswordReset($token){

        if(!session()->hasFlash('pw-reset-success') && !$this->user->isValidToken($token,'password')){
            return false;
        }//if

        view()->title('Reset Your Password');
        return $this->view('user/password-reset.html');
        
    }//getPasswordReset



    public function postPasswordReset($token){

        $user_id = $this->user->isValidToken($token,'password');

        if(!$user_id){
            return false;
        }//if

        $UserDataModel = new \App\data_model\User(data()->post()->all());

        if(!$UserDataModel->verifySetData()){
            session()->setFlash('pw-reset-errors', $UserDataModel->getErrors());
        }//if
        else {
            $this->user->changePassword($UserDataModel['password'],$user_id);
            $this->user->deleteToken($user_id,'password');
            session()->setFlash('pw-reset-success',1);
        }//el

        return $this->redirect(request()->uri());

    }//postPasswordReset


}//User
