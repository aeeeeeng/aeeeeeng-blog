<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
      return view("admins.auth.LoginForm");
    }

    public function login(Request $request)
    {
      // validate form
      $this->validate($request, array(
        'email' => 'required|email',
        'password' => 'required|min:6'
      ));
      // attempt to log the user in
      if(Auth::guard('admin')->attempt(['email' => $request->email, 'password'=>$request->password], $request->remember)){
        // if successfull, then redirect to their  intended location
        return redirect()->intended(route('admin.dashboard'));
      }
      // if unsuccessfull, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
      $guard = Auth::guard();
      $guard->logout();
      $request->session()->invalidate();
      //unlink session disini ----
      return redirect("/admin03061993");
    }
}
