<?php

namespace App\Http\Controllers;
use App\Pmsg;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserPmsg extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $msg = Pmsg::where('user_id', '=', $user->id)->get();

        return view('user.admin.pmsg.index', compact('msg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.pmsg.create');
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
            'msg' => 'required',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $input = $request->all();

        $user = Auth::user();

        $file = $request->file('image');

        $name = rand() . '.' . $file->getClientOriginalExtension();

        $file->move('images', $name);

        Pmsg::create(['user_id'=>$user->id,'msg'=>$input['msg'],'image'=>$name]);

        Session::flash('insert', 'Successfully Uploaded');

        return redirect()->route('user-p-message.index');
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
        $msg = Pmsg::findOrFail($id);

        return view('user.admin.pmsg.edit', compact('msg'));
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
        $this->validate($request, [
            'msg' => 'required',
            'image'=>'image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $input = $request->all();

        if ($file = $request->file('image')) 
        {
            $name = rand() . '.' . $file->getClientOriginalExtension();

            $file->move('images', $name);

            Pmsg::findOrFail($id)->update(['msg'=>$input['msg'],'image'=>$name]);
        }
        else
        {
            pmsg::findOrFail($id)->update(['msg'=>$input['msg']]);
        }

        Session::flash('insert', 'Successfully Updated');

        return redirect()->route('user-p-message.index');

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
