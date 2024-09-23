<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Dashboard/Category/CategoryView', [
            'categories' => Category::all()
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
        $request->validate([
            'nama_kategori' => ['required']
        ]);

        Category::create([
            'slug' => Str::slug($request->nama_kategori),
            'nama_kategori' => $request->nama_kategori
        ]);


        return to_route('category.index')->with('message', 'Category Quiz berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_kategori' => ['required']
        ]);

        Category::whereId($request->id)->update([
            'slug' => Str::slug($request->nama_kategori),
            'nama_kategori' => $request->nama_kategori
        ]);

        return to_route('category.index')->with('message', 'Category Quiz berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        Category::destroy($request->id);
        return to_route('category.index')->with('message', 'Category Quiz berhasil Dihapus!');
    }
}
