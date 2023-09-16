<?php

namespace App\Http\Controllers;

use App\Models\Iscrizione;
use App\Models\Soci;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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

    public function exportIscrizione()
    {
        /**
         *  Route::get('/exportIscrizione', 'exportIscrizione');
         * prepara i dati da esportare in excel
         */

        /*    $data = DB::table('iscriziones')->orderBy('socio_id', 'DESC')->get();
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
     */
    }

    public function importIscrizione(Request $request)
    {
        /*
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
     */
    }
    // ----------------------------------------------------------------
}
