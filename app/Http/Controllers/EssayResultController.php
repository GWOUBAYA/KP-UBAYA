<?php

namespace App\Http\Controllers;

use App\Essay;
use Illuminate\Http\Request;
use App\EssayAnswer;
use Auth;

class EssayResultController extends Controller
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
        $results = Essay::all()->load('user');

        if (!Auth::user()->isAdmin()) {
            $results = $results->where('user_id', '=', Auth::id());
        }

        return view('results.index', compact('results'));
    }

    /**
     * Display Result.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = Essay::find($id)->load('user');

        if ($test) {
            $results = EssayAnswer::where('essay_id', $id)
                ->with('essay')
                ->get();
        }

        return view('results.show', compact('test', 'results'));
    }
}
