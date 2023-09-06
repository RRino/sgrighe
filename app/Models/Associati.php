<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Associati extends Model
{
    use HasFactory;

    public function getAnagrafica(){
        return $this->hasOne(Anagrafica::class);
    }

    public function anagrafica(): BelongsTo
    {
        return $this->belongsTo(Anagrafica::class);
    }
}


