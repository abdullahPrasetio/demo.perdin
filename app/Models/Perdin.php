<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perdin extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function getLokasiBerangkatNameAttribute()
    {
        return "Kota Bandung";
    }

    public function getLokasiTujuanNameAttribute()
    {
        return getLocation($this->lokasi_tujuan)['nama'];
    }

    public function getPembuatAttribute()
    {
        if ($this->user_id===null) {
            $nama=null;
            $nip=null;
            $jabatan=null;
        }else{
            $user=getUserById($this->user_id);
            $nama=$user['nama'];
            $nip=$user['nip'];
            $jabatan=$user['jabatan'];
        }
        return collect(['nama'=>$nama, 'nip'=>$nip,'jabatan'=>$jabatan]);
    }

    public function getApproveByAttribute()
    {
        if ($this->approve_id===null) {
            $nama=null;
            $nip=null;
            $jabatan=null;
        }else{
            $user=getUserById($this->approve_id);
            $nama=$user['nama'];
            $nip=$user['nip'];
            $jabatan=$user['jabatan'];
        }
        return collect(['nama'=>$nama, 'nip'=>$nip,'jabatan'=>$jabatan]);
    }

    public function getTotalAllowanceAttribute()
    {
        return $this->allowance*$this->durasi;
    }

    public function log()
    {
        return $this->hasMany(LogPerdin::class);
    }
}
