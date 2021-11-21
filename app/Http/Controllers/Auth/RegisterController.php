<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect()->route('login')->with('success','Registered successfully. You may now Log In.');
    }
     
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
            'firstname' => ['required', 'string', 'min:3', 'max:255','regex:/^[a-zA-Z ]+$/'],
            'lastname' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[a-zA-Z ]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'confirmed'],
            'contactNo' => ['required','regex:/(09)[0-9]{9}/','min:11'],
            'emContactNo' => ['required','regex:/(09)[0-9]{9}/','min:11']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {   
        if(User::exists()){
            return User::create([
                'FirstName' => $data['firstname'],
                'LastName' => $data['lastname'],
                'email'=> $data['email'],
                'UserType' => 'user',
                'password' => Hash::make($data['password']),
                'ContactNo'=>$data['contactNo'],
                'EmContactNo'=>$data['emContactNo'],
            ]);
        }else{
            return User::create([
                'FirstName' => $data['firstname'],
                'LastName' => $data['lastname'],
                'email'=> $data['email'],
                'UserType' => 'admin',
                'password' => Hash::make($data['password']),
                'ContactNo'=>$data['contactNo'],
                'EmContactNo'=>$data['emContactNo'],
            ]);
        }
        
    }
}
