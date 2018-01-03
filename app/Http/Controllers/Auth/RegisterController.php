<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;
use App\Models\Post;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string',
        ]);

      
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
   
    public function store(Request $request)
    {

        $this->validator($request->all())->validate();
        $user = new User;
        $user->firstname = $request->get( 'firstname' );
        $user->lastname = $request->get('lastname' );
        $user->username = $request->get('username' );
        $user->email = $request->get('email' );
        $pass = $user->email.time();

        $password = md5($pass);
        $user->password = bcrypt($password);

        $user->referral = $request->get( 'referral' );
        $user->banned = 0;

        //$user->password_confirmation = $password;
        $user->confirmation_code = $password;
        $trade_key = md5($user->username.$user->email.time());
        $user->trade_key = $trade_key;
       // $user->ip_lastlogin=$this->get_client_ip();
        $user->ip_lastlogin= \Request::ip();
        // Save if valid. Password field will be hashed before save
        $user->save();

        if ( $user->id )
        {
           //Add user role user table.
            $user->addRole('User');
       
            //FOR VERIFY EMAIL
            
            $data_send=array('user' => $user);
            $message ="Testing!!";
            Mail::send('emails.confirmEmail', $data_send, function($message) use ($user)
            {
              $message->to($user->email)->subject('Account Confirmation');

            });

            $data_send=array('user' => $user,'password'=>$password);
            $message ="Testing!!";

            //FOR SEND PASSWORD
            Mail::send('emails.sendpass', $data_send, function($message) use ($user)
            {
              $message->to($user->email)->subject('Your Password');

            });

            $notice ="Your account has been successfully created. Please check your email for the instructions on how to confirm your account.";
            // Redirect with success message
            return Redirect::action('UserController@login')->with('notice', $notice);
        }
        
    }







}
