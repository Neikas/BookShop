<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::Notapproved()->paginate();
    
        return view('admin.book.index')->with('books', $books);
    }
    
    public function approveBook(Book $book)
    {
        $book->update(['approved' => true]);

        return redirect()->route('admin.book.index')->wiht('meesage', 'Book has been approved!');
    }
}
