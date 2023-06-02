<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

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

    protected function attemptLogin(Request $request)
    {
        $user = User::where('email', $request->username)->orWhere('username', $request->username)->first();

        if($user){
            if (Auth::attempt(['username' => $user->username, 'password' => $request->password]) || Auth::attempt(['email' => $user->email, 'password' => $request->password])){
                Auth::loginUsingId($user->id);
                return redirect('/home');
            } else {
                throw ValidationException::withMessages([$this->username() => __('Invalid credentials. Please try again.')]);
            }
        } else {
            throw ValidationException::withMessages([$this->username() => 'Invalid credentials. Please try again.']);
        }
    }

    public function username()
    {
        return 'username';
    }
}
