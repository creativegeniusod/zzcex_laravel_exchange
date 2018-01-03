<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Hash;
use Config;
use App;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected $maxLoginAttempts = 10; // Amount of bad attempts user can make
    //protected $lockoutTime = 300; // Time for which user is going to be blocked in seconds

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       /* $this->middleware('guest')->except('logout');*/
    }


    public function do_login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $remember_me = $request->has('remember') ? true : false; 

        if(Auth::guard('web')->attempt(['email' => $email, 'password' => $password],$remember_me) || Auth::guard('web')->attempt(['username' => $email, 'password' => $password],$remember_me))
        {
            $user_id = Auth::user()->id;
            if(User::find($user_id)->hasRole('Admin'))
            {
            return Redirect::to('admin');
            }else {
            return Redirect::to('user/profile')->with( 'notice', "Welcome to cryptoexchange. You can now start Trading." ); 
            }
        }else{
            return back() ->with( 'notice', "Email or password is invalid." );
        }
    }



    public function firstAuth(){
        $input = array(
                    'email'    => Input::get( 'email' ), // May be the username too
                    'username' => Input::get( 'email' ), // so we have to pass both
                    'password' => Input::get( 'password' ),
                );
        $user = User::where('email','=',Input::get( 'email' ))->orwhere('username','=',Input::get( 'email' ))->first();

        if(!empty($user->banned ==1)){
            echo json_encode(array('status'=>'error','message'=>Lang::get('messages.you_was_banned')));
            exit;
        }

        if(!empty($user->confirmed == 0))
        {
            echo json_encode(array('status'=>'error','message'=>'Your account may not be confirmed. Check your email for the confirmation link'));
            exit;
        }

        if(isset($user->password) && Hash::check(Input::get( 'password' ), $user->password)){

            if(!empty($user->authy)) {

                $authcontroller = new app('App\Http\Controllers\AuthController');
                $auth_controller = app('App\Http\Controllers\AuthController')->getAuthy();
                $requestSms = $auth_controller->requestSms($user->authy);
               /*
                $auth_controller = app('App\Http\Controllers\AuthController')->getAuthy();
                $requestSms =  $auth_controller->requestSms($user->authy);*/
                // echo "<pre>errors: "; print_r($requestSms->errors()); echo "</pre>";
                // echo "<pre>requestSms: "; print_r($requestSms); echo "</pre>";
                if($requestSms->ok()){
                    echo json_encode((array)$requestSms->ok()+array('status'=>'two_login', 'authy_id'=>$user->authy));
                    exit;
                }else{//not_sent_token
                    echo json_encode((array)$requestSms->errors()+array('status'=>'error'));
                    exit;
                }

            }else{
                  echo json_encode($input + array('status'=>'one_login_success','signup_confirm'=>Config::get('signup_confirm')));
                    exit;
            }
        }else{

            echo json_encode(array('status'=>'error','message'=> trans('messages.not_match_user')));
            exit;
        }
    }


}
