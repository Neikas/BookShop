<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;

class ReviewController extends Controller
{
    public function index()
    {

        return  ReviewResource::collection( Review::all());
    }
}
