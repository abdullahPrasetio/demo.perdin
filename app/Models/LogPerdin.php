<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPerdin extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function perdin()
    {
        return $this->belongsTo(Perdin::class,'id');
    }
}
