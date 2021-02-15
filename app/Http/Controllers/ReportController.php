<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Book;
use App\Models\ReportMessage;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->admin)
        {
            $reports = Report::paginate();

            return view('user.book.report.index')->with([ 'reports' => $reports  ]);
        }

        $reports = auth()->user()->reports()->paginate();
        
        return view('user.book.report.index')->with([ 'reports' => $reports ]);
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
        $book = Book::where('id', $book_id)->firstOrFail();

        $request->validate(['report_text' => 'required']);

        $report = Report::create([
            'book_id' => $book_id,
            'user_id' => auth()->id(),
            'report_text' => $request->input('report_text'),

        ]);

        return redirect()->route('book.show', [ $book ])->with('message', 'Success');
    }
    public function reportMessageStore(Request $request, Report $report)
    {
        if( auth()->user()->admin ){

            $request->validate([ 'message' => 'required' ]);

            ReportMessage::create([
                'message' => $request->message,
                'user_id' => auth()->id(),
                'report_id' => $report->id,
                'is_admin' => auth()->user()->admin
            ]);

            return redirect()->route('report.show', [ $report ])->with('message', 'Message set successfuly!');
        }

        $request->validate([ 'message' => 'required' ]);

        ReportMessage::create([
            'message' => $request->message,
            'user_id' => auth()->id(),
            'report_id' => $report->id,
        ]);

        return redirect()->route('report.show', [ $report ])->with('message', 'Message set successfuly!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return view('user.book.report.chat.index')->with('report', $report);
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
