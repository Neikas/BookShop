@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                        <div class="card-header">{{ __('Edite Book') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.book.update', $book) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ __('Book Title') }} </label>
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                    <input type="text" name="title" class="form-control" value="{{  $book->title  }}" placeholder="{{ __('Harry Potter') }}" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ __('Book Author') }} </label>
                                    @if ($errors->has('author'))
                                        <span class="text-danger">{{ $errors->first('author') }}</span>
                                    @endif
                                    <a type="button" data-toggle="tooltip" data-placement="right" title="Seperate Author with comma to add more than one!">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                    <input type="text" name="author" class="form-control" value="{{  $book->authors  }}" placeholder="{{ __('J. K. Rowling, Jack Thorne,') }}" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{ __('Book Genre') }} </label>
                                    @if ($errors->has('genre'))
                                    <span class="text-danger">{{ $errors->first('genre') }}</span>
                                    @endif
                                    <a type="button" data-toggle="tooltip" data-placement="right" title="Seperate Genres with comma to add more than one!">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                    <input type="text" name="genre" class="form-control"  value="{{  $book->genres  }}" placeholder="{{ __('Romance, love, drama') }}" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{ __('Description') }}</label>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                    <textarea id="myTextarea" class="form-control" name="description"  required rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('picture') }}</span>
                                    @endif
                                    <label for="exampleFormControlFile1">{{ __('Cover Picture') }}</label>
                                    <input type="file" name="picture" value="{{ asset( $book->picture) }}" class="form-control-file" >
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('discount'))
                                        <span class="text-danger">{{ $errors->first('discount') }}</span>
                                    @endif
                                    <label for="exampleFormControlFile1">{{ __('Enter discount procent from price') }}</label>
                                    <input type="number" min="0" max="100" name="discount" value="{{  $book->discount}}" class="form-control" >
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('picture') }}</span>
                                    @endif
                                    <label for="exampleFormControlFile1">{{ __('Book Price') }}</label>
                                    <input type="number" min="0.10" step="0.10" name="price"  class="form-control" value="{{   $book->price   }}" placeholder="{{ __('12.99') }}" required >
                                </div>

                                <button type="submit"  class="btn btn-primary btn-lg btn-block"> Post book for approval</button>
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
        document.getElementById("myTextarea").value = "{{   $book->description   }}";
    </script>
@endsection