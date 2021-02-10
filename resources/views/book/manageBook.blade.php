@extends('layouts.app')

@section('content')

<div>
    <div class="row justify-content-center">
        <h2>
            My books
        </h2>
    </div>
    @include('book.userBookIndex')
    <div class="row justify-content-center">
        {{ $books->links() }}
    </div>
</div> 

@endsection