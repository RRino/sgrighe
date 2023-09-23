<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consegne extends Model
{
 
    use HasFactory;

    public function consegnem(){
        return $this->hasMany(Associati::class);
    }



    public function consegneb()
    {
        return $this->belongsTo(Associati::class);
    }
}