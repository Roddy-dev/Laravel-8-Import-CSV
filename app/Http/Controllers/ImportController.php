<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\CsvData;
use App\Models\Familie;
use App\Models\Verweise;
use App\Models\Lebenslauf;
use Illuminate\Http\Request;
use App\Imports\ContactsImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
// use Illuminate\Support\Arr;
use App\Http\Requests\CsvImportRequest;
use Maatwebsite\Excel\HeadingRowImport;

class ImportController extends Controller
{
    public function parseImport(CsvImportRequest $request)
    {
        if (!$this->validateModelName($request->modelname)) {
            return redirect()->back()->withErrors(['msg' => 'Invalid model']);
        }
        ini_set('auto_detect_line_endings', true);
        $data = array_map('str_getcsv', file($request->file('csv_file')->getRealPath()));
        if ($request->has('header')) {
            array_shift($data); // remove header as we dont want it or funny format of excel
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
        if (!$this->validateModelName($model)) {
            return redirect()->back()->withErrors(['msg' => 'Invalid model']);
        }
        $this->dropTable($model);
        foreach ($csv_data as $row) {
            if ($model == 'familie') {
                $familie = new Familie();
                foreach (config('app.db_fields_familie') as $index => $field) {
                    $familie->$field = $row[$request->fields[$index]];
                }
                $familie->save();
            };
            if ($model == 'lebenslauf') {
                $lebenslauf = new Lebenslauf();
                foreach (config('app.db_fields_lebenslauf') as $index => $field) {
                    $lebenslauf->$field = $row[$request->fields[$index]];
                }
                $lebenslauf->save();
            };
            if ($model == 'verweise') {
                $verweise = new Verweise();
                foreach (config('app.db_fields_verweise') as $index => $field) {
                    $verweise->$field = $row[$request->fields[$index]];
                }
                $verweise->save();
            };
        }
        
        return redirect()->route($model.'s.index')->with('success', 'Import finished.');
    }

    public function configureForParse()
    {
        // if we have valid model name and
    }

    public function dropTable($tableName)
    {
        //this should probably be done to prevent duplicate entries and for this db to mirror
        // original db. Bit hacky, better would be upserts via laravel excel.
        // dd($tableName.'s');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $truncated =  DB::table($tableName.'s')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        sleep(30); //to test on table plus
        return $truncated;
    }
    
    protected function validateModelName($name)
    {
        return in_array($name, config('app.db_accepted_models'));
    }
}
