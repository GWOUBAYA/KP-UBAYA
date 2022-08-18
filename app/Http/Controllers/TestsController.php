<?php

namespace App\Http\Controllers;

use DB;
use App\Essay;
use App\Essayanswer;
use App\Essayresult;
use Auth;
use App\Test;
use App\TestAnswer;
use App\Topic;
use App\Question;
use App\QuestionsOption;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTestRequest;

class TestsController extends Controller
{
    /**
     * Display a new test.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $topics = Topic::inRandomOrder()->limit(10)->get();

        $essays = Essay::all();
        $questions = Question::inRandomOrder()->limit(10)->get();
        foreach ($questions as &$question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
            // dd($question->options);
        }
        // dd($essays);
        /*
        foreach ($topics as $topic) {
            if ($topic->questions->count()) {
                $questions[$topic->id]['topic'] = $topic->title;
                $questions[$topic->id]['questions'] = $topic->questions()->inRandomOrder()->first()->load('options')->toArray();
                shuffle($questions[$topic->id]['questions']['options']);
            }
        }
        */

        return view('tests.create', compact('questions', 'essays'));
    }

    public function essay()
    {
        $essay = Essay::inRandomOrder()->get();
        return view('tests.essay', compact('essay'));
    }
    /**
     * Store a newly solved Test in storage with results.
     *
     * @param  \App\Http\Requests\StoreResultsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input('essay_text'));
        $result = 0;

        $test = Test::create([
            'user_id' => Auth::id(),
            'result'  => $result,
        ]);

        foreach ($request->input('questions2', []) as $key => $question) {
            // dd($request->input('essay_text'));
            $status = 0;
            Essayanswer::create([
                'user_id'   => Auth::id(),
                'test_id'   => $test->id,
                'essay_id'  => $question,
                'answer'    => $request->input('essay_text' . $question),
                'correct'   => $status,
            ]);
            // dd($request->input('essay_text'.$question));
        }



        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;

            if (
                $request->input('answers.' . $question) != null
                && QuestionsOption::find($request->input('answers.' . $question))->correct
            ) {
                $status = 1;
                $result++;
            }
            TestAnswer::create([
                'user_id'     => Auth::id(),
                'test_id'     => $test->id,
                'question_id' => $question,
                'option_id'   => $request->input('answers.' . $question),
                'correct'     => $status,
            ]);
            // dd($request->input('answers.' . $question), $question);

            // dd($request->input('answers.' . $question));
        }

        $test->update(['result' => $result]);

        return redirect()->route('results.show', [$test->id]);
    }
}