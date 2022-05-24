<?php

namespace App\Http\Controllers;

use App\Essay;
use Illuminate\Http\Request;
use App\EssayAnswer;
use Auth;
use App\Http\Requests\StoreEssayRequest;
use App\Http\Requests\UpdateEssayRequest;

class EssayController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of Essay.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $essays = Essay::all();

        return view('essay.index', compact('essay'));
    }

    /**
     * Show the form for creating new Essay.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $relations = [
            'topics' => \App\Topic::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];


        return view('essay.create', $relations);
    }


    public function store(StoreEssayRequest $request)
    {

        $essay = Essay::create($request->all());

        foreach ($request->input() as $key => $value) {
            if (strpos($key, 'option') !== false && $value != '') {
                $status = 0;
                EssayAnswer::create([
                    'essay_id' => $essay->id,
                    'answer'      => $value,
                    'correct'     => $status
                ]);
            }
        }

        return redirect()->route('essay.index');
    }


    /**
     * Show the form for editing Essay.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $relations = [
            'topics' => \App\Topic::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $essay = Essay::findOrFail($id);

        return view('essay.edit', compact('essay') + $relations);
    }

    /**
     * Update Essay in storage.
     *
     * @param  \App\Http\Requests\UpdateEssaysRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEssayRequest $request, $id)
    {
        $essay = Essay::findOrFail($id);
        $essay->update($request->all());

        return redirect()->route('essay.index');
    }


    /**
     * Display Essay.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relations = [
            'topics' => \App\Topic::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $essay = Essay::findOrFail($id);

        return view('essay.show', compact('essay') + $relations);
    }


    /**
     * Remove Essay from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $essay = Essay::findOrFail($id);
        $essay->delete();

        return redirect()->route('essay.index');
    }

    /**
     * Delete all selected Essay at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Essay::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
