<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Review;
use App\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\CreateBookRequest;

class BookController extends Controller
{   
    public function indexAdminBookUnapproved()
    {
        $books = Book::paginate();

        return view('admin.book.index')->with('books', $books);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookChangeApproved(Book $book, $status)
    {
        $book->update(['approved' => true]);

        return redirect()->route('admin.book.index');
    }


    public function index()
    {
        if(request('search')){
            $search = request('search');
            setcookie('search',$search, time()+60*10);
            session()->flash('search', $search);
        }

        $books = Book::with('authors')
        ->approved()
        ->when(
            request('search'), function($query)
            {
                $search = request('search');

                $query->where( function($query) use ($search) 
                {
                    $query->where('title','LIKE','%'.$search.'%');
                    $query->orWhereHas('authors' ,function($query) use ($search) 
                    {
                        $query->where('author', 'LIKE','%'.$search.'%');
                    });
            })->paginate();
        })
        ->latest('id')
        ->paginate();

        return view('guest.book.index')->with('books', $books);
    }
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.book.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {  
        if($request->hasFile('picture'))
        {
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename =time().'.'.$extension;
            $file->move('uploads/booksCover/', $filename);

            $resizedImage = Image::make( public_path('uploads/booksCover/' . $filename))
            ->fit(400,400)->save();
        }else {
            $filename = 'default.png';
        }

        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'price' => $request->price,
            'picture' => 'uploads/booksCover/'.$filename,
        ]);

        $authors = explode(',',$request->author);
        $genres = explode(',',$request->genre);

        foreach($authors as $author)
        {
            $authorCheck = Author::where('author', $author)->firstOrCreate([ 'author' => $author]);

            $authorCheck->books()->attach($book);
        }
        foreach($genres as $genre)
        {
            $genreCheck = Genre::where('genre', $genre)->firstOrCreate(['genre' => $genre]);

            $genreCheck->books()->attach($book);
        }
            return redirect()->route('userBook')->with('message', 'Book was successfully created!');
    }

    public function getAllUserBooks()
    {
        $books = auth()->user()->books()->paginate();

        return view('user.book.index')->with('books', $books);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $book->loadCount('reviews');

        return view('guest.book.show')->with('book', $book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {

        $authors = $book->authors()->get()->implode('author', ',');
        $genres = $book->genres()->get()->implode('genre', ',');

        $book->authors = $authors;
        $book->genres = $genres;

        return view('user.book.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBookRequest $request, Book $book)
    {
        if($request->hasFile('picture'))
        {
            if(File::exists( public_path($book->picture)) )
            {
                File::delete(public_path($book->picture));
            }
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename =time().'.'.$extension;
            $file->move('uploads/booksCover/', $filename);

            $resizedImage = Image::make( public_path('uploads/booksCover/' . $filename))
            ->fit(400,400)->save();
        }else {
            $filename = str_replace('uploads/booksCover/', '', $book->picture);
        }

        $authors = explode(',',$request->author);
        $genres = explode(',',$request->genre);      

        $book->authors()->detach();
        $book->genres()->detach();

        foreach($authors as $author)
        {   
            $authorCheck = Author::where('author', $author)->firstOrCreate([ 'author' => $author]);

            $authorCheck->books()->attach($book);
        }
        foreach($genres as $genre)
        {
            $genreCheck = Genre::where('genre', $genre)->firstOrCreate([ 'genre' => $genre]);

            $genreCheck->books()->attach($book);
        }
        
        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'picture' => 'uploads/booksCover/'. $filename,
        ]);

        return redirect()->route('book.edit', $book->id)->with('message', 'Book was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->authors()->detach();
        $book->genres()->detach();
        //add delete picture from book if had
        if($book->picture != 'uploads/booksCover/default.png'){
            if(File::exists( public_path($book->picture)) )
            {
                File::delete(public_path($book->picture));
            }
        }

        $book->delete();
        return redirect()->route('admin.book.index')->with('message', 'Success');
    }
}
