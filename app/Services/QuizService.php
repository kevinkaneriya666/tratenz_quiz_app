<?php
    
namespace App\Services;
use App\Models\Quiz;
use Exception;

class QuizService {
    public function insertQuiz($request){
        $response = Quiz::store($request);
        if(!$response){
           return null; 
        }
        return $response;
    }
}

