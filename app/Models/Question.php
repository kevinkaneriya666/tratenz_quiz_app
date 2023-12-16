<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'category',
        'question',
        'answer_1',
        'answer_2',
        'answer_3',
        'answer_4',
        'marks'
    ];


    public static function storeCsv($csv){        
        $content = [];
        try{            
            foreach($csv as $row){
                $content[] = [
                    'category' => $row['Category'] == 'Math' ? '1' : ($row['Category'] == 'Science' ? '2' : '3'),
                    'question' => $row['Question'],
                    'answer_1' => $row['A'],
                    'answer_2' => $row['B'],
                    'answer_3' => $row['C'],
                    'answer_4' => $row['D'],
                    'marks' => $row['Mark'],
                ];
            }
            
            self::insert($content);
            
            return 1;
        } catch(Exception $e){
            //dd($e->getMessage());
            return 0;
        }
    }

    public function scopeQuestions($query){
        return $query->get();
    }

    public function getCategories(){
        return $this->get()->pluck('category');
    }

    protected function category(): Attribute{
        return Attribute::make(
            get: fn (string $value) => $value == '1' ? 'Math' : ($value == '2' ? 'Science' : 'English'),            
        );
    }

}
