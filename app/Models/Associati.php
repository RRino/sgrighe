<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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


    public function ruolispecb() :BelongsTo
    {
        return $this->belongsTo(Ruolispec::class);
    }
  
    public function ruolispecm() : HasMany
    {
        return $this->hasMany(Ruolispec::class);
    }

    public function ruolispecmm() 
    {
        return $this->belongsToMany(Ruolispec::class);
    }

    public function dateiscr() 
    {
        return $this->belongsTo(Dateiscr::class);
    }
  
    public function dateiscr_many() 
    {
        return $this->hasMany(Dateiscr::class);
    }
  

    public function consegnem() 
    {
        return $this->hasMany(Consegne::class);
    }

    public function consegne() 
    {
        return $this->belongsTo(Consegne::class);
    }
}


