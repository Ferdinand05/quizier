<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionController extends Controller
{
    public function index()
    {

        $question = Question::latest()->get();
        return Inertia::render(
            'Dashboard/Question/QuestionView',
            ['quiz' => Quiz::all(), 'questions' => QuestionResource::collection($question)]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => ['required', 'string'],
            'quiz_id' => ['required', 'exists:quizzes,ulid']
        ]);


        Question::create([
            'pertanyaan' => $request->pertanyaan,
            'quiz_id' => $request->quiz_id,
            'points' => $request->point
        ]);

        return to_route('question.index')->with('message', 'Pertanyaan telah berhasil Dibuat!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'pertanyaan' => ['required', 'string'],
            'quiz_id' => ['required', 'exists:quizzes,ulid']
        ]);

        Question::whereId($request->id)->update([
            'pertanyaan' => $request->pertanyaan,
            'quiz_id' => $request->quiz_id,
            'points' => $request->point
        ]);

        return to_route('question.index')->with('message', 'Pertanyaan telah berhasil Diubah!');
    }

    public function destroy(Request $request)
    {
        Question::whereId($request->id)->delete();

        return to_route('question.index')->with('message', 'Pertanyaan telah berhasil DiHapus!');
    }
}
