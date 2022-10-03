<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

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

    public function store(Request $request){
       $expense = new Expense();
       $expense->user_id = auth()->user()->id;
       $expense->date = $request->expense_date;
       $expense->expense_desc = $request->expense_desc;
       $expense->expense = $request->expense_price;
       $expense->save();
       return redirect()->back()->with('success','Expense Created.');
    }
}
