<?php

namespace App\Http\Controllers;
//namespace App\Http\Controllers\Auth;

use App\VerifyUser;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\User;
class RegistraionController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware(['auth'=>'verified']);
////        $this->middleware(['auth'=>'verified']);
//    }
//    use AuthenticatesUsers;
//    protected $redirectTo = '/askme';
////
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }

    public function create(){
        return view('Register');
    }
    public function store(Request $request){
        request()->validate([
            'name'=>'required',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:8|confirmed',
            'g-recaptcha-response' => new Captcha(),
        ]);
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        DB::insert("insert into users(`name`,email,password,created_at) values (?,?,?,?)",[$name, $email, $password,now()]);
//        $user = DB::table('users')->get();
//        //        DB::table('users')->truncate();
//        $verifyUser = VerifyUser::create([
//            'user_id'=>$user->id,
//            'token'=>str_random(40);
//        ]);
//        Mail::to($user->email)->send(new VerifyMail($user));
//
        return redirect()->to('login')
            ->with(['success' => 'Congratulations! your account is registered, you will shortly receive an email to activate your account.']);
    }
    public function login(){
         $data = Input::except(array('_token'));
         $rule = array(
             'email'=>'required|email',
             'password'=>'required'
         );
         $validator = Validator::make($data,$rule);
         if($validator->fails()){
             return redirect()->action('Qacontroller@login')->withErrors($validator);
         }else{
             $userdata = array(
                 'email'=>Input::get('email'),
                 'password'=>Input::get('password')
             );
             if(Auth::attempt($userdata)){
                 return redirect()->action('Qacontroller@index')->with('status','kkk');
             }
             else{
                 return redirect()->to('login')->withErrors('$validator');
             }
         }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('google_id', $user->id)->first();
            $user->token;
            if($finduser){

                Auth::login($finduser);

                return redirect('/askme');

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id
                ]);

                Auth::login($newUser);

                return redirect('/askme');
            }

        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }
}
