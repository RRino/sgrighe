<?php

namespace App\Http\Controllers;

use App\Models\Anagrafica;
use App\Models\Associati;
use App\Models\Consegne;
use App\Models\Ruoli;
use App\Models\Soci;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class ExcelController extends Controller
{

    /**

     * @param Request $request

     * @return \Illuminate\Http\RedirectResponse

     * @throws \Illuminate\Validation\ValidationException

     * @throws \PhpOffice\PhpSpreadsheet\Exception

     */

    /**

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    /**

     * @param $customer_data
     * esporta dati ExportExcel($customer_data) in excel
     * per soci e iscrizioni  ecc ..
     */

    public function ExportExcel($customer_data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {

            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(35);
            $spreadSheet->getActiveSheet()->fromArray($customer_data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="SoIs.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();

        } catch (Exception $e) {
            return;
        }

    }

    public function ExportAssociatiExcel($customer_data)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {

            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(35);
            $spreadSheet->getActiveSheet()->fromArray($customer_data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="associati.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();

        } catch (Exception $e) {
            return;
        }

    }
    public function index_soci()
    {

        /**
         * Route::get('/formExcel_soci', 'index_soci')
         * richiama form per caricare dati soci da excel
         *
         */
        $viewData = [];
        $viewData["title"] = "Import Export Soci";
        $viewData["tipo"] = "Soci";

        return view('excel.formImpExpSoci')->with("viewData", $viewData);

    }

    public function importSoci(Request $request)
    {

        /**
         *   Route::post('/importSoci', 'importSoci');
         *  Importa i dati da file excel
         *
         */
        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:xls,xlsx',
        ]);
        $the_file = $request->file('uploaded_file');
        try {

            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range = range(2, $row_limit);
            $column_range = range('Z', $column_limit);
            $startcount = 0;
            $data = array();

            $anno = Carbon::now()->format('Y');

            foreach ($row_range as $row) {

                $cons = $sheet->getCell('K' . $row)->getValue();
                if (strlen($cons) == 2) {
                    $cons = $sheet->getCell('K' . $row)->getValue();
                } else {
                    $cons = '';
                }

                if ($sheet->getCell('H' . $row)->getValue() == 'Si') {
                    $ultimo = $anno;
                } else {
                    $ultimo = 'No';
                }

                if ($sheet->getCell('I' . $row)->getValue() == 'Si') {
                    $penultimo = $anno - 1;
                } else {
                    $penultimo = 'No';
                }

                if ($sheet->getCell('J' . $row)->getValue() == 'Si') {
                    $terultimo = $anno - 2;
                } else {
                    $terultimo = 'No';
                }

                $data[] = [
                    'id' => $sheet->getCell('X' . $row)->getValue(),
                    'cognome' => $sheet->getCell('A' . $row)->getValue(),
                    'nome' => $sheet->getCell('B' . $row)->getValue(),
                    'indirizzo' => $sheet->getCell('C' . $row)->getValue(),
                    'cap' => $sheet->getCell('D' . $row)->getValue(),
                    'localita' => $sheet->getCell('E' . $row)->getValue(),
                    'comune' => $sheet->getCell('F' . $row)->getValue(),
                    'sigla_provincia' => $sheet->getCell('G' . $row)->getValue(),

                    'consegna' => $cons,
                    'email' => $sheet->getCell('M' . $row)->getValue(),
                    'telefono' => $sheet->getCell('N' . $row)->getValue(),
                    'cellulare' => $sheet->getCell('O' . $row)->getValue(),
                    'tipo_socio' => $sheet->getCell('S' . $row)->getValue(),
                    'pec' => $sheet->getCell('P' . $row)->getValue(),
                    'codice_fiscale' => $sheet->getCell('Q' . $row)->getValue(),
                    'partita_iva' => $sheet->getCell('R' . $row)->getValue(),
                    'description' => $sheet->getCell('T' . $row)->getValue(),
                    'published' => 1,
                    'created_at' => $sheet->getCell('U' . $row)->getValue(),
                    'updated_at' => $sheet->getCell('V' . $row)->getValue(),
                ];
                $startcount++;
            }

//-------------------------- Soci -----------------------------------
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('socis')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::table('socis')->insert($data);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return back()->withSuccess('I dati sono stati caricati.');
    }

    public function importSoci_old(Request $request)
    {

        /**
         *   Route::post('/importSoci', 'importSoci');
         *  Importa i dati da file excel
         *
         */
        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:xls,xlsx',
        ]);
        $the_file = $request->file('uploaded_file');
        try {

            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range = range(2, $row_limit);
            $column_range = range('Z', $column_limit);
            $startcount = 0;
            $data = array();

            $anno = Carbon::now()->format('Y');

            // ------------ SOCI ------------
            foreach ($row_range as $row) {

                $data[] = [
                    'id' => $sheet->getCell('X' . $row)->getValue(),
                    'cognome' => $sheet->getCell('A' . $row)->getValue(),
                    'nome' => $sheet->getCell('B' . $row)->getValue(),
                    'indirizzo' => $sheet->getCell('C' . $row)->getValue(),
                    'cap' => $sheet->getCell('D' . $row)->getValue(),
                    'localita' => $sheet->getCell('E' . $row)->getValue(),
                    'comune' => $sheet->getCell('E' . $row)->getValue(),
                    'sigla_provincia' => $sheet->getCell('F' . $row)->getValue(),

                    'email' => $sheet->getCell('L' . $row)->getValue(),
                    'telefono' => $sheet->getCell('M' . $row)->getValue(),
                    'cellulare' => $sheet->getCell('M' . $row)->getValue(),
                    'description' => $sheet->getCell('N' . $row)->getValue(),

                    'per_soc' => 1,
                    'pec' => $sheet->getCell('Q' . $row)->getValue(),
                    'codice_fiscale' => $sheet->getCell('R' . $row)->getValue(),
                    'partita_iva' => $sheet->getCell('S' . $row)->getValue(),
                    'published' => 1,
                    'created_at' => $sheet->getCell('U' . $row)->getValue(),
                    'updated_at' => $sheet->getCell('V' . $row)->getValue(),
                ];
                $startcount++;
            }

//-------------------------- Soci -----------------------------------
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('anagraficas')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::table('anagraficas')->insert($data);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return back()->withSuccess('I dati A sono stati caricati.');
    }

    /**

     *This function loads the customer data from the database then converts it

     * into an Array that will be exported to Excel

     */

    public function exportSociTutti()
    {
        /**
         *  Route::get('/exportSoci', 'exportSoci');
         * Prepara i dati da esportare in excel con
         *  $this->ExportExcel($data_array);
         */

        $anno = Carbon::now()->format('Y');

        $soci = exportSoci_IscrittiTutti();

        // nome colonna
        $anno0 = 'Anno_' . $anno;
        $anno1 = 'Anno_' . $anno - 1;
        $anno2 = 'Anno_' . $anno - 2;
        $anno3 = 'Anno_' . $anno + 1;
        // data_item valore
        $anno0i = $anno;
        $anno1i = $anno - 1;
        $anno2i = $anno - 2;
        $anno3i = $anno + 1;

        $data_array[] = array("cognome", "nome", "indirizzo", "cap", "localita",
            "comune", "sigla_provincia", $anno3, $anno0, $anno1, $anno2,
            "consegna", "data-iscriz", "email", "telefono", "cellulare", "pec", "codice_fiscale",
            "partita_iva", "tipo_socio", "description");

        foreach ($soci as $data_item) {

            $data_array[] = array(
                'cognome' => $data_item->cognome,
                'nome' => $data_item->nome,
                'indirizzo' => $data_item->indirizzo,
                'cap' => $data_item->cap,
                'localita' => $data_item->localita,
                'comune' => $data_item->comune,
                'sigla_provincia' => $data_item->sigla_provincia,
                $anno3 => $data_item->$anno3i,
                $anno0 => $data_item->$anno0i,
                $anno1 => $data_item->$anno1i,
                $anno2 => $data_item->$anno2i,

                'consegna' => $data_item->consegna,
                'data-iscriz' => '',
                'email' => $data_item->email,
                'telefono' => $data_item->telefono,
                'cellulare' => $data_item->cellulare,
                'pec' => $data_item->pec,
                'codice_fiscale' => $data_item->codice_fiscale,
                'partita_iva' => $data_item->partita_iva,
                'tipo_socio' => $data_item->tipo_socio,
                'description' => $data_item->description,
                // 'published' => $data_item->published,
                // 'created_at' => $data_item->created_at,
                // 'updated_at' => $data_item->updated_at,

            );

        }
        $this->ExportExcel($data_array);

        return back()->withSuccess('I dati sono stati scaricati.');
    }
    // ------------------------------ ISCRIZIONE ------------------------------------------

    public function index_iscrizioni()
    {

        /**
         * Route::get('/formExcel_iscrizioni', 'index_iscrizioni');
         * // da menu sidebar richiama form per importare excel
         * form per importare i dati da file excel
         */

        $viewData = [];
        $viewData["title"] = "Import Export Iscrizioni";
        $viewData["tipo"] = "Iscrizioni";

        return view('excel.formImpExpIscrizione')->with("viewData", $viewData);
    }




    // ----------------------------------------------------------------

    public function exportAssociati_old()
    {

        $associati = Associati::with(["anagrafica", "ruoli", "ruolispecm", "dateiscr_many", "consegne"])->get();

        $data_array[] = array("cognome", "nome", "indirizzo", "cap", "localita",
            "comune", "sigla_provincia",
            "consegna", "data-iscriz", "email", "telefono", "cellulare", "pec", "codice_fiscale",
            "partita_iva", "per_soc", "description", "published", "ruolo", "ruoli-spec", 'date_id',
            'date_assoc_id', 'date_nome', 'date_enumdate');

        foreach ($associati as $data_item) {
            $ruospec = '';
            foreach ($data_item->ruolispecm as $rspec) {
                $ruospec = $ruospec . ' ' . $rspec->nome . '' . $rspec->id;
            }

            $dateis = '';
            foreach ($data_item->dateiscr_many as $dtis) {
                $dateis = $dateis . ' ' . $dtis->nome;
                $date_id = $dtis->id;
                $date_associati_id = $dtis->associati_id;
                $date_nome = $dtis->nome;
                $date_enumdateiscr_id = $dtis->enumdateiscr_id;
            }

            $data_array[] = array(
                'cognome' => $data_item->anagrafica->cognome,
                'nome' => $data_item->anagrafica->nome,
                'indirizzo' => $data_item->anagrafica->indirizzo,
                'cap' => $data_item->anagrafica->cap,
                'localita' => $data_item->anagrafica->localita,
                'comune' => $data_item->anagrafica->comune,
                'sigla_provincia' => $data_item->anagrafica->sigla_provincia,

                'consegna' => $data_item->consegne->nome,
                'data-iscriz' => $dateis,
                'email' => $data_item->anagrafica->email,
                'telefono' => $data_item->anagrafica->telefono,
                'cellulare' => $data_item->anagrafica->cellulare,
                'pec' => $data_item->anagrafica->pec,
                'codice_fiscale' => $data_item->anagrafica->codice_fiscale,
                'partita_iva' => $data_item->anagrafica->partita_iva,
                'per_soc' => $data_item->anagrafica->tipo_socio,
                'description' => $data_item->anagrafica->description,
                'published' => $data_item->anagrafica->published,
                'ruolo' => $data_item->ruoli->nome,
                'ruoli-spec' => $ruospec,

              //  'date_id' => $dtis->id . ',' . $dtis->associati_id . ',' . $dtis->nome . ',' . $dtis->enumdateiscr_id,
                // 'date_assoc_id' => $dtis->associati_id,
                //  'date_nome' => $dtis->nome,
                // 'date_enumdate' => $dtis->enumdateiscr_id,
                // 'created_at' => $data_item->created_at,
                // 'updated_at' => $data_item->updated_at,

            );

        }

        $this->ExportAssociatiExcel($data_array);

        return back()->withSuccess('I dati sono stati scaricati.');
    }






    public function importAssociati_old(Request $request)
    {

        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:xls,xlsx',
        ]);
        $the_file = $request->file('uploaded_file');
        try {

            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range = range(2, $row_limit);
            $column_range = range('Z', $column_limit);
            $startcount = 0;
            $data = array();

            foreach ($row_range as $row) {

                /*  $cons = $sheet->getCell('K' . $row)->getValue();
                if (strlen($cons) == 2) {
                $cons = $sheet->getCell('K' . $row)->getValue();
                } else {
                $cons = '';
                }
                 */

                $data[] = [
                    'id' => $sheet->getCell('X' . $row)->getValue(),
                    'cognome' => $sheet->getCell('A' . $row)->getValue(),
                    'nome' => $sheet->getCell('B' . $row)->getValue(),
                    'indirizzo' => $sheet->getCell('C' . $row)->getValue(),
                    'cap' => $sheet->getCell('D' . $row)->getValue(),
                    'localita' => $sheet->getCell('E' . $row)->getValue(),
                    'comune' => $sheet->getCell('F' . $row)->getValue(),
                    'sigla_provincia' => $sheet->getCell('G' . $row)->getValue(),

                    'email' => $sheet->getCell('J' . $row)->getValue(),
                    'telefono' => $sheet->getCell('K' . $row)->getValue(),
                    'cellulare' => $sheet->getCell('L' . $row)->getValue(),
                    'per_soc' => $sheet->getCell('S' . $row)->getValue(),
                    'pec' => $sheet->getCell('M' . $row)->getValue(),
                    'codice_fiscale' => $sheet->getCell('N' . $row)->getValue(),
                    'partita_iva' => $sheet->getCell('O' . $row)->getValue(),
                    'per_soc' => 1,//$sheet->getCell('P' . $row)->getValue(),
                    'description' => $sheet->getCell('Q' . $row)->getValue(),
                    'published' => $sheet->getCell('R' . $row)->getValue(),
                   // 'created_at' => $sheet->getCell('U' . $row)->getValue(),
                   // 'updated_at' => $sheet->getCell('V' . $row)->getValue(),

                ];
                $startcount++;
            }

//-------------------------- Associati -----------------------------------
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('anagraficas')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::table('anagraficas')->insert($data);

//-------------------------- Ruoli -----------------------------------
            foreach ($row_range as $row) {
            
                $data_ruolo[] = [
                    'ruoli_id' => $sheet->getCell('V' . $row)->getValue(),
                ];
                $startcount++;
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('associatis')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::table('associatis')->insert($data_ruolo);
//-------------------------- Ruolispec -----------------------------------


$rusp = $sheet->getCell('U' . $row)->getValue();
$row_range = explode(',',$rusp);
            foreach ($row_range as $row) {
                $data[] = [

                ];
                $startcount++;
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('ruolispecs')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::table('ruolispecs')->insert($data);

//-------------------------- Dateiscr -----------------------------------
            foreach ($row_range as $row) {
                $data[] = [

                ];
                $startcount++;
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('tateiscrs')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::table('dateiscrs')->insert($data);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return back()->withSuccess('I dati sono stati caricati.');
    }


    // --------------- NUOVI --------------------
    public function exportAssociati()
    {

        $associati = Associati::with(["anagrafica", "ruoli", "ruolispecm", "dateiscr_many", "consegne"])->get();

        $data_array[] = array("cognome", "nome", "indirizzo", "cap", "localita",
            "comune", "sigla_provincia",
            "consegna", "data-iscriz", "email", "telefono", "cellulare", "pec", "codice_fiscale",
            "partita_iva", "per_soc", "ruolo","ruolo_specifico","description", "published", 'created_at', 'updated_at', "associati_table", 'ruolispec_table',
            'dateiscr_table');

            foreach ($associati as $data_item) {
              
            $assoc = '';
            foreach ($associati as $item) {
                $assoc = $item->id . ',' . $item->anagrafica_id .
                ',' . $item->ruoli_id . ',' . $item->consegne_id .
                ',' . $item->created_at . ',' . $item->updated_at;
            }

    

            $ruospec_table = '';
            foreach ($data_item->ruolispecm as $rspec) {
                $ruospec_table = $ruospec_table . 
                ','.$rspec->id .
                ','.$rspec->associati_id.
                ','.$rspec->enumruolispec_id.
                ','.$rspec->nome.
                ','.$rspec->created_at.
                ','.$rspec->updated_at;
            }

            $ruospec = '';
            foreach ($data_item->ruolispecm as $rspec) {
                $ruospec = $ruospec .' '.$rspec->nome;
            }

            $dateis_table = '';
            foreach ($data_item->dateiscr_many as $dtis) {
                $dateis_table = $dateis_table .
                ',' . $dtis->id .
                ',' . $dtis->associati_id .
                ',' . $dtis->nome .
                ',' . $dtis->enumdateiscr_id .
                ',' . $dtis->created_at .
                ',' . $dtis->updated_at;
            }

            $dateis = '';
            foreach ($data_item->dateiscr_many as $dtis) {
                $dateis = $dateis. ' '.$dtis->nome;
            }

            $data_array[] = array(
                'cognome' => $data_item->anagrafica->cognome,
                'nome' => $data_item->anagrafica->nome,
                'indirizzo' => $data_item->anagrafica->indirizzo,
                'cap' => $data_item->anagrafica->cap,
                'localita' => $data_item->anagrafica->localita,
                'comune' => $data_item->anagrafica->comune,
                'sigla_provincia' => $data_item->anagrafica->sigla_provincia,
                'consegna' => $data_item->consegne->nome,
                'data-iscriz' => $dateis,
                'email' => $data_item->anagrafica->email,
                'telefono' => $data_item->anagrafica->telefono,
                'cellulare' => $data_item->anagrafica->cellulare,
                'pec' => $data_item->anagrafica->pec,
                'codice_fiscale' => $data_item->anagrafica->codice_fiscale,
                'partita_iva' => $data_item->anagrafica->partita_iva,
                'per_soc' => $data_item->anagrafica->tipo_socio,
                'ruolo' => $data_item->ruoli->nome,
                'ruolo_specifico' => $ruospec,
                'description' => $data_item->anagrafica->description,
                'published' => $data_item->anagrafica->published,
                'create_at' => $data_item->anagrafica->created_at ,
                'update_at' => $data_item->anagrafica->updated_at,

               'associati_table' => $assoc,
                'ruolispec_table' => $ruospec_table,
                'dateiscr_table' => $dateis_table,
 
            );

        }

        $this->ExportAssociatiExcel($data_array);

        return back()->withSuccess('I dati sono stati scaricati.');
    }







    
    public function importAssociati(Request $request)
    {

        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:xls,xlsx',
        ]);
        $the_file = $request->file('uploaded_file');
        try {

            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $row_limit = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range = range(2, $row_limit);
            $column_range = range('Z', $column_limit);
            $startcount = 0;
            $data = array();

            foreach ($row_range as $row) {

                /*  $cons = $sheet->getCell('K' . $row)->getValue();
                if (strlen($cons) == 2) {
                $cons = $sheet->getCell('K' . $row)->getValue();
                } else {
                $cons = '';
                }
                 */

                $data[] = [
                    'id' => $sheet->getCell('X' . $row)->getValue(),
                    'cognome' => $sheet->getCell('A' . $row)->getValue(),
                    'nome' => $sheet->getCell('B' . $row)->getValue(),
                    'indirizzo' => $sheet->getCell('C' . $row)->getValue(),
                    'cap' => $sheet->getCell('D' . $row)->getValue(),
                    'localita' => $sheet->getCell('E' . $row)->getValue(),
                    'comune' => $sheet->getCell('F' . $row)->getValue(),
                    'sigla_provincia' => $sheet->getCell('G' . $row)->getValue(),

                    'email' => $sheet->getCell('J' . $row)->getValue(),
                    'telefono' => $sheet->getCell('K' . $row)->getValue(),
                    'cellulare' => $sheet->getCell('L' . $row)->getValue(),
                    'per_soc' => $sheet->getCell('S' . $row)->getValue(),
                    'pec' => $sheet->getCell('M' . $row)->getValue(),
                    'codice_fiscale' => $sheet->getCell('N' . $row)->getValue(),
                    'partita_iva' => $sheet->getCell('O' . $row)->getValue(),
                    'per_soc' => 1, //$sheet->getCell('P' . $row)->getValue(),
                    'description' => $sheet->getCell('Q' . $row)->getValue(),
                    'published' => $sheet->getCell('R' . $row)->getValue(),
                    // 'created_at' => $sheet->getCell('U' . $row)->getValue(),
                    // 'updated_at' => $sheet->getCell('V' . $row)->getValue(),

                ];
                $startcount++;
            }

//-------------------------- Associati -----------------------------------
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('anagraficas')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::table('anagraficas')->insert($data);

//-------------------------- Ruoli -----------------------------------
            foreach ($row_range as $row) {

                $data_ruolo[] = [
                    'ruoli_id' => $sheet->getCell('V' . $row)->getValue(),
                ];
                $startcount++;
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('associatis')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::table('associatis')->insert($data_ruolo);
//-------------------------- Ruolispec -----------------------------------

            $rusp = $sheet->getCell('U' . $row)->getValue();
            $row_range = explode(',', $rusp);
            foreach ($row_range as $row) {
                $data[] = [

                ];
                $startcount++;
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('ruolispecs')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::table('ruolispecs')->insert($data);

//-------------------------- Dateiscr -----------------------------------
            foreach ($row_range as $row) {
                $data[] = [

                ];
                $startcount++;
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('tateiscrs')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::table('dateiscrs')->insert($data);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return back()->withSuccess('I dati sono stati caricati.');
    }
}
