<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\author;
use App\Models\Rating;
use App\Traits\ImageUploadTrait;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image as Image;


class BooksController extends Controller
{

    use ImageUploadTrait;
    // public function details(Book $book)
    // {
    //     return view('Books.details', compact('book'));
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = book::all();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = author::all();
        $categories = Category::all();
        $publishers = Publisher::all();
        return view('admin.books.create', compact(
            'authors',
            'publishers',
            'categories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'nullable',
            'authors' => 'nullable',
            'publisher' => 'nullable',
            'description' => 'nullable',
            'publisher_year' => 'nullable|numeric',
            'number_of_copies' => 'numeric|required',
            'number_of_pages' => 'numeric|required',
            'price' => 'numeric|required',
            'cover_image' => 'image|required',
            'isbn' => ['required', 'alpha_num', Rule::unique('books', 'isbn')],
        ]);
        $book = new Book;
        $book->title = $request->title;
        $book->isbn = $request->isbn;
        $book->category_id = $request->category;
        $book->publisher_id = $request->publisher;
        $book->description = $request->description;
        $book->publisher_year = $request->publish_year;
        $book->number_of_pages = $request->number_of_pages;
        $book->number_of_copies = $request->number_of_copies;
        $book->price = $request->price;
        $book->cover_image = $this->uploadImage($request->cover_image);
        $book->save();
        $book->authors()->attach($request->authors);
        session()->flash('flash_message', 'book added successfully');
        return redirect(route('books.show', $book));
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = author::all();
        $categories = Category::all();
        $publishers = Publisher::all();
        return view('admin.books.edit', compact(
            'authors',
            'publishers',
            'categories',
            'book'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {

        $this->validate($request, [
            'title' => 'required',
            'category' => 'nullable',
            'authors' => 'nullable',
            'publisher' => 'nullable',
            'description' => 'nullable',
            'publisher_year' => 'nullable|numeric',
            'number_of_copies' => 'numeric|required',
            'number_of_pages' => 'numeric|required',
            'price' => 'numeric|required',
            'cover_image' => 'image',
        ]);

        $book->title = $request->title;
        if ($request->has('cover_image')) {
            Storage::disk('public')->delete($book->cover_image);
            $book->cover_image = $this->uploadImage($request->cover_image);
        }
        $book->isbn = $request->isbn;
        $book->category_id = $request->category;
        $book->publisher_id = $request->publisher;
        $book->description = $request->description;
        $book->publisher_year = $request->publish_year;
        $book->number_of_pages = $request->number_of_pages;
        $book->number_of_copies = $request->number_of_copies;
        $book->price = $request->price;
        if ($book->isDirty('isbn')) {
            $this->validate($request, [
                'isbn' => ['required', 'alpha_num', Rule::unique('books', 'isbn')],
            ]);
        }
        $book->save();
        $book->authors()->detach();
        $book->authors()->attach($request->authors);
        session()->flash('flash_message', 'book edited successfully');
        return redirect(route('books.show', $book));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        storage::disk('public')->delete($book->cover_image);
        $book->delete();
        session()->flash('flash_message', 'delete');
        return redirect(route('books.index'));
    }

    public function details(Book $book)
    {
        $bookfind = 0;
        if (Auth::check()) {
            $bookfind = auth()->user()->ratedpurches()->where('book_id', $book->id)->first();
        }
        return view('books.details', compact('book', 'bookfind'));
    }

    public function rate(Request $request, Book $book)
    {
        if (auth()->user()->rated($book)) {
            $rating = Rating::where(['user_id' => auth()->user()->id, 'book_id' => $book->id])->first();
            $rating->value = $request->value;
            $rating->save();
        } else {
            $rating = new Rating;
            $rating->user_id = auth()->user()->id;
            $rating->book_id = $book->id;
            $rating->value = $request->value;
            $rating->save();
        }
        return back();
    }
}