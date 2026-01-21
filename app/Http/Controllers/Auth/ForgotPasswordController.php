<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
     * Show the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {   
    
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmailCustom(Request $request) 
    {
        if ($request->api) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);
    
            if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
            }
        }
        else{
              $this->validateEmail($request);
        }
        
        $user = User::where('email',$request->only('email'))->first();
        

        if(!$user){
            if($request->api){
                return response()->json(['status' => 'Email not exist!.']);
            }else{
                return back()->with('status','Email not exist!.');
            }
        }
        
        // Create a password reset token
        $token = Password::getRepository()->create($user);
        
        // Generate the reset link URL
        $resetLink = URL::to(route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ]));
        

        $to = $user->email; // Replace with the recipient's email address
        $subject = "Foget Password Mail.";
                
        $message = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Password Reset</title>
        </head>
        <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
        
            <table style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 10px;">
                <tr>
                    <td style="text-align: center;">
                    <h5> UK PATHSHALA</h5>
                        <img src="https://example.com/logo.png" alt="Your Logo" style="max-width: 150px;">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>Password Reset Request</h2>
                        <p>Hello,</p>
                        <p>We received a request to reset your password. If you did not make this request, please ignore this email.</p>
                        <p>To reset your password, click the button below:</p>
                        <p>
                            <a href="'.$resetLink.'" 
                            style="background-color: #007bff; color: #ffffff; padding: 10px 20px; text-decoration: none; 
                            border-radius: 5px; font-weight: bold;">Reset Password</a>
                        </p>
                        <p>If you have any issues, you can copy and paste the following URL into your browser:</p>
                        <p>'.$resetLink.'</p>
                        <p>This link will expire in 1 hour for security reasons.</p>';
                $headers = "Content-Type: text/html; charset=UTF-8"; // Replace with your email address
                // Send the email
                $mailSent = mail($to, $subject, $message, $headers);
                
                
                // if ($request->api) {
                         return response()->json(['status' => 'Change email link sent to your email successfully.']);
                // }
                return back()->with('status','Change email link sent to your email successfully.');
        

    }
     
    public function sendResetLinkEmail(Request $request)
    {
  
        $this->validateEmail($request);
        
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );
    
        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }
    
}
