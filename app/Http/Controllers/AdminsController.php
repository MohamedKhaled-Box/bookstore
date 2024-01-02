<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function index()
    {
        $number_of_books = Book::count();
        $number_of_Categories = Category::count();
        $number_of_Authors = Author::count();
        $number_of_Publishers = Publisher::count();
        return view('admin.index', compact('number_of_books', 'number_of_Categories', 'number_of_Authors', 'number_of_Publishers'));
    }
}
