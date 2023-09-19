<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruoli_spec extends Model
{
    use HasFactory;

    public function ruoli(): BelongsTo
    {
        return $this->belongsTo(Associoati::class);
    }

    public function ruolim()
    {
        return $this->hasMany(Associati::class);
    }

    public function ruoli_specmm() 
    {
        return $this->belongsToMany(Associati::class);
    }
}
