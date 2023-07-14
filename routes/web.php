<?php

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IscrizioneController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ServizioController;
use App\Http\Controllers\SociController;
use App\Http\Controllers\AnagraficheController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */



Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'home']);
Route::get('admin/home', [HomeController::class, 'adminHome'])->middleware('is_admin');

Route::get('superAdmin/home', [HomeController::class, 'superAdminHome'])->middleware('is_admin');
Route::get('/', [HomeController::class, 'index'])->middleware('is_admin');

//usa database per memorizzare dati da javascript
Route::post('salvaChck', [ServizioController::class, 'salvaSelChck']);

Route::controller(AnagraficheController::class)->group(function () {
    Route::get('/anagrafiche', 'home');

    Route::get('/consegne', 'consegne');
    Route::get('/formConsegne', 'formAddConsegne');
    Route::POST('addConsegne', 'store');

    Route::get('/deleteConsegne/{id}', 'delete');
    Route::post('editConsegne', 'edit');
});

Route::controller(ExcelController::class)->group(function () {
    Route::get('/excel_soci', 'index_soci')->middleware('is_admin');
    Route::get('/excel_iscrizioni', 'index_iscrizioni');
    Route::post('/import', 'importSoci');

    Route::get('/export', 'exportSoci');
    Route::get('/exportIscrizione', 'exportIscrizione');
    Route::post('/importIscriz', 'importIscrizione');

});

Route::controller(SociController::class)->group(function () {
    Route::get('/list', 'index')->name('soci.index')->middleware('is_admin');//ok visualizza lista soci
    Route::get('/list/{col}', 'indexOrd')->middleware('is_admin');//ok ordina una colonna in index.blade
    Route::get('changeStatus/{id}', 'changeStatus');//ok cambia lo stato di unn socio Ablilitato/sospeso
    Route::view('formAdd', 'soci.formAdd');//ok crea form per add socio
    Route::POST('add', 'salvasocio');// ok salva nuovo socio nel database
    Route::POST('/paginazione', 'pagine'); // ok imposta numero righe nelle tabelle che hanno la paginazione e il box righe
    Route::delete('deleteSocio/{id}', 'cancellaSocio'); // ok Cancella socio dal database
    Route::get('edit/{id}', 'editSocio');
    Route::post('editSocio', 'update');// ok Aggiorna Socio usato in soci.edit.blade
    Route::get('singolo/{id}', 'singolo'); // ok Visualizza dati singolo socio 
    Route::post('filtro', 'indexFiltro');//ok  Filtra soci per anno join con iscrizione
    Route::view('formFiltroAnno/', 'soci.FiltroAnno'); // ok // filtro anno rinnovo
});

Route::controller(IscrizioneController::class)->group(function () {
    Route::get('iscrizione', 'iscrizioneList');// Lista iscrizioni con edit e ricerca
    Route::get('editIscrizione/{id}', 'showData');// edit iscrizione 
    Route::get('showIscrizione/{id}', 'formIscr'); // Form per aggiungere iscrizione ad un socio
    Route::POST('addIscrizione', 'AddIscrizione'); // anno aggiunge iscrizione
    Route::get('deleteIscrizione/{id}', 'deleteIscrizione');
    Route::get('filtraIscritto', 'filtraIscritto');
    Route::POST('trovaIscritto', 'trovaIscritto');
    Route::get('socio/{id}', 'socioIscrizione');
    // se prima iscrizine
    Route::get('primaIscrizione/{id}', 'primaIscrizione');

});

Route::controller(PdfController::class)->group(function () {
    //usati in view.pdf.pdfFiltroAnno.blaede.php
    Route::post('bollettini_ultimo', 'PdfBollettini');
    Route::post('bollettini_penultimo', 'PdfBollettini');
    //usato da bottone "Bollettini anno" in soci.SociList.blade.php richiama la view pdf.pdfFiltroAnno
    Route::view('bollettini_anno', 'pdf.pdfFiltroAnno');
    //usato da bottone "Bollettini da chckbox" che chiama ajax poi da success in soci.SociList.blade.php
    Route::get('bollettini/{tipo}', 'PdfBollettini');
    // Route::get('bollettini_anno/{tipo}', 'pdf.pdfFiltroAnno');

    //usati in view.pdf.pdfFiltroAnno.blaede.php
    Route::post('etichette_ultimo', 'PdfEtichette');
    Route::post('etichette_penultimo', 'PdfEtichette');
    //usato da bottone "Bollettini anno" in soci.SociList.blade.php richiama la view pdf.pdfFiltroAnno
    Route::view('etichette_anno', 'pdf.PdfFiltroEtichette');
    //usato da bottone "Bollettini da chckbox" che chiama ajax poi da success in soci.SociList.blade.php
    Route::get('etichette/{tipo}', 'PdfEtichette');
    // Route::get('bollettini_anno/{tipo}', 'pdf.pdfFiltroAnno');
});

Route::get('/nonAut', function () {
    return view('nonAutorizzato');
});

//Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name("home.about");
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name("product.index");
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name("product.show");


Route::get('/cart', 'App\Http\Controllers\CartController@index')->name("cart.index");
Route::get('/cart/delete', 'App\Http\Controllers\CartController@delete')->name("cart.delete");
Route::post('/cart/add/{id}', 'App\Http\Controllers\CartController@add')->name("cart.add");

Route::middleware('auth')->group(function () {
    Route::get('/cart/purchase', 'App\Http\Controllers\CartController@purchase')->name("cart.purchase");
    Route::get('/my-account/orders', 'App\Http\Controllers\MyAccountController@orders')->name("myaccount.orders");
});
    
Route::get('/', function () {
    return view('welcome');
});