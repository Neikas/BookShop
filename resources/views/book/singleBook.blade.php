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
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#form">
                                        Report this book
                                    </button>  
                                @endauth
                            </div>
                            <div class="col-6 align-self-end">
                                <div class="d-flex">
                                    <div class="content text-center">
                                        @if($book->countStars > 0 )
                                        <div class="ratings"> <span class="product-rating">{{ round ($book->sumStars / $book->countStars, 1 )}}</span><span>/5</span>
                                            <div class="stars"> @php echo str_repeat('<i class="fa fa-star"></i>', round ($book->sumStars / $book->countStars, 1 ))@endphp </div>
                                                
                                            <div class="rating-text"> <span>{{ $book->countStars }} ratings & {{ $book->countComments }} reviews</span> </div>
                                        </div>
                                        @else
                                        <div class="ratings"> <span class="product-rating">{{ 0 }}</span><span>/5</span>
                                            <div class="stars"> @php echo str_repeat('<i class="fa fa-star"></i>', 0 )@endphp </div>
                                                
                                            <div class="rating-text"> <span>{{ $book->countStars }} ratings & {{ $book->countComments }} reviews</span> </div>
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
            {{-- Modal --}}
            @include('book.reportBook')
            {{-- Modal --}}    
        @endauth
        <div class="row mt-5">
                @include('book.bookReviews')  
        </div>
        <div class="row mt-5">

        </div>
        <div class="row mt-5 justify-content-center">
            @guest
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            Log in or register to leave review!
                        </div>
                    </div>
            @else
            <div class="col-12 md-1 mt-1" >
                {{-- {{ $book->reviews->links() }} --}}
            </div>
                @include('book.reviewForm')
            @endguest

        </div>
    </div>
@endsection