<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            // 'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verify_token' => base64_encode($data['email']),
        ]);

     
        $email = new EmailVerification($user);
        Mail::to($user->email)->send($email);
        return $user;
    }

    public function showForm($email_token) {
          // ??????????????????????????????
          if ( !User::where('email_verify_token',$email_token)->exists() )
          {
              return view('auth.main.register')->with('message', '???????????????????????????????????????????????????????????????????????????');
          } else {
              $user = User::where('email_verify_token', $email_token)->first();
              // ??????????????????????????????
              if ($user->status == config('Const.USER_STATUS.REGISTER')) //REGISTER=1
              {
                  logger("status". $user->status);
                    return view('auth.main.register')->with('message', '????????????????????????????????????????????????????????????????????????????????????');
              }
              // ?????????????????????????????????
       
              $user->status = config('Const.USER_STATUS.MAIL_AUTHED');
              if($user->save()) {
                  return view('auth.main.register', compact('email_token'));
              } else{
                  return view('auth.main.register')->with('message', '????????????????????????????????????????????????????????????????????????????????????????????????????????????');
              }
          }
    }

    public function mainRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
          ]);
        $user = User::where('email_verify_token',$request->email_token)->first();
        $user->status = config('Const.USER_STATUS.REGISTER');
        $user->name = $request->name;
        $user->save();
        return view('auth.main.registered');
    }
}
