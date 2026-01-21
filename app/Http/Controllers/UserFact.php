<?php

namespace App\Http\Controllers;
use App\Fact;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserFact extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $fact = Fact::where('user_id', '=', $user->id)->get();

        return view('user.admin.facts.index', compact('fact'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.facts.create');
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
            'facts' => 'required',
            'number' => 'required',
        ]);

        $user = Auth::user();

        $input = $request->all();

        Fact::create(['user_id'=>$user->id,'fact'=>$input['facts'],'num'=>$input['number']]);

        Session::flash('insert', 'Successfully Uploaded');

        return redirect()->route('user-facts.index');
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
        $fact = Fact::findOrFail($id);

        return view('user.admin.facts.edit', compact('fact'));
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
            'facts' => 'required',
            'number' => 'required',
        ]);

        $user = Auth::user();

        $input = $request->all();

        Fact::findOrFail($id)->update(['fact'=>$input['facts'],'num'=>$input['number']]);

        Session::flash('insert', 'Successfully Updated');

        return redirect()->route('user-facts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fact::findOrFail($id)->delete();

        return redirect()->back();
    }
}
