<?php
namespace App\service;

/**
 * Provides functionality for interacting with users.
 */
class User {


    /**
     * @var string SESSION_KEY The key used to store the users id in the session.
    */
    const SESSION_KEY = 'user';


    /**
     * @var string PERM_LOGIN_COOKIE_NAME The key used to store the users id in a permanent login cookie.
    */
    const PERM_LOGIN_COOKIE_NAME = 'app_user';


    /**
     * @var string|int PERM_LOGIN_LENGTH TTL for a permanent login token cookie.
    */
    const PERM_LOGIN_LENGTH = '+180 days';


    /**
     * @var string ACTIVATION_SLUG The slug used to activate user accounts.
    */
    const ACTIVATION_SLUG = '/account-activation/';


    /**
     * @var string PW_RESET_SLUG The slug used to reset users passwords.
    */
    const PW_RESET_SLUG = '/password-reset/';


    /**
     * @var boolean $logged_Whether the user is logged in.
    */
    protected $logged_in = false;


    /**
     * @var null|int $user_id The logged in users id.
    */
    protected $user_id;


    /**
     * @var \App\repository\User $User {@link \App\repository\User} instance.
    */
    public $User;


    /**
     * @var null|array $data Cache for user data fields.
    */
    public $data;



    /**
     * Set `$this->logged_in` and `$this->user_id`.
     *
     * @param null|int $user_id If you want to use the User service for a specific user, construct it with the 
     * users id.
    */
    public function __construct($user_id = null){

        $this->User = new \App\repository\User;

        if($user_id !== null && is_numeric($user_id)){
            $this->user_id = $user_id;
        } else if(session()->has($this->getSessionKey())){
            $this->logged_in = true;
            $this->user_id = session()->get($this->getSessionKey());
        }//if

    }//construct



    /**
     * Get the key that identifies a users session.
     *
     *
     * @return string
    */
    public function getSessionKey(){
        return self::SESSION_KEY;
    }//getSessionKey



    /**
     * Returns whether the user is logged in.
     *
     *
     * @return boolean
    */
    public function loggedIn(){
        return $this->logged_in;
    }//loggedIn



    /**
     * Get the users `id`.
     *
     *
     * @return null|int
    */
    public function userId(){
        return $this->user_id;
    }//userId



    /**
     * Get the basic fields of the logged in user, caching the results.
     *
     * @return null|array
    */
    public function getData(){

        if(!$this->data && $this->loggedIn()){
            $this->data = $this->User
                ->select('username,email,banned_date')
                ->where('id=?',$this->user_id)
                ->first();
            $this->data['id'] = $this->user_id;
        }//if

        return $this->data;

    }//getData



    /**
     * Attempt to log in a user and create a Session.
     *
     *
     * @param string $name_or_email The users name or email.
     * @param string $password The users password.
     * @param boolean $permanent Whether to create a permanent login cookie for the user session, default is 
     * `false`.
     *
     * @return int Returns `1` if successfull login, `0` if not, `-1` if the account isn't verified. 
    */
    public function login($name_or_email,$password, $permanent = false){

        $row = $this->User->select('id,verified_date')
            ->where('(username=? OR email=?) AND password=?', [
                $name_or_email,
                $name_or_email,
                \Crypt::hash($password),
            ])
            ->data(); 

        if(!$row->rowCount()){
            return 0;
        }//if

        $row = $row->fetch();

        if(!$row['verified_date']){
            return -1;
        }//if

        session()->set($this->getSessionKey(),$row['id']);
        session()->regen();

        $this->user_id = $row['id'];
        $this->logged_in = true;

        if($permanent === true){
            $this->makeLoginPermanent($this->user_id);
        }//if

        return 1;

    }//login



    /**
     * Log a user out.
    */
    public function logout(){

        session()->destroy();

        if(data()->hasCookie(self::PERM_LOGIN_COOKIE_NAME)){

            $cookie = data()->getCookie(self::PERM_LOGIN_COOKIE_NAME);
            
            $p = explode('|',$cookie);
    
            $id = array_shift($p);
            $user_id = array_shift($p);

            if($id && $user_id){
                $record             = new \App\record\UserLoginToken;
                $record['id']       = $id;
                $record['user_id']  = $this->userId();

                $record->delete();
            }//if

            data()->deleteCookie(self::PERM_LOGIN_COOKIE_NAME);

        }//if

    }//logout



    /**
     * Returns whether a email address is already in use.
     *
     *
     * @param string $email The email address.
     *
     * @return boolean 
    */
    public function emailInUse($email){

        $result = $this->User
            ->select('email')
            ->where(['email' => $email])
            ->data();

        if($result->rowCount() != 0){
            return true;
        }//if

        return false;

    }//emailInUse



