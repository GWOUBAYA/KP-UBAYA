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
use Composer\Util\Http\Response;
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
        $test = Test::find($id)->load('user');

        if ($test) {
            $results = TestAnswer::where('test_id', $id)
                ->with('question')
                ->with('question.options')
                ->get();
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
    public function essayCek(Request $request, $id)
    {

        // DB::table('users')
        //       ->where('id', $id)
        //       ->update(['status' => 1]);
        $results = DB::table('essayanswers')
            ->where('user_id', $id)
            ->join('users', 'essayanswers.user_id', '=', 'users.id')
            ->join('essays', 'essayanswers.essay_id', '=', 'essays.id')
            ->orderBy('essayanswers.test_id', 'desc')
            ->limit(2)
            ->get();
        // dd($results);
        // $results = User::all();
        // // $coba = User::select('id')->get();
        // dd($request);
        //     // ->update(['status' => 1]);

        // // dd(User::where('id', $user->id)->get());

        return view('results.cekEssay', compact('results'));
    }
    public function updateAcc2(Request $request, $id1, $id2)
    {
        $tes = DB::table('essayanswers')
            ->where('test_id', $id1)
            ->where('essay_id', $id2)
            ->update(['correct' => 1]);
        // dd($tes);
        // $results = User::all();
        // // $coba = User::select('id')->get();
        // dd($request);
        //     // ->update(['status' => 1]);

        // // dd(User::where('id', $user->id)->get());

        return redirect()->route('results.index')->with('status1', 'Status peserta telah diubah');
    }

    public function updateDec2(Request $request, $id1, $id2)
    {
        $tes = DB::table('essayanswers')
            ->where('test_id', $id1)
            ->where('essay_id', $id2)
            ->update(['correct' => 2]);
        // dd($tes);
        // $results = User::all();
        // // $coba = User::select('id')->get();
        // dd($request);
        //     // ->update(['status' => 1]);

        // // dd(User::where('id', $user->id)->get());

        return redirect()->route('results.index')->with('status2', 'Status peserta telah diubah');
    }
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

    public function download($file_name)
    {
        $file_path = public_path('uploads/' . $file_name);
        return response()->download($file_path);
    }

    // public function getDownload()
    // {
    //     //PDF file is stored under project/public/download/info.pdf
    //     $file = public_path() . "/download/info.pdf";

    //     $headers = array(
    //         'Content-Type: application/pdf',
    //     );

    //     return Response::download($file, 'filename.pdf', $headers);
    // }
}
