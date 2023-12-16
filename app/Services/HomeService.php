<?php

namespace App\Services;

use App\Models\Question;
use Exception;

class HomeService {

    public function processCsv($request){
        $header = null;
        $data = array();
       
        try{
            if (($handle = fopen($request->file('file'), 'r')) !== false){
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    if (!$header){
                        $header = $row;
                    } else{
                        $data[] = array_combine($header, $row);
                    }
                }
                fclose($handle);
            }
        } catch(Exception $e){
            return [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }

        return $data;
    }

    public function storeCsvData($csv_data){
        $response = Question::storeCsv($csv_data);
        
        return $response;
    }
}