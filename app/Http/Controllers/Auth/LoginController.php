<?php
  
namespace App\Http\Controllers\Auth;
   
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
   
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
        $this->middleware('guest')->except('logout');
    }
   
    public function login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->UserType == "admin") {
                $now = Carbon::now();
                $restricteds = DB::table('users')
                    ->select()
                    ->where('userType', '=' ,'restricted')
                    ->get();
                foreach ($restricteds as $restricted) {
                    $end = Carbon::parse($restricted->created_at);
                    $length = $end->diffInDays($now);
                    if ($length >= 365) {
                        $delete = User::find($restricted->UserID);
                        $delete->delete();
                    }
                }
                return redirect()->route('admin.home');
            }else if(auth()->user()->UserType == "user"){
                $now = Carbon::now();
                $restricteds = DB::table('users')
                    ->select()
                    ->where('userType', '=' ,'restricted')
                    ->get();
                foreach ($restricteds as $restricted) {
                    $end = Carbon::parse($restricted->created_at);
                    $length = $end->diffInDays($now);
                    if ($length >= 365) {
                        $delete = User::find($restricted->UserID);
                        $delete->delete();
                    }
                }
                return redirect()->route('home');
            }else{
                return redirect()->route('login');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }
}