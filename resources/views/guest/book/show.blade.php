@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="app" >
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
                            <reviews-avg-index :book="{{ json_encode($book) }}"></reviews-avg-index>
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

                <div class="row mt-5">
                    <div class="w-100">
                        @include('guest.book.review.index')  
                    </div>
                </div>

            @auth   
                {{-- User report create form Modal --}}
                @include('user.book.report.create')
                {{-- Modal --}}    
            @endauth
        </div>
@endsection