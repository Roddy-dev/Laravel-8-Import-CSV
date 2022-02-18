<?php

namespace App\Http\Controllers;

use App\Models\CsvData;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Imports\ContactsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CsvImportRequest;
use App\Models\Familie;
use Maatwebsite\Excel\HeadingRowImport;

class ImportController extends Controller
{
    
    // minor brain wave, put model on csv file so that the model can be selected properly
    public function parseImport(CsvImportRequest $request)
    {
        // $validated = $request->validate([
        //     'modelname' => 'required',
        // ]);
        
        if ($request->has('header')) {
            // $headings = (new HeadingRowImport)->toArray($request->file('csv_file'));
            // $data = Excel::toArray(new ContactsImport, $request->file('csv_file'))[0];
            $data = array_map('str_getcsv', file($request->file('csv_file')->getRealPath()));
            array_shift($data); // remove header as we dont want it.
        } else {
            $data = array_map('str_getcsv', file($request->file('csv_file')->getRealPath()));
        }
        
        if (count($data) > 0) {
            $csv_data = array_slice($data, 0, 2);
            
            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_model_name' => $request->modelname,
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }
        
        return view('import_fields', [
            'headings' => $headings ?? null,
            'csv_data' => $csv_data,
            'model' => $request->modelname,
            'csv_data_file' => $csv_data_file
        ]);
    }
    
    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        $model = $data->csv_model_name;

        foreach ($csv_data as $row) {
            // dump($row);
            if ($model = 'familie') {
                $familie = new Familie();
                foreach (config('app.db_fields_familie') as $index => $field) {
                    // if ($data->csv_header) {
                    //     $familie->$field = $row[$request->fields[$field]];
                    // } else {
                    $familie->$field = $row[$request->fields[$index]];
                    // }
                }
                $familie->save();
            }
            // $contact = new Contact();
            // foreach (config('app.db_fields_'.$model) as $index => $field) {
            //     if ($data->csv_header) {
            //         $contact->$field = $row[$request->fields[$field]];
            //     } else {
            //         $contact->$field = $row[$request->fields[$index]];
            //     }
            // }
            // $contact->save();
        }
        
        return redirect()->route($model.'s.index')->with('success', 'Import finished.');
    }
    
    // protected function validateModelName($name){
    //     $acceptedNames = ['familie', 'lebenslauf', 'werweise'];
    //     if($name->not)
        
    // }
}
