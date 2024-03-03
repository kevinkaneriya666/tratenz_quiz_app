<?php

namespace App\Http\Controllers;

use App\Http\Requests\CsvRequest;
use App\Models\Question;
use App\Models\User;
use App\Models\UserAddress;
use App\Services\HomeService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        $categories = (new Question)->getCategories();
        
        return view('home',compact('categories'));
    }

    public function test()
    {        
        $users = User::with(['address'])->limit(15000)->get();
        dd($users);
        return view('test',compact('users'));
    }


    public function uploadCSV(CsvRequest $request,HomeService $homeService)
    {
        $data = $homeService->processCsv($request);
        if(isset($data['status']) && $data['status'] == 0){
            return redirect()->back()->with('error',$data['message']);
        }
        
        $response = $homeService->storeCsvData($data);
        if($response == 0){
            return redirect()->route('home')->with('error','Error in inserting data');
        }

        return redirect()->route('home')->with('success','Data inserted successfully');
            
    }

    public function datatables(Request $request){
        $data = Question::questions();
        
        return DataTables::of($data)
            ->addIndexColumn()                       
            ->make(true);
    }

    
}
