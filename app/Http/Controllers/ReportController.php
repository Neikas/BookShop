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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Book $book)
    {   
        if(auth()->user()->admin)
        {
            return redirect()->route('book.show', [ $book ])->with('message', 'Admin user cant report book!');
        }
        $request->validate(['report_text' => 'required' ]);
        $report = Report::create([
            'book_id' => $book->id,
            'user_id' => auth()->id(),
            'report_text' => $request->input('report_text'),

        ]);
        return redirect()->route('book.show', [ $book ])->with('message', 'Success');
    }
    public function reportMessageStore(Request $request, Report $report)
    {
        $request->validate([ 'message' => 'required' ]);

        if( auth()->user()->admin ){

            ReportMessage::create([
                'message' => $request->message,
                'user_id' => auth()->id(),
                'report_id' => $report->id,
                'is_admin' => auth()->user()->admin
            ]);
            return redirect()->route('report.show', [ $report ])->with('message', 'Message set successfuly!');
        }

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
}
