<?php

Router::multi('/login',Array(
    'get'   => 'App\controller\UserPublic@getLogin',
    'post'  => 'App\controller\UserPublic@postLogin',
));

Router::get('/logout',function(){

    if(\App::with('User')->loggedIn()){
        \App::with('User')->logout();
    }//if

    \View::redirect('/login');

});


Router::multi('/signup',Array(
    'get'   => 'App\controller\UserPublic@getSignUp',
    'post'  => 'App\controller\UserPublic@postSignUp',
));

Router::multi('/forgot-password',Array(
    'get'   => 'App\controller\UserPublic@getForgotPassword',
    'post'  => 'App\controller\UserPublic@postForgotPassword',
));

Router::get(\App\service\User::ACTIVATION_SLUG . '{token}','App\controller\UserPublic@getActivateAccount')
    ->where('token','all');

Router::multi(\App\service\User::PW_RESET_SLUG . '{token}',Array(
    'get'   => 'App\controller\UserPublic@getPasswordReset',
    'post'  => 'App\controller\UserPublic@postPasswordReset',
))->where('token','all');

Router::auth(\App\service\User::SESSION_KEY,'/login')->filter('/user/{*}',function(){

    Router::filter('/user/{*}')->children(Array(

        '' => Array(
            'type' => 'get',
            'action' => 'App\controller\User@getIndex',
        ),

        'edit' => Array(
            'type' => 'multi',
            'action' => Array(
                'get'   => 'App\controller\User@getEdit',
                'post'  => 'App\controller\User@postEdit',
            ),
            'children' => Array(
                '/password' => Array(
                    'type'      => 'post',
                    'action'    => 'App\controller\User@postEditPassword',
                ),
            ),
        ),

    ));

});
