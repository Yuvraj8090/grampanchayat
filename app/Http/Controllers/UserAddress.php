<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Address;
use Illuminate\Http\Request;

class UserAddress extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $add = Address::where('user_id', '=', $user->id)->where('address', '!=', null)->get();

        return view('user.admin.address.index', compact('add'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.admin.address.create');
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
            'address' => 'required',
            'map' => 'required',
        ]);

        $user = Auth::user();

        $input = $request->all();

        Address::create(['user_id'=>$user->id,'address'=>$input['address'], 'map'=>$input['map']]);

        Session::flash('insert', 'Successfully Uploaded');

        return redirect()->route('user-address.index');
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
        $add = Address::findOrFail($id);

        return view('user.admin.address.edit', compact('add'));
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
            'address' => 'required',
            'map' => 'required',
        ]);

        Address::findOrFail($id)->update($request->all());

        Session::flash('insert', 'Successfully Updated');

        return redirect()->route('user-address.index');
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
