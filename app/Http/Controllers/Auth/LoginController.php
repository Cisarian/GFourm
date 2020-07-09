<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    public function changePassword($user_id)
    {
        dd('hit1');
        $user = App\User::where('id', $user_id)->first();
        
        $validateData = request()->validate([
            'user' => 'required|unique:User',
            'password' => 'required|required_with:password_confirmation|confirmed|min:8',
        ]);
        
        $user -> name = $validateData;
        $user -> password = Hash::make($validateData['password']);
        $user -> save();
        return redirect(route('home'));
    }
}
