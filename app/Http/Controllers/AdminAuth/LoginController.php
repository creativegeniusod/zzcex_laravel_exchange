<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
     //Trait
    use AuthenticatesUsers;

    //Where to redirect seller after login.
    protected $redirectTo = 'admin/admin_home';

    //Trait
    use AuthenticatesUsers;

    //Custom guard for seller
    protected function guard()
    {
      return Auth::guard('admin');
    }

    //Shows seller login form
    public function showLoginForm()
    {
     return view('admin.login');
    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('admin/admin_home');
    }


    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
  
        if(Auth::guard('admin')->attempt(['email' => $email, 'password' => $password]))
        { 
            $user_id = Auth::guard('admin')->user()->id; 
           
            if(User::find($user_id)->hasRole('Admin'))
              { 
                  return redirect('admin/admin_home');
              }else {
                die('password incorrect');
              }

          }else{
          die('not!!!');
          }
    }

}

