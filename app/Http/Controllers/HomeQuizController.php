<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetailQuestionResource;
use App\Http\Resources\DetailQuizResource;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuizResource;
use App\Http\Resources\ResultResource;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class HomeQuizController extends Controller
{
    public function index(Request $request)
    {


        if ($request->category) {
            $quiz = Quiz::where('category_id', $request->category)->get();
        } else {
            $quiz = Quiz::all();
        }

        return Inertia::render(
            'HomeQuiz/HomeQuizView',
            [
                'quiz' => QuizResource::collection($quiz),
                'categories' => Category::all()
            ]
        );
    }

    public function show(Request $request)
    {

        $quiz = Quiz::find($request->ulid);
        $question = Question::where('quiz_id', $request->ulid)->paginate(1);

        // Ambil jawaban user yang sudah tersimpan
        $userAnswer = Answer::where('user_id', Auth::id())
            ->where('quiz_id', $request->ulid)
            ->pluck('option_id', 'question_id'); // ambil hanya option yang dipilih

        return Inertia::render('HomeQuiz/ShowQuizView', [
            'quiz' => new DetailQuizResource($quiz),
            'questions' =>  DetailQuestionResource::collection($question),
            'userAnswer' => $userAnswer
        ]);
    }


    public function addAnswer(Request $request)
    {




        $request->validate([
            'question_id' => 'exists:questions,id',
            'option_id' => 'exists:options,id',
            'quiz_id' => 'exists:quizzes,ulid'
        ]);


        $existingAnswer = Answer::where('user_id', Auth::id())
            ->where('question_id', $request->question_id)
            ->where('quiz_id', $request->quiz_id)
            ->first();


        if ($existingAnswer) {

            $existingAnswer->update([
                'option_id' => $request->option_id
            ]);


            $userAnswer = Answer::where('user_id', Auth::id())->where('quiz_id', $request->quiz_id)->where('question_id', $request->question_id)->first();

            return back()->with('message', 'Jawaban berhasil diubah')->with('userAnswer', $userAnswer);
        } else {

            Answer::create([
                'user_id' => Auth::id(),
                'question_id' => $request->question_id,
                'quiz_id' => $request->quiz_id,
                'option_id' => $request->option_id
            ]);


            $userAnswer = Answer::where('user_id', Auth::id())->where('quiz_id', $request->quiz_id)->where('question_id', $request->question_id)->first();
            return redirect()->back()->with('message', 'Jawaban berhasil disimpan')->with('userAnswer', $userAnswer);
        }
    }

    function finishQuiz(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,ulid'
        ]);

        $userAnswers = Answer::where('user_id', Auth::id())->where('quiz_id', $request->quiz_id)
            ->get();

        $quizOptions = Option::whereIn('id', $userAnswers->pluck('option_id'))->get();

        $score = 0;
        foreach ($quizOptions as $q) {
            if ($q->is_correct == 1) {
                $score += 1;
            }
        }

        Result::create([
            'user_id' => Auth::id(),
            'quiz_id' => $request->quiz_id,
            'skor' => $score
        ]);



        // hapus jawaban
        Answer::where('user_id', Auth::id())->where('quiz_id', $request->quiz_id)->delete();


        return redirect()->back()->with('message', 'Hasil telah disimpan');
    }


    public function leaderboard(Request $request)
    {


        if ($request->id) {
            $result = Result::where('quiz_id', $request->id)->orderBy('skor', 'desc')->orderBy('created_at', 'asc')->get();
        } else {
            $result = Result::orderBy('skor', 'desc')->orderBy('created_at', 'asc')->get();
        }

        return Inertia::render(
            'HomeQuiz/Leaderboard',
            [
                'results' => ResultResource::collection($result),
                'quiz' => Quiz::get(['ulid', 'nama_quiz'])
            ]
        );
    }
}
