<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $limit=(int)$request->input('limit', 10);
        $current_page=$request->input('page');
        $search=$request->input('search');
        $data=getLocations($search);
        unset($data['http_code']);
        $total=count($data);
        
        $starting_point = ($current_page * $limit) - $limit;

        $data=array_slice($data,$starting_point,$limit,true);
        $data = new LengthAwarePaginator($data, $total,$limit, $current_page,  [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        return ResponseFormatter::success($data);
    }

    
}
