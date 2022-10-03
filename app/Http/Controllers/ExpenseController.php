<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home()
    {
        return view('home');
    }

    public function expenseDetails()
    {
        // $expenses = DB::table('expenses')->where('user_id',auth()->user()->id)->whereMonth('date', date('m'))->whereYear('date', date('Y'))->get(['date', 'expense_desc', 'expense']);

        $expenses = Expense::where('user_id',auth()->user()->id)->whereMonth('date', date('m'))->whereYear('date', date('Y'))->select('date')
        ->groupBy('date')
        ->get();

        $expenseSum = DB::table('expenses')->where('user_id', auth()->user()->id)->whereMonth('date', date('m'))->whereYear('date', date('Y'))->sum('expense');
        return view('getExpense', compact('expenses', 'expenseSum'));
    }

    public function filterExpense(Request $request)
    {
        if ($request->expense_start_date != '' && $request->expense_end_date != '') {
            $from = $request->expense_start_date;
            $to = $request->expense_end_date;

            // $expenses = DB::table('expenses')->where('user_id', auth()->user()->id)->whereBetween('date', [$from, $to])->orderBy('date', 'asc')->get(['date', 'expense_desc', 'expense']);

            $expenses = Expense::where('user_id',auth()->user()->id)->whereBetween('date', [$from, $to])->select('date')
        ->groupBy('date')->orderBy('date', 'asc')
        ->get();

            $expenseSum = DB::table('expenses')->where('user_id', auth()->user()->id)->whereBetween('date', [$from, $to])->orderBy('date', 'asc')->sum('expense');
        }
        return view('getExpense', compact('expenses', 'expenseSum'));
    }



    public function store(Request $request)
    {
        $expense = new Expense();
        $expense->user_id = auth()->user()->id;
        $expense->date = $request->expense_date;
        $expense->expense_desc = $request->expense_desc;
        $expense->expense = $request->expense_price;
        $expense->save();
        return redirect()->back()->with('success', 'Expense Created.');
    }
}
