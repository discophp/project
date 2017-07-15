<?php
namespace App\controller;
use Disco\http\Controller;

class User extends Controller {


    /**
     * @var \App\service\User $user
     */
    private $user;


    public function __construct(\App\service\User $user) {
        $this->user = $user;
    }


    public function getIndex(){
        view()->title('Dashboard');
        return $this->view('user/index.html');
    }//getIndex



    public function getEdit(){
        view()->title('Edit Your Account Information');
        return $this->view('user/edit.html');
    }//getEdit



    public function postEdit(){

        $data = data()->post()->all();

        $userDataModel = new \App\data_model\User($data);

        if(!$userDataModel->verifySetData()){

            session()->setFlash('edit-data', $userDataModel->getData());
            session()->setFlash('edit-errors', $userDataModel->getErrors());

        }//if
        else {

            $this->user->updateUser($userDataModel);

            session()->setFlash('edit-success', 'Account Information Updated!');

        }//el

        return $this->redirect(request()->getRequestUri());

    }//postEdit



    public function postEditPassword(){

        $data = data()->post(['password_current', 'password', 'password_verify']);

        $userDataModel = new \App\data_model\User($data);

        $current_password = $this->user->User
            ->select('password')
            ->where('id=?', $this->user->userId())
            ->first()['password'];

        if(\Crypt::hash($data['password_current']) != $current_password){
            session()->setFlash('edit-password-errors', [
                'password_current' => 'That wasn\'t your current password',
            ]);
        }//if
        else if(!$userDataModel->verifySetData()){
            session()->setFlash('edit-password-errors', $userDataModel->getErrors());
        }//elif
        else {

            $this->user->changePassword($userDataModel['password']);

            session()->setFlash('edit-success', 'Password Updated!');

        }//el

        return $this->redirect(app()->route('user.edit'));

    }//postEditPassword



}//User
