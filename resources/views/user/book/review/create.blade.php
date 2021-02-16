<div class="col-12 justify-content-center">
    <div class="card">
        <div class="card-body text-center">
            <h4 class="card-title">Leave Rview</h4>
        </div>
        <div class="comment-widgets">
            <!-- Comment Row -->
                <form method="Post" action="{{ route('review.store', ['book' => $book]) }}"> 
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Your rating</label>
                        @csrf
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
                        <div class="col-md-12">
                        <textarea class="form-control" id="message" name="comment" placeholder="Please enter your feedback here..." rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="d-flex justify-content-center">
                        <div class="col-6">
                          <button type="submit" class="btn-danger btn-block">Submit</button>
                        </div>
                      
                      </div>
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