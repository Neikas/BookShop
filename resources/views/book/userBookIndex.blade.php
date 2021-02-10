@foreach ($books->chunk(5) as $chunk)
    <div class="row justify-content-center">
        @foreach ($chunk as $book)
            <div class="card" style="width: 12rem; margin: 5px;">
            <img src="{{ asset( $book->picture) }}" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">{{ $book->title }}</h5>
            <h5 class="card-title">
                @foreach ($book->authors as $author)
                    {{ $author->author . ' ' }}
                @endforeach
            </h5>
            <h4 class="card-title"> {{ $book->price }} 	&euro;</h4>
            <h4 class="card-title"> Status:@if($book->approved) Aprroved @else Dissaproved @endif </h4>
                <a href="{{ route('book.edit', [ $book ]) }}" class="btn btn-primary">Edit book </a>
            </div>
        </div>
        @endforeach
    </div >
@endforeach
