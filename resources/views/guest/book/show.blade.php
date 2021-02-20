@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <img src="{{ asset( $book->picture) }}" style="width:100%; height:450px;" class="card-img-top" alt="...">
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col align-self-start">
                                <h5 >{{ $book->title}}</h5>   
                                @auth  
                                    @if(auth()->user()->admin)
                                        <a href="{{ route('admin.book.edit', $book ) }}" type="button" class="btn btn-danger" >
                                            Edit this book
                                        </a>  
                                    @else
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#form">
                                            Report this book
                                        </button>  
                                    @endif
                                @endauth

                            </div>
                            <div class="col-6 align-self-end">
                                <div class="d-flex">
                                    <div class="content text-center">
                                        @if( $book->reviews_count )
                                        <div class="ratings"> <span class="product-rating">{{ $book->avg_rating }} / 5</span>
                                            <div class="stars"> 
                                                @for($i = 0 ; $i < $book->avg_rating;$i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                            </div>
                                            <div class="rating-text"> out of {{ $book->reviews_count }} reviews</div>
                                        </div>
                                        @else
                                        <div class="ratings">
                                            No reviews yet
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" style="height: 350px">
                      <h5 class="card-title">
                          @foreach ($book->authors as $author)
                              {{ $author->author . ' ' }}
                          @endforeach
                    </h5>
                      <p class="card-text">{{ $book->description}}</p>
                    </div>
                </div>
            </div>  
        </div>
        @auth   
            {{-- User report create form Modal --}}
            @include('user.book.report.create')
            {{-- Modal --}}    
        @endauth
        <div class="row mt-5">
            
            @include('guest.book.review.index')  
        </div>
        <div class="row mt-5">

        </div>
        <div class="row mt-5 justify-content-center">
            @guest
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <a href="{{ route('login') }}">Log in</a> or <a href="{{ route('register') }}"> register  </a > to leave review!
                        </div>
                    </div>
            @else
            <div class="col-12 md-1 mt-1" >
                {{-- {{ $book->reviews->links() }} --}}
            </div>
                @include('user.book.review.create')
            @endguest

        </div>
    </div>
@endsection