<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;

class ReviewController extends Controller
{
    public function index(Book $book)
    {   
        return  ReviewResource::collection( $book->reviews()->get());
    }
}
