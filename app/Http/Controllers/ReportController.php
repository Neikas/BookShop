<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Book;
use App\Models\ReportMessage;
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
        if(auth()->user()->admin)
        {
            $reports = Report::paginate(15);
            
        }else{
            $reports = Report::where('user_id', '=', $user_id)->paginate(20);
        }
        return view('book.reports.index')->with(['reports'=> $reports , ]);
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
            $report = Report::create([
                'book_id' => $book_id,
                'user_id' => auth()->user()->id,
                'report_text' => $request->report_text,
    
            ]);
            $book->report_id = $report->id;
            $book->save();
            return redirect()->route('book.show', [ $book ])->with('message', 'Success');
        }
    }
    public function reportMessageStore(Request $request, Report $report)
    {
        $report = $report->firstOrFail();
        //check if this report created by this user
        if($report->user_id == auth()->user()->id)
        {
            $request->validate([
                'message' => 'required',
            ]);
            ReportMessage::create([
                'message' => $request->message,
                'user_id' => auth()->user()->id,
                'report_id' => $report->id,
            ]);
            return redirect()->route('report.show', [ $report ])->with('message', 'Message set successfuly!');
        }
        elseif( auth()->user()->admin ){
            $request->validate([
                'message' => 'required',
            ]);
            ReportMessage::create([
                'message' => $request->message,
                'user_id' => auth()->user()->id,
                'report_id' => $report->id,
                'is_admin' => auth()->user()->admin
            ]);
            return redirect()->route('report.show', [ $report ])->with('message', 'Message set successfuly!');
        }
            return abort(403);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        
        return view('book.reports.chat')->with('report',$report);
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
