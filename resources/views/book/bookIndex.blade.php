
@if(count($books) < 1)
<div class="row justify-content-center">
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">No records found!</h4>
      <hr>
      <p>Aww yeah, we didn't founded that book ; ()</p>
    </div>
  </div>
@endif

@foreach ($books->chunk(5) as $chunk)
    <div class="row justify-content-center">
        @foreach ($chunk as $book)
            <div class="card" style="width: 12rem; margin: 5px;">
            <img src="{{ asset( $book->picture) }}"  style="width:100%; height:350px;" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">{{ $book->title }}</h5>
            <h5 class="card-title">
                @foreach ($book->authors as $author)
                    {{ $author->author . ' ' }}
                @endforeach
            </h5>
            <h4 class="card-title"> {{ $book->price }} &euro;</h4>
            <a href="{{ route('book.show', [ $book ]) }}" class="btn btn-primary btn-block">Check book</a>
            </div>
        </div>
        @endforeach
    </div >
@endforeach
