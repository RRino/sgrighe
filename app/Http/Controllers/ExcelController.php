<?php

namespace App\Http\Controllers;

use App\Models\Iscrizione;
use App\Models\Soci;
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

            foreach ($row_range as $row) {

                $cons = $sheet->getCell('J' . $row)->getValue();
                if(strlen($cons) == 2){
                    $cons = $sheet->getCell('J' . $row)->getValue();
                 }else{
                    $cons = ''; 
                 }

                $data[] = [
                    'id' => $sheet->getCell('X' . $row)->getValue(),
                    'cognome' => $sheet->getCell('A' . $row)->getValue(),
                    'nome' => $sheet->getCell('B' . $row)->getValue(),
                    'indirizzo' => $sheet->getCell('C' . $row)->getValue(),           
                    'cap' => $sheet->getCell('D' . $row)->getValue(),
                    'localita' => $sheet->getCell('E' . $row)->getValue(),
                    'comune' => $sheet->getCell('E' . $row)->getValue(),
                    'sigla_provincia' => $sheet->getCell('F' . $row)->getValue(),
                    'ultimo' => $sheet->getCell('G' . $row)->getValue(),
                    'penultimo' => $sheet->getCell('H' . $row)->getValue(),
                    
                    'consegna' =>$cons,
                   

                    'email' => $sheet->getCell('L' . $row)->getValue(),
                    'telefono' => $sheet->getCell('M' . $row)->getValue(),
                    'cellulare' => $sheet->getCell('M' . $row)->getValue(),
                    'description' => $sheet->getCell('N' . $row)->getValue(),
                    'tipo_socio' =>1,//$sheet->getCell( 'O' . $row )->getValue(),

                    'pec' => $sheet->getCell('Q' . $row)->getValue(),
                    'codice_fiscale' => $sheet->getCell('R' . $row)->getValue(),
                    'partita_iva' => $sheet->getCell('S' . $row)->getValue(),
                    'published' => 1,
                    'created_at' => $sheet->getCell('U' . $row)->getValue(),
                    'updated_at' => $sheet->getCell('V' . $row)->getValue(),
                ];
                $startcount++;
            }

            foreach ($row_range as $row) {
                if ($sheet->getCell('G' . $row)->getValue() == null) {
                 
                   }else{
                $iscrizione[] = [
                    //'id' =>$sheet->getCell( 'A' . $row )->getValue(),
                    'nome' => $sheet->getCell('B' . $row)->getValue(),
                    'cognome' => $sheet->getCell('A' . $row)->getValue(),
                    'socio_id' => $sheet->getCell('X' . $row)->getValue(),
                    'anno' => $sheet->getCell('G' . $row)->getValue(),
                    'description' => $sheet->getCell('N' . $row)->getValue(),

                ];
               }
                $startcount++;
            }

            foreach ($row_range as $row) {
                if ($sheet->getCell('H' . $row)->getValue() == null) {
            
             
                }else{
                    $iscrizione2[] = [
                        //'id' =>$sheet->getCell( 'A' . $row )->getValue(),
                        'nome' => $sheet->getCell('B' . $row)->getValue(),
                        'cognome' => $sheet->getCell('A' . $row)->getValue(),
                        'socio_id' => $sheet->getCell('X' . $row)->getValue(),
                        'anno' => $sheet->getCell('H' . $row)->getValue(),
                        'description' => $sheet->getCell('N' . $row)->getValue(),
                    ];
                }
                $startcount++;
            }
//-------------------------- Soci -----------------------------------
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('socis')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::table('socis')->insert($data);

