@foreach ($books->chunk(5) as $chunk)
    <div class="row justify-content-center">
        @foreach ($chunk as $book)
            <div class="card" style="width: 12rem; margin: 5px;">
            <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="...">
            <div class="card-body">
            <h5 class="card-title">{{ $book->title }}</h5>
            <h5 class="card-title">Book Author</h5>
            <h4 class="card-title"> {{ $book->price }}</h4>
            <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        @endforeach
    </div >
@endforeach
