<?php
namespace App\record;

class UserLoginToken extends \Disco\classes\Record {

    protected $model = '\App\model\UserLoginToken';
    
    

    /**
     * @var null|string $autoIncrementField The autoincrement field name.
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




}//UserLoginToken
