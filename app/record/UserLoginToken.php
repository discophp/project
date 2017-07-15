<?php
namespace App\record;
use \Disco\database\Record;

class UserLoginToken extends Record {

    /**
    * @var string $model
    */
    protected $model = '\App\repository\UserLoginToken';
    
    

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
  'user_id' => 
  array (
    'null' => false,
    'type' => 'int',
    'length' => '11',
  ),
  'token' => 
  array (
    'null' => false,
    'type' => 'char',
    'length' => '172',
  ),
  'ip_address' => 
  array (
    'null' => false,
    'type' => 'varchar',
    'length' => '45',
  ),
  'created_on_date' => 
  array (
    'null' => false,
    'type' => 'datetime',
  ),
  'last_accessed_date' => 
  array (
    'null' => false,
    'type' => 'datetime',
  ),
  'user_agent' => 
  array (
    'null' => true,
    'type' => 'varchar',
    'length' => '800',
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
    * @return int
    */
    public function getUserId(){
        return $this->fields['user_id'];
    }
    
    /**
    * @param int $userId
    * @return $this
    */
    public function setUserId($userId){
        $this->fields['user_id'] = $userId;
        return $this;
    }
    

    /**
    * @return string
    */
    public function getToken(){
        return $this->fields['token'];
    }
    
    /**
    * @param string $token
    * @return $this
    */
    public function setToken($token){
        $this->fields['token'] = $token;
        return $this;
    }
    

    /**
    * @return string
    */
    public function getIpAddress(){
        return $this->fields['ip_address'];
    }
    
    /**
    * @param string $ipAddress
    * @return $this
    */
    public function setIpAddress($ipAddress){
        $this->fields['ip_address'] = $ipAddress;
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
    * @return string|\DateTime
    */
    public function getLastAccessedDate(){
        return $this->fields['last_accessed_date'];
    }
    
    /**
    * @param string|\DateTime $lastAccessedDate
    * @return $this
    */
    public function setLastAccessedDate($lastAccessedDate){
        $this->fields['last_accessed_date'] = $lastAccessedDate;
        return $this;
    }
    

    /**
    * @return string|null
    */
    public function getUserAgent(){
        return $this->fields['user_agent'];
    }
    
    /**
    * @param string|null $userAgent
    * @return $this
    */
    public function setUserAgent($userAgent){
        $this->fields['user_agent'] = $userAgent;
        return $this;
    }
    




}//UserLoginToken
