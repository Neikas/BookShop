@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <img src="{{ asset( $book->picture) }}" class="card-img-top" alt="...">
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col align-self-start">
                                <h5 >{{ $book->title}}</h5>
                            </div>
                            <div class="col-6 align-self-end">
                                <div class="d-flex">
                                    <div class="content text-center">
                                        <div class="ratings"> <span class="product-rating">{{ $book->reviews[0]->stars ?? 'No rating'}}</span><span>/5</span>
                                            <div class="stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                            <div class="rating-text"> <span>46 ratings & 15 reviews</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">
                          @foreach ($book->authors as $author)
                              {{ $author->author . ' ' }}
                          @endforeach
                    </h5>
                      <p class="card-text">{{ $book->description}}</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>  
        </div>
        <div class="row mt-5">
                @include('book.bookReviews')

                
        </div>
        <div class="row mt-5">

        </div>
        <div class="row mt-5">
            @guest
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            Log in or register to leave review!
                        </div>
                    </div>
            @else 
                @include('book.reviewForm')
                <div class="col-12">
                    {{ $book->reviews->links() }}
                </div>

            @endguest

        </div>
    </div>


@endsection