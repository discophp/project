<?php
namespace App\record;
use \Disco\database\Record;

class UserToken extends Record {

    /**
    * @var string $model
    */
    protected $model = '\App\repository\UserToken';
    
    

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
  'type' => 
  array (
    'null' => false,
    'type' => 'varchar',
    'length' => '45',
  ),
  'token' => 
  array (
    'null' => false,
    'type' => 'char',
    'length' => '172',
  ),
  'created_on_date' => 
  array (
    'null' => false,
    'type' => 'datetime',
  ),
  'expires_on_date' => 
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
    public function getType(){
        return $this->fields['type'];
    }
    
    /**
    * @param string $type
    * @return $this
    */
    public function setType($type){
        $this->fields['type'] = $type;
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
    public function getExpiresOnDate(){
        return $this->fields['expires_on_date'];
    }
    
    /**
    * @param string|\DateTime|null $expiresOnDate
    * @return $this
    */
    public function setExpiresOnDate($expiresOnDate){
        $this->fields['expires_on_date'] = $expiresOnDate;
        return $this;
    }
    




}//UserToken
