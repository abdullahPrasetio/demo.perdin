<?php

namespace App\Http\Controllers;

use DateTimeImmutable;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request) 
    {
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required'
        ]);
        $login=loginWebservice($request->username,$request->password);
        if(array_key_exists('status',$login)){
            if ($login['status']=='error') {
                return redirect()->route('login.show')->with("success",$login['message']);
            }
        }
        $result=$login['data']==="true"? true : false;
        if ($result==false) {
            return redirect()->route('login.show')->with("success","Username or password false");
        }
        $user=getUserProfile($request->username);
        unset($user['http_code']);
        $secretKey  = env('JWT_SECRET');
        $issuedAt   = new DateTimeImmutable();
        $expire     = $issuedAt->modify('+30 minutes')->getTimestamp(); 
        $data = [
            'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated                     // Issuer
            'nbf'  => $issuedAt->getTimestamp(),         // Not before
            'exp'  => $expire,                           // Expire
            'user' => $user,                     // User name
        ];
        $token=JWT::encode(
            $data,
            $secretKey,
            'HS512'
        );
        return redirect('/home')->withCookie(cookie('token',$token,30000))->with('success','Success login!, Welcome '.$user['nama']);
    }

    public function logout(Request $request)
    {
        $cookie = \Cookie::forget('token');
        return redirect()->route('login.show')->withCookie($cookie)->with("success","Succes logout");
    }
}
