<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $title="Location";
        $subtitle="Data Location";
        
        return view('locations.index',["title"=>$title,"subtitle"=>$subtitle]);
    }

    public function getDataTable(Request $request)
    {
        if ($request->ajax()) {
            $limit=(int)$request->input('limit', 10);
            $current_page=$request->input('page') ?? 1;
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
            return view('locations.table',compact('data'))->render();
        }
    }
}
