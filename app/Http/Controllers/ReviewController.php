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
        if($book->reviews()->get()->contains('user_id', auth()->id() )) 
        {
            return redirect()->route('book.show', $book)->with('message', 'One review per book for same user!');
        }
        
        Review::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'stars' => $request->stars,
            'comment' => $request->comment,
            'author' => auth()->user()->name
        ]);

        return redirect()->route('book.show', $book)->with('message', 'Thanks for review!');
    }
}
