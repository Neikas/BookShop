<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel">Report Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('report.store', ['book_id' => $book->id])}}">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="password1">{{ $book->title}}</label>
            </div>
            <div class="form-group">
              <label for="password1">Detailed tell us why you report this book</label>
              <textarea type="text" class="form-control"  name="report_text" placeholder="Enter text here" rows="2"></textarea>
            </div>
          </div>
          <div class="modal-footer border-top-0 d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>