<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Book;
use App\Models\Review;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewAvgResource;
use App\Http\Resources\ReviewResource;

class ReviewController extends Controller
{
    public function index(Book $book)
    {   
        return  ReviewResource::collection( $book->reviews()->get());
    }
    public function store(ReviewRequest $request, Book $book)
    {
        if($book->reviews()->get()->contains('user_id', auth()->id() )) 
        {
            return response()->json([ 'error' => 404, 'message' =>  'One review per book for same user!' ], 403);
        }
        Review::create([
            'comment' => $request->comment,
            'stars' => $request->stars,
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'author' => auth()->user()->name
        ]);
        return ReviewResource::collection($book->reviews()->get());
    }
    public function getAvg(Book $book)
    {
        $book->loadCount('reviews');
            return new ReviewAvgResource($book);
    }
}
