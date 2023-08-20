<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Param_etichette extends Model
{
    public static function validate($request)
    {
        $request->validate([
     
        "nome" => "required",
        "spazio_sopra" => "required",
        "altezza" => "required",
        "larghezza" => "required",
        "numero_orrizontale" => "required",
        "numero_verticale" => "required",
        "description" => "nullable",
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


    public function getSpazio_sopra()
    {
        return $this->attributes['spazio_sopra'];
    }
    
    public function setSpazio_sopra($spazio_sopra)
    {
        $this->attributes['spazio_sopra'] = $spazio_sopra;
    }
 
    public function getAltezza()
    {
        return $this->attributes['altezza'];
    }
    
    public function setAltezza($altezza)
    {
        $this->attributes['altezza'] = $altezza;
    }


    public function getLarghezza()
    {
        return $this->attributes['larghezza'];
    }
    
    public function setLarghezza($larghezza)
    {
        $this->attributes['larghezza'] = $larghezza;
    }


    public function getNumero_orrizontale()
    {
        return $this->attributes['numero_orrizontale'];
    }
    
    public function setNumero_orrizontale($numero_orrizontale)
    {
        $this->attributes['numero_orrizontale'] = $numero_orrizontale;
    }


    public function getNumero_verticale()
    {
        return $this->attributes['numero_verticale'];
    }
    
    public function setNumero_verticale($numero_verticale)
    {
        $this->attributes['numero_verticale'] = $numero_verticale;
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
   
    
}
