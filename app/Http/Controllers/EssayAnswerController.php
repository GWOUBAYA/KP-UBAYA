<?php

namespace App\Http\Controllers;

use App\Essayanswer;
use Illuminate\Http\Request;
use App\Essay;
use Auth;
use App\Http\Requests\UpdateEssayAnswerRequest;
use App\Http\Requests\StoreEssayAnswerRequest;

class EssayAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of EssayAnswer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $essay_answer = Essay::all();

        return view('essay_answer.index', compact('essay_answer'));
    }

    /**
     * Show the form for creating new EssayAnswer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $relations = [
            'essay' => \App\Essay::get()->pluck('essay_text', 'id')->prepend('Please select', ''),
        ];

        return view('essay_answer.create', $relations);
    }

    /**
     * Store a newly created EssayAnswer in storage.
     *
     * @param  \App\Http\Requests\StoreEssayAnswersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEssayAnswerRequest $request)
    {
        EssayAnswer::create($request->all());

        return redirect()->route('essay_answer.index');
    }


    /**
     * Show the form for editing EssayAnswer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $relations = [
            'essay' => \App\Essay::get()->pluck('essay_text', 'id')->prepend('Please select', ''),
        ];

        $essays_option = EssayAnswer::findOrFail($id);

        return view('essay_answer.edit', compact('essay_answer') + $relations);
    }

    /**
     * Update EssayAnswer in storage.
     *
     * @param  \App\Http\Requests\UpdateEssayAnswersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Display EssayAnswer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relations = [
            'essay' => \App\Essay::get()->pluck('essay_text', 'id')->prepend('Please select', ''),
        ];

        $essays_option = EssayAnswer::findOrFail($id);

        return view('essay_answer.show', compact('essay_answer') + $relations);
    }


    /**
     * Remove EssayAnswer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $essaysoption = EssayAnswer::findOrFail($id);
        $essaysoption->delete();

        return redirect()->route('essay_answer.index');
    }

    /**
     * Delete all selected EssayAnswer at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Essayanswer::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
