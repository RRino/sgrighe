<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Reader\Exception;

use PhpOffice\PhpSpreadsheet\Writer\Xls;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Pagination\Paginator;

use App\Models\Soci;
use App\Models\Iscrizione;

class ExcelController extends Controller
{
   /**

    * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

    */

    function index_soci() {

        Paginator::useBootstrap();
           $data = DB::table('socis')->orderBy('cognome', 'ASC')->paginate(50);
           //$data= Soci::paginate(20); //Eloquent ORM
           return view('excel.ExcelList', compact('data'));
    
       }
    
    
    
       /**
    
        * @param Request $request
    
        * @return \Illuminate\Http\RedirectResponse
    
        * @throws \Illuminate\Validation\ValidationException
    
        * @throws \PhpOffice\PhpSpreadsheet\Exception
    
        */
    
       function importSoci(Request $request){
    
           $this->validate($request, [
               'uploaded_file' => 'required|file|mimes:xls,xlsx'
           ]);
           $the_file = $request->file('uploaded_file');
           try{
    
               $spreadsheet = IOFactory::load($the_file->getRealPath());
               $sheet        = $spreadsheet->getActiveSheet();  
               $row_limit    = $sheet->getHighestDataRow();   
               $column_limit = $sheet->getHighestDataColumn();   
               $row_range    = range( 3, $row_limit );  
               $column_range = range( 'V', $column_limit );    
               $startcount = 2;
               $data = array();
    
               foreach ( $row_range as $row ) { 
                   $data[] = [
                       //'id' =>$sheet->getCell( 'A' . $row )->getValue(),
                       'nome' =>$sheet->getCell( 'B' . $row )->getValue(),
                       'cognome' => $sheet->getCell( 'C' . $row )->getValue(),
                       'indirizzo' => $sheet->getCell( 'D' . $row )->getValue(),
                       'consegna' => $sheet->getCell( 'E' . $row )->getValue(),
                       'cap' => $sheet->getCell( 'F' . $row )->getValue(),
                       'localita' =>$sheet->getCell( 'G' . $row )->getValue(),
                       'comune' =>$sheet->getCell( 'H' . $row )->getValue(),
                       'sigla_provincia' =>$sheet->getCell( 'I' . $row )->getValue(),
                       'ultimo' =>$sheet->getCell( 'J' . $row )->getValue(),
                       'penultimo' =>$sheet->getCell( 'K' . $row )->getValue(),
    
                       'email' =>$sheet->getCell( 'L' . $row )->getValue(),
                       'pec' =>$sheet->getCell( 'M' . $row )->getValue(),
                       'codice_fiscale' =>$sheet->getCell( 'N' . $row )->getValue(),
                       'partita_iva' =>$sheet->getCell( 'O' . $row )->getValue(),
                       'telefono' =>$sheet->getCell( 'P' . $row )->getValue(),
                       'cellulare' =>$sheet->getCell( 'Q' . $row )->getValue(),
                       'tipo_socio' =>$sheet->getCell( 'R' . $row )->getValue(),
                       'published' =>$sheet->getCell( 'S' . $row )->getValue(),
                       'description' =>$sheet->getCell( 'T' . $row )->getValue(),
                       'created_at' =>$sheet->getCell( 'U' . $row )->getValue(),
                       'updated_at' =>$sheet->getCell( 'V' . $row )->getValue(),
                  ];
                   $startcount++;
               }
             
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
    
    
       /**
    
        * @param $customer_data
    
        */
    
       public function ExportExcel($customer_data){
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
    
    
       /**
    
        *This function loads the customer data from the database then converts it
    
        * into an Array that will be exported to Excel
    
        */
    
       function exportSoci(){
    
           $data = DB::table('socis')->orderBy('cognome', 'DESC')->get();
    
           $data_array [] = array("id","nome","cognome","indirizzo","consegna","cap","localita","comune","sigla_provincia","ultimo","penultimo","email"
                                   ,"pec","codice_fiscale","partita_iva","telefono","cellulare","tipo_socio","published","description","created_at","updated_at");
    
           foreach($data as $data_item)
    
           {
    
               $data_array[] = array(
    
                   'id' =>$data_item->id,
                   'nome' =>$data_item->nome,
                   'cognome' => $data_item->cognome,
                   'indirizzo' => $data_item->indirizzo,
                   'consegna' => $data_item->consegna,
                   'cap' => $data_item->cap,
                   'localita' =>$data_item->localita,
                   'comune' =>$data_item->comune,
                   'sigla_provincia' =>$data_item->sigla_provincia,
                   'ultimo' =>$data_item->ultimo,
                   'penultimo' =>$data_item->penultimo,
                   'email' =>$data_item->email,
                   'pec' =>$data_item->pec,
                   'codice_fiscale' =>$data_item->codice_fiscale,
                   'partita_iva' =>$data_item->partita_iva,
                   'telefono' =>$data_item->telefono,
                   'cellulare' =>$data_item->cellulare,
                   'tipo_socio' =>$data_item->tipo_socio,
                   'published' =>$data_item->published,
                   'description' =>$data_item->description,
                   'created_at' =>$data_item->created_at,
                   'updated_at' =>$data_item->updated_at
    
               );
           }
    
           $this->ExportExcel($data_array);
    
       }

       // ------------------------------ ISCRIZIONE ------------------------------------------


       function index_iscrizioni(){
  
        Paginator::useBootstrap();
           $data = DB::table('iscriziones')->orderBy('socio_id', 'ASC')->paginate(20);
           //$data= Soci::paginate(20); //Eloquent ORM
           return view('excel.IscrizioneList', compact('data'));
    
       }

       function exportIscrizione(){
   
        $data = DB::table('iscriziones')->orderBy('socio_id', 'ASC')->get();
        $data_array [] = array("id","nome","cognome","anno","socio_id","created_at","updated_at");
 
        foreach($data as $data_item)
        {
            $data_array[] = array(
 
                'id' =>$data_item->id,
                'nome' =>$data_item->nome,
                'cognome' => $data_item->cognome,
                'anno' => $data_item->anno,
                'socio_id' => $data_item->socio_id,
                'created_at' =>$data_item->created_at,
                'updated_at' =>$data_item->updated_at
 
            );
        }
 
        $this->ExportIscriz($data_array);
 
    }

    public function ExportIscriz($iscriz_data){
    
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
 
 
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(35);
            $spreadSheet->getActiveSheet()->fromArray($iscriz_data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Iscriz.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
 
    }

    function importIscrizione(Request $request){
    
        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('uploaded_file');
        try{
 
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();  
            $row_limit    = $sheet->getHighestDataRow();   
            $column_limit = $sheet->getHighestDataColumn();   
            $row_range    = range( 3, $row_limit );  
            $column_range = range( 'V', $column_limit );    
            $startcount = 2;
            $data = array();
 
            foreach ( $row_range as $row ) { 
                $data[] = [
                    //'id' =>$sheet->getCell( 'A' . $row )->getValue(),
                    'nome' =>$sheet->getCell( 'B' . $row )->getValue(),
                    'cognome' => $sheet->getCell( 'C' . $row )->getValue(),
                    'anno' => $sheet->getCell( 'E' . $row )->getValue(),
                    'socio_id' => $sheet->getCell( 'E' . $row )->getValue(),
                    'created_at' =>$sheet->getCell( 'G' . $row )->getValue(),
                    'updated_at' =>$sheet->getCell( 'H' . $row )->getValue(),
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