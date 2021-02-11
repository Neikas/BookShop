@extends('layouts.app')

@section('content')
@foreach ($reports->chunk(5) as $chunk)
    <div class="row justify-content-center">
        @foreach ($chunk as $report)
            <div class="col-2 mt-2 md-2">
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
@endforeach



@endsection