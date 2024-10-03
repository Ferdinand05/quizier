<?php

namespace App\Http\Controllers;

use App\Http\Resources\OptionResource;
use App\Http\Resources\QuestionResource;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Dashboard/Option/OptionView', [
            'options' => OptionResource::collection(Option::all()),
            'questions' => QuestionResource::collection(Question::all())
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        //
    }
}
