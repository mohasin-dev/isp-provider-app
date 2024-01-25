<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;

class ReportController extends Controller
{
    public function expenseReport(){
        return view('expenseReport');
    }
    public function expenseReportResult(Request $request){
        // print_r($request->all());
        // dd();
        //Reservation::whereBetween('reservation_from', [$from, $to])->get();
        $expenseReports = Expense::whereBetween('created_at',[$request->from_date, $request->to_date])->get();
        $sum = $expenseReports->sum('amount');
        $from = $request->from_date;
        $to = $request->to_date;
        //echo $sum;
        //dd();
        return view('expenseReport', compact('expenseReports', 'sum', 'from', 'to'));
    }
}
