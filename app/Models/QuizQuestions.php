<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestions extends Model
{
    use HasFactory;

    protected $table = 'quiz_questions';

    protected $fillable = [
        'quiz_id',
        'question_id',        
    ];

    public static function storeQuizQuestions($questionsList,$quizData){
        try{
            $sum = 0;
            $data = [];
            foreach($questionsList as $question){
                if($sum < $quizData->marks){
                    $data[] = [
                        'quiz_id' => $quizData->id,
                        'question_id' => $question->id
                    ];
                    $sum = $sum + intval($question->marks);
                }
            }        
            self::insert($data);

            return 1;
        } catch(Exception $e){
            return 0;
        }
    }
}
