<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Gender;
use Illuminate\Http\Request;

class BookController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth')->except('index');
        $this->middleware('auth')->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::simplePaginate(25);

        return view('main')->with('books', $books);
    }
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.addBook');
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
        }

        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'price' => $request->price,
            'picture' => 'uploads/booksCover/'.$filename,
        ]);

        $authors = explode(',',$request->author);
        $genders = explode(',',$request->gender);

        foreach($authors as $author)
        {
            $authorCheck = Author::where('author','=', $author)->first();
            if ($authorCheck === null)
            {   
                $authorCheck = Author::create(['author'=> $author]);
            }
            $authorCheck->books()->attach($book);
        }
        foreach($genders as $gender)
        {
            $genderCheck = Gender::where('gender','=', $gender)->first();
            if ($genderCheck === null)
            {
                $genderCheck =  Gender::create(['gender'=> $gender]);
            }
            $genderCheck->books()->attach($book);
        }
            return redirect()->route('book.create')->with('message', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.singleBook')->with('book', $book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
        /**
     * Display book my id from list
     *
     * @param  \App\Models\Book  $book
     * @param  $id 
     * @return \Illuminate\Http\Response
     */
}
