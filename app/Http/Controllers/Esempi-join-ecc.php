<?php

namespace App\Http\Controllers;

use App\Models\Iscrizione;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\Console\Helper\TableStyle;


class IscrizioneController extends Controller
{

/*AGGIUNGE COLONNA
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
      $type = 'string';
        $length = 20;
        $fieldName = 'car_tyer';

        Schema::table('iscriziones', function (Blueprint $table) use ($type, $length, $fieldName) {
            $table->$type($fieldName, $length);
        });
*/



/*2 Tabelle

     $users = User::join('posts', 'users.id', '=', 'posts.user_id')
               ->get(['users.*', 'posts.descrption']);

3 tabelle
    $users = User::join('posts', 'posts.user_id', '=', 'users.id')
              ->join('comments', 'comments.post_id', '=', 'posts.id')
              ->get(['users.*', 'posts.descrption']);

condizioni
              $users = User::join('posts', 'posts.user_id', '=', 'users.id')
            ->where('users.status', 'active')
            ->where('posts.status','active')
            ->get(['users.*', 'posts.descrption']);

LEFT
Author::leftJoin('posts', 'posts.author_id', '=', 'authors.id')
      ->select('authors.*')
      ->get();
condizioni
      Author::leftJoin('posts', 'posts.author_id', '=', 'authors.id')
       ->select('authors.*')
       ->where('authors.status', 'active')
       ->where('authors.subscription', 'active')
       ->get();

       RIGHT
       User::rightJoin('city','city.user_id','=','users.id')
          ->select('users.name','city.city_name')
         ->get();

    condizioni
    User::rightJoin('city','city.user_id','=','users.id')
          ->select('users.name','city.city_name')
          ->where('users.status', 'active')
          ->where('city.status', 'active')
         ->get();

// TODO - todo note

or a FIXME note
// FIXME - fix something 

         Partecipazione avanzata di Laravel

Se desideri utilizzare una clausola di stile "where" 
sui tuoi join, puoi utilizzare i  metodi where e  orWhere su un join. 
Invece di confrontare due colonne, questi metodi confronteranno la colonna con un valore:

	
DB::table('users')
        ->join('contacts', function ($join) {
            $join->on('users.id', '=', 'contacts.user_id')
                 ->where('contacts.user_id', '>', 5);
        })
        ->get();
Join di sottoquery di Laravel

Il seguente join è subquery join in laravel:

Add Tag 
	
DB::table('posts')
->select('user_id', DB::raw('MAX(created_at) as last_post_created_at'))
->where('is_published', true)->groupBy('user_id');*/




/*

CREATE TABLE ruolo_secondario (
      ruoli INT NOT NULL, id INT NOT NULL,
      nome VARCHAR(100),
      PRIMARY KEY(ruoli, id)
  )   ENGINE=INNODB;
  
  CREATE TABLE ruoli (
      id INT NOT NULL,
      PRIMARY KEY (id)
  )   ENGINE=INNODB;
  
  CREATE TABLE collegamenti (
      no INT NOT NULL AUTO_INCREMENT,
      anagrafica INT NOT NULL,
      ruolo_secondario_id INT NOT NULL,
      ruoli_id INT NOT NULL,
  
      PRIMARY KEY(no),
      INDEX (anagrafica),
      INDEX (ruoli_id),
  
      FOREIGN KEY (anagrafica, ruolo_secondario_id)
        REFERENCES ruolo_secondario(ruoli, id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
  
      FOREIGN KEY (ruoli_id)
        REFERENCES ruoli(id)
  )   ENGINE=INNODB;
*/

  /*
CREATE TABLE product (
    category INT NOT NULL, id INT NOT NULL,
    price DECIMAL,
    PRIMARY KEY(category, id)
)   ENGINE=INNODB;

CREATE TABLE customer (
    id INT NOT NULL,
    PRIMARY KEY (id)
)   ENGINE=INNODB;

CREATE TABLE product_order (
    no INT NOT NULL AUTO_INCREMENT,
    product_category INT NOT NULL,
    product_id INT NOT NULL,
    customer_id INT NOT NULL,

    PRIMARY KEY(no),
    INDEX (product_category, product_id),
    INDEX (customer_id),

    FOREIGN KEY (product_category, product_id)
      REFERENCES product(category, id)
      ON UPDATE CASCADE ON DELETE RESTRICT,

    FOREIGN KEY (customer_id)
      REFERENCES customer(id)
)   ENGINE=INNODB;

  */
}
