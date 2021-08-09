<?php

namespace App\Providers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Auth::viaRequest('custom-jwt', function ($request) {
        //     $secretKey  = env('JWT_SECRET');
        //     $token=$request->cookie('token');
        
        //     if ($token && strlen($token) > 0) {
        //         try {
        //             $user = JWT::decode($token, $secretKey, ['HS512']);
        //             dd($user);
        //             if (!$user) throw new \Exception;
        //         } catch (\Exception $e) {
        //             return null;
        //         }
        
        //         return $user->user;
        //     }
        
        //     return null;
        // });
        //
    }
}
