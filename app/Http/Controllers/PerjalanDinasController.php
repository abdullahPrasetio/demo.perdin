<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Perdin;
use App\Models\LogPerdin;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests\PerjalananDinasRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class PerjalanDinasController extends Controller
{
    public function __construct()
    {
        $this->middleware('owner:perdins',['only'=>['show','printPerdin']]);
    }
    public function index(Request $request) 
    {
        $title="Perjalanan Dinas";
        $subtitle="Data Perjalanan Dinas";
        
        return view('perdins.index',["title"=>$title,"subtitle"=>$subtitle]);
    }

    public function create(Request $request)
    {
        $title="Perjalanan Dinas";
        $subtitle="Buat Perjalanan Dinas";
        $locations=getLocations();
        unset($locations['http_code']);
        return view('perdins.create',["title"=>$title,"subtitle"=>$subtitle,'locations'=>$locations]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id'=>'integer|required',
            'lokasi_berangkat'=>'integer|required',
            'lokasi_tujuan'=>'integer|required',
            'tanggal_berangkat'=>'date|required',
            'tanggal_pulang'=>'date|required',
            'tujuan_perdin'=>'string|required',
        ]);
        $data=$request->all();
        $data['unit_kerja']=$request->user->unitkerja;
        $data['durasi']=getDiffDate($request->tanggal_berangkat,$request->tanggal_pulang);
        $data['no_perdin']=getPerdin($request);
        $distanceAllowance=getDistanceAllowance($request->lokasi_berangkat,$request->lokasi_tujuan);
        $data['jarak']=$distanceAllowance['distance'];
        $data['allowance']=$distanceAllowance['allowance'];
        $data['status']="Pending";
        // dd($data['no_perdin']);
        $perdin=Perdin::create($data);
        $log=LogPerdin::create([
            'perdin_id'=>$perdin->id,
            'user_id'=>$request->user->pegawaiid,
            'name'=>$request->user->nama,
            'nip'=>$request->user->nip,
            'jabatan'=>$request->user->jabatan,
            'activity'=>"Pengajuan Perjalanan Dinas"
        ]);

        return redirect()->route('perjalanan-dinas.index')->with('success',"Pengajuan berhasil dibuat");
    }

    public function show($id)
    {
        $perdin=Perdin::with(['log'])->findOrFail($id);
        $title="Perjalanan Dinas";
        $subtitle="Buat Perjalanan Dinas";
        return view('perdins.show',["title"=>$title,"subtitle"=>$subtitle,'perdin'=>$perdin]);
    }

    public function changeStatus(Request $request,$id,$status) 
    {
        $perdin=Perdin::find($id);
        if ($request->user->unitkerja!="SDM") {
            return abort(403, 'Unauthorized action.');
        }
        $perdin->status=$status;
        if ($status=="Approved") {
            $perdin->approve_id=$request->user->pegawaiid;
        }
        $perdin->save();
        $activity=null;
        if ($status=="Rejected") {
            $activity=$request->alasan;
        }
        $log=LogPerdin::create([
            'perdin_id'=>$perdin->id,
            'user_id'=>$request->user->pegawaiid,
            'name'=>$request->user->nama,
            'nip'=>$request->user->nip,
            'jabatan'=>$request->user->jabatan,
            'activity'=>"Mengubah status menjadi ".$status." ".$activity
        ]);

        return redirect()->back()->with('success',"Success change status to ".$status);
    }

    public function getDataTable(Request $request)
    {
        if ($request->ajax()) {
            $limit=(int)$request->input('limit', 10);
            $current_page=$request->input('page') ?? 1;
            $search=$request->input('search');
            $perdin=Perdin::query();
            if ($request->user->unitkerja!="SDM") {
                $perdin->where('user_id',$request->user->pegawaiid);
            }
            $data=$perdin->latest()->paginate($limit);
            // dd($data);
            return view('perdins.table',compact('data'))->render();
        }
    }

    public function printPerdin(Request $request,$id)
    {
        Date::setLocale('id');
        $perdin=Perdin::with(['log'])->findOrFail($id);

        if ($request->user->unitkerja!="SDM") {
            if ($request->user->pegawaiid !=$perdin->user_id ) {
                return abort(403, 'Unauthorized action.');
            }
        }
        $title="Perjalanan Dinas Print ".$perdin->no_perdin;
        $pdf = PDF::loadView('perdins.print_detail', ['perdin'=>$perdin,'title'=>$title,'datePrint' => Date::now()->format('l j F Y'),]);
        PDF::setOptions(['isPhpEnabled' => true]);
        $pdf->setPaper('A4', 'landscape');
        $now = date('Y-m-d');
        // dd($pdf);
        // return view('perdins.print_detail',compact('perdin'));
        return $pdf->stream();
    }
}
