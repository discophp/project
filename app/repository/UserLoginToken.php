<?php
namespace App\repository;
use \Disco\database\Repository;

class UserLoginToken extends Repository {

    
    public $table = 'user_login_token';
    public $ids = Array('id','user_id');



}//UserLoginToken
