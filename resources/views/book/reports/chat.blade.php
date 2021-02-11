@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <h3>Report Messeging</h3>
</div>
<div class="row justify-content-center">
    <div class="col-6 mt-2 md-2">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $report->book->title }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ \Carbon\Carbon::parse($report->created_at)->format('d/m/Y')}}</h6>
                <p class="card-text">{{ $report->report_text }}</p>
            </div>
        </div>
    </div>
</div>
    <div class="row justify-content-center rounded">
        <div class="col-8 p-4 m-2 bg-warning text-dark rounded">
            @foreach ($report->reportMessages as $message)
                @if ($message->is_admin)
                <div class="p-2 rounded bg-danger text-white">
                    <div class="msg-wrap">
                        <div class="media msg">
                            <div class="media-body">
                                <small class="pull-right time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($message->created_at)->isoFormat('dddd, MMMM Do YYYY, h:mm')}}</small>
                                <h5 class="media-heading"><p class="text-primary"> Adminsitrator </p>{{ $message->user->name}}</h5>
                                <p class="col-lg-6">{{ $message->message}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="p-2 m-2 rounded bg-white text-dark">
                    <div class="msg-wrap">
                        <div class="media msg">
                            <div class="media-body">
                                <small class="pull-right time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($message->created_at)->isoFormat('dddd, MMMM Do YYYY, h:mm')}}</small>
                                <h5 class="media-heading">{{ $message->user->name}}</h5>
                                <p class="col-lg-6">{{ $message->message}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
  
            <form method="POST" action="{{ route('report.message.store', ['report_id' => $report->id ])}}">
                @csrf
                <div class="send-wrap ">
                    <textarea class="form-control send-message" name="message" rows="3" placeholder="Write a message..."></textarea>
                </div>
                <div class="btn-panel">
                    <button type="submit" class="col-lg-12 text-center mt-1 btn-block btn-primary" role="button"><i class="fa fa-plus"></i> Send Message</button>
                </div>
            </form>
        </div>
    </div>
@endsection