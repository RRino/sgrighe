<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Param_bollettini extends Model
{
    public static function validate($request)
    {
      
        $request->validate([
        "causale" => "required",
        "prezzo" => "required",
        "description" => "nullable",
        ]);
    }

   
  
   
    public function getId()
    {
        return $this->attributes['id'];
    }
    
    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getCausale()
    {
        return $this->attributes['causale'];
    }
    
    public function setCausale($causale)
    {
        $this->attributes['causale'] = $causale;
    }

    public function getPrezzo()
    {
        return $this->attributes['prezzo'];
    }
    
    public function setPrezzo($cognome)
    {
        $this->attributes['Prezzo'] = $prezzo;
    }

    

    public function getDescription()
    {
        return $this->attributes['description'];
    }
    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }


    public function getCreated_at()
    {
        return $this->attributes['created_at'];
    }
    public function setCreated_at($created_at)
    {
        $this->attributes['created_at'] = $created_at;
    }


    public function getUpdated_at()
    {
        return $this->attributes['updated_at'];
    }
    public function setUpdated_at($updated_at)
    {
        $this->attributes['updated_at'] = $updated_at;
    }


 
  
 
}