//-------------------------- Iscrizione -----------------------------------
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('iscriziones')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
             DB::table('iscriziones')->insert($iscrizione);

            //-------------------------- Iscrizion2 -----------------------------------
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
             DB::table('iscriziones')->insert($iscrizione2);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];

            return back()->withErrors('There was a problem uploading the data!');
        }
        return back()->withSuccess('I dati sono stati caricati.');
    }

    /**

     *This function loads the customer data from the database then converts it

     * into an Array that will be exported to Excel

     */

    public function exportSoci(Request $req)
    {

        $anno = $req->anno;

        // TODO prova salva soci xx
        /**
         *  Route::get('/exportSoci', 'exportSoci');
         * Prepara i dati da esportare in excel con
         *  $this->ExportExcel($data_array);
         */
        // $data = DB::table('socis')->orderBy('id', 'DESC')->get();

        $data = DB::table('socis')
            ->leftJoin('iscriziones', 'socis.id', '=', 'iscriziones.socio_id')
            ->where('iscriziones.anno', $anno)
        //->orWhere('iscriziones.anno',null)
            ->get();

        // $socir = DB::table('socis')
        //        ->rightJoin('iscriziones', 'socis.id', '=', 'iscriziones.socio_id')
        //       ->get();

        $data_array[] = array("id", "nome", "cognome", "indirizzo", "consegna", "cap", "localita", "comune", "sigla_provincia", "ultimo", "penultimo", "email"
            , "pec", "codice_fiscale", "partita_iva", "telefono", "cellulare", "tipo_socio", "published", "description", "created_at", "updated_at");

        foreach ($data as $data_item) {

            $data_array[] = array(

                'id' => $data_item->id,
                'nome' => $data_item->nome,
                'cognome' => $data_item->cognome,
                'indirizzo' => $data_item->indirizzo,
                'consegna' => $data_item->consegna,
                'cap' => $data_item->cap,
                'localita' => $data_item->localita,
                'comune' => $data_item->comune,
                'sigla_provincia' => $data_item->sigla_provincia,
                'ultimo' => $data_item->anno,
                'penultimo' => $data_item->penultimo,
                'email' => $data_item->email,
                'pec' => $data_item->pec,
                'codice_fiscale' => $data_item->codice_fiscale,
                'partita_iva' => $data_item->partita_iva,
                'telefono' => $data_item->telefono,
                'cellulare' => $data_item->cellulare,
                'tipo_socio' => $data_item->tipo_socio,
                'published' => $data_item->published,
                'description' => $data_item->description,
                'created_at' => $data_item->created_at,
                'updated_at' => $data_item->updated_at,

            );
        }

        $this->ExportExcel($data_array);

    }

    public function exportSociTutti()
    {
        /**
         *  Route::get('/exportSoci', 'exportSoci');
         * Prepara i dati da esportare in excel con
         *  $this->ExportExcel($data_array);
         */
        // $data = DB::table('socis')->orderBy('id', 'DESC')->get();

        $data = DB::table('socis')
            ->leftJoin('iscriziones', 'socis.id', '=', 'iscriziones.socio_id')
            ->orWhere('iscriziones.anno', null)
            ->orWhereNotNull('iscriziones.anno')
            ->get();

        // $socir = DB::table('socis')
        //        ->rightJoin('iscriziones', 'socis.id', '=', 'iscriziones.socio_id')
        //       ->get();

        $data_array[] = array("id", "nome", "cognome", "indirizzo", "consegna", "cap", "localita", "comune", "sigla_provincia", "ultimo", "penultimo", "email"
            , "pec", "codice_fiscale", "partita_iva", "telefono", "cellulare", "tipo_socio", "published", "description", "created_at", "updated_at");

        foreach ($data as $data_item) {

            $data_array[] = array(

                'id' => $data_item->id,
                'nome' => $data_item->nome,
                'cognome' => $data_item->cognome,
                'indirizzo' => $data_item->indirizzo,
                'consegna' => $data_item->consegna,
                'cap' => $data_item->cap,
                'localita' => $data_item->localita,
                'comune' => $data_item->comune,
                'sigla_provincia' => $data_item->sigla_provincia,
                'ultimo' => $data_item->anno,
                'penultimo' => $data_item->penultimo,
                'email' => $data_item->email,
                'pec' => $data_item->pec,
                'codice_fiscale' => $data_item->codice_fiscale,
                'partita_iva' => $data_item->partita_iva,
                'telefono' => $data_item->telefono,
                'cellulare' => $data_item->cellulare,
                'tipo_socio' => $data_item->tipo_socio,
                'published' => $data_item->published,
                'description' => $data_item->description,
                'created_at' => $data_item->created_at,
                'updated_at' => $data_item->updated_at,

            );
        }

        $this->ExportExcel($data_array);

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

    public function exportIscrizione()
    {
        /**
         *  Route::get('/exportIscrizione', 'exportIscrizione');
         * prepara i dati da esportare in excel
         */
        $data = DB::table('iscriziones')->orderBy('socio_id', 'DESC')->get();
        $data_array[] = array("id", "anno", "socio_id", "created_at", "updated_at");

        foreach ($data as $data_item) {
            $data_array[] = array(

                'id' => $data_item->id,
                'anno' => $data_item->anno,
                'socio_id' => $data_item->socio_id,
                'created_at' => $data_item->created_at,
                'updated_at' => $data_item->updated_at,

            );
        }
        $this->ExportExcel($data_array);
    }

    public function importIscrizione(Request $request)
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
            $row_range = range(3, $row_limit);
            $column_range = range('V', $column_limit);
            $startcount = 2;
            $data = array();

            foreach ($row_range as $row) {
                $data[] = [
                    'id' => $sheet->getCell('A' . $row)->getValue(),
                    'anno' => $sheet->getCell('B' . $row)->getValue(),
                    'socio_id' => $sheet->getCell('C' . $row)->getValue(),
                    'created_at' => $sheet->getCell('D' . $row)->getValue(),
                    'updated_at' => $sheet->getCell('E' . $row)->getValue(),
                ];
                $startcount++;
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('iscriziones')->truncate();

            DB::table('iscriziones')->insert($data);
        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];

            return back()->withErrors('There was a problem uploading the data!');
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return back()->withSuccess('I dati sono stati caricati.');
    }
    // ----------------------------------------------------------------
}
