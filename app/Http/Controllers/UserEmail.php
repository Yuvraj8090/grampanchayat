<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Email;
use Illuminate\Http\Request;

class UserEmail extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $email = Email::where('user_id', '=', $user->id)->get();

        return view('user.admin.email.index', compact('email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.email.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'to' => 'required',
            'subject' => 'required|max:200',
            'message' => 'required',
            'file' => 'mimes:jpeg,png,jpg,docx,ppt,xlsx|max:2000',
        ]);

        $user = Auth::user();

        $input = $request->all();

        if ($file = $request->file('file')) 
        {
            $name = rand() . '.' . $file->getClientOriginalExtension();

            $file->move('images', $name);

            Email::create([

                'user_id' => $user->id,
                'to' => $input['to'],
                'subject' => $input['subject'],
                'file' => $name,
                'msg' => $input['message'],
            ]);

            $to = $input['to'];
            $subject = $input['subject'];
            $htmlContent = "".$input['message']." <br/><a href='http://grampanchayat.con/images/".$input['file']."' download>Download Attachment</a>";
            $headers = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type:text/html;charset=UTF-8' . "\r\n" .
            'From: '.$input['name'].' <contact@addressguru.in>' . "\r\n" .
            'Reply-To: '.$input['name'].' <contact@addressguru.in>' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            $mail = mail($to, $subject, $htmlContent, $headers);
        }
        else
        {   
            Email::create([

                'user_id' => $user->id,
                'to' => $input['to'],
                'subject' => $input['subject'],
                'msg' => $input['message'],
            ]);

            $to = $input['to'];
            $subject = $input['subject'];
            $htmlContent = $input['message'];
            $headers = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type:text/html;charset=UTF-8' . "\r\n" .
            'From: '.$input['name'].' <contact@addressguru.in>' . "\r\n" .
            'Reply-To: '.$input['name'].' <contact@addressguru.in>' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            $mail = mail($to, $subject, $htmlContent, $headers);
        }

        Session::flash('insert', 'Successfully Sent');

        return redirect()->route('user-email.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
