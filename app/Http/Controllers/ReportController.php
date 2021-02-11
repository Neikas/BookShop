<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Book;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $reports = Report::where('user_id', '=', $user_id)->paginate(20);
        return view('book.reports.index')->with('reports', $reports);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $book_id)
    {
        $book = Book::where('id', '=', $book_id)->firstOrFail();

        if($book == null )
        {
            return abort(404);
            //return redirect()->route('book.show',[$book_id])->with('message', 'error');
        }else{
            $request->validate([
                'report_text' => 'required',
            ]);
            Report::create([
                'book_id' => $book_id,
                'user_id' => auth()->user()->id,
                'report_text' => $request->report_text,
    
            ]);
            return redirect()->route('book.show', [ $book ])->with('message', 'Success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
