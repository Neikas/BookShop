@extends('layouts.app')

@section('content')




@foreach ($reports->chunk(5) as $chunk)
<div class="row">
    @foreach ($chunk as $report)
        <div class="col-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                <h5 class="card-title">Book title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Report date</h6>
                <p class="card-text">Report text</p>
                <a href="#" class="card-link">Open</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endforeach



@endsection