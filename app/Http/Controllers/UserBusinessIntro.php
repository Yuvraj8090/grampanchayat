<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Business;
use Illuminate\Http\Request;

class UserBusinessIntro extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $add = Business::where('user_id', '=', $user->id)->where('intro', '!=', null)->get();

        return view('user.admin.business-intro.index', compact('add'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.business-intro.create');

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
            'intro' => 'required',
        ]);

        $user = Auth::user();

        $input = $request->all();

        Business::create([

            'user_id' => $user->id,
            'intro' => $input['intro'],
        ]);

        Session::flash('insert', 'Successfully Uploaded');

        return redirect()->route('user-business-intro.index');
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
        $add = Business::findOrFail($id);

        return view('user.admin.business-intro.edit', compact('add'));
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
            'intro' => 'required',
        ]);

        Business::findOrFail($id)->update($request->all());

        Session::flash('insert', 'Successfully Updated');

        return redirect()->route('user-business-intro.index');
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
