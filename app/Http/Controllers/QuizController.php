<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Dashboard/Quiz/QuizView', ['categories' => Category::all(), 'quiz' => Quiz::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'nama_quiz' => ['required'],
            'deskripsi' => ['required', 'string'],
            'jumlah_soal' => ['required'],
            'waktu_mulai' => ['required'],
            'waktu_selesai' => ['required'],
            'category_id' => ['required']
        ]);

        Quiz::create([
            'nama_quiz' => $request->nama_quiz,
            'deskripsi' => $request->deskripsi,
            'jumlah_soal' => $request->jumlah_soal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'category_id' => $request->category_id
        ]);


        return to_route('quiz.index')->with('message', 'Quiz berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {



        $quiz = Quiz::destroy($request->id);

        return to_route('quiz.index')->with('message', 'Quiz berhasil Dihapus!');
    }
}
