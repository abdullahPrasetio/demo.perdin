<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class PerjalananDinasController extends Controller
{
    public function getAllData(Request $request)
    {
        $id_berangkat=$request->input('id_berangkat',345);
        $id_tujuan=$request->input('id_tujuan',345);
        $lokasi_berangkat=getLocation($id_berangkat);
        $lokasi_tujuan=getLocation($id_tujuan);
        if ($lokasi_tujuan['lon']==null||$lokasi_tujuan['lat']==null) {
            $distance=0;
        }else{
            $distance=getDistance($lokasi_berangkat,$lokasi_tujuan);
        }
        $allowance=getAllowance($lokasi_berangkat,$lokasi_tujuan,$distance);
        $distance=$distance==0?"Luar Negeri":$distance;
        return ResponseFormatter::success(['distance'=>$distance,'allowance'=>$allowance]);  
    }

}
