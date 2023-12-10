<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublishersController extends Controller
{
    public function result(Publisher $publisher)
    {
        $books = $publisher->books()->paginate(12);
        $title = 'books for ' . $publisher->name;
        return view('gallery', compact('books', 'title'));
    }
    public function list(Publisher $publisher)
    {
        $publishers = Publisher::all()->sortBy('name');
        $title = 'publishers';
        return view('publishers.index', compact('publishers', 'title'));
    }
    public function search(Request $request)
    {
        $publishers = Publisher::where('name', 'like', "%{$request->term}")->get()->sortBy('name');
        $title = 'search results for ' . $request->term;
        return view('publishers.index', compact('publishers', 'title'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        //
    }
}