<?php

namespace App\Http\Controllers;

use App\Http\Resources\OptionResource;
use App\Http\Resources\QuestionResource;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionController extends Controller
{
    public function index(Request $request)
    {

        if ($request->id) {
            $question = Question::where('quiz_id', $request->id)->get();
        } else {
            $question = Question::all();
        }

        return Inertia::render(
            'Dashboard/Question/QuestionView',
            [
                'quiz' => Quiz::all(),
                'questions' => QuestionResource::collection($question),
                'options' => OptionResource::collection(Option::all()),
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => ['required', 'string'],
            'quiz_id' => ['required', 'exists:quizzes,ulid'],
            'answers' => ['required']

        ]);


        $correctCount = collect($request->answers)->filter(function ($item) {
            return $item['is_correct'] == "1";
        })->count();

        if ($correctCount != 1) {

            return to_route('question.index')->with('message', 'Hanya boleh ada 1 Jawaban yang Benar');
        }


        $question = Question::create([
            'pertanyaan' => $request->pertanyaan,
            'quiz_id' => $request->quiz_id,
            'points' => $request->point
        ]);



        foreach ($request->answers as $option) {
            Option::create([
                'question_id' => $question->id,
                'jawaban' => $option['text'],
                'is_correct' => $option['is_correct']
            ]);
        }

        return to_route('question.index')->with('message', 'Question & Option berhasil dibuat!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'pertanyaan' => ['required', 'string'],
            'quiz_id' => ['required', 'exists:quizzes,ulid'],
            'answers' => ['required']
        ]);



        $correctCount = collect($request->answers)->filter(function ($item) {
            return $item['is_correct'] == true;
        })->count();


        if ($correctCount != 1) {

            return to_route('question.index')->with('message', 'Hanya boleh ada 1 Jawaban yang Benar');
        }



        $question = Question::whereId($request->id)->first();
        $question->update([
            'pertanyaan' => $request->pertanyaan,
            'quiz_id' => $request->quiz_id,
            'points' => $request->point
        ]);


        foreach ($request->answers as $option) {
            Option::where('id', $option['id'])->update([
                'question_id' => $question->id,
                'jawaban' => $option['text'],
                'is_correct' => $option['is_correct']
            ]);
        }


        return to_route('question.index')->with('message', 'Pertanyaan & Jawaban telah berhasil Diubah!');
    }

    public function destroy(Request $request)
    {
        Question::whereId($request->id)->delete();
        Option::where('question_id', $request->id)->delete();
        return to_route('question.index')->with('message', 'Pertanyaan & Jawaban telah berhasil DiHapus!');
    }
}
