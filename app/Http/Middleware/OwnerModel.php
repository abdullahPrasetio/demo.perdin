<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerModel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$resourceName)
    {
        if ($resourceName=="perdins") {
            $id=$request->route('perjalanan_dina');
        }else{
            $id=$request->route($resourceName);
        }
        $modelsUserId=DB::table($resourceName)->find($id)->user_id;
        if ($request->user->unitkerja=="SDM") {
            return $next($request);
        }
        if ($request->user->pegawaiid !=$modelsUserId ) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
