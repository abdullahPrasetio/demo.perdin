<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class JwtAuth
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
            return redirect('/login');
        }
        try{
            $decoded=JWT::decode($token, $secretKey, ['HS512']);
            $request->user=$decoded->user;
            \View::share('user', $decoded->user);
        }catch(\Exception $e){
            return redirect('/login')->with('error',$e->getMessage());
        }
        return $next($request);
    }
}
