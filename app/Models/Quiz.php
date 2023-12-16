<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\DB;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quiz';

    protected $fillable = [
        'category_id',
        'marks',        
    ];

    protected function categoryId(): Attribute{
        return Attribute::make(
            set: fn (string $value) => intval($value),
        );
    }

    public static function store($request){
        DB::beginTransaction();
        try{
            $quizData = self::updateOrCreate(
                ['id' => 0],
                $request->only('category_id','marks')
            );

            $questionsList = self::getQuestionsList($quizData->category_id);
            if($questionsList != Null && $quizData != Null){
                $response = QuizQuestions::storeQuizQuestions($questionsList,$quizData);
                if($response == 1){
                    DB::commit();
                } else{
                    DB::rollback();
                }
            }

            return $quizData;
        } catch(Exception $e){
            DB::rollback();
        }
    }

    public static function getQuestionsList($category_id){
        return Question::where('category',$category_id)->inRandomOrder()->get();
    }
}
