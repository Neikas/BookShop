<div class="col-12">
    <div class="card">
        <div class="card-body text-center">
            <h4 class="card-title">Leave Rview</h4>
        </div>
        <div class="comment-widgets">
            <!-- Comment Row -->
                <form method="Post" action="{{ route('review.store', ['book_id' => $book->id, 'user_id' => auth()->user()->id ]) }}"> 
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Your rating</label>
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $book->id }}"/>
                        <div class="col-md-9">
                            <div class="rating">
                            
                             <label>
                                <input type="radio" name="stars" value="1" />
                                <span class="icon">★</span>
                              </label>
                              <label>
                                <input type="radio" name="stars" value="2" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                              </label>
                              <label>
                                <input type="radio" name="stars" value="3" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>   
                              </label>
                              <label>
                                <input type="radio" name="stars" value="4" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                              </label>
                              <label>
                                <input type="radio" name="stars" value="5" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                              </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Your message</label>
                        <div class="col-md-9">
                        <textarea class="form-control" id="message" name="comment" placeholder="Please enter your feedback here..." rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn">Submit</button>
                    </div>
                </form>
        </div> <!-- Card -->
    </div>
</div>

<script>
    $(':radio').change(function() {
console.log('New star rating: ' + this.value);
});

</script>