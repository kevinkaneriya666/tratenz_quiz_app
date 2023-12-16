<?php

namespace App\Http\Requests;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'marks' => ['required','integer',function($attribute,$value,$fail){
                $markSum = Question::where('category',$this->get('category_id'))->sum('marks');
                if($markSum < $value){
                    $fail('Quiz mark is greater then total availabel questions sum');
                }
            }]
        ];
    }
}
