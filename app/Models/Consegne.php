<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consegne extends Model
{
 
    public static function validate($request)
    {
        $request->validate([
        "nome" => "nullable",
        "sigla" => "nullable",
    
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

    public function getNome()
    {
        return $this->attributes['nome'];
    }
    
    public function setNome($nome)
    {
        $this->attributes['nome'] = $nome;
    }

    public function getSigla()
    {
        return $this->attributes['sigla'];
    }
    
    public function setSigla($sigla)
    {
        $this->attributes['sigla'] = $sigla;
    }
}
