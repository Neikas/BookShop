@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                        <div class="card-header">{{ __('Add Book to store') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ __('Book Title') }} </label>
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                    <input type="text" name="title" class="form-control" value="{{  old('title')  }}" placeholder="{{ __('Harry Potter') }}" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ __('Book Author') }} </label>
                                    @if ($errors->has('author'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                    <a type="button" data-toggle="tooltip" data-placement="right" title="Seperate Author with comma to add more than one!">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                    <input type="text" name="author" class="form-control" value="{{  old('author')  }}" placeholder="{{ __('J. K. Rowling, Jack Thorne,') }}" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ __('Book Gender') }} </label>
                                    @if ($errors->has('gender'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                    <a type="button" data-toggle="tooltip" data-placement="right" title="Seperate Genders with comma to add more than one!">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                    <input type="text" name="gender" class="form-control" value="{{  old('gender')  }}" placeholder="{{ __('Romance, love, drama') }}" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{ __('Description') }}</label>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                    <textarea class="form-control" name="description" value="{{   old('description')   }}" required rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('picture') }}</span>
                                    @endif
                                    <label for="exampleFormControlFile1">{{ __('Cover Picture') }}</label>
                                    <input type="file" name="picture" class="form-control-file" >
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('picture') }}</span>
                                    @endif
                                    <label for="exampleFormControlFile1">{{ __('Book Price') }}</label>
                                    <input type="number" min="1" step="0.10" name="price"  class="form-control" value="{{  old('price')  }}" placeholder="{{ __('12.99') }}" required >
                                </div>

                                <button type="submit"  class="btn btn-primary btn-lg btn-block"> Post book to listing</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endsection