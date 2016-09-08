<?php
namespace App\record;

class UserToken extends \Disco\classes\Record {

    protected $model = '\App\model\UserToken';
    
    

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
    'length' => '128',
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




}//UserToken
