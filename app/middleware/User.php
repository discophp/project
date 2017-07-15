<?php
namespace App\middleware;


class User {

    /**
     * @var \App\service\User $user
     */
    private $user;

    public function __construct(\App\service\User $user) {
        $this->user = $user;
    }

    public function handle($request, $next, $method, $redirectTo = null){

        app()->with('Log')->info('In user middleware : ' . $method);

        if($method === 'loggedIn'){
            if(!$this->user->loggedIn()){
                redirect($redirectTo ?: '/login');
            }
        } else if($method === 'notLoggedIn'){
            if($this->user->loggedIn()){
                redirect($redirectTo ?: '/');
            }
        }

        return $next($request);

    }

}