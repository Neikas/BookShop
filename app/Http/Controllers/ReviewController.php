<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request, Book $book)
    {     
        Review::create([
            'author' => auth()->user()->name,
            'book_id' => $book->id,
            'stars' => $request->stars,
            'comment' => $request->comment,
        ]);

        return redirect()->route('book.show', $book)->with('message', 'Thanks for review!');
    }
}
