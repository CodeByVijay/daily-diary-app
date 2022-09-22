<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function register(Request $req){
        $req->validate([
            'pass'=>'required|same:con_pass',
            'con_pass'=>'required',
        ]);
    }
}
