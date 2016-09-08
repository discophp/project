<?php
namespace App\controller;

class User {


    public function getIndex(){
        \Template::with('user/index');
    }//getIndex



    public function getEdit(){
        \View::title('Edit Your Account Information');
        \Template::with('user/edit');
    }//getEdit



    public function postEdit(){

        $data = \Data::post()->all();

        $UserDataModel = new \App\data_model\User($data);

        if(!$UserDataModel->verifySetData()){

            \Session::setFlash('edit-data',$UserDataModel->getData());
            \Session::setFlash('edit-errors',$UserDataModel->getErrors());

        }//if
        else {

            \App::with('User')->updateUser($UserDataModel);

            \Session::setFlash('edit-success','Account Information Updated!');

        }//el

        \View::redirect($_SERVER['REQUEST_URI']);

    }//postEdit



    public function postEditPassword(){

        $data = \Data::post(Array('password_current','password','password_verify'));

        $UserDataModel = new \App\data_model\User($data);

        $current_password = \App::with('User')->User
            ->select('password')
            ->where('id=?',\App::with('User')->userId())
            ->first()['password'];

        if(\Crypt::hash($data['password_current']) != $current_password){
            \Session::setFlash('edit-password-errors',Array(
                'password_current' => 'That wasn\'t your current password',
            ));
        }//if
        else if(!$UserDataModel->verifySetData()){
            \Session::setFlash('edit-password-errors',$UserDataModel->getErrors());
        }//elif
        else {

            \App::with('User')->changePassword($UserDataModel['password']);

            \Session::setFlash('edit-success','Password Updated!');

        }//el

        \View::redirect('/user/edit');

    }//postEditPassword



}//User
