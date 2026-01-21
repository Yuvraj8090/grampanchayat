<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function resetCustom(Request $request){
        
        $this->validate($request,[
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
        
         $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );
        
        if ($response == 'passwords.token') {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Password reset successful'], 200);
            } else {
                return redirect()->route('login')->with('status', 'Your password has been reset! You can now log in.');
            }
        }
        
        // Handle failure differently for API and web requests
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Password reset failed'], 422);
        } else {
            return redirect()->back()->with('error', 'Password reset failed.');
        }
        
    
    }

}
