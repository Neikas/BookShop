@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="row justify-content-center">
            <h4> My reported books</h2>
    </div>
@if(count($reports) < 1)
<div class="row justify-content-center">
    <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">No records found!</h4>
      <hr>
      <p>Aww yeah, we didn't founded any repor tof yours! ; ()</p>
    </div>
</div>
@endif

@foreach ($reports->chunk(5) as $chunk)
    <div class="row justify-content-center">
        @foreach ($chunk as $report)
            <div class="col-3 mt-2 md-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $report->book->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ \Carbon\Carbon::parse($report->created_at)->format('d/m/Y')}}</h6>
                        <p class="card-text">{{ $report->report_text }}</p>
                        <a href="{{ route('report.show', [$report ]) }}" class="card-link">Open</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endforeach



@endsection