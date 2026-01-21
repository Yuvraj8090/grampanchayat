<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\IOFactory;



class ExcelController extends Controller
{
    public function upload(Request $request)
    {   

        $this->validate($request,[
            'file' => 'required|mimes:xlsx,xls',
        ]);
        
        $file = $request->file('file');

        // Load the spreadsheet
        $spreadsheet = IOFactory::load($file);
        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

         // Get the highest row number and column letter
         $highestRow = $sheet->getHighestRow();
         $highestColumn = $sheet->getHighestColumn();

         // Process and save data to the database
        for ($row = 1; $row <= $highestRow; ++$row) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false)[0];
          
            $data[] = $rowData;
        }

        dd($data);


        

        // dd($sheet);

        // Excel::filter('chunk')->selectSheetsByIndex(0)->load($file)->chunk(250, function (Collection $results) {
        //     // dd($results);
        //     foreach ($results as $row) {
        //         User::create([
        //             'column1' => $row[0],
        //             'column2' => $row[1],
        //             'column3' => $row[2],
        //             // Add more columns as needed
        //         ]);
        //     }
        // });

        // // You can do more validation, processing, and saving here
        // Excel::filter('chunk')->selectSheetsByIndex(0)->load($file)->chunk(250, function (Collection $results) {

        //     dd($results);

        //     foreach ($results as $row) {
        //         User::create([
        //             'column1' => $row[0],
        //             'column2' => $row[1],
        //             'column3' => $row[2],
        //             // Add more columns as needed
        //         ]);
        //     }
        // });

        return 'File uploaded successfully!';
    }
}
