<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dateiscr extends Model
{
    use HasFactory;

    public function date_specm(){
        return $this->hasMany(Associati::class);
    }



    public function date_specb()
    {
        return $this->belongsTo(Associati::class);
    }
}
