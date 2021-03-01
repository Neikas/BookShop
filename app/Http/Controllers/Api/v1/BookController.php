<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    public function index()
    {   
        return BookResource::collection( Book::Approved()->with(['authors', 'genres'])->paginate());
    }
    public function show(Book $book)
    {
        if(!$book->approved) return abort(404);

        return new BookResource($book);
        
    }
}
