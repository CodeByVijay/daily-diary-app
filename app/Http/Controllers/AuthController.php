<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $req)
    {
        $req->validate([
            'pass' => 'required|same:con_pass',
            'con_pass' => 'required',
        ], [
            'pass.required' => 'Password not blank.',
            'con_pass.required' => 'Confirm Password not blank.',
            'pass.same' => 'Password & Confirm Password pass must match.'
        ]);

        $user = new User();
        $user->name = $req->name;
        $user->email = $req->username;
        $user->password = Hash::make($req->pass);
        $user->save();
        return redirect()->route('login')->with('success', 'Registration Successfully Completed.');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            return redirect()->route('user.home');
        } else {
            return redirect()->route('login')
                ->with('error', 'Email-Address And Password Are Wrong.');
        }
    }
}
