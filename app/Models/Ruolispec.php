<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruolispec extends Model
{
    use HasFactory;

    public function ruolispecb()
    {
        return $this->belongsTo(Associati::class);
    }

    public function ruolispecm()
    {
        return $this->hasMany(Associati::class);
    }

    public function ruolispecmm() 
    {
        return $this->belongsToMany(Associati::class);
    }
}