    /**
     * Is the user banned?
     *
     * return boolean
    */
    public function isBanned(){

        return $this->User
            ->select('banned_date')
            ->where('id=?',$this->user_id)
            ->first()['banned_date'];

    }//isBanned



    /**
     * Update the current users last access time.
     *
     * 
     * @return void
    */
    public function updateLastAccess(){

        $this->User
            ->update(['last_access_date' => ['__raw' => 'NOW()']])
            ->where('id=?',$this->userId())
            ->finalize();

    }//updateLastAccessed



    /**
     * Send a user a account activation email.
     *
     *
     * @param int $user_id The id of the user.
     *
     * @return boolean
    */
    public function sendActivationEmail($user_id){

        $record = new \App\record\User(['id' => $user_id]);

        if(!$record->exists()){
            return ['sent' => false];
        }//if

        $token = $this->generateToken($record->id,'activate',null);

        $data = [];

        $data['url'] = app()->domain() . app()->route('user.activation', ['token' => $token]);

        $data['link'] = \Html::a(['href' => $data['url']], 'Activate Account');

        $data['to'] = $record->fetch('email');

        try {
            return \Email::send($data['to'], 'Activate Your Account', template()->render('user/email/account-activation.html', $data));
        } catch(\Exception $e){
            \App::log("Error sending account activation email to user : `{$record['id']}`");
            return false;
        }//catch

    }//sendActivationEmail



    /**
     * Activate/verify a users account.
     *
     * @param string $token The token that was generated and emailed to the user.
     *
     * @return boolean
    */
    public function activateAccount($token){

        $user_id = $this->isValidToken($token,'activate');

        if($user_id === false){
            return false;
        }//if

        $this->deleteToken($user_id,'activate');

        return $this->User
            ->update('verified_date=NOW()')
            ->where('id=?', $user_id)
            ->finalize();

    }//activateAccount



    /**
     * Send a user a password reset email if their email is found.
     *
     *
     * @param string $email The email of the user.
     *
     * @return boolean
     * @throws \Disco\exceptions\Exception
    */
    public function sendPasswordResetEmail($email){

        $user = $this->User->select('id')->where('email=?',$email)->first();

        if(!$user['id']){
            return false;
        }//if

        $token = $this->generateToken($user['id'],'password');

        $data = [];
        $data['url'] = app()->domain() . app()->route('user.password-reset', ['token' => $token]);
        $data['link'] = \Html::a(['href' => $data['url']], 'Reset Password');

        $data['to'] = $email;

        try {
            return \Email::send($data['to'], 'Password Reset Request', template()->render('user/email/password-reset.html', $data));
        } catch(\Exception $e){
            throw new \Disco\exceptions\Exception("Error sending account activation email to user : `{$user['id']}` : {$e->getMessage()}");
        }//catch

    }//sendPasswordResetEmail



    /**
     * Determines whether the passed token is valid.
     * If it is the `user_id` will be returned, if it's expired false will be returned, if it didn't exist 
     * `false` will be returned.
     *
     *
     * @param string $token The token.
     * @param string $token_type The type of token.
     *
     * @return boolean|int False if expired or non-existent, users id if valid token.
    */
    public function isValidToken($token, $token_type){

        $Token = \App\record\UserToken::find(
                    ['token' => $token , 'type' => $token_type],
                    ['id', 'user_id', 'UNIX_TIMESTAMP(expires_on_date) AS expires_on_date']
                );

        if($Token === false || ($Token->expires_on_date && $Token->expires_on_date < time())){
            return false;
        }//if

        return $Token->user_id;

    }//isValidToken



    /**
     * Generate a token to be used for email security that is unique for a user.
     *
     *
     * @param int $user_id The user id.
     * @param string $token_type The token type.
     * @param null|int $expires_days `null` if the token doesn't expire, otherwise a integer representing the 
     * number of days the token will be valid for. Default is `5` days.
     *
     * @return string
    */
    public function generateToken($user_id,$token_type,$expires_days = 5){

        $User = new \App\record\User(['id' => $user_id]);

        if(!$User->exists()){
            return false;
        }//if

        $user_has_token = \App\record\UserToken::find(
                [
                    'user_id'   => $User->id,
                    'type'      => $token_type
                ],
                'id'
            );

        $Token = new \App\record\UserToken;

        $Token->user_id         = $User->id;
        $Token->token           = str_replace('/','|',base64_encode( openssl_random_pseudo_bytes(128)));
        $Token->created_on_date = ['__raw' => 'NOW()'];
        if(is_int($expires_days)){
            $Token->expires_on_date = ['__raw' => '(NOW() + INTERVAL ' . $expires_days . ' DAY)'];
        }//if
        $Token->type            = $token_type;

        if($user_has_token === false){
            $Token->insert();
        } else {
            $Token->id = $user_has_token->id;
            $Token->update();
        }//el

        return $Token->token;

    }//generateToken



