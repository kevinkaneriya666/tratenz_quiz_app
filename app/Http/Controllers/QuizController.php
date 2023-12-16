<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizRequest;
use App\Models\Question;
use App\Services\QuizService;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function makeQuiz(Request $request){
        $categories = (new Question())->getCategories();
        
        return view('make-quiz',compact('categories'));
    }

    public function storeQuiz(QuizRequest $request,QuizService $quizService){
        $quiz = $quizService->insertQuiz($request);    
        if($quiz){
            return redirect()->route('make_quiz')->with('success','Quiz has been created successfully');            
        }

        return redirect()->route('make_quiz')->with('error','Error inserting quiz');
    }
}
