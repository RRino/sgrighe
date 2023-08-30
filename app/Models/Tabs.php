<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabs extends Model
{
    use HasFactory;
    public function anagraficas()

    {

        return $this->hasMany(Anagrafica::class);

    }
}
