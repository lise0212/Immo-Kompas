<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;




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
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function validateUser(Request $request){
        if($request->has('email', 'password')){
            //$password = Hash::make($request[$request->password]);
            $paswoord= DB::table('users')
            ->select('password')
            ->where("email", "=", "$request->email")
            ->get();

            $user = DB::table('users')
            ->where("email", "=", "$request->email")
            ->where("password", "=", Hash::check("$request->password", $paswoord))
            ->get();

            if(count($user) == 1){
                return $user;
            }
            else{
                return $user;
            }
        }
    }

    public function getUsers(){
        return DB::table('users')
            ->select('email')
            ->get();
    }


}
