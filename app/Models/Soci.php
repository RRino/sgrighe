<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Soci extends Model
{
    public static function validate($request)
    {
      
        $request->validate([
        "nome" => "required|max:255",
        "cognome" => "required|max:255",
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
        "tipo_socio" => "required",
        "published" => "required|boolean",
        "description" => "nullable",
        "ultimo" => "nullable",
        "penultimo" => "nullable",
        "terultimo" => "nullable",
        ]);
    }

    /*

    Una relazione uno a molti è similare alla precedente ma permette di associare
     un particolare modello con una lista di altri modelli che possono avere
      solamente un padre. L'esempio di prima potrebbe ritornare valido, 
      se supponiamo che un utente può avere diversi indirizzi
       (per esempio di spedizione, di fatturazione, di residenza...).

    Per definire questa relazione creiamo il metodo addresses invocando il metodo
     hasMany.


   public function addresses() {
        return $this->hasMany('App\Address');
    }

    User::find(123)->addresses

    Sfruttando invece l'oggetto che rappresenta la relazione è possibile effettuare filtri:

    User::find(123)->addresses()->where('city', 'Milano')->get()

    Per definire la relazione inversa possiamo utilizzare il metodo belongsTo 
    nello stesso modo analizzato per le relazioni uno a uno.
    */
/*
    public function items()
    {
        return $this->hasMany(Iscrizione::class)->orderBy('anno', 'desc');;
    }
    
    public function getItems()
    {
        return $this->items;//;
    }

*/


  
public function iscrizione()
{
    return $this->hasOne('App\Iscrizione');
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


    public function getTipo_socio()
    {
        return $this->attributes['tipo_socio'];
    }
    public function setTipo_socio($tipo_socio)
    {
        $this->attributes['tipo_socio'] = $tipo_socio;
    }

    public function getConsegna()
    {
        return $this->attributes['consegna'];
    }
    public function setConsegna($consegna)
    {
        $this->attributes['consegna'] = $consegna;
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


 
  
 
}

