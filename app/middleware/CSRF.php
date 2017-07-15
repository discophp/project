<?php
namespace App\middleware;
use \Disco\exceptions\HttpError;


class CSRF {

    public function handle($request, $next){
        if(!data()->validateCSRFToken()){
            throw new HttpError('Your request was invalid', 403);
        }
        return $next($request);
    }

}