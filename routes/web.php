<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PerjalanDinasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show')->middleware('jwt.guest');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('jwt.custom.auth')->group(function () {
    Route::get('home', HomeController::class)->name('home');
    
    Route::middleware(['admin'])->group(function () {
        // Location
        Route::get('location', [LocationController::class,'index'])->name('location');
        Route::get('location-table', [LocationController::class,'getDataTable'])->name('location.table');
        
        // User
        Route::get('user', [UserController::class,'index'])->name('user');
        Route::get('user-table', [UserController::class,'getDataTable'])->name('user.table');
        
    });
    // Perjalanan DInas
    Route::get('perjalanan-dinas-table', [PerjalanDinasController::class,'getDataTable'])->name('perjalanan-dinas.table');
    Route::get('perjalanan-dinas-print/{perjalanan_dina}', [PerjalanDinasController::class,'printPerdin'])->name('perjalanan-dinas.print');
    Route::post('perjalanan-dinas/change-status/{id}/{status}', [PerjalanDinasController::class,'changeStatus'])->name('perjalanan-dinas.change-status');
    Route::resource('perjalanan-dinas', PerjalanDinasController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('test',function(){
    foreach(range(1, 100) as $number) {
        if ($number % 3 != 0 && $number % 5 != 0) {
            echo $number . '<br>';
            continue;
          }
          if ($number % 3 == 0) echo 'Mam';
          if ($number % 5 == 0) echo 'pu';
          echo '<br>';
    }
});
Route::get('test2',function(){
    $array=["bandung"=>"Jawa Barat","Semarang"=>"Jawa Tengah","Cirebon"=>"Jawa Barat"];
    $data=[];
    foreach($array as $key=>$value){
        $data[$value][]=$key;
    }
    return $data;
});

Route::get('test3',function(){
    $array=[1,[10,4,[50,25],3],12,[3,21,8]];
    
    $iterasi=new RecursiveIteratorIterator(new RecursiveArrayIterator($array));
    $total=0;
    foreach($iterasi as $v) {
        $total+=$v;
    }
    return $total;
});

Route::get('test4',function(){
    $array=[21,4,43,8];
    function myCompare($x, $y)
    {
        $xy = $y.$x;
        
        $yx = $x.$y;
        
        return strcmp($xy, $yx) > 0 ? 1: 0;
    }
    function printLargest($arr)
    {
        usort($arr, "myCompare");
    
        for ($i = 0; $i < count($arr) ; $i++ )
            echo $arr[$i];
    }
 
    $total=printLargest($array);
    return $total;
});