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
     
        "anno" => "required:date",
        "nome" => "nullable",
        "cognome" => "nullable",
        ]);
    }

       /**

     * Get the post that owns the comment.

     *  

     * Syntax: return $this->belongsTo(Post::class, 'foreign_key', 'owner_key');

     *

     * Example: return $this->belongsTo(Post::class, 'post_id', 'id');

     * 

     */

    

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

    public function getDescription()
    {
        return $this->attributes['description'];
    }
    
    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }
 
 
   public function getNome()
    {
        return $this->attributes['nome'];
    }
    
    public function setNome($nome)
    {
        $this->attributes['nome'] = $nome;
    }
    public function getCognome()
    {
        return $this->attributes['cognome'];
    }
    
    public function setCognome($cognome)
    {
        $this->attributes['nome'] = $cognome;
    }
 

    public function getAnno()
    {
        return $this->attributes['anno'];
    }
    
    public function setAnno($anno)
    {
        $this->attributes['anno'] = $anno;
    }

 
    public function socis()
    {
        return $this->hasMany(Soci::class);
    }
    
   


    
}

