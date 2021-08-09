<?php

use App\Models\Perdin;
use Illuminate\Support\Facades\Http;


function loginWebservice($username, $password)
{
    $url = env('URL_SERVICE') . '/api/auth/login?username='.$username.'&password='.$password;

    try {
        // $response = Http::timeout(10)->post($url);
        $response=Http::post($url);
        $data['http_code'] = $response->getStatusCode();
        $data['data']=$response->getBody()->read(5);
        return $data;
    } catch (\Throwable $th) {
        return [
            'status' => 'error',
            'http_code' => 500,
            'message' => $th->getMessage(),
            'message2'=>'service customer unavailable'
        ];
    }
}

function getUser($nama=null,$unitkerja=null,$username=null)
{
    $url = env('URL_SERVICE') . '/api/pegawai/list';

    try {
        $response = Http::timeout(60)->get($url,['nama'=>$nama,'unitkerja'=>$unitkerja,'username'=>$username]);
        $data = $response->json();
        $data['http_code'] = $response->getStatusCode();
        return $data;
    } catch (\Exception $th) {
        return [
            'status' => 'error',
            'http_code' => 500,
            'message' => $th->getMessage(),
        ];
    }
}

function getUserProfile($username)
{
    $url = env('URL_SERVICE') . '/api/pegawai/username/'.$username;

    try {
        $response = Http::timeout(10)->get($url);
        $data = $response->json();
        $data['http_code'] = $response->getStatusCode();
        return $data;
    } catch (\Exception $th) {
        return [
            'status' => 'error',
            'http_code' => 500,
            'message' => $th->getMessage(),
        ];
    }
}

function getUserById($id)
{
    $url = env('URL_SERVICE') . '/api/pegawai/'.$id;

    try {
        $response = Http::timeout(10)->get($url);
        $data = $response->json();
        $data['http_code'] = $response->getStatusCode();
        return $data;
    } catch (\Exception $th) {
        return [
            'status' => 'error',
            'http_code' => 500,
            'message' => $th->getMessage(),
        ];
    }
}

function getLocations($nama=null)
{
    $url = env('URL_SERVICE') . '/api/lokasi/list';

    try {
        $response = Http::timeout(60)->get($url,['nama'=>$nama]);
        $data = $response->json();
        $data['http_code'] = $response->getStatusCode();
        return $data;
    } catch (\Exception $th) {
        return [
            'status' => 'error',
            'http_code' => 500,
            'message' => $th->getMessage(),
        ];
    }
}

function getLocation($id=null)
{
    $url = env('URL_SERVICE') . '/api/lokasi/'.$id;

    try {
        $response = Http::timeout(60)->get($url);
        $data = $response->json();
        $data['http_code'] = $response->getStatusCode();
        return $data;
    } catch (\Exception $th) {
        return [
            'status' => 'error',
            'http_code' => 500,
            'message' => $th->getMessage(),
        ];
    }
}

// Cek jarak
function getDistanceBetween($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Mi') 
{ 
	$theta = $longitude1 - $longitude2; 
	$distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)))  + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
	$distance = acos($distance); 
	$distance = rad2deg($distance); 
	$distance = $distance * 60 * 1.1515; 
	switch($unit) 
	{ 
		case 'Mi': break; 
		case 'Km' : $distance = $distance * 1.609344; 
	} 
	return (round($distance,2)); 
}

function getDistance($lokasi_berangkat,$lokasi_tujuan){
    return getDistanceBetween($lokasi_berangkat["lat"],$lokasi_berangkat['lon'],$lokasi_tujuan['lat'],$lokasi_tujuan['lon'],"Km");
}

function getAllowance($lokasi_berangkat,$lokasi_tujuan,$distance)
{
    $allowance=0;
    if ($distance>60) {
        if ($lokasi_berangkat['provinsi']==$lokasi_tujuan['provinsi']) {
            $allowance=200000;
        }
        if ($lokasi_berangkat['provinsi']!=$lokasi_tujuan['provinsi']&&$lokasi_berangkat['pulau']==$lokasi_tujuan['pulau']) {
            $allowance=250000;
        }
        if ($lokasi_berangkat['pulau']!=$lokasi_tujuan['pulau']) {
            $allowance=300000;
        }
    }

    if ($lokasi_berangkat['negara']!=$lokasi_tujuan['negara']) {
        $allowance=50*14500;
    }

    return $allowance;
}

function getRomawi($bln){
    switch ($bln){
        case 1: 
            return "I";
            break;
        case 2:
            return "II";
            break;
        case 3:
            return "III";
            break;
        case 4:
            return "IV";
            break;
        case 5:
            return "V";
            break;
        case 6:
            return "VI";
            break;
        case 7:
            return "VII";
            break;
        case 8:
            return "VIII";
            break;
        case 9:
            return "IX";
            break;
        case 10:
            return "X";
            break;
        case 11:
            return "XI";
            break;
        case 12:
            return "XII";
            break;
    }
}

function getDiffDate($awal,$akhir){
    $awal=new DateTime($awal);
    $akhir=new DateTime($akhir );
    $d = $akhir->diff($awal)->days + 1;
    return $d;
}

function getPerdin($request) {
    $tahun=date("Y");
    $bulan = getRomawi(date('m'));
    $latest = Perdin::where('unit_kerja',$request->user->unitkerja)->latest()->first();
    $transactionAll = Perdin::where('unit_kerja',$request->user->unitkerja)->get();
    if ($transactionAll->count() == 0) {
        $id = 1;
    } else {
        $no_perdin = $latest->no_perdin;
        $array = explode("/",$no_perdin);
        if ($bulan == $array[1]) {
            (int)$id = $array[2];
            ++$id;
        } else {
            $id = 1;
        }
    }
    return $tahun .'/'.$bulan.'/'. sprintf("%04s", $id).'/'.$request->user->unitkerja;
}

function getDistanceAllowance($id_berangkat,$id_tujuan){
    $lokasi_berangkat=getLocation($id_berangkat);
    $lokasi_tujuan=getLocation($id_tujuan);
    if ($lokasi_tujuan['lon']==null||$lokasi_tujuan['lat']==null) {
        $distance=0;
    }else{
        $distance=getDistance($lokasi_berangkat,$lokasi_tujuan);
    }
    $allowance=getAllowance($lokasi_berangkat,$lokasi_tujuan,$distance);
    return collect(['distance'=>$distance, 'allowance'=>$allowance]);
}


function formatRupiah($angka)
{
    return "Rp." . number_format((float)$angka, 0, ',', '.');
}

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil. " Rupiah";
}