<?php

namespace App\Http\Middleware;
use Closure;

use Illuminate\Support\Facades\Auth;

class AuthenticateApi
{

    public function handle($request, Closure $next)
    {



        if (Auth::guard('api')->check()) {
            Auth::shouldUse("api");
            $request->user()->last_login=date("Y-m-d H:i:s");
            $request->user()->save();
             return $next($request);

        }


        $data['msg'] = 'UnAuthenticated';
        return response($data, 401);
    }



}