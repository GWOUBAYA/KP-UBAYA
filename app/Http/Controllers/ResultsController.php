<?php

namespace App\Http\Controllers;

// use Auth;
use App\Test;
use App\User;
use App\TestAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreResultsRequest;
use App\Http\Requests\UpdateResultsRequest;
use Illuminate\Support\Facades\Auth;

class ResultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index', 'show');
    }

    /**
     * Display a listing of Result.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $results = DB::table('users')
              ->where('role_id', 2)->get();
              
        // = User::all();

        if (!Auth::user()->isAdmin()) {
            $results = $results->where('id', '=', Auth::id());
        }

        // dd($results);

        return view('results.index'  , compact('results'));
    }

    /**
     * Display Result.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = Test::find($id)->load('user');

        if ($test) {
            $results = TestAnswer::where('test_id', $id)
                ->with('question')
                ->with('question.options')
                ->get()
            ;
        }

        return view('results.show', compact('test', 'results'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAcc(Request $request, $id)
    {
        DB::table('users')
              ->where('id', $id)
              ->update(['status' => 1]);
        // dd($id);
        // $results = User::all();
        // // $coba = User::select('id')->get();
        // dd($request);
        //     // ->update(['status' => 1]);

        // // dd(User::where('id', $user->id)->get());

        return redirect()->route('results.index')->with('status1', 'Status peserta telah diubah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDec(Request $request, $id)
    {
        DB::table('users')
        ->where('id', $id)
        ->update(['status' => 2]);


        return redirect()->route('results.index')->with('status2', 'Status peserta telah diubah');
    }
}
