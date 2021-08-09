<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class JwtGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $secretKey  = env('JWT_SECRET');
        $token=$request->cookie('token');
        if(!$token){
            return $next($request);
        }else{
            try{
                $decoded=JWT::decode($token, $secretKey, ['HS512']);
                $request->user=$decoded->user;
                \View::share('user', $decoded->user);
                return redirect()->back();
            }catch(\Exception $e){
                return $next($request);
            }
        }
    }
}
