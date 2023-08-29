<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Iscrizione extends Model
{
   
    public static function validate($request)
    {
        $request->validate([
     
        "socio_id" => "nullable",

        ]);
    }

       /**

       */

     public $timestamps = false;

    //------------- attributi ------------
    public function getId()
    {
        return $this->attributes['id'];
    }
    
    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

 
    public function getSoci_id()
    {
        return $this->attributes['socio_id'];
    }
    
    public function setSoci_id($socio_id)
    {
        $this->attributes['socio_id'] = $socio_id;
    }

   
 
    public function socis()
    {
        return $this->hasMany(Soci::class);
    }
    
   


    
}

