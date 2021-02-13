@extends('layouts.app')

@section('content')

<div>
    <div class="row justify-content-center">
        <h4>
            My books
        </h4>
    </div>
    @include('book.userBookIndex')
    <div class="row justify-content-center">
        {{ $books->links() }}
    </div>
</div> 

@endsection