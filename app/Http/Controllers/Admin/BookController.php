<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\CreateBookRequest;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::Notapproved()->paginate();
    
        return view('admin.book.index')->with('books', $books);
    }
    
    public function approveBook(Book $book)
    {
        $book->update(['approved' => true]);

        return redirect()->route('admin.book.index')->with('meesage', 'Book has been approved!');
    }
    public function edit(Book $book)
    {
        $authors = $book->authors()->get()->implode('author', ',');
        $genres = $book->genres()->get()->implode('genre', ',');

        $book->authors = $authors;
        $book->genres = $genres;
        return view('admin.book.edit')->with('book', $book);
    } 
    public function update(CreateBookRequest $request, Book $book)
    {   
        $request->validate([ 'discount' => 'min:0|max:100']);
        
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
            'approved' => true,
            'discount' => $request->discount
        ]);
        


        return redirect()->route('admin.book.edit', $book)->with('message', 'Book was succesfully updated!');
    }
}
