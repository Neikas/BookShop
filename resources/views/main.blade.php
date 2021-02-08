@extends('layouts.app')

@section('content')

<div>
  @include('book.bookIndex')
  <div class="row justify-content-center">
  {{ $books->links() }}
  </div>
</div> 

@endsection
