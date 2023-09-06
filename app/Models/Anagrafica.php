<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anagrafica extends Model
{
    public static function validate($request)
    {
      
        $request->validate([
        "per_soc" => "required",
        "nome" => "required|max:255",
        "cognome" => "nullable",
        "indirizzo" => "required",
        "cap" => "required",
        "localita" => "required",
        "comune" => "required",
        "sigla_provincia" => "required",
        "email" => "required|email",
        "pec" => "nullable",
        "codice_fiscale" => "nullable",
        "partita_iva" => "nullable",
        "telefono" => "nullable",
        "cellulare" => "nullable",
        "per_soc" => "nullable",
        "published" => "required|boolean",
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
        $this->attributes['cognome'] = $cognome;
    }

    public function getIndirizzo()
    {
        return $this->attributes['indirizzo'];
    }
    
    public function setIndirizzo($indirizzo)
    {
        $this->attributes['indirizzo'] = $indirizzo;
    }

    public function getAssociati()
    {
        return $this->hasOne(Associati::class);
    }

    public function associati(): BelongsTo
    {
        return $this->belongsTo(Anagrafica::class);
    }

    public function getCap()
    {
        return $this->attributes['cap'];
    }
    public function setCap($cap)
    {
        $this->attributes['cap'] = $cap;
    }


    public function getLocalita()
    {
        return $this->attributes['localita'];
    }
    public function setLocalita($localita)
    {
        $this->attributes['localita'] = $localita;
    }
 


    public function getComune()
    {
        return $this->attributes['comune'];
    }
    public function setComune($comune)
    {
        $this->attributes['comune'] = $comune;
    }



    public function getSigla_provincia()
    {
        return $this->attributes['sigla_provincia'];
    }
    public function setSigla_Provincia($sigla_provincia)
    {
        $this->attributes['sigla_provincia'] = $sigla_provincia;
    }

    public function getEmail()
    {
        return $this->attributes['email'];
    }
    public function setEmail($email)
    {
        $this->attributes['email'] = $email;
    }



    public function getPec()
    {
        return $this->attributes['pec'];
    }
    public function setPec($pec)
    {
        $this->attributes['pec'] = $pec;
    }



    public function getCodice_fiscale()
    {
        return $this->attributes['codice_fiscale'];
    }
    public function setCodice_fiscale($codice_fiscale)
    {
        $this->attributes['codice_fiscale'] = $codice_fiscale;
    }



    public function getPartita_iva()
    {
        return $this->attributes['partita_iva'];
    }
    public function setPartita_iva($partita_iva)
    {
        $this->attributes['partita_iva'] = $partita_iva;
    }



    public function getTelefono()
    {
        return $this->attributes['telefono'];
    }
    public function setTelefono($telefono)
    {
        $this->attributes['telefono'] = $telefono;
    }


    public function getCellulare()
    {
        return $this->attributes['cellulare'];
    }
    public function setCellulare($cellulare)
    {
        $this->attributes['cellulare'] = $cellulare;
    }


    public function getTper_soc()
    {
        return $this->attributes['per_soc'];
    }
    public function setTper_soc($per_soc)
    {
        $this->attributes['per_soc'] = $per_soc;
    }


 
    public function getPublished()
    {
        return $this->attributes['published'];
    }
    public function setPublished($published)
    {
        $this->attributes['published'] = $published;
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

    public function anagraficas()

    {

        return $this->belongsTo(Tabs::class);

    }
}
