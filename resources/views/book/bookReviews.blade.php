<h4 class="card-title">Latest Rviews</h4>
@foreach ( $book->reviews as $review)
    <div class="col-lg-12">
        <div class="card">
            <div class="comment-widgets">
                <!-- Comment Row -->
                <div class="d-flex flex-row comment-row m-t-0">
                    <div class="comment-text w-100">
                        <h6 class="font-medium">{{ $review->author }}</h6> 
                        <span class="m-b-15 d-block">{{ $review->comment }}</span>
                        <div class="comment-footer"> <span class="text-muted float-right">{{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y')}}</span> </div>
                    </div>
                </div> <!-- Comment Row -->
            </div> <!-- Card -->
        </div>
    </div>
    
@endforeach


