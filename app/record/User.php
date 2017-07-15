<?php
namespace App\record;
use \Disco\database\Record;

class User extends Record {

    /**
    * @var string $model
    */
    protected $model = '\App\repository\User';
    
    

    /**
     * @var array $fieldDefinitions All the table/records fields and their data types.
    */
    protected $fieldDefinitions = array (
  'id' => 
  array (
    'null' => false,
    'type' => 'int',
    'length' => '11',
  ),
  'username' => 
  array (
    'null' => false,
    'type' => 'varchar',
    'length' => '60',
  ),
  'email' => 
  array (
    'null' => false,
    'type' => 'varchar',
    'length' => '120',
  ),
  'password' => 
  array (
    'null' => false,
    'type' => 'varchar',
    'length' => '180',
  ),
  'created_on_date' => 
  array (
    'null' => false,
    'type' => 'datetime',
  ),
  'last_access_date' => 
  array (
    'null' => true,
    'type' => 'datetime',
  ),
  'banned_date' => 
  array (
    'null' => true,
    'type' => 'datetime',
  ),
  'verified_date' => 
  array (
    'null' => true,
    'type' => 'datetime',
  ),
);

    /**
     * @var null|string $autoIncrementField The autoincrement field name.
    */
    protected $autoIncrementField = 'id';


    
    /**
    * @return int
    */
    public function getId(){
        return $this->fields['id'];
    }
    
    /**
    * @param int $id
    * @return $this
    */
    public function setId($id){
        $this->fields['id'] = $id;
        return $this;
    }
    

    /**
    * @return string
    */
    public function getUsername(){
        return $this->fields['username'];
    }
    
    /**
    * @param string $username
    * @return $this
    */
    public function setUsername($username){
        $this->fields['username'] = $username;
        return $this;
    }
    

    /**
    * @return string
    */
    public function getEmail(){
        return $this->fields['email'];
    }
    
    /**
    * @param string $email
    * @return $this
    */
    public function setEmail($email){
        $this->fields['email'] = $email;
        return $this;
    }
    

    /**
    * @return string
    */
    public function getPassword(){
        return $this->fields['password'];
    }
    
    /**
    * @param string $password
    * @return $this
    */
    public function setPassword($password){
        $this->fields['password'] = $password;
        return $this;
    }
    

    /**
    * @return string|\DateTime
    */
    public function getCreatedOnDate(){
        return $this->fields['created_on_date'];
    }
    
    /**
    * @param string|\DateTime $createdOnDate
    * @return $this
    */
    public function setCreatedOnDate($createdOnDate){
        $this->fields['created_on_date'] = $createdOnDate;
        return $this;
    }
    

    /**
    * @return string|\DateTime|null
    */
    public function getLastAccessDate(){
        return $this->fields['last_access_date'];
    }
    
    /**
    * @param string|\DateTime|null $lastAccessDate
    * @return $this
    */
    public function setLastAccessDate($lastAccessDate){
        $this->fields['last_access_date'] = $lastAccessDate;
        return $this;
    }
    

    /**
    * @return string|\DateTime|null
    */
    public function getBannedDate(){
        return $this->fields['banned_date'];
    }
    
    /**
    * @param string|\DateTime|null $bannedDate
    * @return $this
    */
    public function setBannedDate($bannedDate){
        $this->fields['banned_date'] = $bannedDate;
        return $this;
    }
    

    /**
    * @return string|\DateTime|null
    */
    public function getVerifiedDate(){
        return $this->fields['verified_date'];
    }
    
    /**
    * @param string|\DateTime|null $verifiedDate
    * @return $this
    */
    public function setVerifiedDate($verifiedDate){
        $this->fields['verified_date'] = $verifiedDate;
        return $this;
    }
    




}//User