    /**
     * Delete a {@link \App\record\UserToken}.
     *
     *
     * @param int $user_id The user id.
     * @param string $token_type The type of token.
     *
     * @return void
    */
    public function deleteToken($user_id,$token_type){
        $UserToken = \App\record\UserToken::find(
            [
                'user_id'   => $user_id,
                'type'      => $token_type
            ],
            'id'
        );

        if($UserToken === false){
            return;
        }//if

        $UserToken->delete();

    }//deleteToken



    /**
     * Create a permanent login token for a user.
     *
     *
     * @var int $user_id The user_id.
     *
     * @return boolean 
    */
    public function makeLoginPermanent($user_id){

        $token = base64_encode( openssl_random_pseudo_bytes(128));
        $secret = app()->config('AES_KEY256');

        $record = new \App\record\UserLoginToken;

        $record['token']                = $token;
        $record['user_id']              = $user_id;
        $record['created_on_date']      = ['__raw' => 'NOW()'];
        $record['ip_address']           = $_SERVER['REMOTE_ADDR'];
        $record['last_accessed_date']   = ['__raw' => 'NOW()'];
        $record['user_agent']           = $_SERVER['HTTP_USER_AGENT'];

        $id = $record->insert();

        $cookie = $id . '|' . $user_id . '|' . $token;
        $mac = hash_hmac('sha256',$cookie,$secret);

        $cookie .= '|'.$mac;

        return data()->setCookie(self::PERM_LOGIN_COOKIE_NAME, $cookie, self::PERM_LOGIN_LENGTH);

    }//makeLoginPermanent



    /**
     * Check if a user has a permanent login token. If so, log them in.
     *
     *
     * @return void
    */
    public function checkForPermanentLoginToken(){

        if(data()->hasCookie(self::PERM_LOGIN_COOKIE_NAME)){

            $cookie = \Data::getCookie(self::PERM_LOGIN_COOKIE_NAME);

            $p = explode('|',$cookie);
    
            $id         = array_shift($p);
            $user_id    = array_shift($p);
            $mac        = array_pop($p);
            $token      = join('|',$p);
    
            $secret = app()->config('AES_KEY256');
            if ($mac !== hash_hmac('sha256', $id . '|' . $user_id . '|' . $token, $secret)) {
                return false;
            }//if
    
            $loginToken = \App\record\UserLoginToken::find(['id' => $id, 'user_id' => $user_id], ['id,user_id,token']);

            if($loginToken !== false && \Crypt::timingSafeCompare($loginToken['token'], $token)) {
    
                session()->set($this->getSessionKey(),$user_id);
                session()->regen();
    
                $this->user_id = $user_id;
                $this->logged_in = true;

                $loginToken['last_accessed_date'] = ['__raw' => 'NOW()'];
                $loginToken->update();

            }//if 

        }//if
    
    }//checkForPermanentLoginToken



    /**
     * Update the current user.
     *
     * @param \App\data_model\User $DataModel The user data model containing the fields to update.
     *
     * @return boolean
    */
    public function updateUser(\App\data_model\User $DataModel){

        return $this->User
            ->update($DataModel->getData())
            ->where('id=?',$this->userId())
            ->finalize();

    }//updateUser



    /**
     * Delete the current user. 
     *
     * @return boolean
    */
    public function deleteUser(){
        return $this->User->delete('id=?',$this->userId());
    }//deleteUser



    /**
     * Change the current users password.
     *
     * @param string $password The new password.
     * @param int $user_id The id of the user.
     *
     * @return boolean
    */
    public function changePassword($password,$user_id = null){

        if($user_id === null){
            $user_id = $this->userId();
        }//if

        return $this->User
            ->update([
                'password' => \Crypt::hash($password),
            ])
            ->where('id=?',$user_id)
            ->finalize();

    }//changePassword



    /**
     * Check that a users email is unique.
     *
     * @param int $user_id The users id.
     * @param string $email The email address.
     *
     * @return int `0` for not in use, `1` for in use
    */
    public function checkUniqueEmail($user_id,$email){

        return $this->User
            ->select('id')
            ->where('email=? AND id<>?', [$email, $user_id])
            ->limit(1)
            ->data()
            ->rowCount();

    }//checkUniqueEmail



}//User
