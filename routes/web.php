<?php

use App\Http\Controllers\AnagraficheController;
use App\Http\Controllers\ConsegneController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IscrizioneController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServizioController;
use App\Http\Controllers\SociController;
use App\Http\Controllers\IlTuoEnteController;
use App\Http\Controllers\FileController;

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

Route::get('/nonAut', function () {
    return view('nonAutorizzato');
});

// -------------------- Route Libro Laravel-------------------------
Route::get('/index', 'App\Http\Controllers\HomeController@index')->name("home.index");
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

Route::middleware('admin')->group(function () {
    Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");
    Route::get('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@index')->name("admin.product.index");
    Route::post('/admin/products/store', 'App\Http\Controllers\Admin\AdminProductController@store')->name("admin.product.store");
    Route::delete('/admin/products/{id}/delete', 'App\Http\Controllers\Admin\AdminProductController@delete')->name("admin.product.delete");
    Route::get('/admin/products/{id}/edit', 'App\Http\Controllers\Admin\AdminProductController@edit')->name("admin.product.edit");
    Route::put('/admin/products/{id}/update', 'App\Http\Controllers\Admin\AdminProductController@update')->name("admin.product.update");
});
// ------------------- Fine libro -------------------

Route::get('superAdmin/home', [HomeController::class, 'superAdminHome'])->middleware('is_admin');
//Route::get('/', [HomeController::class, 'index'])->middleware('is_admin');
Route::get('home', [HomeController::class, 'home'])->name('home');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('admin/super', [HomeController::class, 'adminHome'])->name('admin.super')->middleware('is_admin');

Route::controller(ServizioController::class)->group(function () {
//usa database per memorizzare dati da javascript
    Route::post('salvaChck', 'salvaSelChck');
    Route::post('salvaChck_del', 'salvaSelChck_selSocio');
    Route::get('pref_etichette', 'preferenze_etichette');
    Route::get('pref_bollettini', 'preferenze_bollettini');
    
    Route::post('param_bollettini',  'editParamBollettini');
    Route::post('param_etichette', 'editParamEtichette');
});

Route::controller(AnagraficheController::class)->group(function () {
      
Route::get('/anagrafiche/{tab?}', 'show')->name('show');
    
/*
Route::get('/file', 'list_file');
Route::post('/uploadFile', 'uploadFile')->name('uploadFile');
Route::post('download','fordownload')->name('down');
//for displaying PDF
Route::get('/display_img','index');
*/

    Route::get('/anagrafiche', 'anagrafica')->name('anagrafica');
    Route::get('/formAnagrafica', 'formAddAnagrafica');
    Route::POST('addAnagrafica', 'store');
    Route::get('/deleteAnagrafica/{id}', 'delete');
   
});

Route::get('/display_img', [FileController::class, 'index']);
Route::get('/file', [FileController::class, 'list_file']);
Route::post('/uploadFile', [FileController::class, 'uploadFile']);//->name('file.store');
Route::get('/deleteFile/{id}', [FileController::class, 'imageDelete']);//->name('file.store');

Route::controller(ConsegneController::class)->group(function () {
    Route::get('/consegne', 'consegne');
    Route::get('/formConsegne', 'formAddConsegne');
    Route::POST('addConsegne', 'store');
    Route::get('/deleteConsegne/{id}', 'delete');
   
});


Route::controller(ExcelController::class)->group(function () {
    Route::get('/formExcel_soci', 'index_soci'); //->middleware('is_admin'); // da menu sidebar richiama form per importare excel
    Route::post('/importSoci', 'importSoci');
    Route::post('/importSoci_old', 'importSoci_old');
    Route::post('/exportSoci', 'exportSoci');
    Route::get('/exportSociTutti', 'exportSociTutti');
    
    Route::get('/formExcel_iscrizioni', 'index_iscrizioni'); // da menu sidebar richiama form per importare excel
    Route::post('/importIscrizione', 'importIscrizione');
    Route::get('/exportIscrizione', 'exportIscrizione');
});

Route::controller(SociController::class)->group(function () {
    Route::get('/list', 'index')->name('soci.index')->middleware('is_admin'); //ok visualizza lista soci
    Route::get('/list/{col}', 'indexOrd'); //ok ordina una colonna in index.blade
    Route::get('changeStatus/{id}', 'changeStatus'); //ok cambia lo stato di unn socio Ablilitato/sospeso con Ajax
    Route::view('formAdd', 'soci.formAdd'); //ok crea form per add socio
    Route::POST('add', 'salvasocio'); // ok salva nuovo socio nel database
    Route::POST('/paginazione', 'pagine'); // ok imposta numero righe nelle tabelle che hanno la paginazione e il box righe
    Route::delete('deleteSocio/{id}', 'cancellaSocio'); // ok Cancella socio dal database
    Route::get('edit/{id}', 'editSocio');
    Route::post('editSocio', 'update'); // ok Aggiorna Socio usato in soci.edit.blade
    Route::get('singolo/{id}', 'singolo'); // ok Visualizza dati singolo socio

    //Route::post('filtro', 'indexFiltro');//ok  Filtra soci per anno join con iscrizione
    // Route::view('formFiltroAnno/', 'soci.FiltroAnno'); // ok // filtro anno rinnovo
    Route::get('deleteSoci/{id}', 'sociCancella'); // ok Cancella socio dal database 'deleteSoci/1' è richiamata da $ajax in index.blade
    Route::POST('/selAnno', 'selAnno');
    Route::POST('/selCognome', 'selCognome');
});

Route::controller(IscrizioneController::class)->group(function () {
    Route::POST('editIscrizione', 'editIscrizione');

    Route::get('iscrizione', 'iscrizioneList'); // Lista iscrizioni con edit e ricerca
    Route::get('editIscrizione/{id}', 'showData'); // edit iscrizione
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
    /**
     * Il bottone dropdown 'bollettini da sel.' in soci.index.blade richiama ajax che prima chiama
     * Route::post('salvaChck', [ServizioController::class, 'salvaSelChck']);
     * il quale salva in una tabella 'servizios' gli 'id' selezionati dai checkbox
     * poi chiama Route::get('bollettini/{tipo}', 'PdfBollettini'); con  window.location.href = "/bollettini/1";
     * che crea i pdf dei bollettini
     * stessa cosa per le etichette
     */
    Route::view('bollettini_anno', 'pdf.pdfFiltroBollettini'); // pagina con form richiamati da bottone 'Filtra anno bolettini'
    Route::get('etichette_anno', 'getFiltroEtichette');
    Route::post('creaBollettini_anno', 'PdfBollettini'); // richiamato dal form filtro anno bollettini

    Route::post('etichette_anno', 'PdfEtichette');
    Route::get('bollettini/{tipo}', 'PdfBollettini'); //usato da bottone "Bollettini da chckbox" che chiama AJAX poi da success in soci.index.blade.php
    Route::get('etichette/{tipo}', 'PdfEtichette');
    Route::get('pdf','printPagePdf');

});

Route::get('articoli', [PostController::class, 'index']);
Route::get('create', [PostController::class, 'create']);
Route::post('post', [PostController::class, 'store']);
Route::get('show/{id}', [PostController::class, 'show']);
Route::get('editPost/{id}', [PostController::class, 'editPost']);
Route::post('update/{id}', [PostController::class, 'update']);
Route::get('delete/{id}', [PostController::class, 'destroy']);

Route::get('iltuoente_list', [IlTuoEnteController::class, 'index']);

Route::get('/iconeHome', function () {
    return view('iconeHome');
});

Route::get('/', function () {
    return view('welcome');
});



