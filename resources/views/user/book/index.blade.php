@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <h4>My books</h4>
</div>
@if($books->count() < 1)
<div class="row justify-content-center">
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">No books found!</h4>
    </div>
  </div>
@endif
@foreach ($books->chunk(5) as $chunk)
    <div class="row justify-content-center">
        @foreach ($chunk as $book)
            <div class="card" style="width: 12rem; margin: 5px;">
            <img src="{{ asset( $book->picture) }}" style="width:100%; height:350px;" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $book->title }}</h5>
                <h5 class="card-title">
                    @foreach ($book->authors as $author)
                        {{ $author->author . ' ' }}
                    @endforeach
                </h5>
                <h4 class="card-title"> {{ $book->price }} 	&euro;</h4>
                <h4 class="card-title"> Status:@if($book->approved) Aprroved @else Dissaproved @endif </h4>
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('book.edit', [ $book ]) }}" class="btn btn-sm btn-primary">Edit book </a>             
                    </div>
                    <div class="col-6">
                        <a  class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">Delete book </a>
                    </div>
                </div>
            </div>
            <div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Book</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form action="{{ route('book.destroy', $book) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <h5 class="text-center">Are you sure you want to delete this book?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-danger">Yes, Delete Book</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div >
@endforeach
<div class="row justify-content-center">
    {{ $books->links() }}
</div>

@endsection