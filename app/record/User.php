<?php
namespace App\record;

class User extends \Disco\classes\Record {

    protected $model = '\App\model\User';
    
    

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




}//User
