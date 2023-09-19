<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Associati extends Model
{
    use HasFactory;
    public function anagrafica(): BelongsTo
    {
        return $this->belongsTo(Anagrafica::class);
    }

    public function ruoli() 
    {
        return $this->belongsTo(Ruoli::class);
    }


    public function ruoli_spec() 
    {
        return $this->belongsTo(Ruoli_spec::class);
    }
  
    public function ruoli_specm() 
    {
        return $this->hasMany(Ruoli_spec::class);
    }

    public function ruoli_specmm() 
    {
        return $this->belongsToMany(Ruoli_spec::class);
    }

    public function dateiscr() 
    {
        return $this->belongsTo(Dateiscr::class);
    }
  
    public function dateiscr_many() 
    {
        return $this->hasMany(Dateiscr::class);
    }
  
}


