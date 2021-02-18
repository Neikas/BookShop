<?php

namespace App\Http\Controllers\User;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        $books = auth()->user()->books()->paginate();

        return view('user.book.index')->with('books', $books);
    }
    
}
