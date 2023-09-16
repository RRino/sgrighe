<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruoli extends Model
{
    use HasFactory;

    public function ruoli_specm(){
        return $this->hasMany(Associati::class);
    }



    public function ruoli_specb()
    {
        return $this->belongsTo(Associati::class);
    }
}


