<?php

router()
    ->middleware(function($request, $next) {
        \Log::instance()->info('Hey the middleware on the router works!');
        return $next($request);
    })
    ->controller('UserPublic')
    ->multi('/login',[
        'get'   => 'getLogin',
        'post'  => 'postLogin',
    ]);

router()->get('/logout',function(){

    if(app()->with('User')->loggedIn()){
        app()->with('User')->logout();
    }//if

    redirect('/login');

});

router()
    ->middleware('user:notLoggedIn')
    ->controller('UserPublic')
    ->group(function() {

        router()->multi('/signup', [
            'get'   => 'getSignUp',
            'post'  => 'postSignUp',
        ]);

        router()
            ->multi('/forgot-password', [
                'get'   => 'getForgotPassword',
                'post'  => 'postForgotPassword',
            ])
            ->name('user.forgot-password');

        router()
            ->get(\App\service\User::ACTIVATION_SLUG . '{token}','getActivateAccount')
            ->name('user.activation');

        router()
            ->multi(\App\service\User::PW_RESET_SLUG . '{token}', [
                'get'   => 'getPasswordReset',
                'post'  => 'postPasswordReset',
            ])
            ->name('user.password-reset');


    });

router()
    ->middleware('user:loggedIn')
    ->filter('/user/{*}', function(){
        router()
            ->controller('User')
            ->group(function(){

                router()
                    ->get('', 'getIndex')
                    ->name('user.index');

                router()
                    ->multi('edit', [
                        'get' => 'getEdit',
                        'post' => 'postEdit',
                    ])
                    ->name('user.edit');

                router()
                    ->post('edit/password', 'postEditPassword')
                    ->name('user.edit.password');

            });
    });
