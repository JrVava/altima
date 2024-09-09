<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }  

    public function postLogin(Request $request)
    {
        $request->validate([
            'emp_code' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('emp_code', 'password');
        
        if (Auth::attempt($credentials)) {
            if(Auth::user()->hasRole('Admin')){
                return redirect()->route('dashboard')->withSuccess('You have Successfully loggedin');
            }else{
                return redirect()->route('user-form')->withSuccess('You have Successfully loggedin');
                
            }
                        
        }
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
  
        return Redirect('/');
    }
}
