<?php

namespace App\Http\Controllers;
use App\Intro;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserIntro extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $intro = Intro::where('user_id', '=', $user->id)->get();

        return view('user.admin.intro.index', compact('intro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.intro.create');
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
            'introduction' => 'required',
        ]);

        $input = $request->all();

        $user = Auth::user();

        Intro::create(['user_id'=>$user->id,'intro'=>$input['introduction']]);

        Session::flash('insert', 'Successfully Uploaded');

        return redirect()->route('user-introduction.index');
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
        $intro = Intro::findOrFail($id);

        return view('user.admin.intro.edit', compact('intro'));
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
            'introduction' => 'required',
        ]);

        $input = $request->all();

        Intro::findOrFail($id)->update(['intro'=>$input['introduction']]);

        Session::flash('insert', 'Successfully Updated');

        return redirect()->route('user-introduction.index');
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
