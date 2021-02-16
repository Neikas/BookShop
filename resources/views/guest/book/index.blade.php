@extends('layouts.app')

@section('content')

@if( $books->count() < 1 )
    <div class="row justify-content-center">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">No books found!</h4>
            <hr>
        </div>
    </div>
@endif

@foreach ($books->chunk(5) as $chunk)
    <div class="row justify-content-center">
        @foreach ($chunk as $book)
            <div class="card" style="width: 12rem; margin: 5px;">
                    <img src="{{ asset( $book->picture) }}"  style="width:100%; height:350px;" class="card-img-top rounded" alt="...">   
                <div class="card-body">
                    @if ($book->discount > 0 )
                        <div class="alert alert-danger" role="alert">
                            <span class="label label-danger"> 
                                <i class="fa fa-percent fa-5" aria-hidden="true">{{ $book->discount }}</i>
                            </span>
                        </div>
                    @endif
                    @if( $book->is_new )   
                        <div class="alert alert-danger" role="alert">
                            <span class="label label-danger"> 
                                <i class="fa fa-tags fa-5" aria-hidden="true">New</i>
                            </span> 
                        </div>
                    @endif
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <h5 class="card-title">
                        @foreach ($book->authors as $author)
                            {{ $author->author . ' ' }}
                        @endforeach
                    </h5>
                    @if($book->discount)
                    <h5 class="card-title"> {{ $book->discountedPrice() }} &euro; <s>   {{ $book->price }} &euro; </s></h5>
                    <a href="{{ route('book.show', [ $book ]) }}" class="btn btn-primary btn-block">Check book</a>
                    @else
                    <h5 class="card-title"> {{ $book->discountedPrice() }}</h5>
                    <a href="{{ route('book.show', [ $book ]) }}" class="btn btn-primary btn-block">Check book</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div >
@endforeach

<div class="row justify-content-center">
    {{$books->links() }}
</div>

@endsection